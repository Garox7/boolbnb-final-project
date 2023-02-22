<?php

namespace App\Http\Controllers\Api;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('property_images')->get();
        return response()->json([
            'success' => true,
            'results' => $properties,
        ]);
    }
}
