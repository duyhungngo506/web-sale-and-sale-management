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
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách sản phẩm</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex" style="justify-content: space-between">
                <h6>Products</h6>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmodal">Thêm sản
                    phẩm</button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên món</th>
                                <th>Loại</th>
                                <th>Mô tả</th>
                                <th>ĐVT</th>
                                <th>Giá gốc</th>
                                <th>Giá sale</th>
                                <th>Hình ảnh</th>
                                {{-- <th>Trạng thái</th> --}}
                                <th>Tác vụ</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->id_type }}</td>
                                    <td style="width: 20%">{{ $product->description }}</td>
                                    <td>{{ $product->unit }}</td>
                                    <td>{{ $product->unit_price }}</td>
                                    <td>{{ $product->promotion_price }}</td>
                                    <td><img src="/image/product/{{ $product->image }}" alt="" srcset=""
                                            style="width: 100px"></td>
                                    {{-- <td>{{ $product->new }}</td> --}}
                                    <td>
                                        <button class="btn btn-primary mt-2 " data-toggle="modal"
                                            data-target="#editmodal{{ $product->id }}">Sửa </button>
                                        <div class="modal fade" style="" id="editmodal{{ $product->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('products.update', $product->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin sản
                                                                phẩm
                                                            </h5>
                                                            <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-around">
                                                            <div class="form-group w-100 mx-4">
                                                                <label for="name">Tên món</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" aria-describedby="helpId" placeholder=""
                                                                    value="{{ $product->name }}" required>
                                                                <label for="typeProduct">Loại</label>
                                                                <select class="form-control" name="typeProduct"
                                                                    id="">
                                                                    @foreach ($producttypes as $producttype)
                                                                        <option
                                                                            @if ($producttype->id == $product->id_type) selected @endif
                                                                            value="{{ $producttype->id }}">
                                                                            {{ $producttype->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                                <label for="description">Mô tả</label>
                                                                <input type="text" class="form-control"
                                                                    name="description" id="description"
                                                                    aria-describedby="helpId" placeholder=""
                                                                    value="{{ $product->description }}" required>

                                                                <label for="dvt">ĐVT</label>
                                                                <input type="text" class="form-control" name="dvt"
                                                                    id="dvt" aria-describedby="helpId" placeholder=""
                                                                    value="{{ $product->unit }}" required>
                                                            </div>
                                                            <div class="form-group w-100" mx-4>
                                                                <label for="unit_price">Giá gốc</label>
                                                                <input type="number" class="form-control" name="unit_price"
                                                                    id="unit_price" aria-describedby="helpId" placeholder=""
                                                                    value="{{ $product->unit_price }}" required>
                                                                <label for="promotion_price">Giá sale</label>
                                                                <input type="text" class="form-control"
                                                                    name="promotion_price" id="promotion_price"
                                                                    aria-describedby="helpId" placeholder=""
                                                                    value="{{ $product->promotion_price }}" required>
                                                                <label for="image">Ảnh sản phẩm</label>
                                                                <input type="file"
                                                                    accept="image/x-png,image/gif,image/jpeg"
                                                                    onchange="Changeimg(event)" class="form-control"
                                                                    name="image_file" aria-describedby="helpId"
                                                                    placeholder="" value="">
                                                                <img width="100"
                                                                    src="./image/product/{{ $product->image }}"
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

                                                            <button type="submit" class="btn btn-danger">Cập
                                                                nhật</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger mt-2" data-toggle="modal"
                                            data-target="#deletemodal{{ $product->id }}">
                                            Xóa</button>

                                        <div class="modal fade" style="" id="deletemodal{{ $product->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn
                                                            muốn
                                                            xóa {{ $product->name }}?</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Bấm đồng ý để xóa <b>{{ $product->name }}</b>
                                                        khỏi
                                                        cửa hàng</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Thoát</button>
                                                        <form action="{{ route('products.destroy', $product->id) }}"
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
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm mới
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex justify-content-around">
                            <div class="form-group w-100 mx-4">
                                <label for="name">Tên món</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    aria-describedby="helpId" placeholder="" value="" required />
                                <label for="typeProduct">Loại</label>
                                <select class="form-control" name="typeProduct" id="">
                                    @foreach ($producttypes as $producttype)
                                        <option value="{{ $producttype->id }}">{{ $producttype->name }}</option>
                                    @endforeach
                                </select>

                                <label for="description">Mô tả</label>
                                <input type="text" class="form-control" name="description" id="description"
                                    aria-describedby="helpId" placeholder="" value="" required />

                                <label for="dvt">ĐVT</label>
                                <input type="text" class="form-control" name="dvt" id="dvt"
                                    aria-describedby="helpId" placeholder="" value="" required />
                            </div>
                            <div class="form-group w-100" mx-4>
                                <label for="unit_price">Giá gốc</label>
                                <input type="number" class="form-control" name="unit_price" id="unit_price"
                                    aria-describedby="helpId" placeholder="" value="" required />
                                <label for="promotion_price">Giá sale</label>
                                <input type="text" class="form-control" name="promotion_price" id="promotion_price"
                                    aria-describedby="helpId" placeholder="" value="" required />
                                <label for="image">Ảnh sản phẩm</label>

                                <input type="file" accept="image/x-png,image/gif,image/jpeg" name="image_file"
                                    onchange="Changeimg(e)" class="form-control" placeholder=""
                                    aria-describedby="helpId" required />

                                <img width="100" src="" id="imgg" alt="" />
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
@endsection
@section('js')
    <!-- Bootstrap core JavaScript-->
    <script src="/admin_resource/vendor/jquery/jquery.min.js"></script>
    <script src="/admin_resource/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/admin_resource/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="/admin_resource/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/admin_resource/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin_resource/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/admin_resource/js/demo/datatables-demo.js"></script>
@endsection
