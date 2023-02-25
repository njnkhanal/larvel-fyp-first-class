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
                    <h1>Apply Now</h1>
                    <hr>
                    @if (Auth::user())
                    <form action="{{ route('job.apply.store',$job->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                <strong>Error: </strong> {{ $error }}
                            </div>
                        @endforeach
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="name" id="name" class="form-control" placeholder="name" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="email">email</label>
                          <input type="email" name="email" id="email" class="form-control" placeholder="email" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="phone">phone</label>
                          <input type="text" name="contact" id="phone" class="form-control" placeholder="phone" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="address">address</label>
                          <input type="text" name="address" id="address" class="form-control" placeholder="address" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="resume">resume</label>
                          <input type="file" name="resume" id="resume" class="form-control" placeholder="resume" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <button type="submit" name="" id="" class="btn btn-dark btn-sm btn-block">Apply Now</button>
                    </form>
                    @else
                        <div class="jumbotron">
                            <h4>Login first to apply form.</h4>

                            <p class="lead">
                                <a class="btn btn-primary btn-md" href="{{ route('login') }}" role="button">Login</a>
                            </p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
