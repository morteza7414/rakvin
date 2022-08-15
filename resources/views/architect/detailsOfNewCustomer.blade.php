<x-main-layout>

    <x-slot name="title">
        معرفی مشتری
    </x-slot>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> مشتری</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">مشخصات مشتری</li>
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
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    مشخصات مشتری
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی</label>
                                    <input class="form-control" value="{{$customer->name}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>نام کاربری(شماره موبایل)</label>
                                    <div class="inline_flex width-100">
                                        <input id="username" class="form-control" value="{{$customer->mobile}}"
                                               disabled>
                                        <button class="btn btn-primary" onclick="usernameCopy()">کپی</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>رمز عبور</label>
                                    <div class="inline_flex width-100">
                                        <input id="password" class="form-control" value="{{$password}}" disabled>
                                        <button class="btn btn-primary" onclick="passwordCopy()">کپی</button>
                                    </div>
                                </div>
                                <input hidden id="shareText" value="{{$text}}">

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button onclick=socialShareButton() class="btn btn-primary">
                                    اشتراک گذاری
                                </button>
                                <button class="btn btn-primary" onclick="allCopy()">کپی</button>
                            </div>
                            <div id="social_medias" style="display: none;transition: 0.3s ease-out" class="inline_flex ">
                                {!! $socialShare !!}
                            </div>
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
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

        <script>
            function usernameCopy() {
                /* Get the text field */
                var copyText = document.getElementById("username");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);

                /* Alert the copied text */
                alert("نام کاربری در حافظه ذخیره شد : " + copyText.value);
            }
        </script>
        <script>
            function passwordCopy() {
                /* Get the text field */
                var copyText = document.getElementById("password");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);

                /* Alert the copied text */
                alert("رمز عبور در حافظه ذخیره شد : " + copyText.value);
            }
        </script>
        <script>
            function allCopy() {
                /* Get the text field */
                var copyText = document.getElementById("shareText");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);

                /* Alert the copied text */
                alert("نام کاربری و رمز عبور در حافظه ذخیره شد.");
            }
        </script>
        <script>
            function socialShareButton() {
                /* Get the text field */
                var element = document.getElementById("social_medias");
                element.classList.toggle("active");
            }
        </script>


    </x-slot>

</x-main-layout>
