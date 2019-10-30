<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
/* use Location; */

class GoogleMapsController extends Controller
{
    public function mapsSearch()
    {
        $api_key = env('GOOGLE_API_KEY');

        /*
        $ip = Request::ip();
        $position = Location::get($ip);
        $location = $position->latitude . "," . $position->longitude;
        */

        Log::info("Hello Stackdriver! This will show up as log level INFO!");

        return view('maps', [
            "api_key" => $api_key,
        ]);
    }
}
