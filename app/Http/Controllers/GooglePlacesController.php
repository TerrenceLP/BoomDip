<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;

class GooglePlacesController extends Controller
{
    public function placesSearch()
    {
        $api_key = env('GOOGLE_API_KEY');

        $position = Location::get();
        $location = $position->latitude . "," . $position->longitude;
        $location = "circle:2500@$location";
        $imgMissing = '/img/google/placeholder.png';

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://maps.googleapis.com/maps/api/place/findplacefromtext/']);

        $query_params = [
                'input' => 'Museum',
                'inputtype' => 'textquery',
                'fields' => 'photos,formatted_address,name,opening_hours,rating',
                'locationbias' => $location,
                'key' => $api_key,
            ];

        $response = $client->request('GET', 'json', [
            'query' => $query_params
        ]);

        $response = json_decode($response->getBody(), true);

        foreach($response['candidates'] as $key => $value) {

            $rating = $value['rating'] ?? 0;
            $rating =  round($rating * 2) / 2;
            $stars = Self::ratingStars($rating);

            $placeInfo[$key]['name'] = $value['name'];
            $placeInfo[$key]['rating'] = "$stars";
            $placeInfo[$key]['ratings'] = "$rating";
            $placeInfo[$key]['open_now'] = $value['opening_hours']['open_now'] ?? '';
            $placeInfo[$key]['formatted_address'] = $value['formatted_address'];
            $photo_reference = $value['photos'][0]['photo_reference'] ?? '';

            if($photo_reference != '') {
                    $placeInfo[$key]['photo'] = Self::placesPhoto($photo_reference);
            }else {
                    $placeInfo[$key]['photo'] = $imgMissing;
            }
        }

        return view('places', [
            "placeInfo" => $placeInfo,
        ]);
    }

    public static function ratingStars($rating)
    {
        $star = '<i class="fas fa-star"></i>';
        $star_half = '<i class="fas fa-star-half"></i>';

            switch ($rating) {

                case "5":
                $stars = $star. $star. $star. $star. $star;
                return $stars;
                break;

                case "4.5":
                $stars = $star . $star. $star. $star . $star_half;
                return $stars;
                break;

                case "4":
                $stars = $star . $star. $star. $star;
                return $stars;
                break;

                case "3.5":
                $stars = $star . $star . $star . $star_half;
                return $stars;
                break;

                case "3":
                $stars = $star . $star . $star;
                return $stars;
                break;

                case "2.5":
                $stars = $star . $star . $star_half;
                return $stars;
                break;

                case "2":
                $stars = $star . $star;
                return $stars;
                break;

                case "1.5":
                $stars = $star . $star_half;
                return $stars;
                break;

                case "1":
                $stars = $star;
                return $stars;
                break;

                case "0.5":
                $stars = $star_half;
                return $stars;
                break;

                case "0":
                $stars = "no ratings yet!";
                return $stars;
                break;

            }
    }

    public static function placesPhoto($photo_reference)
    {
        $api_key = env('GOOGLE_PLACES_API_KEY');
        $client = new \GuzzleHttp\Client();

        $uri = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=350&photoreference=$photo_reference&key=$api_key";

        $photo = $client->request('GET', $uri);

        $photo = json_decode($photo->getBody(), true);

        return $uri;
    }
}
