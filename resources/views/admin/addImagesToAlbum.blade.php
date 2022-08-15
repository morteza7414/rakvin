<x-main-layout>

    <x-slot name="title">
        معرفی طراح
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
                        <h1 class="m-0 text-dark">افزودن تصاویر آلبوم</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">خانه</a></li>
                            <li class="breadcrumb-item active">افزودن تصاویر</li>
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
                        <h3 class="card-title">افزودن تصاویر به آلبوم {{$album->name}} </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <!-- error handling -->
                    <div class="col-12">
                        @error('album')
                        <p class="error_message">
                            {{ $message }}
                        </p>
                        @enderror
                        @error('image1')
                        <p class="error_message">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <!-- /.error -->

                    <!-- body content -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <form role="form" method="post" action="{{route('store.albumImages')}}">
                                    @csrf
                                    <input value="{{$album->id}}" class="form-control" type="text"
                                           name="album" hidden>
                                    <div class="form-group">
                                        <label>طراح:</label>
                                        <select class="form-control select2" disabled="disabled" style="width: 100%;">
                                            @if($album->architect()->first())
                                                <option selected="selected">
                                                    {{$album->architect()->first()->name}}
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>نام آلبوم:</label>
                                        <select class="form-control select2" disabled="disabled" style="width: 100%;">
                                            <option selected="selected">
                                                {{$album->name}}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="row col-md-12 form-group">
                                        <label>تصاویر آلبوم:</label>
                                        <div id="albumImages" class="inputs_container col-12">
                                            <div class="form-group inline_flex col-lg-6">
                                                <label>
                                                    تصویر 1:
                                                </label>
                                                <div class="images-inputs-div">
                                                    <div class="input-group">
                                                          <span class="input-group-btn">
                                                            <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                               class="btn btn-primary text-white">
                                                              <i class="fa fa-picture-o"></i> انتخاب
                                                            </a>
                                                          </span>
                                                        <input id="thumbnail" class="form-control" type="image/*"
                                                               name="image1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-dark" onclick="javascript:void(0)" id="addImage">
                                            افزودن تصویر جدید
                                        </button>
                                    </div>


                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">ذخیره اطلاعات</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                        <!-- /.row -->
                        <div class="col-12">
                            @error('mobile')
                            <p class="error_message">
                                {{ $message }}
                            </p>
                            @enderror
                            @error('password')
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
        <!-- add image input -->
        <script>
            var i = 2;
            $("#addImage").click(function () {
                var html = '';
                html += '<div class="form-group inline_flex col-lg-6">'
                html += '<label>'
                html += 'تصویر' + i + ':'
                html += '</label>'
                html += '<div class="images-inputs-div">'
                html += '<div class="input-group">'
                html += '<span class="input-group-btn">'
                html += '<a id="image' + i + '" data-input="thumbnail' + i + '" data-preview="holder" class="btn btn-primary text-white">'
                html += '<i class="fa fa-picture-o">'
                html += '</i>'
                html += ' انتخاب'
                html += '</a>'
                html += '</span>'
                html += '<input id="thumbnail' + i + '" class="form-control" type="image/*" name="image' + i + '">'
                html += '</div>'
                html += '</div>'
                html += '</div>'

                $('#albumImages').append(html);
                $('#image' + i + '').filemanager('image', {prefix: route_prefix});
                i++
            });
        </script>
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
            (function( $ ){
                $.fn.filemanager = function(type, options) {
                    type = type || 'file';

                    this.on('click', function(e) {
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
            var lfm = function(id, type, options) {
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
