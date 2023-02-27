@extends('backend.layouts.headerfooter')
@section('body-content')
    <div class="pagetitle">
        <h1>applied Index</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Job Apply</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">applied Table</h5>

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
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email</th>
                                <th scope="col">Resume</th>
                                <th scope="col">Job</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applied as $apply)
                                <tr>
                                    <th scope="row">{{ $apply->id }}</th>
                                    <td>{{ $apply->name }} <span class="badge bg-dark">{{ $apply->status }}</span></td>
                                    <td>{{ $apply->address }}</td>
                                    <td>{{ $apply->contact }}</td>
                                    <td>{{ $apply->email }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ asset($apply->resume) }}" target="_blank"><i
                                                class="fa fa-eye" aria-hidden="true"></i> View</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-dark">{{ $apply->job ? $apply->job->title : '' }}</span>

                                    </td>
                                    <td>
                                        @if ($apply->status == 'accepted')
                                            <a class="btn btn-danger"
                                                href="{{ route('applyjob.index.update', ['type' => 'cancel', 'id' => $apply->id]) }}">Cancel</a>
                                        @else
                                            {{-- <a class="btn btn-info"
                                            href="{{ route('applyjob.index.update', ['type' => 'pending', 'id' => $apply->id]) }}">Pending</a> --}}
                                            <a class="btn btn-dark"
                                                href="{{ route('applyjob.index.update', ['type' => 'accepted', 'id' => $apply->id]) }}">Accepted</a>
                                            <a class="btn btn-danger"
                                                href="{{ route('applyjob.index.update', ['type' => 'cancel', 'id' => $apply->id]) }}">Cancel</a>
                                        @endif
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
