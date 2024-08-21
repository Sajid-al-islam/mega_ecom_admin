<!DOCTYPE html>
    
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Raleway, sans-serif;
        }

        body {
            /* background: linear-gradient(90deg, #C7C5F4, #776BCC); */
            background-image: url('/loginbg.jpg');
            background-size: cover;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
            backdrop-filter: blur(5px);
            width: unset;
            max-width: unset;
        }

        .screen {
            background: linear-gradient(90deg, #5D54A4, #7C78B8);
            position: relative;
            height: 600px;
            width: 360px;
            box-shadow: 0px 0px 24px #5C5696;
        }

        .screen__content {
            z-index: 1;
            position: relative;
            height: 100%;
        }

        .screen__background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            -webkit-clip-path: inset(0 0 0 0);
            clip-path: inset(0 0 0 0);
        }

        .screen__background__shape {
            transform: rotate(45deg);
            position: absolute;
        }

        .screen__background__shape1 {
            height: 520px;
            width: 520px;
            background: #FFF;
            top: -50px;
            right: 120px;
            border-radius: 0 72px 0 0;
        }

        .screen__background__shape2 {
            height: 220px;
            width: 220px;
            background: #6C63AC;
            top: -172px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape3 {
            height: 540px;
            width: 190px;
            background: linear-gradient(270deg, #5D54A4, #6A679E);
            top: -24px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape4 {
            height: 400px;
            width: 200px;
            background: #7E7BB9;
            top: 420px;
            right: 50px;
            border-radius: 60px;
        }

        .login {
            width: 320px;
            padding: 30px;
            padding-top: 156px;
        }

        .login__field {
            padding: 20px 0px;
            position: relative;
        }

        .login__icon {
            position: absolute;
            top: 30px;
            color: #7875B5;
        }

        .login__input {
            border: none;
            border-bottom: 2px solid #D1D1D4;
            background: none;
            padding: 10px;
            padding-left: 24px;
            font-weight: 700;
            width: 75%;
            transition: .2s;
        }

        .login__input:active,
        .login__input:focus,
        .login__input:hover {
            outline: none;
            border-bottom-color: #6A679E;
        }

        .login__submit {
            background: #fff;
            font-size: 14px;
            margin-top: 30px;
            padding: 16px 20px;
            border-radius: 26px;
            border: 1px solid #D4D3E8;
            text-transform: uppercase;
            font-weight: 700;
            display: flex;
            align-items: center;
            width: 100%;
            color: #4C489D;
            box-shadow: 0px 2px 2px #5C5696;
            cursor: pointer;
            transition: .2s;
        }

        .login__submit:active,
        .login__submit:focus,
        .login__submit:hover {
            border-color: #6A679E;
            outline: none;
        }

        .button__icon {
            font-size: 24px;
            margin-left: auto;
            color: #7875B5;
        }

        .social-login {
            position: absolute;
            height: 140px;
            width: 160px;
            text-align: center;
            bottom: 0px;
            right: 0px;
            color: #fff;
        }

        .social-icons {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-login__icon {
            padding: 20px 10px;
            color: #fff;
            text-decoration: none;
            text-shadow: 0px 0px 8px #7875B5;
        }

        .social-login__icon:hover {
            transform: scale(1.5);
        }

        .social-login {
            height: 100px;
            width: 100%;
            top: 38px;
        }

        button:disabled .visually-hidden {
            display: block;
            color: #6662a0;
            width: 215px !important;
            height: 20px !important;
            clip: unset !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" onsubmit="submitHandler()">
                    @csrf
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <div>
                            <input type="email" class="login__input @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="email">
                            <p class="text-danger" id="email"></p>
                        </div>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <div>
                            <input type="password" class="login__input @error('password') is-invalid @enderror"
                                name="password" autocomplete="new-password" placeholder="Password">

                            <p class="text-danger" id="password"></p>
                        </div>
                    </div>
                    {{-- <button class="button login__submit">
                        <span class="button__text">Log In Now</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button> --}}
                    <div>
                        <button class="button login__submit" type="submit" id="spiner">
                            <span class="button__text">Log In</span>
                            <i class="button__icon fas fa-chevron-right"></i>
                            <span class="spinner-border spinner-border-sm d-none mx-2" role="status"
                                aria-hidden="true"></span>
                            <span class="visually-hidden">Loading...</span>
                        </button>
                    </div>
                </form>
                <div class="social-login">
                    <img src="https://etek.com.bd/cache/frontend/images/etek_logo.png" style="width: 150px;"
                        alt="">
                    {{-- <h3>log in via</h3>
                    <div class="social-icons">
                        <a href="#" class="social-login__icon fab fa-instagram"></a>
                        <a href="#" class="social-login__icon fab fa-facebook"></a>
                        <a href="#" class="social-login__icon fab fa-twitter"></a>
                    </div> --}}
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
    <script>
        function submitHandler() {
            event.preventDefault()

            let spiner = document.getElementById('spiner')
            loadHandler(spiner, response = false)

            //  spiner.classList.remove('d-none')
            fetch('login', {
                    method: "POST",
                    body: new FormData(event.target),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'validation_error') {
                        loadHandler(spiner, response = true)
                        let error = data.errors
                        Object.entries(error).forEach(([key, value]) => {
                            let field = document.getElementById(key)
                            if (field) {
                                field.innerText = value
                            }
                        });
                    } else if (data.status === 'error') {
                        loadHandler(spiner, response = true)
                        let target = document.getElementById('errorMsgShow')
                        target.innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
                                <strong>Error! ${data.message}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" onclick="document.getElementById('errorMsgShow').classList.add('d-none')">&times;</span>
                                </button>
                            </div>
                            `;
                        target.classList.remove('d-none');
                    } else {
                        localStorage.setItem('token', data.access_token);
                        window.location.href = 'admin#/dashboard';
                    }

                })
        }

        function loadHandler(target, response) {
            if (response) {
                target.removeAttribute('disabled')
                target.children[0].classList.remove('d-none')
                target.children[1].classList.add('d-none')
                target.children[2].classList.add('visually-hidden')
            } else {
                target.setAttribute('disabled', true)
                target.children[0].classList.add('d-none')
                target.children[1].classList.remove('d-none')
                target.children[2].classList.remove('visually-hidden')
            }
        }
    </script>
</body>

</html>
