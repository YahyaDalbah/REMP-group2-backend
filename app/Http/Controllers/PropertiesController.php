<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
class PropertiesController extends Controller
{
    public function index(){
        return Property::all();
    }
    public function store(Request $request){
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'image' => 'required|string',
            'owner_id' => 'required|exists:users,id',
            'isForRent' => 'required|boolean',
            'isForSale' => 'required|boolean',
            "status" => "required|string"
        ]);

        $property = Property::create($fields);
        return $property;
    }
    public function show($id){
        
        $property = Property::findOrFail($id);
        return $property;
        
    }
    public function update(Request $request, $id){
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'image' => 'required|string',
            'owner_id' => 'required|exists:users,id',
            'isForRent' => 'required|boolean',
            'isForSale' => 'required|boolean',
            "status" => "required|string"
        ]);

        $property = Property::findOrFail($id);

        $property->update($fields);
        return $property;
    }
    public function destroy($id){
        $property = Property::findOrFail($id);
        $property->delete();
        return ['message' => 'property deleted', 'data' => $property];
    }
    
}
