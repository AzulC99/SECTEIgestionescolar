<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php echo $data['title']; ?></h1>
                <p class="text-gray-600 mb-4"><?php echo $data['description']; ?></p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <h3 class="text-xl font-semibold text-blue-600 mb-2">Misión</h3>
                        <p class="text-gray-600">Proporcionar una herramienta eficiente para la gestión educativa.</p>
                    </div>
                    
                    <div class="p-4 bg-green-50 rounded-lg">
                        <h3 class="text-xl font-semibold text-green-600 mb-2">Visión</h3>
                        <p class="text-gray-600">Ser el sistema líder en gestión escolar a nivel nacional.</p>
                    </div>
                    
                    <div class="p-4 bg-purple-50 rounded-lg">
                        <h3 class="text-xl font-semibold text-purple-600 mb-2">Valores</h3>
                        <p class="text-gray-600">Excelencia, Innovación, Compromiso con la educación.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>