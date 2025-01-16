<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="pt-16"> <!-- Padding top para compensar navbar fijo -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Card Estudiantes -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 bg-opacity-75">
                        <i class="fas fa-users text-blue-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Estudiantes</p>
                        <p class="text-2xl font-semibold">2,450</p>
                    </div>
                </div>
            </div>
            
            <!-- Card Profesores -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 bg-opacity-75">
                        <i class="fas fa-chalkboard-teacher text-green-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Profesores</p>
                        <p class="text-2xl font-semibold">120</p>
                    </div>
                </div>
            </div>
            
            <!-- Card Cursos -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 bg-opacity-75">
                        <i class="fas fa-book text-purple-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Cursos</p>
                        <p class="text-2xl font-semibold">85</p>
                    </div>
                </div>
            </div>
            
            <!-- Card Asistencia -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 bg-opacity-75">
                        <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Asistencia</p>
                        <p class="text-2xl font-semibold">95%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido Principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Tabla de Últimos Estudiantes -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold">Últimos Estudiantes Registrados</h2>
                </div>
                <div class="p-4">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">Nombre</th>
                                <th class="text-left py-2">Grado</th>
                                <th class="text-left py-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-2">Juan Pérez</td>
                                <td class="py-2">3° Secundaria</td>
                                <td class="py-2"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Activo</span></td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">María García</td>
                                <td class="py-2">2° Secundaria</td>
                                <td class="py-2"><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Activo</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Panel Lateral -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold">Próximos Eventos</h2>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <i class="fas fa-calendar text-blue-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold">Reunión de Padres</p>
                                <p class="text-sm text-gray-500">15 de Enero, 2024</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <i class="fas fa-graduation-cap text-purple-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold">Ceremonia de Graduación</p>
                                <p class="text-sm text-gray-500">20 de Enero, 2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>