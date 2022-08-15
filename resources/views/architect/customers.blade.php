<x-main-layout>

    <x-slot name="title">
        مشتریان {{auth()->user()->name}}
    </x-slot>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">مشتریان</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">
                                مشاهده مشتریان
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
            <div class="card">
                @if(count($customers)>0)
                    <div class="card-header">
                        <h3 class="card-title">لیست مشتریان معرفی شده</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"
                                    data-toggle="tooltip"
                                    title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 2%">
                                    #
                                </th>
                                <th style="width: 20%">
                                    نام
                                </th>
                                <th style="width: 20%">
                                    شماره همراه
                                </th>
                                <th style="width: 9%">
                                    شهر
                                </th>
                                <th style="width: 15%">
                                    تاریخ ثبت نام
                                </th>
                                <th style="width: 20%">
                                    عملیات
                                </th>
                            </tr>
                            </thead>

                            @foreach($customers as $customer)
                                <tbody>
                                <tr>
                                    <td>
                                        #
                                    </td>
                                    <td>
                                        <a>
                                            {{$customer->name}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$customer->mobile}}
                                    </td>
                                    <td class="project_progress">
                                        {{$customer->city}}
                                    </td>
                                    <td class="project_progress">
                                        {{$customer->getCreatedAtInPersian()}}
                                    </td>
                                    <td class="project-actions ">
                                        <form action="{{route('set.customer.accessible',$customer->id)}}" method="get">
                                            <button type="submit" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit">
                                                </i>
                                                ویرایش دسترسی
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach

                        </table>
                        <div class="paginate-links">
                            {{ $customers->onEachSide(1)->links() }}
                        </div>
                    </div>
                    <!-- /.card-body -->
                @else
                    <div class="col-12 text-center">
                        <p>
                            هنوز مشتری از سمت شما معرفی نشده است!
                        </p>
                    </div>
                @endif
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
