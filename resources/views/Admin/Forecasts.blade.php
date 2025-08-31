@extends('Admin.layout')
@section('content')
    @php
        use App\Http\forecastsAdminHelper\forecastsAdminHelper;
        use App\Models\CitiesPrognoza;
        use Carbon\Carbon;
    @endphp
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('forecast.update') }}">
        @csrf

        <!-- Cities select -->
        <label for="city_id">City:</label>
        <select name="city_id" id="city_id">
            @foreach(CitiesPrognoza::all() as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>

        <!-- Weather type select -->
        <label for="weather_type">Weather Type:</label>
        <select name="weather_type" id="weather_type">
            @foreach($weatherTypes as $type)
                <option value="{{ trim($type, ',') }}">{{ ucfirst(trim($type, ',')) }}</option>
            @endforeach
        </select>

        <!-- Temperature -->
        <label for="temperature">Temperature (°C):</label>
        <input type="number" step="0.1" name="temperature" id="temperature" required>

        <!-- Humidity -->
        <label for="humidity">Humidity (%):</label>
        <input type="number" step="0.1" name="humidity" id="humidity" required>

        <!-- Forecast date -->
        <label for="Forecast_date">Forecast Date:</label>
        <input type="date" name="Forecast_date" id="Forecast_date" required>

        <!-- Probability -->
        <label for="probability">Probability (%):</label>
        <input type="number" step="1" min="0" max="100" name="probability" id="probability">

        <button type="submit">Update Forecast</button>
    </form>

    <style>
        .highlight {
            background-color: #fff3cd; /* Bootstrap table-warning */
            transition: background-color 2s ease;
        }
        .highlight.fade-out {
            background-color: transparent !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const updatedRow = document.getElementById('updated-forecast');
            if (updatedRow) {
                updatedRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                updatedRow.classList.add('highlight');

                // Fade out after 3 seconds
                setTimeout(() => {
                    updatedRow.classList.add('fade-out');
                }, 3000);

                // Cleanup classes after 5 seconds
                setTimeout(() => {
                    updatedRow.classList.remove('highlight', 'fade-out');
                }, 5000);
            }
        });
    </script>

    <div class="container mt-4">
        <div class="row">
            @foreach($cities as $city)
                <div class="col-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $city->name }}</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Weather</th>
                                        <th>Temp (°C)</th>
                                        <th>Humidity (%)</th>
                                        <th>Probability (%)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($city->forecasts as $forecast)
                                        @php
                                            $color = forecastsAdminHelper::getColorByTemperature($forecast->temperature);
                                        @endphp
                                        <tr id="{{ $forecast->id == ($updatedForecastId ?? null) ? 'updated-forecast' : '' }}">
                                            <td>{{ Carbon::parse($forecast->Forecast_date)->format('Y-m-d') }}</td>
                                            <td>
                                                <i class="{{ forecastsAdminHelper::getWeatherIcon($forecast->weather_type) }}"></i>
                                                {{ ucfirst($forecast->weather_type) }}
                                            </td>
                                            <td style="color: {{ $color }}">{{ $forecast->temperature }}</td>
                                            <td>{{ $forecast->humidity }}</td>
                                            <td>{{ $forecast->probability ?? 'N/A' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No forecasts yet.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ✅ fixed Font Awesome link -->

@endsection
