<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideIn {
            0% {
                transform: translateX(-50px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .form-slide-in {
            animation: slideIn 1s ease-out;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="w-full max-w-4xl h-full flex bg-white rounded-lg shadow-xl overflow-hidden">
        <!-- Formulario de Login -->
        <div class="w-full sm:w-1/2 p-8 form-slide-in">
            <!-- Logotipo centrado -->
            <div class="flex justify-center mb-6">
                <img src="https://via.placeholder.com/150" alt="Logotipo" class="w-24 h-24">
            </div>
            
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Iniciar Sesión</h2>

            <form action="#" method="POST">
                <!-- Campo de correo -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="example@correo.com" required>
                </div>

                <!-- Campo de contraseña -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" id="password" name="password" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="••••••••" required>
                </div>

                <!-- Botón de Iniciar sesión -->
                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">Iniciar sesión</button>
            </form>

            <!-- Enlace de "Olvidé mi contraseña" -->
            <div class="text-center mt-4">
                <a href="#" class="text-sm text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
            </div>
        </div>

        <!-- Imagen de fondo -->
        <div class="hidden sm:block w-1/2 h-full bg-blue-600 relative">
            <img src="https://via.placeholder.com/800x800" alt="Imagen de fondo" class="w-full h-full object-cover opacity-80">
        </div>
    </div>

</body>
</html>
