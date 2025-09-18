@extends('layout')

@section('content')

    @if(session('error'))
        <div class="alert alert-danger text-center mt-3">
            {{ session('error') }}
        </div>


    @endif

    @if(session('message'))
        <div class="alert alert-warning text-center mt-3">
            {{ session('message') }}
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center vh-100 bg-dark text-white">
        <div class="text-center w-100" style="max-width: 400px;">
            <div class="mb-4">
                <i class="fas fa-home fa-2x"></i>
                <h2 class="mt-2">Find Your City</h2>
            </div>



            <form action="{{ route('search.cities') }}" method="get">
                <input type="text" name="city" class="form-control mb-3" placeholder="Enter city name">
                <button type="submit" class="btn btn-primary w-100">🔍 Search</button>
            </form>

        </div>
    </div>
@endsection




