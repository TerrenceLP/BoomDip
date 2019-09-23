@extends('layouts.app')

@section('content')
  <div class="container-fluid">
        <div class="animated fadeIn">
             <div class="row">
                 <div class="col">
                @hasrole('Administrator')
                    I am a Administrator!
                @else
                    I am not a writer...
                @endhasrole

                <pre>
                @php(print_r($permissions))
                </pre>
                <pre>
                @php(print_r($roles))
                </pre>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
