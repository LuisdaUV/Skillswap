<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SkillSwap</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f3e8ff, #e9d5ff);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .auth-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 1100px;
            width: 100%;
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .auth-form {
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-image {
            background: url('{{ asset('images/auth-image.jpg') }}') center/cover no-repeat;
            position: relative;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .logo-container img {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background-color: #8b5cf6;
            color: white;
            font-weight: 600;
            padding: 14px;
            border-radius: 15px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #7c3aed;
            box-shadow: 0 0 15px rgba(139,92,246,0.4);
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <!-- FORMULARIO -->
        <div class="auth-form">
            <div class="logo-container">
                <img src="{{ asset('images/logo.jpeg') }}" alt="SkillSwap">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800">
                        Skill<span class="text-purple-600">Swap</span>
                    </h1>
                    <p class="text-sm text-gray-500">Aprende enseñando 🚀</p>
                </div>
            </div>

            {{ $slot }}
        </div>

        <!-- IMAGEN DE FONDO -->
        <div class="auth-image"></div>
    </div>
</body>
</html>
