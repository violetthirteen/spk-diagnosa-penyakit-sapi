<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosa Penyakit Pada Sapi</title>

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
            flex-direction:column;
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
            opacity:.12;
            z-index:-1;
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
            opacity:.12;
            z-index:-1;
        }

        /* HERO */

        .hero{

            flex:1;

            max-width:1200px;
            width:100%;

            margin:auto;

            display:grid;
            grid-template-columns:1.1fr .9fr;

            align-items:center;

            gap:40px;

            padding:20px 30px;
        }

        .hero-content h3{

            color:#2563eb;
            font-size:20px;
            font-weight:700;
            margin-bottom:10px;
        }

        .hero-content h1{

            font-size:50px;
            line-height:1.1;
            color:#0f172a;
            margin-bottom:15px;
            font-weight:800;
        }

        .hero-content h2{

            font-size:22px;
            color:#334155;
            margin-bottom:20px;
            font-weight:600;
        }

        .hero-content p{

            color:#64748b;
            font-size:17px;
            line-height:1.8;
            margin-bottom:30px;
            max-width:600px;
        }

        .hero-buttons{

            display:flex;
            gap:15px;
        }

        .hero-btn{

            text-decoration:none;
            padding:14px 28px;
            border-radius:12px;
            font-weight:700;
            transition:.3s;
        }

        .primary{

            background:#2563eb;
            color:white;

            box-shadow:
            0 10px 25px rgba(37,99,235,.25);
        }

        .primary:hover{

            transform:translateY(-3px);
        }

        .secondary{

            background:white;
            color:#1e293b;

            box-shadow:
            0 10px 25px rgba(0,0,0,.08);
        }

        .secondary:hover{

            transform:translateY(-3px);
        }

        /* IMAGE */

        .hero-image{

            display:flex;
            justify-content:center;
            align-items:center;
        }

        .hero-image img{

            width:350px;
            height:350px;

            object-fit:cover;

            border-radius:30px;

            border:8px solid white;

            box-shadow:
            0 25px 50px rgba(0,0,0,.15);
        }

        /* FOOTER */

        footer{

            background:
            linear-gradient(
                135deg,
                #0f172a,
                #1e3a8a
            );

            color:white;
        }

        .footer-container{

            max-width:1300px;

            margin:auto;

            padding:18px 25px;

            display:flex;

            justify-content:space-between;

            align-items:center;
        }

        .footer-left{

            display:flex;
            align-items:center;
            gap:10px;
        }

        .footer-left img{

            width:40px;
            height:40px;
        }

        .footer-left small{

            color:#cbd5e1;
        }

        /* RESPONSIVE */

        @media(max-width:992px){

            body{
                overflow:auto;
            }

            .hero{

                grid-template-columns:1fr;
                text-align:center;
                padding:40px 20px;
            }

            .hero-content p{
                margin:auto auto 30px;
            }

            .hero-buttons{
                justify-content:center;
            }

            .hero-content h1{
                font-size:38px;
            }

            .hero-image img{

                width:280px;
                height:280px;
            }
        }

        @media(max-width:768px){

            .footer-container{

                flex-direction:column;
                gap:10px;
                text-align:center;
            }

            .hero-content h1{
                font-size:32px;
            }

            .hero-content h2{
                font-size:18px;
            }
        }
.hero-content{
    animation:fadeLeft 1s ease;
}

.hero-image{
    display:flex;
    justify-content:center;
    align-items:center;
    animation:fadeRight 1.2s ease;
}

.hero-image img{

    width:350px;
    height:350px;

    object-fit:cover;

    border-radius:30px;

    border:8px solid white;

    box-shadow:
    0 25px 50px rgba(0,0,0,.15);

    animation:floatCow 4s ease-in-out infinite;
}

.hero-btn{
    text-decoration:none;
    padding:14px 28px;
    border-radius:12px;
    font-weight:700;
    transition:.3s;
}

.hero-btn:hover{
    transform:translateY(-4px) scale(1.03);
}

body::before{
    animation:moveBlob1 12s ease-in-out infinite;
}

body::after{
    animation:moveBlob2 15s ease-in-out infinite;
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
        transform:translateX(60px);
    }

    to{
        opacity:1;
        transform:translateX(0);
    }
}

@keyframes floatCow{

    0%{
        transform:translateY(0px);
    }

    50%{
        transform:translateY(-12px);
    }

    100%{
        transform:translateY(0px);
    }
}

@keyframes moveBlob1{

    0%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(-40px,30px);
    }

    100%{
        transform:translate(0,0);
    }
}

@keyframes moveBlob2{

    0%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(40px,-30px);
    }

    100%{
        transform:translate(0,0);
    }
}
    </style>
</head>
<body>

    <section class="hero">

        <div class="hero-content">


            <h1>
                Sistem Pakar Diagnosa Penyakit Pada Sapi
            </h1>

            <h2>
                Menggunakan Metode Certainty Factor
            </h2>

            <p>
                Aplikasi berbasis web yang membantu proses identifikasi penyakit
                pada sapi                 secara cepat dan terstruktur berdasarkan gejala yang
                dipilih pengguna menggunakan metode Certainty Factor.
            </p>

            <div class="hero-buttons">

                <a href="{{ route('login', absolute: false) }}" class="hero-btn primary">
                    Login Sistem
                </a>

                @if(Route::has('register'))
                <a href="{{ route('register', absolute: false) }}" class="hero-btn secondary">
                    Register
                </a>
                @endif

            </div>

        </div>

        <div class="hero-image">

            <img src="{{ asset('images/sapi.jpeg') }}" alt="Sapi">

        </div>

    </section>

    <footer>

        <div class="footer-container">

            <div class="footer-left">

                <img src="{{ asset('images/logo-kampus.png') }}" alt="Logo">

                <div>

                    <strong>
                        Universitas Al-Khairiyah
                    </strong>

                    <br>

                    <small>
                        Sistem Pakar Diagnosa Penyakit Pada Sapi
                    </small>

                </div>

            </div>

            <div>

                © {{ date('Y') }} Daniel Fahmi • 24040060

            </div>

        </div>

    </footer>

</body>
</html>