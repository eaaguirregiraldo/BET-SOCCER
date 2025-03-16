
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Bet Soccer') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Figtree', sans-serif;
        }
        .hero-section {
            height: 80vh;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/soccer-background.jpg') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .logo-container {
            margin-bottom: 2rem;
        }
        .logo-image {
            max-width: 300px;
            height: auto;
        }
        .btn-container {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            border-radius: 0.375rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-primary {
            background-color: #10b981;
            color: white;
        }
        .btn-primary:hover {
            background-color: #059669;
        }
        .btn-secondary {
            background-color: transparent;
            color: white;
            border: 1px solid white;
        }
        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="antialiased">
    <div class="hero-section">
        <div class="logo-container">
            <img src="{{ asset('images/betsoccer.webp') }}" alt="Bet Soccer Logo" class="logo-image">
        </div>
        
        <h1 class="text-4xl font-bold">Bienvenido a Bet Soccer</h1>
        <p class="mt-4 text-xl">La mejor plataforma para apuestas deportivas</p>
        
        <div class="btn-container">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
            @endauth
        </div>
    </div>
    
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    ¿Por qué elegir Bet Soccer?
                </h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    Ofrecemos la mejor experiencia en apuestas deportivas con las mejores cuotas del mercado.
                </p>
            </div>
            
            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Mejores Cuotas</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Garantizamos las mejores cuotas del mercado para maximizar tus ganancias.
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Seguridad Garantizada</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Tu información y tu dinero siempre estarán protegidos con nosotros.
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Pagos Rápidos</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Retira tus ganancias de forma rápida y sin complicaciones.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <img src="{{ asset('images/betsoccer.webp') }}" alt="Bet Soccer Logo" class="h-8 mx-auto mb-4">
                <p>&copy; {{ date('Y') }} Bet Soccer. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>