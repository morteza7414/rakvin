<x-simple-layout>

    <x-slot name="title">
        صفحه ورود
    </x-slot>

    <x-slot name="links">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        ...
        <script type="text/javascript">
            function callbackThen(response){
                // read HTTP status
                console.log(response.status);

                // read Promise object
                response.json().then(function(data){
                    console.log(data);
                });
            }
            function callbackCatch(error){
                console.error('Error:', error)
            }
        </script>
        htmlScriptTagJsApiV3([
            'action' => 'homepage',
            'callback_then' => 'callbackThen',
            'callback_catch' => 'callbackCatch'
        ])
    </x-slot>

    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">
                <img src="{{asset('images/logo-test.png')}}">
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    ورود به پنل کاربری
                </p>

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

                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="mobile" type="number" class="form-control" placeholder="شماره همراه">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
{{--                        @error('mobile')--}}
{{--                        <p class="error_message">--}}
{{--                            {{ $message }}--}}
{{--                        </p>--}}
{{--                        @enderror--}}
                    </div>

                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="رمز عبور">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
{{--                        @error('password')--}}
{{--                        <p class="error_message">--}}
{{--                            {{ $message }}--}}
{{--                        </p>--}}
{{--                        @enderror--}}
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    مرا به خاطر بسپار
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                ورود
                            </button>
{{--                            <button onclick=onClick() class="g-recaptcha"--}}
{{--                                    data-sitekey="6LerLR4hAAAAACuAW8QBIVlJ7VubhLCBAY9GYxcM"--}}
{{--                                    data-callback='onSubmit'--}}
{{--                                    data-action='submit'>--}}
{{--                                Submit--}}
{{--                            </button>--}}
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>

    <script src="https://www.google.com/recaptcha/api.js?render=6LerLR4hAAAAACuAW8QBIVlJ7VubhLCBAY9GYxcM"></script>

    <script>
        function onClick(e) {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('reCAPTCHA_site_key', {action: 'submit'}).then(function(token) {
                    // Add your logic to submit to your backend server here.
                });
            });
        }
    </script>

    </body>


</x-simple-layout>
