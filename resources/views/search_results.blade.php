@php use App\Http\forecastsAdminHelper\forecastsAdminHelper; @endphp
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
    @csrf
    <div class="container-fluid min-vh-100 bg-dark text-white py-5">
        <div class="container">
            <h3 class="text-center mb-4">Search Results for "{{ $cityName }}"</h3>

            @if($cities->count())
                <div class="d-flex flex-column gap-3">
                    @foreach($cities as $city)
                        <div class="d-flex justify-content-between align-items-center bg-primary text-white px-4 py-3 rounded shadow-sm">
                            <div class="d-flex flex-column">
                                <h5 class="mb-1">{{ $city->name }}</h5>
                                <a href="{{ route('forecast.view', ['cityPrognoza' => $city->name]) }}"
                                   class="btn btn-sm btn-warning mt-2">
                                    🌦 View Forecast
                                </a>



                                @php $forecast = $city->oneForecast; @endphp

                                <div class="fs-4">
                                    @if($forecast)
                                        @if(is_array($forecast->condition))
                                            {!! forecastsAdminHelper::getWeatherIconFromApi($forecast->condition) !!}
                                        @else
                                            {!! forecastsAdminHelper::getWeatherIcon($forecast->weather_type) !!}
                                        @endif
                                    @else
                                        <span class="text-warning">No forecast available</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Heart Button on the Right -->
                            <form method="POST" action="{{ route('city.favorite',['city'=>$city->id]) }}">
                                @csrf
                                <button type="submit" style="background:none; border:none; color:white; font-size:1.5rem; cursor:pointer;">
                                    <i class="{{ in_array($city->id, $cityfavorites) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                </button>
                            </form>


                        </div>

                    @endforeach

            @else
                <p class="text-center">No cities found.</p>
            @endif





@endsection
