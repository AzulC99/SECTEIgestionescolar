<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link href="<?php echo URLROOT; ?>/css/styles.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php require_once APPROOT . '/views/components/_nav.php'; ?>
    
    <div class="flex">
        <?php require_once APPROOT . '/views/components/_sidebar.php'; ?>
        
        <main class="flex-1 p-6">
            <?php require_once APPROOT . '/views/' . $view . '.php'; ?>
        </main>
    </div>

    <?php require_once APPROOT . '/views/components/_footer.php'; ?>
    <script src="<?php echo URLROOT; ?>/js/app.js"></script>
</body>
</html>
