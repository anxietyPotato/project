<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.navigation')

    <meta charset="UTF-8">
    <title>Admin - Add City</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Optional: Include Bootstrap via CDN if not already included -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg,
            #8faab1,
            #7cb3ae,
            #e6e1c2,
            #cdb26f,
            #94b79a
            );
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 30px 40px;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 25px;
            color: #6a0572;
        }

        .form-label {
            font-weight: 600;
            color: #444;
        }

        .form-control {
            border-radius: 12px;
            padding: 10px 15px;
            border: 1px solid #ccc;
            transition: box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: #a83279;
            box-shadow: 0 0 0 0.2rem rgba(168, 50, 121, 0.25);
        }

        .btn-primary {
            background-color: #6a0572;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            padding: 10px 25px;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #a83279;
        }

        .text-danger {
            color: #c0392b;
            font-weight: 500;
            margin-top: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #6a0572;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .bg-white.rounded.shadow {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            max-width: 95%;
            margin: 40px auto;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="form-title">Add New City</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('addCity') }}" method="POST">
        @csrf

        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="text-danger">{{ $error }}</p>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="cityName" class="form-label">City Name</label>
            <input type="text" class="form-control" id="cityName" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="temperature" class="form-label">Temperature (°C)</label>
            <input type="number" step="0.01" class="form-control" id="temperature" name="temperature" value="{{ old('temperature') }}">
        </div>

        <div class="mb-3">
            <label for="humidity" class="form-label">Humidity (%)</label>
            <input type="number" step="0.01" class="form-control" id="humidity" name="humidity" value="{{ old('humidity') }}">
        </div>


        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">Add City</button>
        </div>
    </form>
</div>

@if(isset($cities) && $cities->count())
    <div class="mt-5 p-4 bg-white rounded shadow">
        <h4 class="mb-4 text-center">Existing Cities</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center align-middle">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Temperature (°C)</th>
                    <th>Humidity (%)</th>
                    <th>Recorded At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities as $city)
                    <tr>
                        <td>{{ $city->id }}</td>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->temperature }}</td>
                        <td>{{ $city->humidity }}</td>
                        <td>{{ \Carbon\Carbon::parse($city->temperature_recorded_at)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
<a href="{{ route('all.Cities') }}" class="btn btn-outline-secondary mb-4">🌆 View All Cities</a>


</body>
</html>
