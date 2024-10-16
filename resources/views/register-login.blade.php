<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #f1f8e9);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background-color: white;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }

        .toggle-btn {
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }

        .toggle-btn.active-login {
            background-color: rgb(59 130 246); 
            color: white;
        }

        .toggle-btn.active-register {
            background-color: rgb(34 197 94); 
            color: white;
        }

        .toggle-btn.inactive {
            background-color: #e2e8f0;
            color: #4b5563;
        }

        .hidden {
            display: none;
        }

        .hover-scale:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .show {
            display: block;
        }
    </style>
</head>
<body class="flex-col justify-center min-h-screen">
    <!-- Toggle Button -->
    <div class="flex space-x-2">
        <button id="toggle-login" class="toggle-btn active">Iniciar Sesión</button>
        <button id="toggle-register" class="toggle-btn inactive">Crear Cuenta</button>
    </div>
    <div class="flex justify-center items-center">
        <!-- Carousel Container -->
        <div class="w-full max-w-sm p-6">
            <div id="loginForm" class="card p-8 show">
                <!-- Mostrar errores si existen -->
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Bienvenido de nuevo</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-gray-600">Correo electrónico</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Correo electrónico">
                    </div>
                    <div class="mb-4 relative">
                        <label for="password" class="block text-gray-600">Contraseña</label>
                        <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Contraseña">
                        <a href="{{ route('password.request') }}" class="text-blue-600 text-sm">¿Olvidaste tu contraseña?</a>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded shadow-md hover:bg-blue-600 transition">Iniciar Sesión</button>
                    <p class="text-center mt-4 text-gray-600">¿No tienes cuenta? <span class="text-blue-500 cursor-pointer hover:underline" onclick="showRegisterForm()">Crea una aquí</span></p>
                </form>
            </div>

            <div id="registerForm" class="card p-8 hidden">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Crea tu cuenta</h2>
                
                <!-- Mostrar errores si existen -->
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-600">Nombre completo</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border rounded mt-1 focus:outline-none focus:ring-2 focus:ring-green-300" placeholder="Nombre completo">
                    </div>
                    <div class="mb-4">
                        <label for="reg-email" class="block text-gray-600">Correo electrónico</label>
                        <input type="email" id="reg-email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border rounded mt-1 focus:outline-none focus:ring-2 focus:ring-green-300" placeholder="Correo electrónico de trabajo">
                    </div>
                    <div class="mb-4">
                        <label for="reg-password" class="block text-gray-600">Contraseña</label>
                        <input type="password" id="reg-password" name="password" class="w-full px-3 py-2 border rounded mt-1 focus:outline-none focus:ring-2 focus:ring-green-300" placeholder="Usa 8 caracteres, con al menos una letra y un número">
                    </div>
                    <div class="mb-4">
                        <label for="reg-password-confirm" class="block text-gray-600">Confirmar Contraseña</label>
                        <input type="password" id="reg-password-confirm" name="password_confirmation" class="w-full px-3 py-2 border rounded mt-1 focus:outline-none focus:ring-2 focus:ring-green-300" placeholder="Repite la contraseña">
                    </div>
                    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded shadow-md hover:bg-green-600 transition">Crear Cuenta</button>
                    <p class="text-center mt-4 text-gray-600">¿Ya tienes cuenta? <span class="text-blue-500 cursor-pointer hover:underline" onclick="showLoginForm()">Inicia sesión aquí</span></p>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            toggleLogin.classList.add('active-login');
            toggleLogin.classList.remove('inactive');
            toggleRegister.classList.add('inactive');
            toggleRegister.classList.remove('active-register');
            showLoginForm();
        });

        function showRegisterForm() {
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('loginForm').classList.remove('show');
            document.getElementById('registerForm').classList.add('show');
            document.getElementById('registerForm').classList.remove('hidden');
        }

        function showLoginForm() {
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('registerForm').classList.remove('show');
            document.getElementById('loginForm').classList.add('show');
            document.getElementById('loginForm').classList.remove('hidden');
        }

        const toggleLogin = document.getElementById('toggle-login');
        const toggleRegister = document.getElementById('toggle-register');

        toggleLogin.addEventListener('click', () => {
            toggleLogin.classList.add('active-login');
            toggleLogin.classList.remove('inactive');
            toggleRegister.classList.add('inactive');
            toggleRegister.classList.remove('active-register');
            showLoginForm();
        });

        toggleRegister.addEventListener('click', () => {
            toggleRegister.classList.add('active-register');
            toggleRegister.classList.remove('inactive');
            toggleLogin.classList.add('inactive');
            toggleLogin.classList.remove('active-login');
            showRegisterForm();
        });
    </script>
</body>
</html>
