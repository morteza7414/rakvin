<x-main-layout>

    <x-slot name="title">
        سفارشات
    </x-slot>

    <x-slot name="links">
        <!-- Ekko Lightbox -->
        <link rel="stylesheet" href="{{asset('assets/plugins/ekko-lightbox/ekko-lightbox.css')}}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet"
              href="{{asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    </x-slot>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            سفارشات
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">
                                لیست سفارشات
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
                @if(!empty($orders))
                    <div class="card-header">
                        <h3 class="card-title">لیست سفارشات</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 2%">
                                    شناسه
                                </th>
                                <th style="width: 12%">
                                    نام سفارش دهنده
                                </th>
                                <th style="width: 12%">
                                    نام معرف
                                </th>
                                <th style="width: 10%">
                                    شماره تماس
                                </th>
                                <th style="width: 10%">
                                    وضعیت
                                </th>
                                <th style="width: 12%">
                                    تاریخ
                                </th>
                                <th style="width: 20%">
                                    عملیات
                                </th>
                            </tr>
                            </thead>

                            @foreach($orders as $order)
                                <tbody>
                                <tr>
                                    <td>
                                        {{$order->id}}
                                    </td>
                                    <td>
                                        <a>
                                            {{$order->customer->name}}
                                        </a>
                                    </td>
                                    <td>
                                        <a>
                                            {{$order->customer->identifier($order->user_id)->name}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$order->phone}}
                                    </td>
                                    <td class="project_progress">
                                        @if($order->status == 1)
                                            <span>
                                                    در انتظار ثبت
                                                </span>
                                        @elseif($order->status == 2)
                                            <span>
                                                  ثبت شده
                                                </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$order->getCreatedAtInPersian()}}
                                    </td>
                                    <td class="project-actions  ">
                                        <a class="btn btn-info btn-sm" href="{{route('order.show',$order->id)}}">
                                            <i class="fas fa-eye">
                                            </i>
                                            مشاهده
                                        </a>
                                        @if(auth()->user()->role == "admin" and $order->status == 1)
                                            <form class="display-content" action="{{route('order.submit',$order->id)}}" method="post">
                                                @csrf
                                                @method('put')
                                                <button class="btn btn-primary btn-sm" href="#">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    تایید
                                                </button>
                                            </form>
                                        @elseif(auth()->user()->role == "user" and $order->status == 1)
                                            <form action="{{route("order.delete",$order->id)}}" method="post">
                                                @csrf
                                                @method('delete')

                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    حذف
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <div class="paginate-links">
                            {{ $orders->onEachSide(1)->links() }}
                        </div>
                    </div>
                    <!-- /.card-body -->

                @else
                    <div class="col-12 text-center">
                        <p>
                            سفارشی موجود نمی باشد!
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

        <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- Summernote -->
        <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
        <!-- Ekko Lightbox -->
        <script src="{{asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
        <!-- Filterizr-->
        <script src="{{asset('assets/plugins/filterizr/jquery.filterizr.min.js')}}"></script>

        <!-- Select2 -->
        <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="{{asset('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
        <!-- InputMask -->
        <script src="{{asset('assets/plugins/inputmask/jquery.inputmask.bundle.js')}}"></script>


        <!-- Page specific script -->
        <script>
            $(function () {
                $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                    event.preventDefault();
                    $(this).ekkoLightbox({
                        alwaysShowClose: true
                    });
                });

                $('.filter-container').filterizr({gutterPixels: 3});
                $('.btn[data-filter]').on('click', function () {
                    $('.btn[data-filter]').removeClass('active');
                    $(this).addClass('active');
                });
            })
        </script>
        <script>
            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2({
                    theme: 'bootstrap4'
                })

                //Datemask dd/mm/yyyy
                $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
                //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
                //Money Euro
                $('[data-mask]').inputmask()

                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    locale: {
                        format: 'MM/DD/YYYY hh:mm A'
                    }
                })
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                    {
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate: moment()
                    },
                    function (start, end) {
                        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                    }
                )

                //Timepicker
                $('#timepicker').datetimepicker({
                    format: 'LT'
                })

                //Bootstrap Duallistbox
                $('.duallistbox').bootstrapDualListbox()

                //Colorpicker
                $('.my-colorpicker1').colorpicker()
                //color picker with addon
                $('.my-colorpicker2').colorpicker()

                $('.my-colorpicker2').on('colorpickerChange', function (event) {
                    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
                });
            })
        </script>


    </x-slot>

</x-main-layout>
