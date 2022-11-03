 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">HUNG BAKERY <sup></sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item">
         <a class="nav-link" href="{{ route('users.index') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Người dùng</span></a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('typeproducts.index') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Loại sản phẩm</span></a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('admin.products') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Sản phẩm</span></a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('orders.index') }}">
             <i class="fas fa-fw
             fa-tachometer-alt"></i>
             <span>Đơn hàng</span></a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('slides.index') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Slide</span></a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('vouchers.index') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Mã giảm giá</span></a>
     </li>



     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>



 </ul>
 <!-- End of Sidebar -->
