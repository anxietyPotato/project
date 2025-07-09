<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.navbar')

    <meta charset="UTF-8">
    <title>Edit City</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f1e3; /* Sand */
            font-family: 'Segoe UI', sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            color: #2a5d3f; /* Dark Green */
            margin-bottom: 20px;
        }

        label {
            color: #234b6c; /* Navy */
        }

        .btn-primary {
            background-color: #234b6c;
            border-color: #234b6c;
        }

        .btn-outline-secondary {
            border-color: #2a5d3f;
            color: #2a5d3f;
        }

        .btn-outline-secondary:hover {
            background-color: #2a5d3f;
            color: #fff;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .text-danger {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="form-title">✏️ Edit City</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('cities.update', $city->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">City Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $city->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="temperature" class="form-label">Temperature (°C)</label>
            <input type="number" step="0.01" class="form-control" id="temperature" name="temperature" value="{{ old('temperature', $city->temperature) }}">
        </div>

        <div class="mb-3">
            <label for="humidity" class="form-label">Humidity (%)</label>
            <input type="number" step="0.01" class="form-control" id="humidity" name="humidity" value="{{ old('humidity', $city->humidity) }}">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">Update City</button>
        </div>
    </form>
</div>

<div class="text-center mt-3">
    <a href="{{ route('all.Cities') }}" class="btn btn-outline-secondary">⬅ Back to Cities</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


