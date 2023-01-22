@extends('layouts.hf')

@section('body-content')
    <section>
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-3">Homepage</h1>
                <img src="{{ asset('frontend/backgroud.jpg') }}" class="mt-4" width="100%" alt="">
            </div>
            <button class="btn-test">Test Css</button>
        </div>
    </section>
@endsection
