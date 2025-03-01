
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convocatoria - Carrusel ES6</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- ENCABEZADO CON LOGOTIPO Y MENÚ -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/api/placeholder/180/80" alt="Logotipo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/pages/index"><i class="fas fa-home me-1"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/pages/login"><i class="fas fa-calendar-alt me-1"></i>Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="?php echo URLROOT; ?>/pages/convocatorias"><i class="fas fa-envelope me-1"></i> Convocatorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/pages/resultados"><i class="fas fa-envelope me-1"></i> resultados</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

    

</head>
<body>
    
  