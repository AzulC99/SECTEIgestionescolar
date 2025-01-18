<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login con Animación</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Animación personalizada para el formulario */
    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(50%);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }
  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="flex flex-col md:flex-row">
      
      <!-- Sección izquierda (imagen o contenido visual) -->
      <div class="hidden md:block md:w-1/2 bg-blue-500">
        <div class="h-full flex flex-col justify-center items-center text-white px-8 py-12">
          <h2 class="text-4xl font-bold mb-4">Bienvenido</h2>
          <p class="text-lg mb-6">Descubre una experiencia única iniciando sesión en nuestra plataforma.</p>
          <img src="https://via.placeholder.com/300x300" alt="Login Visual" class="rounded-lg">
        </div>
      </div>

      <!-- Sección derecha (formulario de login) -->
      <div 
        class="w-full md:w-1/2 p-8"
        style="animation: fadeInRight 1s ease-in-out;">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Inicia Sesión</h2>
        
        <form action="#" method="POST">
          <!-- Campo de email -->
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-600">Correo Electrónico</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              class="w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
              placeholder="correo@example.com" 
              required>
          </div>
          
          <!-- Campo de contraseña -->
          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-600">Contraseña</label>
            <input 
              type="password" 
              id="password" 
              name="password" 
              class="w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
              placeholder="********" 
              required>
          </div>

          <!-- Recordarme y Olvidaste tu contraseña -->
          <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
              <input 
                id="remember-me" 
                type="checkbox" 
                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="remember-me" class="ml-2 block text-sm text-gray-600">Recuérdame</label>
            </div>
            <a href="#" class="text-sm text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
          </div>

          <!-- Botón de iniciar sesión -->
          <button 
            type="submit" 
            class="w-full bg-blue-500 text-white py-3 rounded-md font-medium hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Iniciar Sesión
          </button>
        </form>

        <!-- Registro -->
        <p class="mt-6 text-sm text-center text-gray-600">
          ¿No tienes una cuenta? 
          <a href="#" class="text-blue-500 hover:underline">Regístrate</a>
        </p>
      </div>
    </div>
  </div>

</body>
</html>
