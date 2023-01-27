@extends('layouts.hf')

@section('body-content')
    <section>
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-3">{{ $user->name }}</h1>
                <p>Email: {{ $user->email }}</p>
            </div>
        </div>
    </section>
@endsection
