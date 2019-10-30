@extends('layouts.template')

@section('content')
    <div class="container">

        <div class="card-group">
        @foreach ($response['places'] as $key => $value)
            <card-component id="{{$value['id']}}" img="{{$value['img']}}" logo="{{$value['logo']}}" title="{{$value['name']}}" rating-img="{{$value['rating']}}" review-count="{{$value['review_count']}}"></card-component>
        @endforeach
        </div>

    </div>
@endsection

@section('scripts')
<script>
        TweenMax.to(".card", 1, {
            duration:1.0,
            rotationY:360
        })
</script>
@endsection
