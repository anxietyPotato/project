@php use App\Http\forecastsAdminHelper\forecastsAdminHelper; @endphp


@extends('layout')

@section('content')

    {{-- Error message --}}
    @if(session('error'))
        <div class="alert alert-danger text-center mt-3">
            {{ session('error') }}
        </div>
    @endif

    {{-- Info message --}}
    @if(session('message'))
        <div class="alert alert-warning text-center mt-3">
            {{ session('message') }}
        </div>
    @endif

    <div class="d-flex flex-column justify-content-center align-items-center vh-100 bg-dark text-white">

        {{-- FAVORITES PANEL ON TOP --}}
        @if($favorites->count())
            <div class="favorites-bar text-white p-3 rounded-3 mb-5"
                 style="min-width: 600px; max-width: 90%;">

                {{-- Title --}}
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <i class="fa-solid fa-star text-warning me-2"></i>
                    <h5 class="mb-0 fw-bold">Favorite Cities</h5>
                </div>

                {{-- Favorites row --}}
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    @foreach($favorites as $fav)
                        @php $forecast = $fav->city->oneForecast; @endphp
                        <form action="{{ route('search.cities') }}" method="get">
                            <input type="hidden" name="city" value="{{ $fav->city->name }}">
                            <button type="submit" class="favorite-card">
                                <div class="fw-bold text-capitalize mb-1">{{ $fav->city->name }}</div>

                                @if($forecast)
                                    <div class="d-flex align-items-center gap-2 justify-content-center">
                                        {{-- Weather icon --}}
                                        @if(is_array($forecast->condition))
                                            {!! forecastsAdminHelper::getWeatherIconFromApi($forecast->condition) !!}
                                        @else
                                            {!! forecastsAdminHelper::getWeatherIcon($forecast->weather_type ?? 'unknown') !!}
                                        @endif

                                        {{-- Colored temperature --}}
                                        @php
                                            $color = forecastsAdminHelper::getColorByTemperature($forecast->temperature);
                                        @endphp
                                        <strong style="color: {{ $color }};">
                                            {{ $forecast->temperature }}°C
                                        </strong>
                                    </div>
                                @endif
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- SEARCH BOX --}}
        <div class="text-center w-100" style="max-width: 400px;">
            <div class="mb-4">
                <i class="fas fa-home fa-2x"></i>
                <h2 class="mt-2">Find Your City</h2>
            </div>

            <form action="{{ route('search.cities') }}" method="get">
                <input type="text" name="city" class="form-control mb-3 text-center"
                       placeholder="Enter city name"
                       style="border-radius: 6px; border: none; height: 40px; background-color: #111; color: #fff;">
                <button type="submit" class="btn w-100"
                        style="background-color: #222; color: white; border: none; border-radius: 6px;">
                    🔍 Search
                </button>
            </form>
        </div>
    </div>

    {{-- Custom Styles --}}
    <style>
        /* Search input styling */
        .form-control {
            border-radius: 10px;
            border: none;
            height: 45px;
            background: #1a1a1a; /* slightly lighter than background */
            color: #fff;
            font-size: 16px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.5);
        }

        .form-control::placeholder {
            color: #888;
        }

        .form-control:focus {
            outline: none;
            background: #222; /* darken on focus */
            box-shadow: 0 0 8px #333;
        }

        /* Search button styling */
        .btn {
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #222, #111);
            color: #fff;
            height: 45px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0,0,0,0.5);
        }

        .btn:hover {
            background: linear-gradient(135deg, #333, #111);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.6);
        }
    </style>

@endsection
