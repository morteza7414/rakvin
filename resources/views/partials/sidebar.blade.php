<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('images/logo-test.png')}}" alt="Rakvin Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Rakvin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    src="{{(auth()->user()->thumbnail)? auth()->user()->thumbnail : asset('images/users_profile/avatar5.png')}}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview @if(request()->is('*/dashboard')) menu-open @endif">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            داشبورد
                        </p>
                    </a>
                </li>
                @if(auth()->user()->role == "admin")
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                سفارشات
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('orders.get',['type' => 'new'])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        سفارشات جدید
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('orders.get',['type' => 'total'])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        کل سفارشات
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('architects.list')}}" class="nav-link">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                طراحان
                            </p>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/define-architect')) menu-open @endif">
                        <a href="{{route("define.architect")}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                معرفی طراح
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('defineAlbum')}}" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                معرفی آلبوم تصاویر
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('get.architect.forAlbum')}}" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                مشاهده آلبوم ها
                            </p>
                        </a>
                    </li>

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('architect.password')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-edit"></i>--}}
{{--                            <p>--}}
{{--                                تغیر پسورد طراح--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                @elseif(auth()->user()->role == "architect")
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                مشتریان
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('define.customer')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        معرفی مشتری جدید
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('total.customers')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        مشتریان معرفی شده
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('customer.password')}}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                تغیر پسورد مشتری
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('get.albums')}}" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                مشاهده آلبوم ها
                            </p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{route('get.albums')}}" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                آلبوم تصاویر
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                سفارشات
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('carts.show')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        سبد سفارش

                                        <span class="badge badge-info right">
                                            {{count(auth()->user()->carts)}}
                                        </span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('total.orders')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        سفارشات گذشته
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
{{--                        <i class="nav-icon far fa-circle text-danger"></i>--}}
                        <i class="nav-icon fa fa-dungeon"></i>
                        <p class="text">خروج از حساب</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
