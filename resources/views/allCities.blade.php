
<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <title>All Cities</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f1e3; /* Sand */
            font-family: 'Segoe UI', sans-serif;
        }

        h1 {
            color: #2a5d3f; /* Dark Green */
        }

        .card {
            border: none;
            background-color: #ffffff;
            border-radius: 16px;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #2a5d3f;
        }

        .btn-danger {
            background-color: #a94442;
            border-color: #a94442;
        }

        .btn-primary {
            background-color: #234b6c; /* Navy Blue */
            border-color: #234b6c;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .container {
            max-width: 1200px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h1 class="mb-4 text-center">🏙️ All Cities</h1>

    @if($cities->isEmpty())
        <div class="alert alert-warning text-center">
            No cities found.
        </div>
    @else
        <div class="row">
            @foreach($cities as $city)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $city->name }}</h5>

                            @if($city->temperature !== null)
                                <p class="card-text"><strong>Temperature:</strong> {{ $city->temperature }}°C</p>
                            @endif



                            <p class="card-text"><strong>Recorded At:</strong>
                                {{ \Carbon\Carbon::parse($city->created_at)->format('Y-m-d') }}
                            </p>

                            <div class="d-flex justify-content-between mt-3">
                                <form method="POST" action="{{ route('cities.destroy', $city->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
