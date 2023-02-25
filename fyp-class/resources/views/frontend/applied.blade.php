@extends('layouts.hf')

@section('body-content')
    <section>
        <div class="container">
            <h1>Job Detail</h1>
            <hr>
            <div class="row">
                <div class="col-md-4 col-12">
                    <img src="{{ asset($job->category ? $job->category->image : ' ') }}" alt="" width="100%">
                    <h2 class="">{{ $job->title }}</h2>
                    <p class="badge badge-primary">{{ $job->category ? $job->category->title : '' }}</p>
                    <div>
                        {{-- {{ $job->description }} --}}
                        {!! $job->description !!}
                    </div>
                </div>
                <div class="col-md-8 col-12">

                    {{-- <a href="" class="btn btn-dark btn-block">Apply Now</a> --}}
                    <h1>Your Applied Detail</h1>
                    <hr>
                    <ul class="list-group">
                        <li class="list-group-item ">Name: {{ $applied->name }}</li>
                        <li class="list-group-item ">Address: {{ $applied->address }}</li>
                        <li class="list-group-item ">Phone: {{ $applied->contact }}</li>
                        <li class="list-group-item ">Email: {{ $applied->email }}</li>
                        <li class="list-group-item ">Resume: <a href="{{ asset($applied->resume) }}" target="_blank">Resume View <i class="fa fa-eye" aria-hidden="true"></i></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </section>
@endsection
