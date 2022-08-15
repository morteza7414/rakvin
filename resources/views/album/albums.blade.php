<x-main-layout>

    <x-slot name="title">
        آلبوم ها
    </x-slot>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">آلبوم تصاویر</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">
                                مشاهده آلبوم ها
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row d-flex align-items-stretch">
                        @foreach($albums as $album)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                <div class="card bg-light">
                                    <div class="card-header text-muted border-bottom-0">
                                        آلبوم {{$album->name}}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="album-baner">
                                                @if(!empty($album->baner))
                                                    <img src="{{$album->baner}}"
                                                         alt="album {{$album->name}} baner"
                                                         class="img-circle img-fluid">
                                                @else
                                                    <img src="{{asset('images/photo1.png')}}"
                                                         alt="album {{$album->name}} baner"
                                                         class="img-circle img-fluid">
                                                @endif
                                            </div>

                                            <div class="col-12 text-center">
                                                <h2 class="lead"><b>{{$album->name}}</b></h2>
                                                <p class="text-muted text-sm">
                                                    <b>طراح: </b> {{$album->architect()->first()->name}} </p>
                                                <p class="text-muted text-sm"><b>تعداد
                                                        عکس: </b> {{count($album->images)}} عدد </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <form role="form" method="get"
                                                  action="{{route('get.album.images',['id' => $album->id , 'slut'=>$album->slut])}}">
                                                <button type="submit"
                                                        class="btn btn-sm btn-primary">
                                                    <i class="fas fa-image"></i> مشاهده عکس های آلبوم
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                        <div class="paginate-links">
                            {{ $albums->onEachSide(1)->links() }}
                        </div>
                    </nav>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


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
