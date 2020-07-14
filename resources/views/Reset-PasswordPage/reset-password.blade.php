@extends('layout.layout-blank')

@section('styles')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/authentication.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
		<script>
            var blockedEmail = false;
            var blockedLogin = false;
			function check_login() {
                var log = $("#login").val().trim();
                $.ajax({
                    url: '/Check_login',
                    type: 'POST',
                    data: {
                        log: log
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data == -1) {
                            blockedLogin = true;
                        } else {
                            blockedLogin = false;
                        }
                        if (blockedEmail && blockedLogin) $('#password').show();
                        else $('#password').hide();
                    },
                    error: function(msg) {
                        alert('Error, try again');
                    }
                });
            }

            function check_email() {
                var email = $("#email").val().trim();
                $.ajax({
                    url: '/Check_email',
                    type: 'POST',
                    data: {
                        email: email
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data == -1) {
                            blockedEmail = true;
                        } else {
                            blockedEmail = false;
                        }
                        if (blockedEmail && blockedLogin) $('#password').show();
                        else $('#password').hide();
                    },
                    error: function(msg) {
                        alert('Error, try again');
                    }
                });
            }

            function check_pass()
            {
                if ($('#password').val().trim() != '') $('#ButtonFormAuth').prop('disabled', false);
                else $('#ButtonFormAuth').prop('disabled', true);
            }

            function reset_pwd()
            {
                $.ajax({
                    url: '/reset_pwd/reset',
                    type: 'GET',
                    data: $('#resetForm').serialize(),
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data == -1) {
                            Alert('Произошла ошибка при смене пароля, повторите попытку!');
                        } else {
                            window.location.href = "/";
                        }
                    },
                    error: function(msg) {
                        alert('Error, try again');
                    }
                });
            }
		</script>
@endsection

@section('content')
    <div class="authentication-wrapper authentication-2 px-4">
        <div class="authentication-inner py-5">
            <!-- Form -->
            <form class="card" action="" method="GET" name="resetForm" id="resetForm">
                {{ csrf_field() }}
                <div class="p-4 p-sm-5">
                    <!-- Logo -->
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset("images/logo.png") }}" alt="" style="width: 100px; height: auto; margin-bottom: 25px;">
                    </div>
                     <!--/ Logo -->
                    <h5 class="text-center text-muted font-weight-normal mb-4">Восстановление пароля</h5>
                    <hr class="mt-0 mb-4">
                    <div class="form-group">
                        <input class="form-control" type="text" name="login" id="login" placeholder="Логин" value="" onkeyup="check_login()" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email" value="" onkeyup="check_email()" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Новый пароль" value="" style="display: none;" onkeyup="check_pass()" required/>
                    </div>
                    <input type="button" name="ButtonFormAuth" value="Восстановить пароль" class="btn btn-primary btn-block" id="ButtonFormAuth" onClick="reset_pwd()" disabled />
				</div>
            </form>
            <!-- / Form -->

        </div>
    </div>
@endsection