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
                    <h1>{{ $post->title }}</h1>
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
        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ? old('title') : $post->title }}">
                            </div>
                            @error('title')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="content">Description</label>
                                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="4">{{ old('content') ? old('content') : $post->content }}</textarea>
                            </div>
                            @error('content')
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
                                <img class="d-block mb-3 img-fluid" src="{{asset('upload/' . $post->thumbnail)}}" alt="">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" id="thumbnail" name="thumbnail"
                                    class="form-control @error('thumbnail') is-invalid @enderror"
                                    value="{{ old('thumbnail') ? old('thumbnail') : $post->thumbnail }}">
                            </div>
                            @error('thumbnail')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control select2bs4" name="category" style="width: 100%;">
                                    <option value="">Select Category</option>
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (old('category') == $category->id)
                                                    selected
                                                @elseif($post->category_id == $category->id)
                                                    selected
                                                @endif >{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @error('category')
                                <div class="error">{{ $message }}</div>
                            @enderror


                            <div class="form-group">
                                <label>Tag</label>
                                <select class="select2bs4" name="tags[]" multiple="multiple" data-placeholder="Select a State"
                                    style="width: 100%;">
                                    <option value="">Select Tags</option>
                                    @if (count($tags) > 0)
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                            @if (old('tags') && in_array($tag->id, old('tags')))
                                                selected
                                            @elseif (in_array($tag->id, $post->getTagIdArray()))
                                                selected
                                            @endif >{{ $tag->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @error('tags')
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
