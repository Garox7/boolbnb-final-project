<?php

namespace App\Http\Controllers\Api;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::where('status', 1 )
            ->with([
                'property_images' => function ($query) {
                    $query->select('id', 'property_id', 'image');
                },
            ])
            ->select('id', 'address', 'bed_count', 'bathroom_count')
            ->get();
        return response()->json([
            'success' => true,
            'results' => $properties,
        ]);
    }
}
