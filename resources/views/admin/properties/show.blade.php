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
        <h1 class="mb-4">{{ strtoupper($property->name) }}</h1>

        <div id="carouselExampleControls" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($property->property_images as $key => $image)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="max-height: 500px;">
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
        <h1>{{ $property->address }}</h1>
        <p> <span class="strong">DESCRIZIONE:</span>  {{$property->description}}</p>
        <div class="info">
            <div>NUMERO LETTI: {{ $property->bed_count }}</div>
            <div>NUMERO STANZE DA LETTO: {{ $property->bedroom_count }}</div>
            <div>NUMERO BAGNI: {{ $property->bathroom_count }}</div>
        </div>


        <ul class="list-group">
            @if(count($property->services) > 0)
            <li class="list-group-item">SERVIZI OFFERTI:</li>
            @endif
            @foreach ($property->services as $service)
            <li class="list-group-item">{{ $service->name }}</li>
            @endforeach
        </ul>
        <div>PROPRIETARIO: {{ $property->user->first_name}}</div>

    </div>

@endsection
