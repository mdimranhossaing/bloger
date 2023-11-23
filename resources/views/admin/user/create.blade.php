@extends('admin.layout.app')
@section('stylesheet')
    <!-- Select2 -->
    <link rel="stylesheet" href="/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">
@endsection
@section('content')
    <!-- BRANDCRUMB START -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ ucfirst(request()->segment(2)) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard') }}">{{ ucfirst(request()->segment(1)) }}</a></li>
                        <li class="breadcrumb-item active">{{ ucfirst(request()->segment(2)) }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- BRANDCRUMB END -->


    <section class="content">

        <!-- MAIN CONTENT START HERE -->
        <form action="{{ route('create.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-header">
                            {{-- <h3 class="card-title">General</h3> --}}

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            
                            {{-- Username --}}
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}">
                            </div>
                            @error('username')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            {{-- name --}}
                            <div class="form-group mb-3">
                                <label for="name">Fullname</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            {{-- email --}}
                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            {{-- password --}}
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}">
                            </div>
                            @error('password')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            {{-- password confirmation --}}
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirm password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    value="{{ old('password_confirmation') }}">
                            </div>
                            @error('password_confirmation')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            {{-- photo --}}
                            <div class="form-group mb-3">
                                <label for="photo">Profile picture</label>
                                <input type="file" name="photo" id="photo"
                                    class="form-control @error('photo') is-invalid @enderror"
                                    value="{{ old('photo') }}">
                            </div>
                            @error('photo')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-">Create User</button>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </form>
        <!-- MAIN CONTENT END HERE -->

    </section>
@endsection
@section('script')
    <!-- Select2 -->
    <script src="/admin/plugins/select2/js/select2.full.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        });
    </script>
@endsection
