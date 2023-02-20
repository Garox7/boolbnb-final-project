@extends('layouts.app')

@section('content')
    @if(session('success_created'))
        <div class="container py-4">
            <div class="alert alert-warning">
                La tua proprietà "{{ session('success_created')->name }}" è stato creata con successo!
            </div>
        </div>
    @endif
    <div class="container">
        <h1 class="card-title">{{$property->name}}</h1>
        <p class="card-text">{{$property->description}}</p>
    </div>
@endsection
