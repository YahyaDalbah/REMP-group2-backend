<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PropertiesController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:available,rented,sold'
        ]);
        
        $query = Property::query();

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
        
        //only show current user's properties when using "mine" filter
        if ($request->has('mine')) {
            $query->where('owner_id', Auth::id());
        }

        return $query->get();
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'image' => 'required|string',
            'images' => 'required|array',
            'isForRent' => 'required|boolean',
            'isForSale' => 'required|boolean',
            "status" => "required|string"
        ]);

        if(Auth::id() == null){
            return response()->json("unauthorized action", 403);
        }
        $fields['owner_id'] = Auth::id();

        $property = Property::create($fields);
        return response()->json($property, 201);
    }

    public function show($id)
    {
        return Property::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        

        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'image' => 'required|string',
            'images' => 'required|array',
            'isForRent' => 'required|boolean',
            'isForSale' => 'required|boolean',
            "status" => "required|string"
        ]);

        $property->update($fields);
        return $property;
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        
        if ($property->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        $property->delete();
        return response()->json(['message' => 'Property deleted']);
    }
    public function uploadImages (Request $request) {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        $urls = [];
        
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                try {
                    $path = $file->store('properties', 'public');
                    $url = Storage::disk('public')->url($path);
                    $urls[] = asset($url);
                } catch (\Exception $e) {
                    Log::error("Image upload failed: " . $e->getMessage());
                    continue;
                }
            }
        }

        return response()->json(['urls' => $urls]);
    }
}