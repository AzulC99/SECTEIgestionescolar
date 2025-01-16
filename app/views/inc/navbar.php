<nav class="bg-blue-600 fixed w-full z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo y nombre -->
            <div class="flex items-center">
                <a href="<?php echo URLROOT; ?>" class="flex items-center">
                    <i class="fas fa-graduation-cap text-white text-2xl mr-2"></i>
                    <span class="text-white font-semibold text-lg"><?php echo SITENAME; ?></span>
                </a>
            </div>
            
            <!-- Menú derecho -->
            <div class="flex items-center">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center text-white hover:text-gray-200">
                        <span class="mr-2"><?php echo $_SESSION['user_name'] ?? 'Usuario'; ?></span>
                        <i class="fas fa-user-circle text-xl"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg">
                        <a href="<?php echo URLROOT; ?>/users/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user mr-2"></i> Perfil
                        </a>
                        <a href="<?php echo URLROOT; ?>/users/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>