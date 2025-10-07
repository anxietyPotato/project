
@extends('layout')

@section('content')
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center text-white"
         style="background: linear-gradient(160deg, #0b0f19 0%, #1b2735 100%);">

        <div class="container py-5" style="max-width: 800px;">
            <h2 class="text-center mb-5 fw-bold text-info">
                🌆 {{ ucfirst($cityPrognoza->name) }} Forecast
            </h2>

            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert alert-danger text-center shadow">{{ session('error') }}</div>
            @endif

            {{-- Astronomy Info --}}
            <div class="p-4 rounded-4 shadow-lg mb-4"
                 style="background: rgba(20, 30, 50, 0.8); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.05);">
                <h4 class="mb-3 text-warning">🌅 Astronomy</h4>
                <p class="mb-1">Sunrise: <strong>{{ $astronomy['sunrise'] ?? 'N/A' }}</strong></p>
                <p>Sunset: <strong>{{ $astronomy['sunset'] ?? 'N/A' }}</strong></p>
            </div>

            {{-- Forecast Info --}}
            <div class="p-4 rounded-4 shadow-lg"
                 style="background: rgba(25, 35, 55, 0.8); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.05);">
                <h4 class="mb-3 text-info">📅 3-Day Forecast</h4>
                @foreach($forecast as $day)
                    <div class="border-bottom border-secondary py-3">
                        <strong class="fs-5 text-light">{{ $day['date'] }}</strong><br>
                        <span class="text-muted">Condition:</span> {{ $day['day']['condition']['text'] }}<br>
                        <span class="text-muted">Avg Temp:</span> <span class="fw-bold text-warning">{{ $day['day']['avgtemp_c'] }}°C</span><br>
                        <span class="text-muted">Humidity:</span> {{ $day['day']['avghumidity'] }}%<br>
                        <span class="text-muted">Chance of Rain:</span> {{ $day['day']['daily_chance_of_rain'] }}%
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('home') }}"
                   class="btn btn-outline-info px-4 py-2 rounded-pill shadow-sm"
                   style="transition: 0.3s ease; text-decoration: none;">
                    ⬅ Back to Home
                </a>
            </div>
        </div>
    </div>

    {{-- Custom Styling --}}
    <style>
        body {
            background: linear-gradient(160deg, #0b0f19 0%, #1b2735 100%);
            color: #eaeaea;
            font-family: 'Poppins', sans-serif;
        }

        h2, h4 {
            letter-spacing: 1px;
        }

        .btn-outline-info:hover {
            background-color: #17a2b8;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 0 12px rgba(23,162,184,0.5);
        }

        .shadow-lg {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5) !important;
        }
    </style>
@endsection
