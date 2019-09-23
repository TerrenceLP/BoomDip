<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;

class YelpController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    public function yelpSearch()
    {
        $api_key = env('YELP_API_KEY');
        // $ip = Request::ip();
        // $ext_ip = "24.163.36.200";
        $ext_ip = "173.230.141.18";
        $position = Location::get($ext_ip);
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.yelp.com/v3/businesses/']);
        $headers = [
                'Authorization' => 'Bearer ' . $api_key . '',
            ];
        $query_params = [
                'term' => 'nightlife',
                'limit' => '18',
                'latitude' => $position->latitude,
                'longitude' => $position->longitude
            ];
        $response = $client->request('GET', 'search', [
                'headers' => $headers,
                'query' => $query_params
            ]);
        $response = json_decode($response->getBody(), true);

        return view('yelp', [
            "response" => $response,
            "position" => $position,
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */

    public function yelpInfo(Request $request)
    {
        $id = $_GET['id'];
        $api_key = env('YELP_API_KEY');

        $client = new \GuzzleHttp\Client();
        $headers = [
                'Authorization' => 'Bearer ' . $api_key . '',
            ];

        $response = $client->request('GET', "https://api.yelp.com/v3/businesses/$id", [
                'headers' => $headers,
            ]);
        $response = json_decode($response->getBody(), true);

        $reviews = $client->request('GET', "https://api.yelp.com/v3/businesses/$id/reviews", [
            'headers' => $headers,
        ]);
        $reviews = json_decode($reviews->getBody(), true);

        return view('info', [
            "response" => $response,
            "reviews" => $reviews,
        ]);
    }
}
