@extends('admin.layouts.app')

@section('content')
    @if(session('success_created'))
        <div class="container py-4">
            <div class="alert alert-success">
                La tua proprietà "{{ session('success_created')->name }}" è stata creata con successo.
            </div>
        </div>
    @elseif (session('success_updated'))
        <div class="container py-4">
            <div class="alert alert-success">
                La tua proprietà "{{ session('success_updated')->name }}" è stata modificata.
            </div>
        </div>
    @endif

    <div class="container">
        <h1 class="mb-4">{{$property->name}}</h1>

        <div id="carouselExampleControls" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($property->property_images as $key => $image)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="max-height: 600px;">
                        <img src="{{ asset('storage/' . $image->image) }}" class="d-block w-100" style="object-fit: cover; width: 100%;" alt="{{ $property->name }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <p class="card-text">{{$property->description}}</p>
    </div>
@endsection
