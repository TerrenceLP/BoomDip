@extends('layouts.yelp')

@section('title', 'SnowBlower')

@section('content')
      <div class="container">
            <div class="card-deck">
        @foreach ($response['businesses'] as $key => $value)

            @php($rating = $value['rating'] ?? '')
            @php($price = $value['price'] ?? '')
            @php($review_count = $value['review_count'] ?? '')
            @php($id = $value['id'] ?? '')
            @php($title = str_limit($value['name'], 35))

            @if($value['image_url'] == "")
             @php($img = "/img/yelp/placeholder.png")
            @else
             @php($img = $value['image_url'])
            @endif

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
                @php($rating_img = "/img/yelp/yelp/yelp_stars/web_and_ios/large/large_0.png")
            @endif

            <div class="card mb-3 card-2">
                <img src="{{ $img }}" class="card-img-top shadow-sm" height="215" style="object-fit: cover;" alt="{{ $title }}">
                <div class="card-body widget-body text-center">
                    <img alt="Vendor Picture" class="widget-img rounded-circle border border-dark bg-secondary shadow-sm" src="/img/yelp/yelp_logo/Yelp_Logo.svg">
                    <h4 class="card-title" style="margin-top: 20px;">{{ $title }}</h4>
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col">
                                <div class="row">
                                        <div class="col pt-2 text-right">
                                                <img src="{{$rating_img}}" />
                                        </div>
                                        <div class="col pt-2 text-left">
                                            {{$review_count}} Reviews
                                        </div>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col">
                    <p class="card-text btn-group-vertical btn-block">
                    <a href="{{ url('/yelp/info') }}/?id={{ $id }}" class="btn btn-lg btn-outline-primary">More Info</a>
                    <a href="#" class="btn btn-lg btn-outline-dark">DM Friends</a>
                    </p>
                            </div>
                    </div>
                </div>
                <div class="card-footer">
                    <i class="fa fa-meh fa-2x mr-2" style="vertical-align: middle;" aria-hidden="true"></i>
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
