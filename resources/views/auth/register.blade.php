<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Sistem Pakar</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Figtree',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            overflow:hidden;

            background:
            linear-gradient(
                180deg,
                #eff6ff 0%,
                #dbeafe 50%,
                #bfdbfe 100%
            );
        }

        body::before{
            content:'';
            position:fixed;
            width:500px;
            height:500px;
            top:-200px;
            right:-150px;
            background:#60a5fa;
            border-radius:50%;
            filter:blur(180px);
            opacity:.15;
            z-index:-1;
            animation:blob1 12s ease-in-out infinite;
        }

        body::after{
            content:'';
            position:fixed;
            width:400px;
            height:400px;
            bottom:-150px;
            left:-150px;
            background:#93c5fd;
            border-radius:50%;
            filter:blur(180px);
            opacity:.15;
            z-index:-1;
            animation:blob2 15s ease-in-out infinite;
        }

        .container{

            width:100%;
            max-width:1150px;

            display:grid;
            grid-template-columns:1fr 1fr;

            gap:50px;

            align-items:center;

            padding:20px;
        }

        .left{

            animation:fadeLeft 1s ease;
        }

        .left h1{

            font-size:50px;
            font-weight:800;
            color:#0f172a;

            margin-bottom:15px;

            line-height:1.1;
        }

        .left h2{

            font-size:22px;
            color:#2563eb;

            margin-bottom:20px;
        }

        .left p{

            color:#64748b;
            line-height:1.8;
            font-size:17px;
        }

        .register-card{

            background:rgba(255,255,255,.92);

            backdrop-filter:blur(20px);

            border-radius:30px;

            padding:40px;

            box-shadow:
            0 20px 50px rgba(0,0,0,.10);

            animation:fadeRight 1s ease;
        }

        .register-card h3{

            text-align:center;

            font-size:30px;

            color:#0f172a;

            margin-bottom:10px;

            font-weight:800;
        }

        .subtitle{

            text-align:center;

            color:#64748b;

            margin-bottom:25px;
        }

        .form-group{

            margin-bottom:18px;
        }

        label{

            display:block;

            margin-bottom:8px;

            font-weight:600;

            color:#334155;
        }

        input{

            width:100%;

            padding:14px;

            border:1px solid #cbd5e1;

            border-radius:12px;

            outline:none;

            transition:.3s;
        }

        input:focus{

            border-color:#2563eb;

            box-shadow:
            0 0 0 4px rgba(37,99,235,.10);
        }

        .btn{

            width:100%;

            padding:14px;

            border:none;

            border-radius:12px;

            background:#2563eb;

            color:white;

            font-size:15px;

            font-weight:700;

            cursor:pointer;

            transition:.3s;
        }

        .btn:hover{

            transform:translateY(-3px);

            background:#1d4ed8;
        }

        .login-link{

            text-align:center;

            margin-top:25px;

            color:#64748b;
        }

        .login-link a{

            text-decoration:none;

            color:#2563eb;

            font-weight:700;
        }

        .error{

            color:#dc2626;

            font-size:13px;

            margin-top:6px;
        }

        @keyframes fadeLeft{

            from{
                opacity:0;
                transform:translateX(-50px);
            }

            to{
                opacity:1;
                transform:translateX(0);
            }
        }

        @keyframes fadeRight{

            from{
                opacity:0;
                transform:translateX(50px);
            }

            to{
                opacity:1;
                transform:translateX(0);
            }
        }

        @keyframes blob1{

            0%,100%{
                transform:translate(0,0);
            }

            50%{
                transform:translate(-40px,30px);
            }
        }

        @keyframes blob2{

            0%,100%{
                transform:translate(0,0);
            }

            50%{
                transform:translate(40px,-30px);
            }
        }

        @media(max-width:900px){

            body{
                overflow:auto;
            }

            .container{
                grid-template-columns:1fr;
            }

            .left{
                text-align:center;
            }

            .left h1{
                font-size:38px;
            }
        }

    </style>

</head>
<body>

<div class="container">

    <div class="left">

        <h1>
            Sistem Pakar Diagnosa Penyakit Pada Sapi
        </h1>

        <h2>
            Metode Forward Chaining
        </h2>

        <p>
            Daftarkan akun Anda untuk mulai menggunakan sistem pakar
            diagnosa penyakit pada sapi berbasis metode Forward Chaining.
        </p>

    </div>

    <div class="register-card">

        <h3>Register</h3>

        <p class="subtitle">
            Buat akun baru
        </p>

        <form method="POST" action="{{ route('register', absolute: false) }}">
            @csrf

            <div class="form-group">

                <label>Nama Lengkap</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required>

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required>

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    required>

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">

                <label>Konfirmasi Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    required>

            </div>

            <button type="submit" class="btn">
                Register
            </button>

            <div class="login-link">

                Already have an account?

                <a href="{{ route('login', absolute: false) }}">
                    Login Here
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>