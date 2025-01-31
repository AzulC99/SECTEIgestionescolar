<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mejorado</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar-open {
            transform: translateX(0);
        }
        .sidebar-closed {
            transform: translateX(-100%);
        }
        @media (min-width: 768px) {
            .sidebar-closed {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100">

    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden"></div>

    <aside id="sidebar" class="fixed top-0 left-0 z-30 h-full w-64 bg-gradient-to-b from-blue-800 to-blue-600 text-white transition-transform duration-300 ease-in-out transform -translate-x-full md:translate-x-0">
        <div class="flex items-center justify-between p-4 border-b border-blue-700">
            <div class="flex items-center space-x-3">
                <i class="fas fa-chart-line text-2xl"></i>
                <span class="text-xl font-bold">Dashboard</span>
            </div>
            <button id="closeSidebar" class="md:hidden text-white p-2 rounded-lg hover:bg-blue-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <nav class="mt-6 px-4">
            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg bg-blue-700 text-white mb-2">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 text-gray-100 mb-2">
                <i class="fas fa-chart-bar"></i>
                <span>Análisis</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 text-gray-100 mb-2">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 text-gray-100 mb-2">
                <i class="fas fa-cog"></i>
                <span>Configuración</span>
            </a>
        </nav>
    </aside>

    <div class="md:ml-64 min-h-screen flex flex-col">
        <header class="bg-white shadow-md">
            <div class="flex items-center justify-between h-16 px-4">
                <button id="menuButton" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <div class="flex items-center space-x-4">
                    <button class="p-2 rounded-lg hover:bg-gray-100 relative">
                        <i class="fas fa-bell text-gray-600"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    
                    <div class="relative group">
                        <button class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                            <img src="/api/placeholder/32/32" class="w-8 h-8 rounded-full" alt="Profile">
                            <span class="text-gray-700">Admin</span>
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Mi Perfil
                            </a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i> Configuración
                            </a>
                            <hr class="my-1">
                            <a href="#" class="block px-4 py-2 text-red-600 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Usuarios Totales</p>
                            <h3 class="text-2xl font-bold">2,543</h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                    </div>
                    <p class="text-green-500 text-sm mt-4">
                        <i class="fas fa-arrow-up"></i> +15% desde el mes pasado
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Ingresos</p>
                            <h3 class="text-2xl font-bold">$45,678</h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i class="fas fa-dollar-sign text-green-600"></i>
                        </div>
                    </div>
                    <p class="text-green-500 text-sm mt-4">
                        <i class="fas fa-arrow-up"></i> +8% desde el mes pasado
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Órdenes</p>
                            <h3 class="text-2xl font-bold">1,123</h3>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <i class="fas fa-shopping-cart text-purple-600"></i>
                        </div>
                    </div>
                    <p class="text-red-500 text-sm mt-4">
                        <i class="fas fa-arrow-down"></i> -3% desde el mes pasado
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Visitas</p>
                            <h3 class="text-2xl font-bold">45,678</h3>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-lg">
                            <i class="fas fa-eye text-yellow-600"></i>
                        </div>
                    </div>
                    <p class="text-green-500 text-sm mt-4">
                        <i class="fas fa-arrow-up"></i> +12% desde el mes pasado
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold">Últimas Transacciones</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Monto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">#123456</td>
                                <td class="px-6 py-4">Juan Pérez</td>
                                <td class="px-6 py-4">$125.00</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                        Completado
                                    </span>
                                </td>
                                <td class="px-6 py-4">24/01/2025</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">#123457</td>
                                <td class="px-6 py-4">María García</td>
                                <td class="px-6 py-4">$250.00</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                        Pendiente
                                    </span>
                                </td>
                                <td class="px-6 py-4">24/01/2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <footer class="bg-white shadow-md mt-auto">
            <div class="mx-auto px-4">
                <div class="py-4 text-center text-sm text-gray-500">
                    © 2025 Tu Empresa. Todos los derechos reservados.
                </div>
            </div>
        </footer>
    </div>

    <script>
        const menuButton = document.getElementById('menuButton');
        const closeSidebarButton = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuButton.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-closed');
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('hidden');
        });

        closeSidebarButton.addEventListener('click', () => {
            sidebar.classList.remove('sidebar-open');
            sidebar.classList.add('sidebar-closed');
            overlay.classList.add('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('sidebar-open');
            sidebar.classList.add('sidebar-closed');
            overlay.classList.add('hidden');
        });
    </script>

</body>
</html>
