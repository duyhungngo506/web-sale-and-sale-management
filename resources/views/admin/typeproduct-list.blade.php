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
        <h1 class="h3 mb-2 text-gray-800">Danh sách loại sản phẩm</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#addmodal">Thêm
                        loại sản phẩm</button>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th style="width: 120px">Tên danh mục</th>
                                <th>Mô tả</th>
                                <th>Hình ảnh</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($typeproducts as $typeproduct)
                                <tr>
                                    <td>{{ $typeproduct->id }}</td>
                                    <td>{{ $typeproduct->name }}</td>
                                    <td>{{ $typeproduct->description }}</td>
                                    <td><img width="100px" src="/image/product/{{ $typeproduct->image }}" alt="">
                                    </td>

                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#editmodal{{ $typeproduct->id }}">Sửa </button>
                                        <div class="modal fade" style="margin-top: 100px"
                                            id="editmodal{{ $typeproduct->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('typeproducts.update', $typeproduct->id) }}"
                                                        method="post" enctype="multipart/form-data">
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

                                                            <div class="form-group">
                                                                <label for="name">Tên</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" aria-describedby="helpId" placeholder=""
                                                                    value="{{ $typeproduct->name }}" required>
                                                                <label for="email">Mô tả</label>
                                                                <input type="text" class="form-control"
                                                                    name="description" id="email"
                                                                    aria-describedby="helpId" placeholder=""
                                                                    value="{{ $typeproduct->description }}" required>

                                                                <label for="image">Hình ảnh</label>
                                                                <input type="file"
                                                                    accept="image/x-png,image/gif,image/jpeg"
                                                                    onchange="Changeimg(event)" class="form-control"
                                                                    name="image_file" id="imgg"
                                                                    aria-describedby="helpId" placeholder=""
                                                                    value="{{ $typeproduct->image }}">
                                                                <img width="100"
                                                                    src="/image/product/{{ $typeproduct->image }}"
                                                                    id="imgg" alt=""><br>
                                                                <script type="text/javascript">
                                                                    const Changeimg = (e) => {
                                                                        const img = document.getElementById('imgg');
                                                                        const file = e.target.files[0];
                                                                        img.src = URL.createObjectURL(file);
                                                                    }
                                                                </script>


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
                                        <button class="btn btn-danger mt-4" data-toggle="modal"
                                            data-target="#deletemodal{{ $typeproduct->id }}">
                                            Xóa</button>

                                        <div class="modal fade" style="margin-top: 200px"
                                            id="deletemodal{{ $typeproduct->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn
                                                            muốn
                                                            xóa {{ $typeproduct->name }}?</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Bấm đồng ý để xóa {{ $typeproduct->name }}
                                                        khỏi cơ
                                                        sở dữ
                                                        liệu</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Thoát</button>
                                                        <form
                                                            action="{{ route('typeproducts.destroy', $typeproduct->id) }}"
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
        <div class="modal fade" style="" style="margin-top: 100px" id="addmodal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('typeproducts.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm loại sản phẩm mới
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    aria-describedby="helpId" placeholder="" value="" required>
                                <label for="email">Mô tả</label>
                                <input type="text" class="form-control" name="description" id="email"
                                    aria-describedby="helpId" placeholder="" value="" required>

                                <label for="image">Hình ảnh</label>
                                <input type="file" accept="image/x-png,image/gif,image/jpeg"
                                    onchange="Changeimg(event)" class="form-control" name="image_file" id="imgg"
                                    aria-describedby="helpId" placeholder="" value="" required>
                                <img width="100" src="" id="imgg" alt=""><br>
                                <script type="text/javascript">
                                    const Changeimg = (e) => {
                                        const img = document.getElementById('imgg');
                                        const file = e.target.files[0];
                                        img.src = URL.createObjectURL(file);
                                    }
                                </script>


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
