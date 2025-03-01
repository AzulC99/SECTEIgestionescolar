<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mejorado</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        :root {
            --burgundy: #800020;
            --burgundy-dark: #5a0017;
            --burgundy-light: #a63146;
            --gold: #D4AF37;
            --gold-light: #F4C65C;
            --gold-dark: #9C7A1D;
            --text-light: #FFFFFF;
            --text-dark: #333333;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f8f8;
        }
        
        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin 0.25s ease-out;
            background-color: var(--burgundy);
        }
        
        #sidebar-wrapper .sidebar-heading {
            padding: 1.25rem;
            font-size: 1.2rem;
            background-color: var(--burgundy-dark);
            border-bottom: 2px solid var(--gold);
        }
        
        #sidebar-wrapper .list-group {
            width: 15rem;
        }
        
        #sidebar-wrapper .list-group-item {
            background-color: var(--burgundy);
            color: var(--text-light);
            border: none;
            border-left: 4px solid transparent;
            transition: all 0.3s;
        }
        
        #sidebar-wrapper .list-group-item:hover {
            background-color: var(--burgundy-light);
            border-left: 4px solid var(--gold);
        }
        
        #sidebar-wrapper .list-group-item.active {
            background-color: var(--burgundy-light);
            border-left: 4px solid var(--gold);
        }
        
        #page-content-wrapper {
            min-width: 100vw;
            min-height: 100vh;
        }
        
        body.sb-sidenav-toggled #sidebar-wrapper {
            margin-left: 0;
        }
        
        .main-content {
            flex: 1;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar .navbar-toggler {
            border: none;
        }
        
        #sidebarToggle {
            background-color: var(--burgundy);
            border-color: var(--burgundy);
        }
        
        #sidebarToggle:hover {
            background-color: var(--burgundy-light);
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
        }
        
        .bg-burgundy {
            background-color: var(--burgundy) !important;
            color: white;
        }
        
        .bg-gold {
            background-color: var(--gold) !important;
            color: var(--text-dark);
        }
        
        .text-burgundy {
            color: var(--burgundy) !important;
        }
        
        .text-gold {
            color: var(--gold) !important;
        }
        
        .btn-burgundy {
            background-color: var(--burgundy);
            color: white;
        }
        
        .btn-burgundy:hover {
            background-color: var(--burgundy-light);
            color: white;
        }
        
        .btn-gold {
            background-color: var(--gold);
            color: var(--text-dark);
        }
        
        .btn-gold:hover {
            background-color: var(--gold-light);
            color: var(--text-dark);
        }
        
        .border-gold {
            border-color: var(--gold) !important;
        }
        
        footer {
            background-color: var(--burgundy) !important;
            color: white;
        }
        
        footer a {
            color: var(--gold);
            text-decoration: none;
        }
        
        footer a:hover {
            color: var(--gold-light);
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--burgundy);
            font-weight: bold;
            font-size: 20px;
        }
        
        .profile-dropdown .dropdown-toggle::after {
            display: none;
        }
        
        .profile-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--burgundy-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }
            
            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }
            
            body.sb-sidenav-toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }
    </style>
</head>
<body>

<div id="page-content-wrapper">
            <!-- Header -->
            <nav class="navbar navbar-expand-lg navbar-light border-bottom mb-4">
                <div class="container-fluid">
                    <button class="btn btn-burgundy" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <span class="d-none d-md-block ms-3 fw-bold text-burgundy">
                        <i class="bi bi-calendar me-1"></i> Miércoles, 26 Febrero, 2025
                    </span>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form class="d-flex ms-auto me-3">
                            <div class="input-group">
                                <input class="form-control border-end-0" type="search" placeholder="Buscar..." aria-label="Search">
                                <button class="btn btn-outline-secondary border-start-0" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                        <ul class="navbar-nav">
                            <li class="nav-item me-3">
                                <a class="nav-link position-relative" href="#">
                                    <i class="bi bi-bell fs-5"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-burgundy">
                                        3
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="nav-link position-relative" href="#">
                                    <i class="bi bi-envelope fs-5"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-burgundy">
                                        5
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown profile-dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <span class="d-none d-md-block">Admin</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <div class="px-3 py-2 text-center border-bottom">
                                        <div class="avatar mx-auto mb-2" style="width: 60px; height: 60px; font-size: 24px;">
                                            <i class="bi bi-person"></i>
                                        </div>
                                         <?php if(isLoggedIn()) : ?>
                                        <small>Conectado como: <?php echo $_SESSION['user_name']; ?> (<?php echo $_SESSION['user_role']; ?>)</small>
                                        
                                    </div>
                                    <a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i>Mi Perfil</a>
                                    <a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Configuración</a>
                                    <a class="dropdown-item" href="#"><i class="bi bi-activity me-2"></i>Actividad</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo URLROOT; ?>/pages/logout"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>



    