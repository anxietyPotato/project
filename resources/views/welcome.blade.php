

    <!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <title>Grades</title>
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
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .grade-card {
            background: white;
            border-left: 6px solid #a83279;
            border-radius: 50px;
            padding: 25px 30px;
            width: 280px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            color: #333;
            transition: transform 0.2s;
        }

        .grade-card:hover {
            transform: scale(1.02);
        }

        .grade-card h3 {
            margin: 0 0 10px 0;
            font-size: 1.4rem;
            color: #6a0572;
        }

        .grade-card p {
            margin: 5px 0;
            font-weight: 500;
        }

        .grade-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: #c0392b;
        }
    </style>
</head>
<body>

<div class="container">

    {{-- /*
    1.          <p>Temperature: {{ $cityForecast->temperature ?? '—' }} &#8451;</p>

    1.if the thing on the left exists and isn’t null, use it. Otherwise, Show  '—'


    2.               <p>recorded_at:
                {{ $cityForecast->forecast_date
                    ? Carbon::parse($cityForecast->forecast_date)->format('d M Y H:i')
                    : '—' }}
                    </p>
    2. You're feeding it a string, and it gives you a smart object that knows how to format, compare, and manipulate dates.
                example : Carbon::parse('next Monday'); // Returns the date of the upcoming Monday
                Carbon::parse('2 weeks ago'); // Returns the date two weeks before today
                */ --}}


</div>
<div class="container">
    @foreach($cities as $city)
        <div class="grade-card-">
            <h3>{{ $city->name }}</h3>
            <p>Current temperature: {{ $city->temperature }} &#8451;</p>
            <p class="grade-value">Current humidity of air: {{ $city->humidity }} &#37;</p>
        </div>
    @endforeach
</div>

</body>
</html>



