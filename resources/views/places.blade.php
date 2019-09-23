@extends('layouts.yelp')

@section('content')
<div class="container">
        <div class="card-deck">
    @foreach ($placeInfo as $key => $value)

        @php($title = $value['name'] ?? '')
        @php($img = $value['photo'] ?? '')
        @php($rating = $value['rating'] ?? '')
        @php($ratings = $value['ratings'] ?? '')
        @php($formatted_address = $value['formatted_address'] ?? '')
        @php($open_now = $value['open_now'] ?? '')

        <div class="card mb-3 card-2">
            <img src="{{ $img }}" class="card-img-top shadow-sm" height="215" style="object-fit: cover;" alt="{{ $title }}">
            <div class="card-body widget-body text-center">
                <img alt="Vendor Picture" class="widget-img rounded-circle border border-dark bg-secondary shadow-sm" src="/img/google/google-icon-logo-svg-vector.svg">
                <h4 class="card-title" style="margin-top: 20px;">{{ $title }}</h4>
                <div class="row" style="margin-bottom:20px;">
                    <div class="col">
                            <div class="row">
                                    <div class="col pt-2 text-right">
                                            {!! $rating !!} - {{ $ratings }}
                                    </div>
                                    <div class="col pt-2 text-left">
                                        Open Now - {{ $open_now }}
                                        <hr>
                                        {{  $formatted_address }}
                                    </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col">
                <p class="card-text btn-group-vertical btn-block">
                <a href="#" class="btn btn-lg btn-outline-primary">More Info</a>
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
