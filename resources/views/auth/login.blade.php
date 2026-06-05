<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masifundeni Login</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            background:#f7f7f7;
        }


        .left-panel{
            width:40%;
            background:#d9d4f7;
            padding:40px;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
        }

        .brand h1{
            color:#3d348b;
            font-size:36px;
            margin-bottom:5px;
        }

        .brand p{
            color:#555;
            font-size:16px;
        }

        .welcome{
            margin-top:30px;
        }

        .welcome h2{
            font-size:42px;
            color:#3d348b;
            margin-bottom:15px;
        }

        .welcome p{
            font-size:18px;
            color:#4b5563;
            line-height:1.6;
        }

        .image-container{
            text-align:center;
            margin-top:30px;
        }

        .image-container img{
            width:60%;
            max-width:260px;
            height:auto;
        }


        .right-panel{
            width:60%;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px;
        }

        .login-box{
            width:100%;
            max-width:520px;
            background:#fff;
            padding:35px;
            border-radius:16px;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
        }

        .login-box h2{
            font-size:38px;
            margin-bottom:8px;
            color:#111827;
        }

        .login-box p{
            font-size:16px;
            color:#6b7280;
            margin-bottom:25px;
        }

        .role-selector{
    display:flex;
    margin-bottom:25px;
    border-radius:10px;
    overflow:hidden;
}

.role-selector input{
    display:none;
}

.role-selector label{
    flex:1;
    text-align:center;
    padding:12px;
    background:#f3f4f6;
    border:1px solid #ddd;
    cursor:pointer;
    font-weight:600;
    transition:0.3s;
}

.role-selector input:checked + label{
    background:#d9d4f7;
    color:#3d348b;
}

        .form-group{
            margin-bottom:18px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            font-size:15px;
            font-weight:600;
            color:#374151;
        }

        .form-group input{
            width:100%;
            padding:14px;
            border:1px solid #d1d5db;
            border-radius:8px;
            font-size:15px;
        }

        .form-group input:focus{
            outline:none;
            border-color:#5b4cc4;
        }

        .forgot{
            float:right;
            font-size:13px;
            color:#5b4cc4;
            text-decoration:none;
        }

        .remember{
            display:flex;
            align-items:center;
            gap:8px;
            margin-bottom:20px;
            color:#555;
            font-size:14px;
        }

        .login-btn{
            width:100%;
            border:none;
            padding:14px;
            background:#5b4cc4;
            color:white;
            border-radius:8px;
            font-size:18px;
            font-weight:600;
            cursor:pointer;
        }

        .login-btn:hover{
            background:#4738b8;
        }

        .footer{
            text-align:center;
            margin-top:20px;
            font-size:14px;
            color:#555;
        }

        .footer a{
            color:#5b4cc4;
            text-decoration:none;
            font-weight:600;
        }

        .errors{
            background:#fee2e2;
            color:#991b1b;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
        }

        @media (max-width:900px){

            body{
                flex-direction:column;
            }

            .left-panel{
                width:100%;
                text-align:center;
            }

            .right-panel{
                width:100%;
            }

            .image-container{
                display:none;
            }
        }
    </style>
</head>
<body>


    <div class="left-panel">

        <div>

            <div class="brand">
                <h1>Masifundeni</h1>
                <p>Student Management System</p>
            </div>

            <div class="welcome">
                <h2>Welcome Back!</h2>

                <p>
                    Log in to access your courses,
                    monitor academic progress,
                    and manage your educational journey.
                </p>
            </div>

        </div>

    </div>


    <div class="right-panel">

        <div class="login-box">

            <h2>Log in</h2>

            <p>Enter your details to access your account</p>

            <div class="role-selector">

    <input type="radio" id="student" name="role" value="student" checked>
    <label for="student">Student</label>

    <input type="radio" id="instructor" name="role" value="instructor">
    <label for="instructor">Instructor</label>

    <input type="radio" id="admin" name="role" value="admin">
    <label for="admin">Admin</label>

</div>

            @if ($errors->any())
                <div class="errors">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email Address</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label>
                        Password

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="forgot">
                                Forgot Password?
                            </a>
                        @endif
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                    >
                </div>

                <div class="remember">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </div>

                <button type="submit" class="login-btn">
                    Log In
                </button>

            </form>

            @if (Route::has('register'))
                <div class="footer">
                    Don't have an account?
                    <a href="{{ route('register') }}">
                        Sign Up
                    </a>
                </div>
            @endif

        </div>

    </div>

</body>
</html>
