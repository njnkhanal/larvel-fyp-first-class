@extends('company.layouts.headerfooter')
@section('body-content')
    <div class="pagetitle">
        <h1>job Index</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">job Table <a href="{{ route('company.job.create') }}"
                            class="btn btn-sm btn-primary">Add
                            New</a></h5>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <strong>success: </strong> {{ session('success') }}
                        </div>
                    @endif
                    <!-- Default Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <th scope="row">{{ $job->id }}</th>
                                    <td>{{ $job->title }}</td>
                                    <td>
                                        {{ $job->category ? $job->category->title : '' }}
                                    </td>
                                    <td><button class="btn">
                                            Status <span class="badge bg-primary">{{ $job->status }}</span>
                                        </button></td>
                                    <td>
                                        <a class="btn btn-dark" href="{{ route('job.edit', $job->id) }}"
                                            role="button">Edit</a>
                                        <form action="{{ route('job.destroy', $job->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-dark" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
            </div>

        </div>
    </section>
@endsection
