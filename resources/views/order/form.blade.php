<x-main-layout>

    <x-slot name="title">
        ثبت سفارش
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
    </x-slot>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">فرم سفارش</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">
                                ثبت سفارش
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
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title float-none text-center">
                                    لطفا فرم سفارش خود را تکمیل نمایید
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" method="post" action="{{route('order.store')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group display-flex">
                                        <label>
                                            تعداد سفارش:
                                        </label>
                                        <div class="margin-horizental-10">
                                            <span>
                                            {{count(auth()->user()->carts)}} عدد
                                            </span>
                                        </div>
                                    </div>

                                    <div class="dropdown-divider"></div>

                                    <div class="form-group">
                                        <label>
                                            لوگو:
                                        </label>
                                        <div class="form-row-description">
                                            <p>
                                                در صورتی که لوگو دارید لطفا آنرا ارسال نمایید.
                                            </p>
                                        </div>
                                        <div class="row">
                                            <div class="form-group display-flex col-6">
                                                <h6 class="margin-0 align-self-center">
                                                    قبلا ارسال کرده ام:
                                                </h6>
                                                <input class="margin-horizental-10" type="checkbox" value="true"
                                                       name="hasLogo"
                                                       @if(count(auth()->user()->uploads) > 0) checked="checked" @endif
                                                ">
                                            </div>
                                            <div class="form-group inline_flex col-6">
                                                <div class="images-inputs-div">
                                                    <div class="input-group">
                                                          <span class="input-group-btn">
                                                            <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                               class="btn btn-primary text-white">
                                                              <i class="fa fa-picture-o"></i> آپلود
                                                            </a>
                                                          </span>
                                                        <input id="thumbnail" class="form-control" type="image/*"
                                                               name="logo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group display-flex ">
                                            <h6 class="margin-0">
                                                تقاضای لوگو دارید:
                                            </h6>
                                            <input class="margin-horizental-10" type="checkbox" value="true"
                                                   name="wantLogo">
                                        </div>
                                    </div>

                                    <div class="dropdown-divider"></div>

                                    <div class="form-group">
                                        <label>نام و نام خانوادگی</label>
                                        <input name="name" type="text" class="form-control"
                                               value="{{auth()->user()->name}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>شماره موبایل</label>
                                        <input name="mobile" type="number" class="form-control"
                                               value="{{auth()->user()->mobile}}"
                                               disabled placeholder="شماره موبایل">
                                    </div>
                                    <div class="form-group">
                                        <label>شهر</label>
                                        <input name="city" type="text" class="form-control"
                                               @if(!empty(auth()->user()->city)) value="{{auth()->user()->city}}"
                                               @else placeholder="نام شهر خود را وارد نمایید" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label>آدرس</label>
                                        <input name="address" type="text" class="form-control"
                                               @if(!empty(auth()->user()->address)) value="{{auth()->user()->address}}"
                                               @else placeholder="آدرس خود را وارد نمایید" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label>ساختمان</label>
                                        <input name="building" type="text" class="form-control"
                                               @if(!empty(auth()->user()->building)) value="{{auth()->user()->building}}"
                                               @else placeholder="نام ساختمان خود را وارد نمایید" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label>تلفن هماهنگی</label>
                                        <input name="phone" type="number" class="form-control"
                                               @if(!empty(auth()->user()->phone)) value="{{auth()->user()->phone}}"
                                               @else value="{{auth()->user()->mobile}}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label>توضیحات</label>
                                        <input name="description" type="text" class="form-control"
                                               placeholder="توضیحات بیشتر در مورد سفارشتان را وارد کنید">
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">ثبت سفارش</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


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

        <script>
            var route_prefix = "/filemanager";
        </script>

        <script>
            (function ($) {
                $.fn.filemanager = function (type, options) {
                    type = type || 'file';

                    this.on('click', function (e) {
                        var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                        var target_input = $('#' + $(this).data('input'));
                        var target_preview = $('#' + $(this).data('preview'));
                        window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                        window.SetUrl = function (items) {
                            var file_path = items.map(function (item) {
                                return item.url;
                            }).join(',');

                            // set the value of the desired input to image url
                            target_input.val('').val(file_path).trigger('change');

                            // clear previous preview
                            target_preview.html('');

                            // set or change the preview image src
                            items.forEach(function (item) {
                                target_preview.append(
                                    $('<img>').css('height', '5rem').attr('src', item.thumb_url)
                                );
                            });

                            // trigger change event
                            target_preview.trigger('change');
                        };
                        return false;
                    });
                }

            })(jQuery);

        </script>

        <script>
            $('#lfm').filemanager('image', {prefix: route_prefix});
        </script>

        <script>
            var lfm = function (id, type, options) {
                let button = document.getElementById(id);

                button.addEventListener('click', function () {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                    var target_input = document.getElementById(button.getAttribute('data-input'));
                    var target_preview = document.getElementById(button.getAttribute('data-preview'));

                    window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
                    window.SetUrl = function (items) {
                        var file_path = items.map(function (item) {
                            return item.url;
                        }).join(',');

                        // set the value of the desired input to image url
                        target_input.value = file_path;
                        target_input.dispatchEvent(new Event('change'));

                        // clear previous preview
                        target_preview.innerHtml = '';

                        // set or change the preview image src
                        items.forEach(function (item) {
                            let img = document.createElement('img')
                            img.setAttribute('style', 'height: 5rem')
                            img.setAttribute('src', item.thumb_url)
                            target_preview.appendChild(img);
                        });

                        // trigger change event
                        target_preview.dispatchEvent(new Event('change'));
                    };
                });
            };

            lfm('lfm2', 'file', {prefix: route_prefix});
        </script>
    </x-slot>

</x-main-layout>
