<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Property;
use App\PropertyImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $properties = Property::where('user_id', $user->id)
            ->with('property_images')
            ->get();
        return view('admin.properties.index', [
            'properties' => $properties,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        // Salvataggio dati
        $property = new Property();
        $property->name = $data['name'];
        $property->description = $data['description'];
        $property->user_id = auth()->id();
        $property->address = $data['address'];
        $property->bedroom_count = $data['bedroom_count'];
        $property->bed_count = $data['bed_count'];
        $property->bathroom_count = $data['bathroom_count'];
        $property->save();

        // Controllo e salvataggio immagini
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('uploads');
                $propertyImage = new PropertyImages();
                $propertyImage->property_id = $property->id;
                $propertyImage->image = $path;
                $propertyImage->save();
            }
        }

        // Redirezionamento
        return redirect()
            ->route('admin.properties.show', ['property' => $property])
            ->with('success_created', $property);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return view('admin.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'address' => 'required|string|max:255',
            'bedroom_count' => 'required|integer|max:20',
            'bed_count' => 'required|integer|max:20',
            'bathroom_count' => 'required|integer|max:20',
        ]);

        $data = $request->all();

        // salvataggio dati
        $property->name = $data['name'];
        $property->description = $data['description'];
        $property->user_id = auth()->id();
        $property->address = $data['address'];
        $property->bedroom_count = $data['bedroom_count'];
        $property->bed_count = $data['bed_count'];
        $property->bathroom_count = $data['bathroom_count'];
        $property->update();

        // redirezionamento
        return redirect()
            ->route('admin.properties.show', ['property' => $property])
            ->with('success_updated', $property);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->property_images()->delete();
        $property->visits()->delete();
        $property->services()->detach();
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success_delete', $property);
    }
}
