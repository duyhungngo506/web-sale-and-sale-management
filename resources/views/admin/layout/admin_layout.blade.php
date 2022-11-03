{{-- @if (Route::has('login'))
    @auth
    @else
        <script>
            window.location = "{{ url('admin/login') }}";
        </script>
    @endauth
@endif --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Quản lý bán hàng</title>
    @yield('css')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.layout.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('admin.layout.topbar')
                @yield('content')
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            @include('admin.layout.footer')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" style="" id="logoutModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn thoát tài khoản?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Lựa chọn "Đăng xuất để kết thúc phiên đăng nhập hiện tại"</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Thoát</button>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Đăng xuất</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @yield('js')

</body>

</html>
