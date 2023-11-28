<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destinations;

class DestinationController extends Controller
{
    public function createDestination(Request $request) {
        $data = $request->validate([
            'place' => 'min:3',
            'distance' => 'max:500|required',
            'price' => 'numeric',
            'duration' => 'nullable',
            'image' => 'nullable|unique:destinations',
            'description' => 'max:500'
        ]);
        $destination = Destinations::create($data);

        return response()->json(['message' => 'Successfully created','data' => $destination]);
    }

    public function getAll(Request $request) {
        $destinations = Destinations::all();

        return response()->json([
            'data' => $destinations
        ]);
    }

    public function getOne(Request $request, int $id) {
        $destination = Destinations::find(['id' => $id]);

        return response()->json([
            'data' => $destination
        ]);
    }

    public function deleteDestination(Request $request, int $id) {
        $destination = Destinations::find(['id' => $id]);
        $destination->each->delete();

        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }

    public function updateDestination(Request $request, int $id) {
        $destination = Destinations::find(['id' => $id]);
        $validated = $request->validate([
            'place' => 'min:3',
            'distance' => 'max:500|required',
            'price' => 'numeric',
            'duration' => 'nullable',
            'image' => 'nullable|unique:destinations',
            'description' => 'max:500'
        ]);
        $updated = $destination->each->update($validated);

        return response()->json([
            'message' => 'Successfully updated',
            'data' => $updated
        ]);
    }
}
