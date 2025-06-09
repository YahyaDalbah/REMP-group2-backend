<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    
    public function index()
    {
        
        $reviews = Review::all();
    
        
        return response()->json($reviews);
    }

  
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'property_id' => 'required|integer|exists:properties,id',
            'user_id' => 'required|integer|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        
        $review = \App\Models\Review::create($validated);

        
        return response()->json($review, 201);
    }

  
    public function show(string $id)
    {
      
        $review = \App\Models\Review::find($id);

        
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        
        return response()->json($review);
    }

    
    public function update(Request $request, string $id)
    {
        
        $review = \App\Models\Review::find($id);

        
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
            'rating' => 'sometimes|required|integer|min:1|max:5',
        ]);

        
        $review->update($validated);

        
        return response()->json($review);
    }

    
    public function destroy(string $id)
    {
        $review = \App\Models\Review::find($id);

      
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        
        $review->delete();

      
        return response()->json(['message' => 'Review deleted successfully']);
    }
}
