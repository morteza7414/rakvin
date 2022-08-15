<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">خانه</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">
        <!-- Messages Dropdown Menu -->
        @if(auth()->user()->role == "admin")
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">
                    {{count(\App\Models\Order::where('status',1)->get())}}
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                سفارشات مشاهده نشده
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">{{count(\App\Models\Order::where('status',1)->get())}} عدد سفارش </p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('orders.get',['type'=>'new'])}}" class="dropdown-item dropdown-footer">مشاهده</a>
            </div>
        </li>
        @endif
        <!-- Notifications Dropdown Menu -->
        @if(auth()->user()->role == "user")
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-cart-arrow-down"></i>
                    <span class="badge badge-warning navbar-badge">
                        {{count(auth()->user()->carts)}}
                    </span>
                </a>
                @if(count(auth()->user()->carts)>0)
                    <div class="mj-dropdown dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">سبد سفارش</span>
                        <div class="dropdown-divider"></div>
                        @foreach(auth()->user()->carts as $cart)
                            <a href="#" class="dropdown-item">
                                <div>
                                    <i class="fa fa-file-image mr-2"></i> عکس کد {{$cart->image_id}}
                                </div>
                                <span class="float-right text-muted text-sm">
                                آلبوم {{$cart->image()->first()->album->name}}
                            </span>
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                        <a href="{{route('carts.show')}}" class="dropdown-item dropdown-footer">
                            ادامه
                        </a>
                    </div>
                @endif
            </li>
        @endif

    </ul>
</nav>
