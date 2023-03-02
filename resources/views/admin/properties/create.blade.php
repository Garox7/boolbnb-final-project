@extends('admin.layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('admin.properties.store') }}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf()

        {{-- NAME --}}
        <div class="mb-3">
            <label for="name" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
            <div class="invalid-feedback">
                @error('name')
                    <ul>
                        @foreach ($errors->get('name') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
        </div>

        {{-- ADDRESS --}}
        <div class="mb-3">
            <label for="address" class="form-label">address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
            <div class="invalid-feedback">
                @error('address')
                    <ul>
                        @foreach ($errors->get('address') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
        </div>

        {{-- BEDROOM --}}
        <div class="mb-3">
            <label for="bedroom_count" class="form-label">Numero camere da letto</label>
            <select class="form-select @error('bedroom_count') is-invalid @enderror" aria-label="Default select example" id="bedroom_count" name="bedroom_count">
                <option value="">Seleziona il numero di camere da letto</option>
                @for($i = 1; $i <= 20; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <div class="invalid-feedback">
                @error('bedroom_count')
                    <ul>
                        @foreach ($errors->get('bedroom_count') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
        </div>

        {{-- BED --}}
        <div class="mb-3">
            <label for="bed_count" class="form-label">Numero di letti</label>
            <select class="form-select @error('bed_count') is-invalid @enderror" aria-label="Default select example" id="bed_count" name="bed_count">
                <option value="">Seleziona il numero di posti letto</option>
                @for($i = 1; $i <= 20; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <div class="invalid-feedback">
                @error('bed_count')
                    <ul>
                        @foreach ($errors->get('bed_count') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
        </div>

        {{-- BATHROOM  --}}
        <div class="mb-3">
            <label for="bathroom_count" class="form-label">Numero di bagni</label>
            <select class="form-select @error('bathroom_count') is-invalid @enderror" aria-label="Default select example" id="bathroom_count" name="bathroom_count">
                <option value="">Seleziona il numero di bagni</option>
                @for($i = 1; $i <= 20; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <div class="invalid-feedback">
                @error('bathroom_count')
                    <ul>
                        @foreach ($errors->get('bathroom_count') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
        </div>

        {{-- SERVICE --}}
        @foreach($services as $service)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$service->id}}" id="service{{$service->id}}" name="services[]">
                <label class="form-check-label" for="service{{$service->id}}">{{$service->name}}</label>
            </div>
        @endforeach
        

        

        {{-- FILE IMAGE --}}
        <div id="image-preview"></div>
        <div id="image-fields">
            <div class="mb-3">
                <label for="image" class="form-label">Seleziona una o più immagini</label>
                <input type="file" class="form-control" id="image" name="image[]" multiple>
            </div>
        </div>
        {{--<button type="button" id="add-image" class="btn btn-secondary mb-3 d-none">Aggiungi immagine</button>--}}
        @if ($errors->has('image') || $errors->has('image.*'))
            <ul>
                @foreach ($errors->get('image') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{-- DESCRIPTION --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
            <div class="invalid-feedback">
                @error('description')
                    <ul>
                        @foreach ($errors->get('description') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary text-light" type="submit">Crea proprietà</button>
        </div>
    </form>
</div>
@endsection
