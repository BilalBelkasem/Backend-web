<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Final Fantasy 14 Community') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* FF14 thema styling */
            .ff14-bg {
                background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            }
            .ff14-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            .ff14-text {
                color: #e8f4fd;
            }
            .ff14-accent {
                color: #00d4ff;
            }
            .ff14-button {
                background: linear-gradient(45deg, #00d4ff, #0099cc);
                border: none;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                transition: all 0.3s ease;
            }
            .ff14-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 212, 255, 0.4);
            }
            
            /* Fix layout issues */
            .min-h-screen {
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }
            
            /* Ensure navigation stays on top */
            nav {
                position: relative;
                z-index: 40;
            }
            
            /* Fix dropdown z-index */
            .relative[x-data] {
                position: relative;
                z-index: 50;
            }
            
            /* Prevent content from overlapping */
            main {
                position: relative;
                z-index: 10;
            }
        </style>
    </head>
    <body class="font-sans antialiased ff14-bg">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="ff14-card shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h1 class="ff14-text text-3xl font-bold">{{ $header }}</h1>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-8">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
