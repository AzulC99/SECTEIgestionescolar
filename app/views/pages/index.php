<?php require APPROOT . '/views/includes/header.php'; ?>

<!-- Overlay para móvil -->
<div x-show="sidebarOpen" 
     @click="sidebarOpen = false" 
     class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden">
</div>

<!-- Sidebar -->
<aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
       class="fixed inset-y-0 left-0 z-30 w-64 transform bg-gray-900 transition duration-200 ease-in-out md:translate-x-0">
    
    <!-- Logo -->
    <div class="flex items-center justify-between px-4 py-6">
        <div class="flex items-center">
            <span class="text-white text-2xl font-semibold">Dashboard</span>
        </div>
        <button @click="sidebarOpen = false" class="md:hidden text-gray-300 hover:text-white">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
    </div>

    <!-- Navegación -->
    <nav class="mt-5 px-2">
        <a href="<?php echo URLROOT; ?>/dashboard" 
           class="group flex items-center px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors">
            <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
            Dashboard
        </a>

        <?php if($_SESSION['role_id'] <= Role::MANAGER): ?>
        <a href="<?php echo URLROOT; ?>/users" 
           class="mt-2 group flex items-center px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors">
            <i data-lucide="users" class="w-5 h-5 mr-3"></i>
            Usuarios
        </a>
        <?php endif; ?>

        <a href="<?php echo URLROOT; ?>/products" 
           class="mt-2 group flex items-center px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors">
            <i data-lucide="package" class="w-5 h-5 mr-3"></i>
            Productos
        </a>

        <a href="<?php echo URLROOT; ?>/reports" 
           class="mt-2 group flex items-center px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors">
            <i data-lucide="bar-chart" class="w-5 h-5 mr-3"></i>
            Reportes
        </a>
    </nav>

    <!-- Perfil y Logout -->
    <div class="absolute bottom-0 w-full">
        <div class="px-4 py-4 border-t border-gray-800">
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" 
                        class="flex items-center w-full text-gray-300 hover:text-white">
                    <img src="<?php echo asset('img/avatar.jpg'); ?>" 
                         class="w-8 h-8 rounded-full mr-3">
                    <span class="text-sm font-medium"><?php echo $_SESSION['user_name']; ?></span>
                    <i data-lucide="chevron-down" class="w-4 h-4 ml-auto"></i>
                </button>

                <div x-show="open" 
                     @click.away="open = false"
                     class="absolute bottom-full left-0 w-full mb-1 bg-gray-800 rounded-lg py-1">
                    <a href="<?php echo URLROOT; ?>/profile" 
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                        Mi Perfil
                    </a>
                    <a href="<?php echo URLROOT; ?>/auth/logout" 
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- Contenido Principal -->
<main class="md:ml-64 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="md:hidden">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <!-- Notificaciones y perfil móvil -->
                <div class="flex items-center">
                    <button class="p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <i data-lucide="bell" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido del Dashboard -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                            <i data-lucide="users" class="w-6 h-6 text-white"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Usuarios</p>
                            <p class="text-lg font-semibold text-gray-700">2,521</p>
                        </div>
                    </div>
                </div>
                <!-- Más stats cards aquí -->
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Ventas Mensuales</h3>
                    <div class="h-80">
                        <!-- Aquí iría el gráfico -->
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Productos Top</h3>
                    <div class="h-80">
                        <!-- Aquí iría otro gráfico -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Inicializar iconos
    lucide.createIcons();
</script>

<?php require APPROOT . '/views/includes/footer.php'; ?>