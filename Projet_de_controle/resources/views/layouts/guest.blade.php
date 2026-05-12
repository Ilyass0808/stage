<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
                margin: 0;
                overflow: hidden;
            }

            .animated-bg {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(125deg, #0a0a0a, #2D0a05, #F53003, #2D0a05);
                background-size: 400% 400%;
                animation: gradientBG 15s ease infinite;
                z-index: -1;
            }

            @keyframes gradientBG {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(30px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
                border-radius: 1rem;
            }

            input {
                background-color: rgba(255, 255, 255, 0.05) !important;
                color: #ffffff !important;
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
            }

            input::placeholder { color: rgba(255, 255, 255, 0.3) !important; }
        </style>
    </head>
    <body class="antialiased">
        <div class="animated-bg"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8 transform hover:scale-110 transition-transform duration-500">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-white drop-shadow-[0_0_15px_rgba(255,255,255,0.5)]" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 glass-card overflow-hidden">
                {{ $slot }}
            </div>
            
            <p class="mt-8 text-indigo-300/50 text-xs font-bold uppercase tracking-[0.2em]">
                &copy; {{ date('Y') }} VirtualStore - Premium Experience
            </p>
        </div>
    </body>
</html>
