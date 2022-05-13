<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Exception;
use App\Models\LatModel;
use App\Models\CityCodes;
use Illuminate\Support\Facades\Log;

class AddWeatherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $baseUrl;
    protected $apiKey;
    
    // protected $signature = 'WeatherDataAdd {lat} {long}';
    //protected $signature = 'WeatherDataAdd {lat} {long}';
    protected $signature = 'WeatherDataAdd';
    // {--long:=longitude.}
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It Will Going to Add the Current WeatherData';

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
        //     $latvalue = $this->argument('lat');
                // $longValue=$this->argument('long');
        if ($this->confirm('This will run the command code continue?')) {
            $citiesData=$this->getAllCities();
            if($citiesData != null) {
                foreach($citiesData as $data){
               
                $latvalue = $data->latitude;
                $longValue=$data->longitude;
              
               $dataGot=$this->GetWeatherDataMethod($latvalue,$longValue);
               if($dataGot==null){
                // return response()->json('Their are not got any value');
                $this->error('Something went wrong!');
            }else{
                $currentDtConvert=$dataGot['current']['dt'];
                foreach($dataGot['current'] as $current ){
                    foreach($dataGot['current']['weather'] as $weather){
                    
                    }
                }
                
    
            $dataAdded=LatModel::create([
                'longitude'=>$dataGot['lon'],
                'latitude'=>$dataGot['lat'],
                'timezone'=>$dataGot['timezone'],
                'timezone_offset'=>$dataGot['timezone_offset'],
                'currentDt'=>$this->ConverVertNumberTodate($currentDtConvert),
                'Current_sunrise'=>$this->ConverVertNumberTodate($dataGot['current']['sunrise']),
                'Current_sunset'=>$this->ConverVertNumberTodate($dataGot['current']['sunset']),
                'Current_temp'=>$dataGot['current']['temp'],
                'Current_feels_like'=>$dataGot['current']['feels_like'],
                'Current_pressure'=>$dataGot['current']['pressure'],
                'Current_humidity'=>$dataGot['current']['humidity'],
                'Current_dew_point'=>$dataGot['current']['dew_point'],
                'Current_uvi'=>$dataGot['current']['uvi'],
                'Current_clouds'=>$dataGot['current']['clouds'],
                'Current_visibility'=>$dataGot['current']['visibility'],
                'Current_wind_speed'=>$dataGot['current']['wind_speed'],
                'Current_wind_deg'=>$dataGot['current']['wind_deg'],
                'weather_id'=>$weather['id'],
                'weather_main'=>$weather['main'],
                'weather_description'=>$weather['description'],
                'weather_icon'=>$weather['icon'],
            ]);
            $dataAdded2=  $this->withProgressBar(LatModel::all(), function ($dataAdde) {
                
            });
            $this->info('The command was successful!');
            }
                }
                
            } 
    }
}
    // private function GetWeatherDataMethod($lat,$lon){
        private function GetWeatherDataMethod($lat,$lon){
        try{
           
           // $WeatherData=Http::Get($this->baseUrl."?lat=.$this->lat.&lon=.$this->lon.&appid=".$this->apiKey)->json();
           $WeatherData=Http::Get($this->baseUrl."?lat=$lat&lon=$lon&units=metric&appid=".$this->apiKey)->json();
            return $WeatherData;
        }catch(\Exception $e){
            Log::info($e->getMessage());
            return response()->json('Connection not created'.$e->getMessage());
        }
    }
    private function ConverVertNumberTodate($number){
        $date=date("Y-m-d H:i:s:a", $number);
        return $date;
    }
    private function getAllCities(){
        $citiesData=CityCodes::get();
        return $citiesData;
    }
}
