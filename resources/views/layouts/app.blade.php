<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

        <!-- Style -->
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(to right, #e0f7fa, #f1f8e9);
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                flex-direction: column;
            }
        
            .card {
                background-color: white;
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                border-radius: 15px;
                padding: 2rem;
                text-align: center;
                width: 90%;
                max-width: 1200px;
            }
        
            .btn {
                padding: 0.75rem 1.5rem;
                background-color: #38bdf8;
                color: white;
                font-weight: 600;
                border-radius: 10px;
                transition: background-color 0.3s ease;
            }
        
            .btn:hover {
                background-color: #0284c7;
            }
        
            .chart-container {
                display: flex;
                justify-content: space-around;
                align-items: center;
                margin-top: 2rem;
                flex-wrap: wrap;
            }
        
            canvas {
                max-width: 300px;
                max-height: 300px;
            }
        
            .bank-card, .work-card {
                background-color: #ffffff;
                border: 1px solid #e0e0e0;
                border-radius: 10px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
                padding: 1rem;
                width: 22%;
                min-width: 200px;
                margin: 10px;
                text-align: left;
            }
        
            .bank-title, .work-title {
                font-weight: bold;
                margin-bottom: 10px;
            }

            .bank-title-solo, .work-title {
                font-weight: bold;
            }
        
            .transaction-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }
        
            .transaction-item {
                display: flex;
                justify-content: space-between;
                padding: 5px 0;
            }
        
            .income {
                color: #21a179; /* Green */
            }
        
            .expense {
                color: #b91c1c; /* Red */
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <!-- @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset -->

            <!-- Page Content -->
            <main style="background: linear-gradient(to right, #e0f7fa, #f1f8e9);">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
