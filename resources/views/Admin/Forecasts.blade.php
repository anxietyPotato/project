<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f3f1ed; /* light earthy background */
        color: #3b3a30;
        margin: 20px;
    }

    form {
        background-color: #e8f5e9; /* soft green */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin-bottom: 40px;
    }

    form label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    form input,
    form select,
    form button {
        display: block;
        width: 100%;
        margin-top: 5px;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #c5e1c5;
        box-sizing: border-box;
    }

    form button {
        margin-top: 15px;
        background-color: #4caf50;
        color: white;
        font-weight: bold;
        cursor: pointer;
        border: none;
    }

    form button:hover {
        background-color: #388e3c;
    }

    .success-message {
        color: #2e7d32;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .cities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .city-card {
        background-color: #f1f4f1;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        overflow: hidden; /* prevents spilling */
    }

    .city-card h2 {
        color: #2e7d32;
        margin-top: 0;
        text-align: center;
    }

    .table-wrapper {
        overflow-x: auto; /* enables horizontal scroll if needed */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        table-layout: fixed; /* ensures cells shrink properly */
        word-wrap: break-word;
    }

    table th,
    table td {
        border: 1px solid #c5e1c5;
        padding: 8px;
        text-align: center;
        word-break: break-word;
    }

    table th {
        background-color: #a5d6a7;
        color: #1b5e20;
    }

    table tbody tr:nth-child(even) {
        background-color: #e8f5e9;
    }
</style>

@if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('forecast.update') }}">
    @csrf

    <!-- Cities select -->
    <label for="city_id">City:</label>
    <select name="city_id" id="city_id">
        @foreach(\App\Models\CitiesPrognoza::all() as $city)
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

<hr>

<div class="cities-grid">
    @foreach($cities as $city)
        <div class="city-card">
            <h2>{{ $city->name }}</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
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
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($forecast->Forecast_date)->format('Y-m-d') }}</td>
                            <td>{{ ucfirst($forecast->weather_type) }}</td>
                            <td>{{ $forecast->temperature }}</td>
                            <td>{{ $forecast->humidity }}</td>
                            <td>{{ $forecast->probability ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No forecasts yet.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
