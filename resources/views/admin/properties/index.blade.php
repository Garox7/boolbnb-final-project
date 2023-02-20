@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($properties as $property)
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$property->name}}</h5>
              <p class="card-text">{{$property->description}}</p>
              <a href="{{route('admin.properties.show', ['property'=>$property])}}" class="btn btn-primary">show</a>
            </div>

          </div>   
        @endforeach
        
    </div>
</div>
@endsection