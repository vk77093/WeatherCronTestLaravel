<?php

namespace App\Http\Controllers;
use App\Models\LatModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Exception;
use App\Exception\Handler;
use Carbon\Carbon;
use App\Models\CityCodes;

class OpenWeatherFetchCont extends Controller
{
   
    protected $baseUrl;
    protected $apiKey;
    public function __construct(){
$this->apiKey = env('Weather_API_KEY');
$this->baseUrl = env('Weather_API_URL');
    }

    public function GetWeatherAPI(){
      try{
 //$WeatherData=Http::Get($this->baseUrl."?lat=33.44&lon=-94.04&appid=".$this->apiKey)->json()['current'];
 //$WeatherData=Http::Get($this->baseUrl."?lat=60.99&lon=30.9&dt=1586468027&appid=".$this->apiKey)->json();
 $WeatherData=$this->GetWeatherDataMethod();
 //var_dump($WeatherData);
 //die($WeatherData);
 //print_r($WeatherData);
 dd($WeatherData);
 return view('WeatherData.fetch',compact('WeatherData'));
      }catch(\Exception $e){
return response()->json('Connection not created'.$e->getMessage());
      }
    }
    public function getWeatherDataByCrul(){
        try{
            $googleApiUrl=$this->baseUrl."?lat=33.44&lon=-94.04&appid=".$this->apiKey;
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            
            curl_close($ch);
            $WeatherData = json_decode($response);
            $currentTime = time();
            //dd($WeatherData);
            // die();
            return view('WeatherData.FetchCrul',compact('WeatherData'));
        }catch(\Exception $e){
            return response()->json('Connection not created'.$e->getMessage());
        }
    }
    public function AddWeatherData(){
$dataGot=$this->GetWeatherDataMethod();
if($dataGot==null){
    return response()->json('Their are not got any value');
}else{
$dataAdded=LatModel::create([
    'longitude'=>$dataGot['lon'],
    'latitude'=>$dataGot['lat'],
    'timezone'=>$dataGot['timezone'],
    'timezone_offset'=>$dataGot['timezone_offset']
]);
return response()->json(array('data' => $dataAdded));
}
    }
    private function GetWeatherDataMethod(){
        try{
            $WeatherData=Http::Get($this->baseUrl."?lat=60.99&lon=30.9&dt=1586468027&appid=".$this->apiKey)->json();
            return $WeatherData;
        }catch(\Exception $e){
            return response()->json('Connection not created'.$e->getMessage());
        }
    }
    public function ConverVertNumberTodateTest(){
        $number='1652318357';
        $date=date("Y-m-d h:i:sa", $number);
        
        //$date=Carbon::parse($number)->format('Y-m-d H:i:s');
        echo $date;
    }
    private function ConverVertNumberTodate($number){
        $date=date("Y-m-d H:i:s", $number);
        echo $date;
    }
    public function getAllCities(){
        $citiesData=CityCodes::get();
        dd($citiesData);

    }
    public function checkCountWeather(){
        try{
           $WeatherData=Http::Get($this->baseUrl."?lat=31.32&lon=75.57&units=metric&appid=".$this->apiKey)->json();
       
        for ($i=0; $i < $WeatherData['daily']; $i++) { 
          
        }
        
          
        }catch(\Exception $e){
            // Log::channel('Hourly_WeatherError')->error($e->getMessage());
            return response()->json('Connection not created'.$e->getMessage());
        }
    }
}
