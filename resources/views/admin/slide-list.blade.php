@extends('admin.layout.admin_layout')
@section('css')
    <!-- Custom fonts for this template -->
    <link href="/admin_resource/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/admin_resource/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/admin_resource/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; justify-content: space-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách banner</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addmodal">Thêm
                    banner</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Hình ảnh</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($slides as $slide)
                                <tr>
                                    <td>{{ $slide->id }}</td>
                                    <td><img width="200px" src="./image/slide/{{ $slide->image }}" alt=""></td>

                                    <td>
                                        <button class="btn btn-primary mx-4" data-toggle="modal"
                                            data-target="#editmodal{{ $slide->id }}">Thay đổi </button>
                                        <div class="modal fade" style="margin-top: 100px" id="editmodal{{ $slide->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('slides.update', $slide->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Thay đổi thông
                                                                tin
                                                            </h5>
                                                            <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="form-group" style="text-align: center">
                                                                <img style="width: 70%"
                                                                    src="./image/slide/{{ $slide->image }}" id="imgg"
                                                                    alt="" />
                                                                <script type="text/javascript">
                                                                    const Changeimg = (e) => {
                                                                        const img = document.getElementById('imgg');
                                                                        const file = e.target.files[0];
                                                                        img.src = URL.createObjectURL(file);
                                                                    }
                                                                </script>

                                                                <input type="file"
                                                                    accept="image/x-png,image/gif,image/jpeg"
                                                                    name="image_file" onchange="Changeimg(e)"
                                                                    class="form-control" placeholder=""
                                                                    aria-describedby="helpId" required />



                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button"
                                                                data-dismiss="modal">Thoát</button>

                                                            <button type="submit" class="btn btn-danger">Cập nhật</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#deletemodal{{ $slide->id }}">
                                            Xóa</button>

                                        <div class="modal fade" style="margin-top: 200px"
                                            id="deletemodal{{ $slide->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn
                                                            muốn
                                                            xóa {{ $slide->name }}?</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Bấm đồng ý để xóa slide {{ $slide->name }}
                                                        khỏi cơ
                                                        sở dữ
                                                        liệu</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Thoát</button>
                                                        <form action="{{ route('slides.destroy', $slide->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger">Đồng ý</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" style="" id="addmodal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('slides.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm banner mới
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex justify-content-around">
                            <div class="form-group w-100 mx-4">
                                <div class="form-group">

                                    <div class="form-group" style="text-align: center">
                                        <img style="width: 70%" src="" id="imgg" alt="" />
                                        <script type="text/javascript">
                                            const Changeimg = (e) => {
                                                const img = document.getElementById('imgg');
                                                const file = e.target.files[0];
                                                img.src = URL.createObjectURL(file);
                                            }
                                        </script>

                                        <input type="file" accept="image/x-png,image/gif,image/jpeg" name="image_file"
                                            onchange="Changeimg(e)" class="form-control" placeholder=""
                                            aria-describedby="helpId" required />



                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Thoát</button>

                            <button type="submit" class="btn btn-danger">Thêm</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@section('js')
    <!-- Bootstrap core JavaScript-->
    <script src="/admin_resource/vendor/jquery/jquery.min.js"></script>
    <script src="/admin_resource/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/admin_resource/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/admin_resource/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/admin_resource/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin_resource/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/admin_resource/js/demo/datatables-demo.js"></script>
@endsection
