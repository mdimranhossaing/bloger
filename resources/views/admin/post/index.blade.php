@extends('admin.layout.app')
@section('stylesheet')
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="20">SN</th>
                            <th width="70">Thumbnail</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Comments</th>
                            <th>Views</th>
                            <th>Likes</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th width="80">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($posts) > 0)
                            @foreach ($posts as $key => $post)
                                <tr>
                                    <td width="20">{{ $key + 1 }}</td>
                                    <td><img class="admin-post-thumb"
                                            src="{{ asset('upload/' . $post->thumbnail) }}" alt="Post Thumbnail">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ count($post->comments) }}</td>
                                    <td>{{ $post->views == 0 ? 0 : $post->views }}</td>
                                    <td>{{ $post->likes == 0 ? 0 : $post->likes }}</td>
                                    <td>{{ date('s:i:h - d M Y', strtotime($post->created_at)) }}</td>
                                    <td>{{ date('s:i:h - d M Y', strtotime($post->updated_at)) }}</td>
                                    <td width="80">
                                        <a class="badge-btn badge-info" href="{{route('admin.single-post', $post->id)}}"><i
                                                class="fa fa-binoculars"></i></a>
                                        <a class="badge-btn badge-success" href="{{route('post.edit', $post->id)}}"><i
                                                class="fas fa-edit"></i></a>
                                        <a class="badge-btn badge-danger"
                                            href="javascript:deletePost('{{route('post.delete', $post->id)}}')"><i
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
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Comments</th>
                            <th>Views</th>
                            <th>Likes</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th width="80">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- MAIN CONTENT END HERE -->
        <form action="" id="deletePostForm" method="POST">@csrf @method('DELETE')</form>
    </section>
@endsection

@section('script')
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
                "order": [[1, 'desc']],
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
                jQuery('#deletePostForm').attr('action', url);
                jQuery('#deletePostForm').submit();
            }
            })
        }
    </script>
@endsection
