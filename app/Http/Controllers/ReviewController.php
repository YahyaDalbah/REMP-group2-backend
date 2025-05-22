<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     * This method returns all reviews from the database.
     */
    public function index()
    {
        // Get all reviews from the database
        $reviews = Review::all();
    
        // Return the reviews as a JSON response
        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     * This method validates the request and creates a new review.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'property_id' => 'required|integer|exists:properties,id',
            'user_id' => 'required|integer|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // Create a new review and save it to the database
        $review = \App\Models\Review::create($validated);

        // Return the newly created review as a JSON response
        return response()->json($review, 201);
    }

    /**
     * Display the specified resource.
     * This method returns a single review by its ID.
     */
    public function show(string $id)
    {
        // Find the review by its ID
        $review = \App\Models\Review::find($id);

        // If the review is not found, return an error message
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        // Return the review as a JSON response
        return response()->json($review);
    }

    /**
     * Update the specified resource in storage.
     * This method updates an existing review with new data.
     */
    public function update(Request $request, string $id)
    {
        // Find the review by its ID
        $review = \App\Models\Review::find($id);

        // If the review is not found, return an error message
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
            'rating' => 'sometimes|required|integer|min:1|max:5',
        ]);

        // Update the review with the validated data
        $review->update($validated);

        // Return the updated review as a JSON response
        return response()->json($review);
    }

    /**
     * Remove the specified resource from storage.
     * This method deletes a review by its ID.
     */
    public function destroy(string $id)
    {
        // Find the review by its ID
        $review = \App\Models\Review::find($id);

        // If the review is not found, return an error message
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        // Delete the review from the database
        $review->delete();

        // Return a success message as a JSON response
        return response()->json(['message' => 'Review deleted successfully']);
    }
}
