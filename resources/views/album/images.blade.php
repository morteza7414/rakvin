<x-main-layout>

    <x-slot name="title">
        آلبوم ها
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
        <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
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
                                گالری تصاویر
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">

                                <div class="card-title">
                                    عکس های مربوط به آلبوم {{$album->name}}
                                </div>
                                @if(auth()->user()->role == "admin")
                                    <div class="float-left">
                                    <form role="form" method="get"
                                          action="{{route('addImagesToAlbum',$album->id)}}">

                                        <button type="submit" class="btn btn-sm btn-dark stand-middle">
                                            <i class="fas fa-image"></i> افزودن عکس
                                        </button>
                                    </form>
                                    </div>
                                @elseif(auth()->user()->role == "architect")
                                    <div class="float-left">
                                        <form role="form" method="get"
                                              action="{{route('set.album.accessible',$album->id)}}">

                                            <button type="submit" class="btn btn-sm btn-dark stand-middle">
                                                <i class="fas fa-image"></i> مدیریت دسترسی
                                            </button>
                                        </form>
                                    </div>
                                @endif

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if(!empty($images))
                                        @foreach($images as $image)
                                            <div class="col-sm-2">
                                                <a href="{{$image->url}}"
                                                   data-toggle="lightbox" data-title="عکس شماره {{$image->id}}"
                                                   data-gallery="gallery">
                                                    <img src="{{$image->url}}"
                                                         class="img-fluid mb-2" alt="عکس شماره {{$image->id}}"/>
                                                </a>
                                                @if(auth()->user()->role == "user")
                                                    <form role="form" method="post"
                                                          action="{{route('cart.create')}}">
                                                        @csrf
                                                        <input value="{{$image->id}}" name="imageId" hidden>
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-image"></i> سفارش عکس کد {{$image->id}}
                                                        </button>
                                                    </form>
                                                @endif
                                                @if(auth()->user()->role == "admin")
                                                    <form role="form" method="post"
                                                          action="{{route('delete.album.image',$image->id)}}">
                                                        @csrf
                                                        @method("delete")
                                                        <button type="submit" class="btn btn-sm btn-danger stand-middle">
                                                            <i class="fas fa-image"></i> حذف عکس کد {{$image->id}}
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
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
                $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
                //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
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
                        ranges   : {
                            'Today'       : [moment(), moment()],
                            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate  : moment()
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

                $('.my-colorpicker2').on('colorpickerChange', function(event) {
                    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
                });
            })
        </script>


    </x-slot>

</x-main-layout>
