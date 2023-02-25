@extends('layouts.hf')

@section('body-content')
    <section>
        <div class="container">
            <h1>Jobs</h1>
            <div class="row">
                @foreach ($jobs as $job)
                    <div class="col-md-3 col-12">
                        <div class="card border-primary">
                            <img src="{{ asset($job->category ? $job->category->image : ' ') }}" alt="" width="100%">
                            <div class="card-body">
                                <h4 class="card-title">{{ $job->title }}</h4>
                                <p class="card-text">{{ $job->category ? $job->category->title : '' }}</p>
                            </div>
                            <a href="{{ route('job.detail',$job->id) }}" class="btn btn-dark">View More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
