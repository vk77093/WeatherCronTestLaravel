<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-border table-hover">
                <thead>
                    <tr>
                        <th>LAT</th>
                        <th>LONG</th>
                        <th>timezone</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$WeatherData['lat']}}</td>
                        <td>{{$WeatherData['lon']}}</td>
                        <td>
                            @foreach ($WeatherData['hourly'] as $hour)
                                
                            @endforeach
                            <td>Date {{$hour['dt']}}</td>
                        </td>
                        <td>
                            @foreach($WeatherData['daily'] as $daily)
                            <tr>
                                <td>{{$daily['dt']}}</td>
                                <td>{{$daily['moon_phase']}}</td>
                                <td>{{$daily['temp']['day']}}</td>
                                <td>{{$daily['temp']['night']}}</td>
                                <td>{{$daily['feels_like']['morn']}}</td>
                            </tr>
                        @endforeach
                        
                        </td>
                        <td>{{$daily['feels_like']['morn']}}</td>
                        {{-- <td>
                            @forelse($WeatherData['alerts'] as $alert)
                            <tr>
                                <td>{{$alert['sender_name']}}</td>
                            </tr>
                            @empty
                        <tr>
                         <td><h3>Currently No Data is here</h3></td>   
                       </tr>   
                            @endforelse
                        </td> --}}
                    </tr>
                   
                       </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>