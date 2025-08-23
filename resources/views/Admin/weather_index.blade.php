<form method="post" action="{{route('weather.update')}}">
    @csrf
    <input type="text" name="temperature" placeholder="insert temperature" >


    <select name="city_id" >

            @foreach(\App\Models\CitiesPrognoza::all() as $city)
             <option value="{{$city->id}}">

                {{$city->name}}

             </option>
             @endforeach
    </select>


    <button> Save </button>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

</form>
@foreach(\App\Models\Cities::all() as $city)
    <p>{{ optional($city->prognoza)->name ?? 'No name found' }} - {{ $city->temperature }}°C</p>
@endforeach
