<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CityCodes;
use App\Models\DailyWeatherModel;
use Illuminate\Support\Facades\Http;

class DailyWeatherAddData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $baseUrl;
    protected $apiKey;
    protected $signature = 'DailyWeatherAdd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will add weather information of the daily and we
    need to check for the timing';

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
        if($this->confirm('Do you want to execute this command?')){
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
                        foreach($dataGot['daily'] as $daily){
                           
                            foreach($daily['weather'] as $weather){
                            $dataAdded=DailyWeatherModel::create([
                                
                                'longitude'=>$dataGot['lon'],
                            'latitude'=>$dataGot['lat'],
                            'timezone'=>$dataGot['timezone'],
                             'timezone_offset'=>$dataGot['timezone_offset'],
                             'dt'=>$this->ConverVertNumberTodate($daily['dt']),
                             'sunrise'=>$this->ConverVertNumberTodate($daily['sunrise']),
                             'sunset'=>$this->ConverVertNumberTodate($daily['sunset']),
                             'moonrise'=>$this->ConverVertNumberTodate($daily['moonrise']),
                             'moonset'=>$this->ConverVertNumberTodate($daily['moonset']),
                             'moon_phase'=>$daily['moon_phase'],
                             'temp_day'=>$daily['temp']['day'],
                             'min'=>$daily['temp']['min'],
                             'max'=>$daily['temp']['max'],
                             'night'=>$daily['temp']['night'],
                             'eve'=>$daily['temp']['eve'],
                             'morn'=>$daily['temp']['morn'],
                             'feels_like_day'=>$daily['feels_like']['day'],
                             'feels_like_night'=>$daily['feels_like']['night'],
                             'feels_like_eve'=>$daily['feels_like']['eve'],
                             'feels_like_morn'=>$daily['feels_like']['morn'],
                             'pressure'=>$daily['pressure'],
                             'humidity'=>$daily['humidity'],
                             'dew_point'=>$daily['dew_point'],
                             'wind_speed'=>$daily['wind_speed'],
                             'wind_deg'=>$daily['wind_deg'],
                             'wind_gust'=>$daily['wind_gust'],

                             'weather_id'=>$weather['id'],
                            'main'=>$weather['main'],
                            'description'=>$weather['description'],
                            'icon'=>$weather['icon'],

                            'clouds'=>$daily['clouds'],
                            'pop'=>$daily['pop'],
                             
                             
                            'uvi'=>$daily['uvi'],
                            ]);
                          }
                        }
                        $dataAdded2=$this->withProgressBar(DailyWeatherModel::all(), function ($dataAdde){

                        });
                        $this->info('  The command was successful!');
                    }
                }
                
            }
        }
    }
    private function GetWeatherDataMethod($lat,$lon){
        try{
           $WeatherData=Http::Get($this->baseUrl."?lat=$lat&lon=$lon&units=metric&appid=".$this->apiKey)->json();
            return $WeatherData;
        }catch(\Exception $e){
            //need to add the log files 
           
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
