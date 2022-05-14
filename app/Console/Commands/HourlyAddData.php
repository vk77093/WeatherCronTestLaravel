<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\HourlyModel;
use App\Models\CityCodes;
use Illuminate\Support\Facades\Log;

class HourlyAddData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $baseUrl;
    protected $apiKey;
    //protected $signature = 'hourlyadd {lat} {long}';
    protected $signature = 'hourlyadd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It Will Add the Hourly Data To the DataBase';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->apiKey = env('Weather_API_KEY');
        $this->baseUrl = env('Weather_API_URL');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       if($this->confirm('Do you want to execute?')){
        $citiesData=$this->getAllCities();
        if($citiesData !=null){
            foreach($citiesData as $data){
               
                $latvalue = $data->latitude;
                $longValue=$data->longitude;
              
               $dataGot=$this->GetWeatherDataMethod($latvalue,$longValue);
               if($dataGot==null){
                $this->error('Something went wrong!');
                return response()->json('Their are not got any value');
    
            }else{
                
                foreach($dataGot['hourly'] as $hour){
                    foreach($hour['weather'] as $weather){
                        $currentDtConvert=$hour['dt'];
                        $dataAdded=HourlyModel::create([
                            'longitude'=>$dataGot['lon'],
                            'latitude'=>$dataGot['lat'],
                            'timezone'=>$dataGot['timezone'],
                             'timezone_offset'=>$dataGot['timezone_offset'],
                            'dt'=>$this->ConverVertNumberTodate($currentDtConvert),
                            'temp'=>$hour['temp'],
                            'feels_like'=>$hour['feels_like'],
                            'pressure'=>$hour['pressure'],
                            'humidity'=>$hour['humidity'],
                            'dew_point'=>$hour['dew_point'],
                            'uvi'=>$hour['uvi'],
                            'clouds'=>$hour['clouds'],
                            'visibility'=>$hour['visibility'],
                            'wind_speed'=>$hour['wind_speed'],
                            'wind_deg'=>$hour['wind_deg'],
                            'wind_gust'=>$hour['wind_gust'],
                            'weather_id'=>$weather['id'],
                            'main'=>$weather['main'],
                            'description'=>$weather['description'],
                            'icon'=>$weather['icon'],
                 
                          ]);
                    }
                    
                }
               
                
              
              $dataAdded2=  $this->withProgressBar(HourlyModel::all(), function ($dataAdde) {
                
            });
            $this->info('The command was successful!');
            }
            }
        }
        // $latvalue = $this->argument('lat');
        // $longValue=$this->argument('long');
        // $dataGot=$this->GetWeatherDataMethod($latvalue,$longValue);
        
       }
       
       
    }
    private function GetWeatherDataMethod($lat,$lon){
        try{
           $WeatherData=Http::Get($this->baseUrl."?lat=$lat&lon=$lon&units=metric&appid=".$this->apiKey)->json();
            return $WeatherData;
        }catch(\Exception $e){
            Log::channel('Hourly_WeatherError')->error($e->getMessage());
            return response()->json('Connection not created'.$e->getMessage());
        }
    }
    private function ConverVertNumberTodate($number){
        $date=date("Y-m-d H:i:s", $number);
        return $date;
    }
    private function getAllCities(){
        $citiesData=CityCodes::get();
        return $citiesData;
    }
}
