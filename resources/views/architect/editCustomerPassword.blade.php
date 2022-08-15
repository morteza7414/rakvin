<x-main-layout>

    <x-slot name="title">
        ویرایش پسورد مشتری
    </x-slot>

    <x-slot name="links">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet"
              href="{{asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </x-slot>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">ویرایش رمزعبور</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">ویرایش </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">ویرایش پسورد مشتری</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <!-- error handling-->
                    <div class="col-12">
                        @error('architect')
                        <p class="error_message">
                            {{ $message }}
                        </p>
                        @enderror
                        @error('password')
                        <p class="error_message">
                            {{ $message }}
                        </p>
                        @enderror
                        @error('repeatPassword')
                        <p class="error_message">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <!-- body content -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if(!empty(auth()->user()->customers()))
                                <form role="form" method="post" action="{{route('store.customer.password')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label>انتخاب مشتری</label>
                                        <select name="customerId" class="form-control select2" style="width: 100%;">
                                            <option value="{{auth()->user()->customers()->first()->id}}" selected="selected">{{auth()->user()->customers()->first()->name}} با شماره همراه  {{auth()->user()->customers()->first()->mobile}}</option>
                                            @foreach($customers->skip(1) as $customer)
                                                <option value="{{$customer->id}}">{{$customer->name}} با شماره همراه  {{$customer->mobile}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">درخواست رمز جدید</button>
                                    </div>
                                </form>
                                @endif

                            </div>

                        </div>
                        <!-- /.row -->
                        <div class="col-12">
                            @error('architect')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                            @enderror
                            @error('album_name')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <x-slot name="scripts">
        <!-- Select2 -->
        <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="{{asset('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
        <!-- InputMask -->
        <script src="{{asset('assets/plugins/inputmask/jquery.inputmask.bundle.js')}}"></script>
        <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
        <!-- date-range-picker -->
        <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- bootstrap color picker -->
        <script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>

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

        @if(Session::has('editCustomerPassword'))
            <script>
                Swal.fire({text: "{{ session('editCustomerPassword') }}",title:"رمز عبور مشتری ویرایش شد!", confirmButtonText: 'تایید', icon: 'success'})
            </script>
        @endif

    </x-slot>

</x-main-layout>
