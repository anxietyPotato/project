@php use App\Http\forecastsAdminHelper\forecastsAdminHelper; @endphp
@extends('layout')

@section('content')
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
                                @php $forecast = $city->oneForecast; @endphp

                                @if($forecast)
                                    <div class="d-flex align-items-center gap-2 text-white-50">
                                        <div class="fs-4">
                                            {!! forecastsAdminHelper::getWeatherIcon($forecast->weather_type) !!}
                                        </div>
                                        <div>{{ ucfirst($forecast->weather_type) }}</div>
                                    </div>
                                @else
                                    <div class="text-white-50">No forecast</div>
                                @endif
                            </div>

                            <!-- Heart Button on the Right -->
                            <form method="POST" action="{{ route('city.favorite',['city'=>$city->id]) }}">
                                @csrf
                                <input type="hidden" name="city_id" value="{{ $city->id }}">
                                <button type="submit" style="background:none; border:none; color:white; font-size:1.5rem; cursor:pointer;">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach

            @else
                <p class="text-center">No cities found.</p>
            @endif





@endsection
