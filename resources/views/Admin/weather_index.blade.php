<form method="post" action="{{route('weather.update')}}">
    @csrf
    <input type="text" name="temperature" placeholder="insert temperature" >


    <select name="city" >

            @foreach(\App\Models\CitiesPrognoza::all() as $city)
             <option value="{{$city->id}}">

                {{$city->name}}

             </option>
             @endforeach
    </select>


    <button> Save </button>


</form>

            @foreach(App\Models\CitiesPrognoza::all() as $city)
                <p>
                     {{ $city->name }} -
                     {{ optional($city->latestForecast)->temperature ?? 'No temperature data' }}°C
                </p>
            @endforeach
