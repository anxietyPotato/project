@php use App\Http\forecastsAdminHelper\forecastsAdminHelper; @endphp
@extends('layout')

@section('content')
    <div class="container-fluid min-vh-100 bg-dark text-white py-5">
        <div class="container">
            <h3 class="text-center mb-4">Search Results for "{{ $cityName }}"</h3>

            @if($cities->count())
                <div class="row g-3">
                    @foreach($cities as $city)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm bg-primary text-white">
                                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                                    <!-- City Name -->
                                    <h5 class="card-title mb-3">{{ $city->name }}</h5>

                                    @php
                                        $forecast = $city->oneForecast;
                                    @endphp

                                    @if($forecast)
                                        <!-- Mini Container for Forecast -->
                                        <div class="w-100 p-3 rounded bg-light text-dark text-center">
                                            <!-- Weather Icon -->
                                            <div class="fs-2 mb-2">
                                                {!! forecastsAdminHelper::getWeatherIcon($forecast->weather_type) !!}
                                            </div>

                                            <!-- Weather Type -->
                                            <div class="fw-semibold mb-1">
                                                {{ ucfirst($forecast->weather_type) }}
                                            </div>

                                            <!-- Temperature -->
                                            <div class="fw-bold"
                                                 style="color: {{ forecastsAdminHelper::getColorByTemperature($forecast->temperature) }}">
                                                {{ $forecast->temperature }}°C
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-white-50">No forecast</div>
                                    @endif
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
