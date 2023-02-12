@extends('backend.layouts.headerfooter')
@section('body-content')
    <div class="pagetitle">
        <h1>User Index</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User Table <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add
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
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Registered On</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $User)
                                <tr>
                                    <th scope="row">{{ $User->id }}</th>
                                    <td>{{ $User->name }}</td>
                                    <td><span class="badge bg-dark text-light">{{ $User->role }}</span></td>
                                    <td>{{ $User->created_at }}</td>

                                    <td>
                                        <a class="btn btn-dark" href="{{ route('user.edit', $User->id) }}"
                                            role="button">Edit</a>
                                        <form action="{{ route('user.destroy', $User->id) }}" method="POST">
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
