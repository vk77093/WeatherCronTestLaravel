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
                           <td>{{$WeatherData->lat}}</td>
                           <td>{{$WeatherData->lon}}</td>
                           <td>{{$WeatherData->timezone}}</td>
                           <td>{{$WeatherData->current->dt}}</td>
                           <td>{{$WeatherData->current->sunrise}}</td>
                           
                          <td>
                            @foreach($WeatherData->minutely as $data)
                            <tr>
                              <td>{{$data->dt}}</td>
                            </tr>
                             @endforeach
                          </td>
                           <td>
                            @foreach($WeatherData->hourly as $data)
                            <tr>
                                <td>{{$data->temp}}</td>
                                <td>{{$data->wind_speed}}</td>
                            </tr>
                            @endforeach
                           </td>
                           <td>
                               @foreach($WeatherData->daily as $daily)
                               <tr>
                                   <td>{{$daily->humidity}}</td>
                                   <td>{{$daily->dew_point}}</td>
                                   <td>{{$daily->humidity}}</td>

                               </tr>
                               @endforeach
                           </td>
                           
                       </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>