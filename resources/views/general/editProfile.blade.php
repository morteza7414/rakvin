<x-main-layout>

    <x-slot name="title">
       ویرایش پروفایل
    </x-slot>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">ویرایش</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">پروفایل</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    مشخصات
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{route('store.edit.profile')}}">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="{{(auth()->user()->thumbnail)? auth()->user()->thumbnail : asset('images/users_profile/avatar5.png')}}"
                                             alt="User profile picture">
                                    </div>
                                    <div class="form-group">
                                        <label>عکس پروفایل</label>
                                        <div class="input-group">
                                          <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                              <i class="fa fa-picture-o"></i> انتخاب
                                            </a>
                                          </span>
                                            <input id="thumbnail" value="{{auth()->user()->thumbnail}}" class="form-control" type="image/*" name="thumbnail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label >شماره موبایل</label>
                                        <input disabled class="form-control" value="{{auth()->user()->mobile}}">
                                    </div>
                                    <div class="form-group">
                                        <label >نام و نام خانوادگی</label>
                                        <input name="name" type="text" class="form-control" value="{{auth()->user()->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label >شهر</label>
                                        <input name="city" type="text" class="form-control" @if(auth()->user()->city) value="{{auth()->user()->city}}" @else placeholder="نام شهر خود را وارد نمایید" @endif  >
                                    </div>
                                    <div class="form-group">
                                        <label >آدرس</label>
                                        <input name="address" type="text" class="form-control" @if(auth()->user()->address) value="{{auth()->user()->address}}" @else placeholder="آدرس خود را وارد کنید" @endif  >
                                    </div>
                                    <div class="form-group">
                                        <label >ساختمان</label>
                                        <input name="building" type="text" class="form-control" @if(auth()->user()->building) value="{{auth()->user()->building}}" @else placeholder="نام ساختمان خود را وارد نمایید" @endif  >
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">ذخیره اطلاعات</button>
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
    </div>

    <x-slot name="scripts">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
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
            // $('#lfm').filemanager('file', {prefix: route_prefix});
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

        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
        <style>
            .popover {
                top: auto;
                left: auto;
            }
        </style>
        <script>
            $(document).ready(function(){

                // Define function to open filemanager window
                var lfm = function(options, cb) {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                    window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
                    window.SetUrl = cb;
                };

                // Define LFM summernote button
                var LFMButton = function(context) {
                    var ui = $.summernote.ui;
                    var button = ui.button({
                        contents: '<i class="note-icon-picture"></i> ',
                        tooltip: 'Insert image with filemanager',
                        click: function() {

                            lfm({type: 'image', prefix: '/filemanager'}, function(lfmItems, path) {
                                lfmItems.forEach(function (lfmItem) {
                                    context.invoke('insertImage', lfmItem.url);
                                });
                            });

                        }
                    });
                    return button.render();
                };

                // Initialize summernote with LFM button in the popover button group
                // Please note that you can add this button to any other button group you'd like
                $('#summernote-editor').summernote({
                    toolbar: [
                        ['popovers', ['lfm']],
                    ],
                    buttons: {
                        lfm: LFMButton
                    }
                })
            });
        </script>


    </x-slot>

</x-main-layout>
