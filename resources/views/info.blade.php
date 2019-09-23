@extends('layouts.yelp')

@section('content')

    <div class="container">

    <div class="row">

        <div class="col bg-primary text-white">

                @php($url = $response['url'] ?? '')
                @php($is_closed = $response['is_closed'] ?? '')
                @php($price = $response['price'] ?? '')
                @php($display_address = $response['location']['display_address'] ?? '')
                @php($bus_rating = $response['rating'] ?? '')

                @if($bus_rating == "0.0")
                @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_0.png")

                @elseif($bus_rating == "1.0")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_1.png")

                @elseif($bus_rating == "1.5")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_1_half.png")

                @elseif($bus_rating == "2.0")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_2.png")

                @elseif($bus_rating == "2.5")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_2_half.png")

                @elseif($bus_rating == "3.0")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_3.png")

                @elseif($bus_rating == "3.5")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_3_half.png")

                @elseif($bus_rating == "4.0")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_4.png")

                @elseif($bus_rating == "4.5")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_4_half.png")

                @elseif($bus_rating == "5.0")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_5.png")

                @else
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/extra_large/extra_large_0.png")
                @endif

                <div class="row">
                    <div class="col">
                            <div class="jumbotron text-dark">
                            <img src="{{$response['image_url']}}" class="rounded-circle pull-left mr-4" style="width: 175px; height: 175px;" />
                                <h1 class="display-4">{{$response['name']}} - <span class="text-success">{{$price}}</span></h1>

                                <p class="lead text-body yelp_business">
                                    @foreach ($response['categories'] as $categories)
                                        {{$categories['title']}},
                                    @endforeach
                                    <br>
                                    <img class="mb-2 mt-2" src="{{ $rating_img }}" />
                                    <br>
                                    <small>{{$response['review_count']}} Reviews <img width="120" src="/img/yelp/yelp_logo/Yelp_Logo.svg" /></small>
                                </p>

                                <hr class="my-4">
                                <div class="text-right">
                                @foreach ($display_address as $da)
                                    {{$da}}, <br>
                                @endforeach
                                {{$response['display_phone']}}
                                <br>
                                <small>{{$is_closed}}</small>
                                </div>
                            </div>
                    </div>
                </div>

                @foreach ($reviews['reviews'] as $rkey => $rvalue)

                @php($text = $rvalue['text'] ?? '')
                @php($rating = $rvalue['rating'] ?? '')
                @php($time_created = $rvalue['time_created'] ?? '')
                @php($user_img = $rvalue['user']['image_url'] ?? '')
                @php($user = $rvalue['user']['name'] ?? '')

                @if($rating == "0.0")
                @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_0.png")

                @elseif($rating == "1.0")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_1.png")

                @elseif($rating == "1.5")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_1_half.png")

                @elseif($rating == "2.0")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_2.png")

                @elseif($rating == "2.5")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_2_half.png")

                @elseif($rating == "3.0")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_3.png")

                @elseif($rating == "3.5")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_3_half.png")

                @elseif($rating == "4.0")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_4.png")

                @elseif($rating == "4.5")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_4_half.png")

                @elseif($rating == "5.0")
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_5.png")

                @else
                    @php($rating_img = "/img/yelp/yelp_stars/web_and_ios/large/large_0.png")
                @endif

                <div class="row">
                    <div class="col">
                        <div class="media m-2">
                                <img class="rounded-circle m-3" src="{{ $user_img }}" style="width: 75px; height: 75px;" alt="{{ $user }}" />
                            <div class="media-body m-3">
                                <h5 class="mt-0">{{ $user }}</h5>
                                <img class="mb-2" src="{{ $rating_img }}" />  <br>
                                {{ $text }}
                                <span class="text-right mt-2"> <br><small>created on {{ $time_created }}</small></span>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
        </div>
    </div>
    </div>

@endsection
