<x-main-layout>

    <x-slot name="title">
        صفحه طراح
    </x-slot>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">صفحه طراح</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active"> صفحه {{$architect->name}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
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
                                                 src="{{($architect->thumbnail)? $architect->thumbnail : asset('images/users_profile/avatar5.png')}}"
                                                 alt="User profile picture">
                                        </div>

                                        <h3 class="profile-username text-center">{{$architect->name}}</h3>

                                        <p class="text-muted text-center">
                                                طراح
                                        </p>
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>تعداد آلبوم</b>
                                                <a class="float-right">
                                                    {{count($architect->albums)}}
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>تعداد عکس</b>
                                                <a class="float-right">
                                                    {{count($architect->images())}}
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>تاریخ شروع فعالیت</b>
                                                <a class="float-right">
                                                    {{$architect->getCreatedAtInPersian()}}
                                                </a>
                                            </li>
                                        </ul>
                                        <form action="{{route('get.albums.forAdmin')}}" method="get">
                                            <input hidden value="{{$architect->id}}" name="architectId">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <b>مشاهده آلبوم ها</b>
                                            </button>
                                        </form>
                                        <a href="{{route('architect.password',$architect->id)}}" class="btn btn-primary btn-block margin-vertical-10">
                                            <b>ویرایش رمزعبور</b>
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
