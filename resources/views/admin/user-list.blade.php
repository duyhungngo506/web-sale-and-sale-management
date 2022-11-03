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
        <h1 class="h3 mb-2 text-gray-800">Danh sách người dùng</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Cấp bậc</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tfoot>

                        </tfoot>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        @if ($user->level == 3)
                                            Khách hàng
                                        @elseif ($user->level == 1)
                                            Admin
                                        @else
                                            Nhân viên
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->phone }}</td>

                                    <td style="display: flex; justify-content: space-around">
                                        <button class="btn btn-primary " data-toggle="modal"
                                            data-target="#editmodal{{ $user->id }}"
                                            @if ($user->level == 1) disabled @endif>Sửa</button>
                                        <div class="modal fade" style="" id="editmodal{{ $user->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('users.update', $user->id) }}" method="post">
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
                                                                    value="{{ $user->name }}" required>
                                                                <label for="email">Email</label>
                                                                <input type="text" class="form-control" name="email"
                                                                    id="email" aria-describedby="helpId" placeholder=""
                                                                    value="{{ $user->email }}" required>

                                                                <label for="adderss">Địa chỉ</label>
                                                                <input type="text" class="form-control" name="address"
                                                                    id="adderss" aria-describedby="helpId" placeholder=""
                                                                    value="{{ $user->address }}" required>

                                                                <label for="phone">Số điện thoại</label>
                                                                <input type="text" class="form-control" name="phone"
                                                                    id="phone" aria-describedby="helpId" placeholder=""
                                                                    value="{{ $user->phone }}" required>

                                                                <label for="level">Cấp quyền</label>

                                                                <select class="form-control" name="level" id="level">
                                                                    <option value="3"
                                                                        @if ($user->level == 3) selected @endif>
                                                                        Khách hàng
                                                                    </option>
                                                                    <option value="1"
                                                                        @if ($user->level == 2) selected @endif>
                                                                        Nhân viên
                                                                    </option>
                                                                </select>

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
                                        <button class="btn btn-danger " @if ($user->level == 1) disabled @endif
                                            data-toggle="modal" data-target="#deletemodal{{ $user->id }}">
                                            Xóa</button>

                                        <div class="modal fade" style="" id="deletemodal{{ $user->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn
                                                            muốn
                                                            xóa {{ $user->name }}?</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Bấm đồng ý để xóa {{ $user->name }} khỏi cơ
                                                        sở dữ
                                                        liệu</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Thoát</button>
                                                        <form action="{{ route('users.destroy', $user->id) }}"
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
