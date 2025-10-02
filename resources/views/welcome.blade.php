@extends('layout')

@section('content')

    {{-- Display error messages if any --}}
    @if(session('error'))
        <div class="alert alert-danger text-center mt-3">
            {{ session('error') }}
        </div>
    @endif

    {{-- Display success/info messages --}}
    @if(session('message'))
        <div class="alert alert-warning text-center mt-3">
            {{ session('message') }}
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center vh-100 bg-dark text-white">

        {{-- Main search box --}}
        <div class="text-center w-100" style="max-width: 400px;">
            <div class="mb-4">
                <i class="fas fa-home fa-2x"></i>
                <h2 class="mt-2">Find Your City</h2>
            </div>

            {{-- Search form for cities --}}
            <form action="{{ route('search.cities') }}" method="get">
                <input type="text" name="city" class="form-control mb-3" placeholder="Enter city name">
                <button type="submit" class="btn btn-primary w-100">🔍 Search</button>
            </form>
        </div>

        {{-- Favorites sidebar - only show if user has favorites --}}
        @if($favorites->count())
            <div class="bg-primary text-white rounded shadow-sm p-3 ms-4"
                 style="width: 220px; max-height: 70vh; overflow-y: auto;">

                {{-- Sidebar title --}}
                <h5 class="mb-3 text-center">⭐ Favorites</h5>

                {{-- List of favorites --}}
                <ul class="list-unstyled mb-0">
                    @foreach($favorites as $fav)
                        <li class="mb-2">
                            <form action="{{ route('search.cities') }}" method="get">
                                <input type="hidden" name="city" value="{{ $fav->city->name }}">

                                @php $forecast = $fav->city->oneForecast;   @endphp

                                <button type="submit" class="btn btn-sm btn-light w-100 d-flex justify-content-between align-items-center">
                                    <span>{{ $fav->city->name }}</span>

                                    @if($forecast)
                                        <span class="d-flex align-items-center gap-1">
    @if(is_array($forecast->condition))
                                                {!! \App\Http\forecastsAdminHelper\forecastsAdminHelper::getWeatherIconFromApi($forecast->condition) !!}
                                            @else
                                                <i class="fa-solid fa-question-circle text-muted"></i>
                                            @endif
                                            {{ $forecast->temperature }}°C
</span>
                                    @endif

                                </button>
                            </form>
                        </li>
                    @endforeach

                </ul>
            </div>
        @endif
    </div>
@endsection





