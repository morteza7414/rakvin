<x-main-layout>

    <x-slot name="title">
        داشبورد مشتری
    </x-slot>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">داشبورد</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">داشبورد {{auth()->user()->name}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    {{count(auth()->user()->customerAccessibleAlbums()->get())}}
                                </h3>

                                <p>  آلبوم</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{route('get.albums')}}" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    {{auth()->user()->customerAccessibleimagesCount()}}
                                </h3>

                                <p>عکس </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    {{count(auth()->user()->orders)}}
                                </h3>

                                <p>سفارشات</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{route('total.orders')}}" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    {{count(auth()->user()->carts)}}
                                </h3>

                                <p>سبد سفارش</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('carts.show')}}" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main conent -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                 src="{{(auth()->user()->thumbnail)? auth()->user()->thumbnail : asset('images/users_profile/avatar5.png')}}"
                                                 alt="User profile picture">
                                        </div>

                                        <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

                                        <p class="text-muted text-center">
                                            @if(auth()->user()->role == "admin")
                                                ادمین
                                            @elseif((auth()->user()->role == "architect"))
                                                طراح
                                            @else
                                                مشتری
                                            @endif
                                        </p>
                                        @if(auth()->user()->role == "user")
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>نام و نام خانوادگی</b>
                                                    <a class="float-right">
                                                        {{auth()->user()->name}}
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>شماره همراه</b>
                                                    <a class="float-right">
                                                        {{auth()->user()->mobile}}
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>آدرس</b>
                                                    <a class="float-right">
                                                        {{auth()->user()->address}}
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>تاریخ ثبت نام</b>
                                                    <a class="float-right">
                                                        {{auth()->user()->getCreatedAtInPersian()}}
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif

                                        <a href="{{route('edit.profile')}}" class="btn btn-primary btn-block">
                                            <b>ویرایش</b>
                                        </a>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.section (main content) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <x-slot name="scripts">
        <!-- ChartJS -->
        <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
        <!-- Sparkline -->
        <script src="{{asset('assets/plugins/sparklines/sparkline.js')}}"></script>
        <!-- JQVMap -->
        <script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.world.js')}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
        <!-- daterangepicker -->
        <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- Summernote -->
        <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>


    </x-slot>

</x-main-layout>
