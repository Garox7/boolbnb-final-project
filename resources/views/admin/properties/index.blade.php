@extends('admin.layouts.app')
@section('content')
    @if(session('success_delete'))
        <div class="container py-4">
            <div class="alert alert-danger">
                La tua proprietà "{{ session('success_delete')->name }}" è stata eliminata.
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row g-3">
            @foreach ($properties as $property)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    @if($property->property_images->first())
                        <img src="{{ asset('storage/' . $property->property_images->first()->image) }}" class="card-img-top img-fluid" style="object-fit: cover; width: 100%; height: 200px;" alt="{{ $property->name }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold fs-4 text-center">{{ strtoupper($property->name) }}</h5>
                        <p class="card-text flex-grow-1">{{ $property->description }}</p>
                        <div class="row">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('admin.properties.show', ['property' => $property])}}" class="btn btn-outline-primary w-100"><span class="fs-5 fw-bold">Mostra</span></a>
                                <a href="{{ route('admin.properties.edit', ['property' => $property])}}" class="btn btn-outline-primary w-100"><span class="fs-5 fw-bold">Modifica</span></a>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-danger w-100 mt-2 delete-button" data-id="{{ $property->slug }}"><span class="fs-5 fw-bold">Elimina</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- Popup di eliminazione  --}}
    @include('admin.partials.delete-popup')
@endsection
