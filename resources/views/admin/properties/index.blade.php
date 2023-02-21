@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row g-3">
        @foreach ($properties as $property)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100">
                @if($property->property_images->first())
                    <img src="{{ asset('storage/' . $property->property_images->first()->image) }}" class="card-img-top img-fluid" style="object-fit: cover; width: 100%; height: 200px;" alt="{{ $property->name }}">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $property->name }}</h5>
                    <p class="card-text flex-grow-1">{{ $property->description }}</p>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('admin.properties.show', ['property' => $property])}}" class="btn btn-primary w-100">Mostra</a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.properties.edit', ['property' => $property])}}" class="btn btn-warning w-100">Modifica</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
