@extends('backend.layouts.headerfooter')
@section('body-content')
    <div class="pagetitle">
        <h1>company Index</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Companies</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">company Table <a href="{{ route('company.create') }}"
                            class="btn btn-sm btn-primary">Add New</a></h5>

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
                                {{-- <th scope="col">Image</th> --}}
                                <th scope="col">Manager</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <th scope="row">{{ $company->id }}</th>
                                    <td>{{ $company->name }}</td>
                                    {{-- <td>
                                        <img src="{{ asset($company->image) }}" alt="" height="50px">
                                    </td> --}}
                                    <td>
                                        {{ $company->user ? $company->user->name : '' }}
                                    </td>
                                    <td><button class="btn">
                                            Status <span class="badge bg-primary">{{ $company->status }}</span>
                                        </button></td>
                                    <td>
                                        <a class="btn btn-dark" href="{{ route('company.edit', $company->id) }}"
                                            role="button">Edit</a>
                                        <form action="{{ route('company.destroy', $company->id) }}" method="POST">
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
