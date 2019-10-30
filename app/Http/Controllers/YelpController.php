<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;

class YelpController extends Controller
{
    public function yelpSearch(Request $request)
    {
        $api_key_yelp = env('YELP_API_KEY');
        $api_key_google_places = env('GOOGLE_PLACES_API_KEY');

        // Get GCP IP Address on App Engine
        if (isset($_SERVER['GAE_SERVICE'])) {
            $forwardedFor = array_map('trim', explode(',', $request->header('X-Forwarded-For')));
            $request->server->set('REMOTE_ADDR', $_SERVER['REMOTE_ADDR'] = $forwardedFor[0]);
            $position = Location::get($_SERVER['REMOTE_ADDR']);
        }else {
            $extIp = "71.65.227.195";
            $position = Location::get($extIp);
        }

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.yelp.com/v3/businesses/']);
        $headers = [
                'Authorization' => 'Bearer ' . $api_key_yelp . '',
            ];
        $query_params = [
                'term' => 'nightlife',
                'limit' => '20',
                'latitude' => $position->latitude,
                'longitude' => $position->longitude
            ];
        $response = $client->request('GET', 'search', [
                'headers' => $headers,
                'query' => $query_params
            ]);
        $response = json_decode($response->getBody(), true);

        foreach($response['businesses'] as $value){
            $places['places'][] = [
                'id' => $value['id'] ?? '',
                'name' => str_limit($value['name'], 25) ?? '',
                'rating' => self::starRating($value['rating'] ?? '0'),
                'price' => $value['price'] ?? '',
                'review_count' => $value['review_count'] ?? '',
                'img' => $value['image_url'] ?: '/img/yelp/placeholder.png',
                'logo' => '<i class="fab fa-yelp fa-2x"></i>',
            ];
        }

        $gpClient = new \GuzzleHttp\Client();
        $gpInput = "restaurants+bars";
        $gpFields = "photos,name,rating";
        $googlePlaces = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=$gpInput&location=$position->latitude%2C$position->longitude&radius=10000&fields=$gpFields&key=$api_key_google_places";
        $response_google_places = $gpClient->request('GET', $googlePlaces);
        $response_google_places = json_decode($response_google_places->getBody(), true);

        foreach($response_google_places['results'] as $value){
            $places['places'][] = [
                'id' => $value['id'] ?? '',
                'name' => str_limit($value['name'], 25) ?? '',
                'rating' => self::starRating($value['rating'] ?? '0'),
                'price' => $value['price_level'] ?? '',
                'review_count' => $value['user_ratings_total'] ?? '',
                'img' => self::placesPhoto($value['photos'][0]['photo_reference']) ?: '/img/yelp/placeholder.png',
                'logo' => '<i class="fab fa-google fa-2x"></i>',
            ];
        }

        shuffle($places['places']);

        return view('yelp', [
            "response" => $places,
            "position" => $position,
        ]);
    }

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

    public static function placesPhoto($photo_reference)
    {
        $api_key_google_places = env('GOOGLE_PLACES_API_KEY');
        $client = new \GuzzleHttp\Client();

        $uri = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=350&photoreference=$photo_reference&key=$api_key_google_places";

        $photo = $client->request('GET', $uri);

        $photo = json_decode($photo->getBody(), true);

        return $uri;
    }

    public static function starRating($rating)
    {
        switch($rating) {
            case ($rating >= "0" && $rating <= "0.9"):
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_0.png";
                return $ratingimg;
                break;
            case ($rating >= "1" && $rating <= "1.4"):
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_1.png";
                return $ratingimg;
                break;
            case ($rating >= "1.5" && $rating <= "1.9"):
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_1_half.png";
                return $ratingimg;
                break;
            case ($rating >= "2" && $rating <= "2.4"):
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_2.png";
                return $ratingimg;
                break;
            case ($rating >= "2.5" && $rating <= "2.9"):
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_2_half.png";
                return $ratingimg;
                break;
            case ($rating >= "3" && $rating <= "3.4"):
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_3.png";
                return $ratingimg;
                break;
            case ($rating >= "3.5" && $rating <= "3.9"):
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_3_half.png";
                return $ratingimg;
                break;
            case ($rating >= "4" && $rating <= "4.4"):
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_4.png";
                return $ratingimg;
                break;
            case ($rating >= "4.5" && $rating <= "4.9"):
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_4_half.png";
                return $ratingimg;
                break;
            case ($rating >= "5" && $rating <= "5"):
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_5.png";
                return $ratingimg;
                break;
            default:
                $ratingimg = "/img/yelp/yelp_stars/web_and_ios/large/large_0.png";
                return $ratingimg;
        }
    }
}
