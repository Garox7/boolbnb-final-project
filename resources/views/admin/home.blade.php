@extends('admin.layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="dashboard-container">
    <h1>Account</h1>
    <p><span>{{ Auth::user()->first_name }}, {{ Auth::user()->last_name }}</span>, {{ Auth::user()->email }}</p>
    <p><a href="{{ route('admin.properties.index') }}">vai alle proprietà</a></p>

    <button>
        <a class="drop-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </button>
</div>

@endsection



{{-- {{ Auth::user()->first_name }} --}}
