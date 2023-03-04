@extends('backend.layouts.headerfooter')
@section('body-content')
    <div class="pagetitle">
        <h1>company Edit</h1>
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
                    <h5 class="card-title">Edit company</h5>

                    <!-- Horizontal Form -->
                    <form method="POST" action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- @foreach ($errors->all() as $error)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">

                                <strong>Error: </strong> {{ $error }}
                            </div>

                            <script>
                                $(".alert").alert();
                            </script>
                        @endforeach --}}
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $company->name }}" name="name" id="inputText">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Company Manager</label>
                            <div class="col-sm-10">
                                <select type="text" class="form-control @error('company_manager') is-invalid @enderror"
                                    name="company_manager" id="inputText">
                                    <option value="">Select User</option>
                                    @foreach (App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $user->company_id == $company->id ? 'selected' : '' }}>
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control @error('title') is-invalid @enderror"
                                    name="image" id="inputEmail">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div> --}}
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" value="active" type="radio" name="status"
                                        id="status1" value="option1"
                                        {{ $company->status ? ($company->status == 'active' ? 'checked' : '') : 'checked' }}>
                                    <label class="form-check-label" for="status1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="inactive" type="radio" name="status"
                                        id="status2" value="option2"
                                        {{ $company->status == 'inactive' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status2">
                                        Inactive
                                    </label>
                                </div>
                                @error('status')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </fieldset>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('company.index') }}" class="btn btn-secondary">Return</a>
                        </div>
                    </form><!-- End Horizontal Form -->

                </div>
            </div>
        </div>
    </section>
@endsection
