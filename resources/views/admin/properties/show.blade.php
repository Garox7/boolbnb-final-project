@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="card-title">{{$property->name}}</h1>
    <p class="card-text">{{$property->description}}</p>
</div>
@endsection
