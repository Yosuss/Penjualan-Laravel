<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .loginBgTech {
            background-color: #fff
            background-repeat: no-repeat;
            background-size: cover;
            background-blend-mode: luminosity;
            display: flex;
            align-items: center;
            justify-content: center;
            letter-spacing: 1px;
            height: 100vh;
        }
        .row {
            background-color: #dbdbdb;
            padding: 2rem 3rem;
            border-radius: 3rem;    
        }
        .card-body{
            padding: 0;
        }
        .headerLogin {
            font-family: 'oswald', sans-serif !important;
            text-align: center;
            color: #765fcd;
            font-size: 40px;
        }
        .form-group-btn {
            justify-content: center;
        }
        .form-group-btn button{
            text-align: center;
        }
    </style>
</head>

<body class="loginBgTech">
    <div class="row">
        <div class="">
            <div class="card-shadow">
                <div class="card-header">
                    <h2 class="headerLogin">
                        Login {!! $appTitle !!}
                    </h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="label mb-2">Username</label>
                        <input type="text" class="form-control" name="username" id="userName" placeholder="username">
                    </div>
                    <div class="form-group">
                        <label class="label mb-2">Password</label>
                        <input type="password" class="form-control" name="password" id="passWord" placeholder="password">
                    </div>
                    <!-- spacer -->
                    <div class="m-2"></div>
                    <div class="form-group-btn">
                        <button class="btn btn-success btn-login">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <script type="module">
        $('.btn-login').on('click', function(a) {
            axios.post('{{url("login/check")}}', {
                username: $('#userName').val(),
                password: $('#passWord').val(),
                _token: '{{csrf_token()}}'
            }).then(function(response) {
                console.log(response)
                if (response.data.status === 'success') {
                    window.location.href = response.data.redirect_url
                } else {
                    Swal.fire('login gagal, Username atau password salah', '', 'error')
                }
            }).catch(function(error) {
                if (error.response.status == 422) {
                    Swal.fire(error.response.data.message, '', 'error')
                } else {
                    Swal.fire('login gagal, Username atau password salah', '', 'error')
                }
            })
        })
    </script>
</footer>

</html>