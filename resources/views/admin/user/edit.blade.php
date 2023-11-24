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
                    <h1>{{ $user->title }}</h1>
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
        <form action="{{ route('update.user', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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

                            <div class="form-group">
                                <label for="name">Full name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $user->name }}">
                            </div>
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username"
                                    class="form-control @error('username') is-invalid @enderror" value="{{ old('username') ? old('username') : $user->username }}">
                            </div>
                            @error('username')
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-3">
                    <div class="card card-secondary">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Budget</h3> --}}

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <img class="d-block mb-3 img-fluid" src="{{asset('upload/' . $user->photo)}}" alt="">
                                <label for="photo">Profile picture</label>
                                <input type="file" id="photo" name="photo"
                                    class="form-control @error('thumbnail') is-invalid @enderror"
                                    value="{{ old('photo') ? old('photo') : $user->photo }}">
                            </div>
                            @error('photo')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            <input type="submit" value="Update Post" class="btn btn-success float-right">

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