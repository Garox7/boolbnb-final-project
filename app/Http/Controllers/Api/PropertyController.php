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

    public function store(Request $request)
    {
        // Validazione
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:100|unique:properties',
            'description' => 'string',
            'address' => 'required|string|max:255',
            'bedroom_count' => 'required|integer|min:1|max:20',
            'bed_count' => 'required|integer|min:1|max:20',
            'bathroom_count' => 'required|integer|min:1|max:20',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Crea la nuova proprietà
        $property = new Property();
        $property->name = $data['name'];
        $property->slug = $data['slug'];
        $property->description = $data['description'];
        $property->address = $data['address'];
        $property->bedroom_count = $data['bedroom_count'];
        $property->bed_count = $data['bed_count'];
        $property->bathroom_count = $data['bathroom_count'];
        $property->user_id = auth()->id();
        $property->save();

        // Salvataggio delle immagini
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('uploads');
                $propertyImage = new PropertyImages();
                $propertyImage->property_id = $property->id;
                $propertyImage->image = $path;
                $propertyImage->save();
            }
        }

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

    public function edit($property)
    {
        $property = Property::where('slug', $property)
            ->with(['property_images' => function ($query) {
                $query->select('id', 'property_id', 'image');
            }])
            ->select('id', 'name', 'description', 'address', 'bedroom_count', 'bathroom_count','bed_count', 'slug')
            ->first();

        return response()->json([
            'success' => true,
            'results' => $property
        ]);
    }

    public function update(Request $request, Property $property)
    {
         // Validazione
         $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:100|unique:properties',
            'description' => 'string',
            'address' => 'required|string|max:255',
            'bedroom_count' => 'required|integer|min:1|max:20',
            'bed_count' => 'required|integer|min:1|max:20',
            'bathroom_count' => 'required|integer|min:1|max:20',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Crea la nuova proprietà
        $property->name = $data['name'];
        $property->slug = $data['slug'];
        $property->description = $data['description'];
        $property->address = $data['address'];
        $property->bedroom_count = $data['bedroom_count'];
        $property->bed_count = $data['bed_count'];
        $property->bathroom_count = $data['bathroom_count'];
        $property->user_id = auth()->id();
        $property->update();

        // Salvataggio delle immagini
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('uploads');
                $propertyImage = new PropertyImages();
                $propertyImage->property_id = $property->id;
                $propertyImage->image = $path;
                $propertyImage->save();
            }
        }

        return response()->json($property, 201);
    }

    public function destroy(Property $property)
    {
        //
    }
}
