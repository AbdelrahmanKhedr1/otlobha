{{-- <!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: right;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>تسجيل الدخول</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">


                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html> --}}
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="{{ asset('dash_mag') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('dash_mag') }}/css/bootstrap.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+IN:wght@100..400&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #ffffff, rgba(34, 139, 34, 0.3));

        }

        .container {
            height: 100vh;
            direction: rtl;
        }

        .input-container {
            position: relative;
            padding-right: 30px;
            padding-left: 30px;
            margin-top: 30px;
            width: 100%;
        }

        input {
            padding: 12px 10px 12px 10px;
            font-size: 14px;
            width: 100%;
            border: none;
            border-bottom: 2px solid rgba(96, 115, 135, 0.3);
            outline: none;
            background-color: transparent;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input:focus {
            border-bottom: 2px solid #57b846;
        }

        label {
            position: absolute;
            right: 30px;
            top: 50%;
            font-size: 12px;
            color: #aaa;
            pointer-events: none;
            transition: all 0.3s ease;
            transform: translateY(-50%);
        }

        input:focus+label,
        input:not(:placeholder-shown)+label {
            font-size: 12px;
            color: grey;
        }

        .text {
            margin-top: 20px;
            font-family: "Playwrite IN", serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
        }


        form {
            height: 100vh;
            width: 390px;
            padding-top: 60px;
        }

        .login100-form-avatar {
            display: block;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
        }

        .logo {
            width: 100%;
            vertical-align: middle;
        }
    </style>
</head>

<body>


    <div class="container d-flex d-flex justify-content-center align-items-center">
        <form class="login" method="POST" action="{{ route('admin.login') }}">
            @csrf
            <h2 class="text-center text">Yalla Bena</h2>
            <span class="login100-form-avatar mt-3">
                <img class="logo" src="img/107.jpg">
            </span>
            <div class="input-container">
                <label for="my-input"> Email</label>
                <input type="email" id="my-input" name="email" required />
            </div>
            <div class="input-container">
                <label for="my-input">Password</label>
                <input type="password" name="password" id="my-input2" required />
            </div>
            <div class="p-3 text-center">
                <button type="submit" style="background: #57b846; color: #ffffff; border-radius: 50px;" class="btn mt-5 w-100">
                    دخول</button>
                {{-- <a style="color: black; font-size: 12px;" href="register.html">Register</a> --}}
            </div>
            {{-- <button type="submit" class="btn btn-primary">Login</button> --}}
        </form>
        {{-- <form class="login">
            <h2 class="text-center text">Yalla Bena</h2>
            <span class="login100-form-avatar mt-3">
                <img class="logo" src="img/107.jpg">
            </span>
            <div class="input-container">
                <input type="email" id="my-input" required />
                <label for="my-input">اسم المستخدم</label>
            </div>
            <div class="input-container">
                <input type="text" id="my-input2" required />
                <label for="my-input">الباسورد</label>
            </div>
            <div class="p-3 text-center">
                <button style="background: #57b846; color: #ffffff; border-radius: 50px;" class="btn mt-5 w-100">تسجيل
                    دخول</button>
                <a style="color: black; font-size: 12px;" href="register.html">Register</a>
            </div>
        </form> --}}
    </div>













    <script src="{{ asset('dash_mag') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dash_mag') }}/jquery-3.6.3.min.js"></script>
    <script src="{{ asset('dash_mag') }}/js/all.min.js"></script>
    {{-- <script src="{{ asset('dash_mag') }}/popper.min.js"></script> --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $('#my-input').on('focus', function() {
                $(this).siblings('label').css({
                    'top': '0px',
                    'font-size': '11px',
                    'color': '#57b846'
                });
            }).on('blur', function() {
                if ($(this).val() === '') {
                    $(this).siblings('label').css({
                        'top': '50%',
                        'font-size': '12px',
                        'color': '#aaa'
                    });
                }
            });
            $('#my-input2').on('focus', function() {
                $(this).siblings('label').css({
                    'top': '0px',
                    'font-size': '11px',
                    'color': '#57b846'
                });
            }).on('blur', function() {
                if ($(this).val() === '') {
                    $(this).siblings('label').css({
                        'top': '50%',
                        'font-size': '12px',
                        'color': '#aaa'
                    });
                }
            });
        });
    </script>
</body>

</html>
