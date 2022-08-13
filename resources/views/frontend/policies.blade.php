@extends('layouts.frontend')

@section('content')

    <div class="about_section mt-60">
        <div class="container">
            @foreach(\App\Policy::all() as $policy)
                <div class="row card mt-5">
                    <div class="col-lg-12 col-md-12 card-body">
                        <div class="about_content">
                            <h1>{{ $policy->name }}</h1>
                            {!! $policy->description !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
