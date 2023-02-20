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
        $properties = Property::with('property_images')->get();

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
        // validazione
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'address' => 'required|string|max:255',
            'bedroom_count' => 'required|integer|max:20',
            'bed_count' => 'required|integer|max:20',
            'bathroom_count' => 'required|integer|max:20',
        ]);

        $data = $request->all();
        $userId = User::with('properties')->get('id')->all();

        // salvataggio dati
        $property = new Property();
        $property->name = $data['name'];
        $property->description = $data['description'];
        $property->user_id = $userId['id'];
        $property->address = $data['address'];
        $property->bedroom_count = $data['bedroom_count'];
        $property->bed_count = $data['bed_count'];
        $property->bathroom_count = $data['bathroom_count'];
        $property->save();

        //redirezionamento
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
