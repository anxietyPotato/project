

    @php
        use App\Models\CitiesPrognoza;
        use Carbon\Carbon;
    @endphp
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    {{-- Bootstrap Icons CDN (if not already included in layout) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container my-4">
        <form method="POST" action="{{ route('weather.update') }}" class="card p-4 shadow-sm mb-5">

        @csrf
            <h4 class="mb-3">Update Forecast</h4>

            <!-- Cities select -->
            <div class="mb-3">
                <label for="city_id" class="form-label">City:</label>
                <select name="city_id" id="city_id" class="form-select">
                    @foreach(CitiesPrognoza::all() as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Weather type select -->
            <div class="mb-3">
                <label for="weather_type" class="form-label">Weather Type:</label>
                <select name="weather_type" id="weather_type" class="form-select">
                    @foreach($weatherTypes as $type)
                        <option value="{{ trim($type, ',') }}">{{ ucfirst(trim($type, ',')) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Temperature -->
            <div class="mb-3">
                <label for="temperature" class="form-label">Temperature (°C):</label>
                <input type="number" step="0.1" name="temperature" id="temperature" class="form-control" required>
            </div>

            <!-- Humidity -->
            <div class="mb-3">
                <label for="humidity" class="form-label">Humidity (%):</label>
                <input type="number" step="0.1" name="humidity" id="humidity" class="form-control" required>
            </div>

            <!-- Forecast date -->
            <div class="mb-3">
                <label for="Forecast_date" class="form-label">Forecast Date:</label>
                <input type="date" name="Forecast_date" id="Forecast_date" class="form-control" required>
            </div>

            <!-- Probability -->
            <div class="mb-3">
                <label for="probability" class="form-label">Probability (%):</label>
                <input type="number" step="1" min="0" max="100" name="probability" id="probability" class="form-control">
            </div>

            <button type="submit" class="btn btn-success w-100">Update Forecast</button>
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

        <hr class="my-5">

        <div class="row g-4">
            @foreach($cities as $city)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-center text-success">{{ $city->name }}</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm text-center align-middle">
                                    <thead class="table-success">
                                    <tr>
                                        <th>Date</th>
                                        <th>Weather</th>
                                        <th>Temperature (°C)</th>
                                        <th>Humidity (%)</th>
                                        <th>Probability (%)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($city->forecasts as $forecast)
                                        @php
                                            $color = \App\Http\forecastsAdminHelper\forecastsAdminHelper::getColorByTemperature($forecast->temperature);
                                            $icon = \App\Http\forecastsAdminHelper\forecastsAdminHelper::getWeatherIcon($forecast->weather_type);
                                        @endphp
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($forecast->Forecast_date)->format('Y-m-d') }}</td>
                                            <td>{!! $icon !!} {{ ucfirst($forecast->weather_type) }}</td>
                                            <td style="color: {{$color}}">{{ $forecast->temperature }}</td>
                                            <td>{{ $forecast->humidity }}</td>
                                            <td>{{ $forecast->probability ?? 'N/A' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-muted">No forecasts yet.</td>
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

