<?php

namespace App\Http\Controllers\Api;

use App\Property;
use App\PropertyImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $properties = Property::where('user_id', $user->id) // TODO: filtrare in base allo status
            ->with('property_images')
            ->get();
            return response()->json([
                'success' => true,
                'results' => $properties,
            ]);
    }

    public function guestIndex()
    {
        $properties = Property::with(['property_images' => function ($query) {
            $query->select('id', 'property_id', 'image');
        }])->select('id', 'bathroom_count', 'bed_count', 'bedroom_count', 'address', 'slug')
        ->get();

        return response()->json([
            'succes' => true,
            'results' => $properties
        ]);
    }

    public function create()
    {
        //
    }

    public function store($request)
    {
        // Validazione
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'address' => 'required|string|max:255',
            'bedroom_count' => 'required|integer|min:1|max:20',
            'bed_count' => 'required|integer|min:1|max:20',
            'bathroom_count' => 'required|integer|min:1|max:20',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Crea la nuova proprietà
        $property = Property::create($data);
        $data['user_id'] = auth()->user()->id;

        // Salvataggio delle immagini
        // if ($request->hasFile('image')) {
        //     foreach ($request->file('image') as $image) {
        //         $path = $image->store('uploads');
        //         $propertyImage = new PropertyImages();
        //         $propertyImage->property_id = $property->id;
        //         $propertyImage->image = $path;
        //         $propertyImage->save();
        //     }
        // }

        return response()->json($property, 201);
    }

    public function show($property)
    {
        // TODO: ottimizzare se possibile
        $property = Property::where('slug', $property)
            ->with(['property_images' => function ($query) {
                $query->select('id', 'property_id', 'image');
            }])
            ->with(['user' => function ($query) {
                $query->select('id', 'first_name', 'last_name', 'email', 'about');
            }])
            ->first();
        if ($property) {
            return response()->json([
                'success' => true,
                'results' => $property,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function edit(Property $property)
    {
        //
    }

    public function update(Request $request, Property $property)
    {
        //
    }

    public function destroy(Property $property)
    {
        //
    }
}
