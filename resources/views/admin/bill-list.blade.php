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
    <style>
        .container-fluid button {
            max-height: 36px;
            min-width: 120px;
            max-width: 120px;
        }
    </style>
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
            <div class="card-header py-3 bg-primary" style="color: #ffff">
                Đơn hàng đang chờ xử lý
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Người nhận</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Thời gian tạo</th>
                                <th>Ghi chú</th>
                                <th>Tổng thanh toán</th>
                                <th style="min-width: 100px;">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @if ($order->status == 0)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->Customer->name }}</td>
                                        <td>{{ $order->Customer->address }}</td>
                                        <td>{{ $order->Customer->phone_number }}</td>
                                        <td>{{ $order->date_order }}</td>
                                        <td>{{ $order->note }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td class="d-flex flex-column" style="min-width: 100px;">
                                            <button class="btn btn-primary  mb-2" data-toggle="modal"
                                                data-target="#editmodal{{ $order->id }}">Chi tiết </button>
                                            <div class="modal fade " id="editmodal{{ $order->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg " role="document">
                                                    <div class="modal-content">
                                                        <form action="" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn
                                                                    hàng
                                                                </h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table"
                                                                    style="width: 100%; border:1px solid #ccc">
                                                                    <thead class="thead-inverse">
                                                                        <tr>
                                                                            <th>Sản phẩm</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Đơn giá</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($billDetails as $item)
                                                                            @if ($item->id_bill == $order->id)
                                                                                <tr>
                                                                                    <td scope="row" class="d-flex">
                                                                                        <div class="product_image">
                                                                                            <img width="50px"
                                                                                                src="./image/product/{{ $item->products->image }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                        <div class="product_name ml-4"
                                                                                            style="font-weight: bold">
                                                                                            {{ $item->products->name }}
                                                                                        </div>
                                                                                    </td>
                                                                                    <td> {{ $item->quantity }} </td>
                                                                                    <td>
                                                                                        @if ($item->products->promotion_price == 0)
                                                                                            {{ number_format($item->products->unit_price) }}
                                                                                        @else
                                                                                            {{ number_format($item->products->promotion_price) }}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach



                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Thoát</button>

                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('delivery', $order->id) }}" method="get">
                                                <button type="submit" class="btn btn-success mb-2">
                                                    Giao hàng</button>
                                            </form>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deletemodal{{ $order->id }}">
                                                Hủy đơn</button>

                                            <div class="modal fade" style="margin-top: 200px"
                                                id="deletemodal{{ $order->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hủy đơn hàng</h5>
                                                            <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Xác nhận hủy đơn hàng có mã là
                                                            {{ $order->id }}</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button"
                                                                data-dismiss="modal">Thoát</button>
                                                            <form action="{{ route('cancel', $order->id) }}"
                                                                method="get">
                                                                <button type="submit" class="btn btn-danger">Đồng
                                                                    ý</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-info" style="color: #ffff">
                Đơn hàng đang vận chuyển
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Người nhận</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Thời gian tạo</th>
                                <th>Ghi chú</th>
                                <th>Tổng thanh toán</th>
                                <th style="min-width: 100px;">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @if ($order->status == 1)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->Customer->name }}</td>
                                        <td>{{ $order->Customer->address }}</td>
                                        <td>{{ $order->Customer->phone_number }}</td>
                                        <td>{{ $order->date_order }}</td>
                                        <td>{{ $order->note }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td class="d-flex flex-column" style="min-width: 100px;">
                                            <button class="btn btn-primary  mb-2" data-toggle="modal"
                                                data-target="#editmodal{{ $order->id }}">Chi tiết </button>
                                            <div class="modal fade " id="editmodal{{ $order->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg " role="document">
                                                    <div class="modal-content">
                                                        <form action="" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Chi tiết
                                                                    đơn
                                                                    hàng
                                                                </h5>
                                                                <button class="close" type="button"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table"
                                                                    style="width: 100%; border:1px solid #ccc">
                                                                    <thead class="thead-inverse">
                                                                        <tr>
                                                                            <th>Sản phẩm</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Đơn giá</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($billDetails as $item)
                                                                            @if ($item->id_bill == $order->id)
                                                                                <tr>
                                                                                    <td scope="row" class="d-flex">
                                                                                        <div class="product_image">
                                                                                            <img width="50px"
                                                                                                src="./image/product/{{ $item->products->image }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                        <div class="product_name ml-4"
                                                                                            style="font-weight: bold">
                                                                                            {{ $item->products->name }}
                                                                                        </div>
                                                                                    </td>
                                                                                    <td> {{ $item->quantity }} </td>
                                                                                    <td>
                                                                                        @if ($item->products->promotion_price == 0)
                                                                                            {{ number_format($item->products->unit_price) }}
                                                                                        @else
                                                                                            {{ number_format($item->products->promotion_price) }}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach



                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Thoát</button>

                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('success', $order->id) }}" method="get">
                                                <button type="submit" class="btn btn-success mb-2">
                                                    Thành công</button>
                                            </form>
                                            <form action="{{ route('failed', $order->id) }}" method="get">
                                                <button type="submit" class="btn btn-warning mb-2">
                                                    Thất bại</button>
                                            </form>


                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-success" style="color: #ffff">
                Đơn hàng thành công
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Người nhận</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Thời gian tạo</th>
                                <th>Ghi chú</th>
                                <th>Tổng thanh toán</th>
                                <th style="min-width: 100px;">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @if ($order->status == 2)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->Customer->name }}</td>
                                        <td>{{ $order->Customer->address }}</td>
                                        <td>{{ $order->Customer->phone_number }}</td>
                                        <td>{{ $order->date_order }}</td>
                                        <td>{{ $order->note }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td class="d-flex flex-column" style="min-width: 100px;">
                                            <button class="btn btn-primary  mb-2" data-toggle="modal"
                                                data-target="#editmodal{{ $order->id }}">Chi tiết </button>
                                            <div class="modal fade " id="editmodal{{ $order->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg " role="document">
                                                    <div class="modal-content">
                                                        <form action="" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Chi tiết
                                                                    đơn
                                                                    hàng
                                                                </h5>
                                                                <button class="close" type="button"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table"
                                                                    style="width: 100%; border:1px solid #ccc">
                                                                    <thead class="thead-inverse">
                                                                        <tr>
                                                                            <th>Sản phẩm</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Đơn giá</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($billDetails as $item)
                                                                            @if ($item->id_bill == $order->id)
                                                                                <tr>
                                                                                    <td scope="row" class="d-flex">
                                                                                        <div class="product_image">
                                                                                            <img width="50px"
                                                                                                src="./image/product/{{ $item->products->image }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                        <div class="product_name ml-4"
                                                                                            style="font-weight: bold">
                                                                                            {{ $item->products->name }}
                                                                                        </div>
                                                                                    </td>
                                                                                    <td> {{ $item->quantity }} </td>
                                                                                    <td>
                                                                                        @if ($item->products->promotion_price == 0)
                                                                                            {{ number_format($item->products->unit_price) }}
                                                                                        @else
                                                                                            {{ number_format($item->products->promotion_price) }}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach



                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Thoát</button>

                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>



                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 ">
            <div class="card-header py-3 bg-warning" style="color: #ffff">
                Đơn hàng giao không thành công
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Người nhận</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Thời gian tạo</th>
                                <th>Ghi chú</th>
                                <th>Tổng thanh toán</th>
                                <th style="min-width: 100px;">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @if ($order->status == 3)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->Customer->name }}</td>
                                        <td>{{ $order->Customer->address }}</td>
                                        <td>{{ $order->Customer->phone_number }}</td>
                                        <td>{{ $order->date_order }}</td>
                                        <td>{{ $order->note }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td class="d-flex flex-column" style="min-width: 100px;">
                                            <button class="btn btn-primary  mb-2" data-toggle="modal"
                                                data-target="#editmodal{{ $order->id }}">Chi tiết </button>
                                            <div class="modal fade " id="editmodal{{ $order->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg " role="document">
                                                    <div class="modal-content">
                                                        <form action="" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Chi tiết
                                                                    đơn
                                                                    hàng
                                                                </h5>
                                                                <button class="close" type="button"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table"
                                                                    style="width: 100%; border:1px solid #ccc">
                                                                    <thead class="thead-inverse">
                                                                        <tr>
                                                                            <th>Sản phẩm</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Đơn giá</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($billDetails as $item)
                                                                            @if ($item->id_bill == $order->id)
                                                                                <tr>
                                                                                    <td scope="row" class="d-flex">
                                                                                        <div class="product_image">
                                                                                            <img width="50px"
                                                                                                src="./image/product/{{ $item->products->image }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                        <div class="product_name ml-4"
                                                                                            style="font-weight: bold">
                                                                                            {{ $item->products->name }}
                                                                                        </div>
                                                                                    </td>
                                                                                    <td> {{ $item->quantity }} </td>
                                                                                    <td>
                                                                                        @if ($item->products->promotion_price == 0)
                                                                                            {{ number_format($item->products->unit_price) }}
                                                                                        @else
                                                                                            {{ number_format($item->products->promotion_price) }}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach



                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Thoát</button>

                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('success', $order->id) }}" method="get">
                                                <button class="btn btn-success mb-2" type="submit"">
                                                    Giao hàng</button>
                                            </form>


                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-danger" style="color: #ffff">
                Đơn hàng đã hủy
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Người nhận</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Thời gian tạo</th>
                                <th>Ghi chú</th>
                                <th>Tổng thanh toán</th>
                                <th style="min-width: 100px;">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @if ($order->status == 4)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->Customer->name }}</td>
                                        <td>{{ $order->Customer->address }}</td>
                                        <td>{{ $order->Customer->phone_number }}</td>
                                        <td>{{ $order->date_order }}</td>
                                        <td>{{ $order->note }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td class="d-flex flex-column" style="min-width: 100px;">
                                            <button class="btn btn-primary  mb-2" data-toggle="modal"
                                                data-target="#editmodal{{ $order->id }}">Chi tiết </button>
                                            <div class="modal fade " id="editmodal{{ $order->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg " role="document">
                                                    <div class="modal-content">
                                                        <form action="" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Chi tiết
                                                                    đơn
                                                                    hàng
                                                                </h5>
                                                                <button class="close" type="button"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table"
                                                                    style="width: 100%; border:1px solid #ccc">
                                                                    <thead class="thead-inverse">
                                                                        <tr>
                                                                            <th>Sản phẩm</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Đơn giá</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($billDetails as $item)
                                                                            @if ($item->id_bill == $order->id)
                                                                                <tr>
                                                                                    <td scope="row" class="d-flex">
                                                                                        <div class="product_image">
                                                                                            <img width="50px"
                                                                                                src="./image/product/{{ $item->products->image }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                        <div class="product_name ml-4"
                                                                                            style="font-weight: bold">
                                                                                            {{ $item->products->name }}
                                                                                        </div>
                                                                                    </td>
                                                                                    <td> {{ $item->quantity }} </td>
                                                                                    <td>
                                                                                        @if ($item->products->promotion_price == 0)
                                                                                            {{ number_format($item->products->unit_price) }}
                                                                                        @else
                                                                                            {{ number_format($item->products->promotion_price) }}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach



                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Thoát</button>

                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endif
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
