@extends('layout')

@section('content')
    <div class="container-fluid min-vh-100 bg-dark text-white py-5">
        <div class="container">
            <h3 class="text-center mb-4">Search Results for "{{ $cityName }}"</h3>

            @if($cities->count())
                <div class="row g-3">
                    @foreach($cities as $city)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card bg-primary text-white text-center shadow-sm h-100">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <h5 class="card-title mb-0">{{ $city->name }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else

                <p class="text-center">No cities found.</p>
            @endif
        </div>
    </div>
@endsection
