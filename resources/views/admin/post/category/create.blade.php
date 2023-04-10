@extends('admin.layout.app')
@section('stylesheet')
    <!-- Select2 -->
    <link rel="stylesheet" href="/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <style>
        .admin-post-thumb {
            width: 80px;
            height: 45px;
            object-fit: cover;
        }
    </style>
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


        <div class="row">
            <div class="col-md-4">
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

                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            {{-- <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" id="slug" name="slug"
                                    class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}">
                            </div>
                            @error('slug')
                                <div class="error">{{ $message }}</div>
                            @enderror --}}

                            <div class="form-group">
                                <label for="photo">Thumbnail</label>
                                <input type="file" id="photo" name="thumbnail"
                                    class="form-control @error('thumbnail') is-invalid @enderror"
                                    value="{{ old('thumbnail') }}">
                            </div>
                            @error('thumbnail')
                                <div class="error">{{ $message }}</div>
                            @enderror

                            <input type="submit" value="Create new Category" class="btn btn-success float-right">


                        </form>

                        <form action="" id="deleteCategoryForm" method="POST">@csrf @method('DELETE')</form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-8">
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

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="20">SN</th>
                                    <th width="70">Thumbnail</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th width="50">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td width="20">{{ $key + 1 }}</td>
                                            <td><img class="admin-post-thumb"
                                                    src="{{ asset('upload/' . $category->thumbnail) }}" alt="Thumbnail">
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ date('s:i:h - d M Y', strtotime($category->created_at)) }}</td>
                                            <td>{{ date('s:i:h - d M Y', strtotime($category->updated_at)) }}</td>
                                            <td width="50">
                                                <a class="badge-btn badge-success mr-2" href="{{route('admin.category.edit',$category->id)}}"><i
                                                        class="fas fa-edit"></i></a>
                                                <a class="badge-btn badge-danger" href="javascript:deletePost('{{route('admin.category.delete', $category->id)}}')"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="20">SN</th>
                                    <th width="70">Thumbnail</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th width="50">Action</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
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

    <!-- DataTables  & Plugins -->
    <script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/admin/plugins/jszip/jszip.min.js"></script>
    <script src="/admin/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/admin/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "order": [
                    [1, 'desc']
                ],
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deletePost(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    jQuery('#deleteCategoryForm').attr('action', url);
                    jQuery('#deleteCategoryForm').submit();
                }
            })
        }
    </script>

@endsection
