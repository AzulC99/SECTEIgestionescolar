<?php require APPROOT . '/Views/templates/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Multistep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; filter: grayscale(100%); }
        .step { display: none; }
        .step.active { display: block; }

         
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        /* Encabezado */
        header {
            background-color: rgba(233, 236, 239, 0.9); /* Gris claro con transparencia */
            padding: 15px 0;
        }

        .navbar-brand img {
            max-height: 60px;
        }

        .navbar-nav .nav-link {
            color: #495057;
            font-size: 18px;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        /* Sección de convocatoria con carrusel */
        .convocatoria-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        /* Carrusel de imágenes de fondo */
        .carousel-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .carousel-container img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .carousel-container img.active {
            opacity: 1;
        }

        /* Contenido sobre la imagen */
        .convocatoria-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            backdrop-filter: blur(5px);
            color: #343a40;
        }

        /* Botón de inscripción */
        .btn-inscripcion {
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            font-size: 20px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-inscripcion:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }

        /* Pie de página */
        footer {
            background-color: rgba(233, 236, 239, 0.9);
            color: #495057;
            padding: 20px;
            text-align: center;
            font-size: 18px;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .convocatoria-content {
                width: 90%;
                padding: 20px;
            }
            .btn-inscripcion {
                font-size: 18px;
                padding: 12px 25px;
            }
        }

             background-color: #f8f9fa; /* Fondo gris claro */
        }

        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-box {
            background-color: #e9ecef; /* Fondo gris */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: auto;
        }

        .login-box img {
            width: 100px;
            display: block;
            margin: 0 auto 15px;
        }

        .input-group-text {
            background-color: #dee2e6; /* Color gris claro para los iconos */
            border: none;
        }

        .form-control {
            background-color: #dee2e6; /* Input en gris claro */
            border: none;
        }

        .form-control:focus {
            background-color: #fff;
            outline: none;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #6c757d; /* Gris oscuro */
            border: none;
        }

        .btn-primary:hover {
            background-color: #5a6268;
        }

        .side-image {
            background: url('https://source.unsplash.com/800x800/?technology,abstract') no-repeat center center;
            background-size: cover;
            height: 100vh;
        }

        @media (max-width: 768px) {
            .side-image {
                display: none;
            }
        }

        
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        /* Encabezado */
        header {
            background-color: rgba(233, 236, 239, 0.9); /* Gris claro con transparencia */
            padding: 15px 0;
        }

        .navbar-brand img {
            max-height: 60px;
        }

        .navbar-nav .nav-link {
            color: #495057;
            font-size: 18px;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        /* Sección de convocatoria con carrusel */
        .convocatoria-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
        } /* Colores principales */
        :root {
            --guinda: #800020;           /* Rojo guinda principal */
            --guinda-oscuro: #5a0018;    /* Rojo guinda oscuro */
            --guinda-claro: #a30028;     /* Rojo guinda claro */
            --dorado: #d4af37;           /* Dorado principal */
            --dorado-claro: #f4d160;     /* Dorado claro */
            --dorado-oscuro: #aa8c2c;    /* Dorado oscuro */
            --crema: #fff8e7;            /* Crema para fondos suaves */
            --negro: #1a1a1a;            /* Negro para textos */
        }

        /* Estilos generales */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--crema);
            color: var(--negro);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Encabezado */
        header {
            background-color: var(--guinda);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 10px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.4s ease;
        }

        header.scrolled {
            padding: 5px 0;
            background-color: rgba(128, 0, 32, 0.95);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            max-height: 60px;
            transition: all 0.4s ease;
        }

        header.scrolled .navbar-brand img {
            max-height: 50px;
        }

        .navbar-nav .nav-link {
            color: var(--crema) !important;
            font-size: 16px;
            font-weight: 600;
            margin: 0 12px;
            padding: 10px 5px;
            position: relative;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 5px;
            left: 0;
            background-color: var(--dorado);
            transition: width 0.3s ease;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        .navbar-nav .nav-link:hover {
            color: var(--dorado) !important;
        }

        .navbar-toggler {
            border-color: var(--dorado);
            background-color: var(--dorado-claro);
        }

        /* Sección principal - carrusel avanzado */
        .hero-carousel {
            position: relative;
            height: 100vh;
            width: 100%;
            margin-top: 80px;
            overflow: hidden;
        }

        .carousel-inner {
            height: 100%;
        }

        .carousel-item {
            height: 100%;
            position: relative;
        }

        .carousel-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.8);
            transition: transform 8s ease;
        }

        .carousel-item.active .carousel-image {
            transform: scale(1.1);
        }

        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(26, 26, 26, 0.5), rgba(128, 0, 32, 0.7));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .carousel-content {
            max-width: 800px;
            padding: 40px;
            background: rgba(255, 248, 231, 0.85);
            border-radius: 15px;
            backdrop-filter: blur(5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2), 0 0 0 3px var(--dorado);
            transform: translateY(50px);
            opacity: 0;
            transition: all 0.8s ease;
            position: relative;
            z-index: 10;
        }

        .carousel-item.active .carousel-content {
            transform: translateY(0);
            opacity: 1;
        }

        .carousel-caption-custom {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            padding: 20px;
            background: linear-gradient(to top, rgba(26, 26, 26, 0.8), transparent);
            color: white;
            text-align: center;
        }

        .carousel-title {
            color: var(--guinda);
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            position: relative;
            display: inline-block;
        }

        .carousel-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--dorado);
        }

        .carousel-description {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 30px;
            color: var(--negro);
        }

        /* Indicadores personalizados */
        .carousel-indicators {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            margin: 0;
            padding: 0;
        }

        .carousel-indicators [data-bs-target] {
            width: 15px;
            height: 15px;
            margin: 0 8px;
            background-color: transparent;
            border: 2px solid var(--dorado);
            border-radius: 50%;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .carousel-indicators .active {
            background-color: var(--dorado);
            transform: scale(1.2);
        }

        /* Controles personalizados */
        .carousel-control-prev, .carousel-control-next {
            width: 50px;
            height: 50px;
            background-color: var(--guinda);
            border-radius: 50%;
            opacity: 0.7;
            top: 50%;
            transform: translateY(-50%);
            margin: 0 20px;
        }

        .carousel-control-prev:hover, .carousel-control-next:hover {
            opacity: 1;
            background-color: var(--dorado);
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            width: 24px;
            height: 24px;
        }

        /* Botón de inscripción */
        .btn-inscripcion {
            background: linear-gradient(135deg, var(--dorado), var(--dorado-oscuro));
            color: var(--guinda-oscuro);
            padding: 15px 30px;
            font-size: 18px;
            font-weight: 700;
            border: none;
            border-radius: 50px;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(170, 140, 44, 0.4);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-inscripcion::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--guinda), var(--guinda-oscuro));
            transition: width 0.4s ease;
            z-index: -1;
        }

        .btn-inscripcion:hover::before {
            width: 100%;
        }

        .btn-inscripcion:hover {
            color: var(--dorado);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(170, 140, 44, 0.5);
        }

        .btn-inscripcion i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .btn-inscripcion:hover i {
            transform: translateX(5px);
        }

        /* Distintivo o badge para ofertas especiales */
        .offer-badge {
            position: absolute;
            top: -20px;
            right: -20px;
            background: var(--guinda);
            color: white;
            padding: 10px 15px;
            border-radius: 50%;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transform: rotate(15deg);
            z-index: 10;
        }

        /* Sección de características */
        .features-section {
            padding: 80px 0;
            background-color: #fff;
        }

        .section-title {
            color: var(--guinda);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 50px;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--dorado);
        }

        .feature-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            height: 100%;
            border-bottom: 3px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            border-bottom: 3px solid var(--dorado);
        }

        .feature-icon {
            color: var(--guinda);
            font-size: 2.5rem;
            margin-bottom: 20px;
            background: rgba(128, 0, 32, 0.1);
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            background: var(--guinda);
            color: white;
            transform: rotateY(180deg);
        }

        .feature-title {
            font-size: 1.5rem;
            color: var(--guinda);
            margin-bottom: 15px;
            font-weight: 700;
        }

        /* Pie de página */
        footer {
            background-color: var(--guinda-oscuro);
            color: var(--crema);
            padding: 50px 0 20px;
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, transparent, var(--dorado), transparent);
        }

        .footer-logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .footer-contact {
            margin-bottom: 30px;
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .footer-contact-icon {
            color: var(--dorado);
            font-size: 20px;
            margin-right: 15px;
            margin-top: 3px;
        }

        .footer-title {
            color: var(--dorado);
            font-size: 1.4rem;
            margin-bottom: 20px;
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--dorado);
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: var(--crema);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            position: relative;
            padding-left: 15px;
        }

        .footer-links a::before {
            content: '\f105';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 0;
            color: var(--dorado);
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--dorado);
            transform: translateX(5px);
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icons a {
            color: var(--crema);
            background: rgba(212, 175, 55, 0.2);
            margin: 0 8px;
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--guinda);
            background: var(--dorado);
            transform: translateY(-5px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(212, 175, 55, 0.2);
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
        }

        .newsletter-form {
            position: relative;
            margin-top: 20px;
        }

        .newsletter-input {
            width: 100%;
            padding: 12px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 30px;
            color: white;
        }

        .newsletter-input::placeholder {
            color: rgba(255, 248, 231, 0.6);
        }

        .newsletter-btn {
            position: absolute;
            right: 5px;
            top: 5px;
            background: var(--dorado);
            color: var(--guinda-oscuro);
            border: none;
            border-radius: 30px;
            padding: 7px 15px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            background: var(--dorado-claro);
            transform: translateX(3px);
        }

        /* Ajustes responsivos */
        @media (max-width: 991px) {
            .carousel-title {
                font-size: 2.5rem;
            }
            
            .carousel-content {
                max-width: 90%;
                padding: 30px;
            }
        }

        @media (max-width: 768px) {
            .hero-carousel {
                height: 90vh;
                margin-top: 76px;
            }
            
            .carousel-title {
                font-size: 2rem;
            }
            
            .carousel-description {
                font-size: 1rem;
            }
            
            .btn-inscripcion {
                font-size: 16px;
                padding: 12px 25px;
            }
            
            .feature-card {
                margin-bottom: 30px;
            }
            
            .footer-column {
                margin-bottom: 30px;
            }
        }

        @media (max-width: 576px) {
            .carousel-content {
                padding: 20px;
            }
            
            .carousel-title {
                font-size: 1.8rem;
            }
            
            .carousel-control-prev, .carousel-control-next {
                width: 40px;
                height: 40px;
                margin: 0 10px;
            }
        }

         /* Sección de convocatoria con carrusel */
        .convocatoria-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 0;
            overflow: hidden;
        }

        /* Carrusel de imágenes de fondo MEJORADO */
        .carousel-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .carousel-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(128, 0, 32, 0.7), rgba(128, 0, 32, 0.4));
            z-index: 0;
        }

        .carousel-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transform: scale(1.05);
            transition: opacity 1.5s ease-in-out, transform 7s ease-in-out;
        }

        .carousel-slide.active {
            opacity: 1;
            transform: scale(1);
        }

        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Indicadores de carrusel personalizado */
        .carousel-indicators-custom {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            z-index: 10;
        }

        .carousel-indicator {
            width: 10px;
            height: 10px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-indicator.active {
            background-color: var(--dorado);
            transform: scale(1.3);
            box-shadow: 0 0 10px var(--dorado);
        }

        /* Flechas de navegación personalizadas */
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dorado);
            font-size: 24px;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .carousel-arrow:hover {
            background-color: rgba(0, 0, 0, 0.3);
            color: var(--dorado-claro);
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-arrow-prev {
            left: 20px;
        }

        .carousel-arrow-next {
            right: 20px;
        }

        /* Contenido sobre la imagen */
        .convocatoria-content {
            position: relative;
            z-index: 1;
            max-width: 850px;
            padding: 50px;
            background: rgba(255, 248, 231, 0.92);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2), 0 0 0 2px var(--dorado);
            color: var(--guinda-oscuro);
            transform: translateY(0);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .convocatoria-content:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25), 0 0 0 3px var(--dorado);
        }

        .convocatoria-content h1 {
            color: var(--guinda);
            font-weight: 700;
            margin-bottom: 25px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid var(--dorado);
            padding-bottom: 15px;
            display: inline-block;
        }

        .convocatoria-content .lead {
            font-size: 1.3rem;
            line-height: 1.8;
            margin-bottom: 30px;
            color: #333;
        }

        /* Contador regresivo */
        .countdown-container {
            display: flex;
            justify-content: center;
            margin: 30px 0;
            gap: 15px;
        }

        .countdown-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            min-width: 80px;
            background: linear-gradient(135deg, var(--guinda-oscuro), var(--guinda));
            border-radius: 10px;
            color: var(--dorado);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--dorado-claro);
        }

        .countdown-number {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .countdown-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Botón de inscripción */
        .btn-inscripcion {
            background: linear-gradient(135deg, var(--dorado), var(--dorado-oscuro));
            color: var(--guinda-oscuro);
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(170, 140, 44, 0.4);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-inscripcion::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--guinda), var(--guinda-oscuro));
            transition: width 0.4s ease;
            z-index: -1;
        }

        .btn-inscripcion:hover::before {
            width: 100%;
        }

        .btn-inscripcion:hover {
            color: var(--dorado);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(170, 140, 44, 0.5);
        }

        .btn-inscripcion i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .btn-inscripcion:hover i {
            transform: translateX(5px);
        }

        /* Etiqueta de destacado */
        .featured-tag {
            position: absolute;
            top: -15px;
            right: -15px;
            background: linear-gradient(135deg, var(--guinda), var(--guinda-oscuro));
            color: var(--dorado);
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: rotate(5deg);
            z-index: 2;
            border: 1px solid var(--dorado-claro);
        }

        .featured-tag i {
            margin-right: 5px;
        }

        /* Detalles decorativos */
        .decorative-icon {
            color: var(--dorado);
            font-size: 2.5rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Brillo dorado en elementos */
        .gold-glow {
            position: relative;
        }

        .gold-glow::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: radial-gradient(ellipse at center, rgba(212, 175, 55, 0.3) 0%, rgba(212, 175, 55, 0) 70%);
            border-radius: 50%;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .gold-glow:hover::before {
            opacity: 1;
        } /* Colores principales */
        :root {
            --guinda: #800020;           /* Rojo guinda principal */
            --guinda-oscuro: #5a0018;    /* Rojo guinda oscuro */
            --guinda-claro: #a30028;     /* Rojo guinda claro */
            --dorado: #d4af37;           /* Dorado principal */
            --dorado-claro: #f4d160;     /* Dorado claro */
            --dorado-oscuro: #aa8c2c;    /* Dorado oscuro */
            --crema: #fff8e7;            /* Crema para fondos suaves */
            --negro: #1a1a1a;            /* Negro para textos */
        }

        /* Estilos generales */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--crema);
            color: var(--negro);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Encabezado */
        header {
            background-color: var(--guinda);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 10px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.4s ease;
        }

        header.scrolled {
            padding: 5px 0;
            background-color: rgba(128, 0, 32, 0.95);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            max-height: 60px;
            transition: all 0.4s ease;
        }

        header.scrolled .navbar-brand img {
            max-height: 50px;
        }

        .navbar-nav .nav-link {
            color: var(--crema) !important;
            font-size: 16px;
            font-weight: 600;
            margin: 0 12px;
            padding: 10px 5px;
            position: relative;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 5px;
            left: 0;
            background-color: var(--dorado);
            transition: width 0.3s ease;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        .navbar-nav .nav-link:hover {
            color: var(--dorado) !important;
        }

        .navbar-toggler {
            border-color: var(--dorado);
            background-color: var(--dorado-claro);
        }

        /* Sección principal - carrusel avanzado */
        .hero-carousel {
            position: relative;
            height: 100vh;
            width: 100%;
            margin-top: 80px;
            overflow: hidden;
        }

        .carousel-inner {
            height: 100%;
        }

        .carousel-item {
            height: 100%;
            position: relative;
        }

        .carousel-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.8);
            transition: transform 8s ease;
        }

        .carousel-item.active .carousel-image {
            transform: scale(1.1);
        }

        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(26, 26, 26, 0.5), rgba(128, 0, 32, 0.7));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .carousel-content {
            max-width: 800px;
            padding: 40px;
            background: rgba(255, 248, 231, 0.85);
            border-radius: 15px;
            backdrop-filter: blur(5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2), 0 0 0 3px var(--dorado);
            transform: translateY(50px);
            opacity: 0;
            transition: all 0.8s ease;
            position: relative;
            z-index: 10;
        }

        .carousel-item.active .carousel-content {
            transform: translateY(0);
            opacity: 1;
        }

        .carousel-caption-custom {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            padding: 20px;
            background: linear-gradient(to top, rgba(26, 26, 26, 0.8), transparent);
            color: white;
            text-align: center;
        }

        .carousel-title {
            color: var(--guinda);
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            position: relative;
            display: inline-block;
        }

        .carousel-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--dorado);
        }

        .carousel-description {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 30px;
            color: var(--negro);
        }

        /* Indicadores personalizados */
        .carousel-indicators {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            margin: 0;
            padding: 0;
        }

        .carousel-indicators [data-bs-target] {
            width: 15px;
            height: 15px;
            margin: 0 8px;
            background-color: transparent;
            border: 2px solid var(--dorado);
            border-radius: 50%;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .carousel-indicators .active {
            background-color: var(--dorado);
            transform: scale(1.2);
        }

        /* Controles personalizados */
        .carousel-control-prev, .carousel-control-next {
            width: 50px;
            height: 50px;
            background-color: var(--guinda);
            border-radius: 50%;
            opacity: 0.7;
            top: 50%;
            transform: translateY(-50%);
            margin: 0 20px;
        }

        .carousel-control-prev:hover, .carousel-control-next:hover {
            opacity: 1;
            background-color: var(--dorado);
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            width: 24px;
            height: 24px;
        }

        /* Botón de inscripción */
        .btn-inscripcion {
            background: linear-gradient(135deg, var(--dorado), var(--dorado-oscuro));
            color: var(--guinda-oscuro);
            padding: 15px 30px;
            font-size: 18px;
            font-weight: 700;
            border: none;
            border-radius: 50px;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(170, 140, 44, 0.4);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-inscripcion::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--guinda), var(--guinda-oscuro));
            transition: width 0.4s ease;
            z-index: -1;
        }

        .btn-inscripcion:hover::before {
            width: 100%;
        }

        .btn-inscripcion:hover {
            color: var(--dorado);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(170, 140, 44, 0.5);
        }

        .btn-inscripcion i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .btn-inscripcion:hover i {
            transform: translateX(5px);
        }

        /* Distintivo o badge para ofertas especiales */
        .offer-badge {
            position: absolute;
            top: -20px;
            right: -20px;
            background: var(--guinda);
            color: white;
            padding: 10px 15px;
            border-radius: 50%;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transform: rotate(15deg);
            z-index: 10;
        }

        /* Sección de características */
        .features-section {
            padding: 80px 0;
            background-color: #fff;
        }

        .section-title {
            color: var(--guinda);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 50px;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--dorado);
        }

        .feature-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            height: 100%;
            border-bottom: 3px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            border-bottom: 3px solid var(--dorado);
        }

        .feature-icon {
            color: var(--guinda);
            font-size: 2.5rem;
            margin-bottom: 20px;
            background: rgba(128, 0, 32, 0.1);
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            background: var(--guinda);
            color: white;
            transform: rotateY(180deg);
        }

        .feature-title {
            font-size: 1.5rem;
            color: var(--guinda);
            margin-bottom: 15px;
            font-weight: 700;
        }

        /* Pie de página */
        footer {
            background-color: var(--guinda-oscuro);
            color: var(--crema);
            padding: 50px 0 20px;
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, transparent, var(--dorado), transparent);
        }

        .footer-logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .footer-contact {
            margin-bottom: 30px;
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .footer-contact-icon {
            color: var(--dorado);
            font-size: 20px;
            margin-right: 15px;
            margin-top: 3px;
        }

        .footer-title {
            color: var(--dorado);
            font-size: 1.4rem;
            margin-bottom: 20px;
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--dorado);
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: var(--crema);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            position: relative;
            padding-left: 15px;
        }

        .footer-links a::before {
            content: '\f105';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 0;
            color: var(--dorado);
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--dorado);
            transform: translateX(5px);
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icons a {
            color: var(--crema);
            background: rgba(212, 175, 55, 0.2);
            margin: 0 8px;
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--guinda);
            background: var(--dorado);
            transform: translateY(-5px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(212, 175, 55, 0.2);
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
        }

        .newsletter-form {
            position: relative;
            margin-top: 20px;
        }

        .newsletter-input {
            width: 100%;
            padding: 12px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 30px;
            color: white;
        }

        .newsletter-input::placeholder {
            color: rgba(255, 248, 231, 0.6);
        }

        .newsletter-btn {
            position: absolute;
            right: 5px;
            top: 5px;
            background: var(--dorado);
            color: var(--guinda-oscuro);
            border: none;
            border-radius: 30px;
            padding: 7px 15px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            background: var(--dorado-claro);
            transform: translateX(3px);
        }

        /* Ajustes responsivos */
        @media (max-width: 991px) {
            .carousel-title {
                font-size: 2.5rem;
            }
            
            .carousel-content {
                max-width: 90%;
                padding: 30px;
            }
        }

        @media (max-width: 768px) {
            .hero-carousel {
                height: 90vh;
                margin-top: 76px;
            }
            
            .carousel-title {
                font-size: 2rem;
            }
            
            .carousel-description {
                font-size: 1rem;
            }
            
            .btn-inscripcion {
                font-size: 16px;
                padding: 12px 25px;
            }
            
            .feature-card {
                margin-bottom: 30px;
            }
            
            .footer-column {
                margin-bottom: 30px;
            }
        }

        @media (max-width: 576px) {
            .carousel-content {
                padding: 20px;
            }
            
            .carousel-title {
                font-size: 1.8rem;
            }
            
            .carousel-control-prev, .carousel-control-next {
                width: 40px;
                height: 40px;
                margin: 0 10px;
            }
        }

         /* Sección de convocatoria con carrusel */
        .convocatoria-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 0;
            overflow: hidden;
        }

        /* Carrusel de imágenes de fondo MEJORADO */
        .carousel-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .carousel-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(128, 0, 32, 0.7), rgba(128, 0, 32, 0.4));
            z-index: 0;
        }

        .carousel-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transform: scale(1.05);
            transition: opacity 1.5s ease-in-out, transform 7s ease-in-out;
        }

        .carousel-slide.active {
            opacity: 1;
            transform: scale(1);
        }

        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Indicadores de carrusel personalizado */
        .carousel-indicators-custom {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            z-index: 10;
        }

        .carousel-indicator {
            width: 10px;
            height: 10px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-indicator.active {
            background-color: var(--dorado);
            transform: scale(1.3);
            box-shadow: 0 0 10px var(--dorado);
        }

        /* Flechas de navegación personalizadas */
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dorado);
            font-size: 24px;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .carousel-arrow:hover {
            background-color: rgba(0, 0, 0, 0.3);
            color: var(--dorado-claro);
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-arrow-prev {
            left: 20px;
        }

        .carousel-arrow-next {
            right: 20px;
        }

        /* Contenido sobre la imagen */
        .convocatoria-content {
            position: relative;
            z-index: 1;
            max-width: 850px;
            padding: 50px;
            background: rgba(255, 248, 231, 0.92);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2), 0 0 0 2px var(--dorado);
            color: var(--guinda-oscuro);
            transform: translateY(0);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .convocatoria-content:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25), 0 0 0 3px var(--dorado);
        }

        .convocatoria-content h1 {
            color: var(--guinda);
            font-weight: 700;
            margin-bottom: 25px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid var(--dorado);
            padding-bottom: 15px;
            display: inline-block;
        }

        .convocatoria-content .lead {
            font-size: 1.3rem;
            line-height: 1.8;
            margin-bottom: 30px;
            color: #333;
        }

        /* Contador regresivo */
        .countdown-container {
            display: flex;
            justify-content: center;
            margin: 30px 0;
            gap: 15px;
        }

        .countdown-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            min-width: 80px;
            background: linear-gradient(135deg, var(--guinda-oscuro), var(--guinda));
            border-radius: 10px;
            color: var(--dorado);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--dorado-claro);
        }

        .countdown-number {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .countdown-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Botón de inscripción */
        .btn-inscripcion {
            background: linear-gradient(135deg, var(--dorado), var(--dorado-oscuro));
            color: var(--guinda-oscuro);
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(170, 140, 44, 0.4);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-inscripcion::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--guinda), var(--guinda-oscuro));
            transition: width 0.4s ease;
            z-index: -1;
        }

        .btn-inscripcion:hover::before {
            width: 100%;
        }

        .btn-inscripcion:hover {
            color: var(--dorado);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(170, 140, 44, 0.5);
        }

        .btn-inscripcion i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .btn-inscripcion:hover i {
            transform: translateX(5px);
        }

        /* Etiqueta de destacado */
        .featured-tag {
            position: absolute;
            top: -15px;
            right: -15px;
            background: linear-gradient(135deg, var(--guinda), var(--guinda-oscuro));
            color: var(--dorado);
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: rotate(5deg);
            z-index: 2;
            border: 1px solid var(--dorado-claro);
        }

        .featured-tag i {
            margin-right: 5px;
        }

        /* Detalles decorativos */
        .decorative-icon {
            color: var(--dorado);
            font-size: 2.5rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Brillo dorado en elementos */
        .gold-glow {
            position: relative;
        }

        .gold-glow::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: radial-gradient(ellipse at center, rgba(212, 175, 55, 0.3) 0%, rgba(212, 175, 55, 0) 70%);
            border-radius: 50%;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .gold-glow:hover::before {
            opacity: 1;
        }

 
    </style>
</head>
<body>
   <!-- Section: Design Block -->
<section class="text-center">
  <!-- Background image -->
    <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
  <!-- Background image -->

        <div class="card mx-4 mx-md-5 shadow-5-strong bg-body-tertiary" style="
        margin-top: -100px;
        backdrop-filter: blur(30px);
        ">
            <div class="card-body py-5 px-md-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-5">Sign up now</h2>
                            <div class="progress mt-3">
                                <div id="progressBar" class="progress-bar bg-dark" style="width: 33%;"></div>
                            </div>
            
                                               <form id="registrationForm">
                    <div class="step active" id="step1">
                        <h5>Datos personales</h5>
                        <div class="mb-3"><label>Primer apellido</label><input type="text" class="form-control" disabled></div>
                        <div class="mb-3"><label>Segundo apellido</label><input type="text" class="form-control" disabled></div>
                        <div class="mb-3"><label>Nombre(s)</label><input type="text" class="form-control" disabled></div>
                        <div class="mb-3"><label>CURP</label><input type="text" class="form-control" disabled></div>
                        <button type="button" class="btn btn-primary next">Siguiente</button>
                    </div>
                    <div class="step" id="step2">
                        <h5>Datos de contacto</h5>
                        <div class="mb-3"><label>Teléfono casa</label><input type="text" class="form-control"></div>
                        <div class="mb-3"><label>Celular</label><input type="text" class="form-control"></div>
                        <button type="button" class="btn btn-secondary prev">Atrás</button>
                        <button type="button" class="btn btn-primary next">Siguiente</button>
                    </div>
                    <div class="step" id="step3">
                        <h5>Dirección</h5>
                        <div class="mb-3"><label>Calle</label><input type="text" class="form-control"></div>
                        <div class="mb-3"><label>No. exterior</label><input type="text" class="form-control"></div>
                        <div class="mb-3"><label>No. interior</label><input type="text" class="form-control"></div>
                        <button type="button" class="btn btn-secondary prev">Atrás</button>
                        <button type="button" class="btn btn-primary next">Siguiente</button>
                    </div>
                    <div class="step" id="step4">
                        <h5>Datos educativos</h5>
                        <div class="mb-3"><label>Fecha de término de estudios</label><input type="date" class="form-control"></div>
                        <div class="mb-3"><label>No. certificado</label><input type="text" class="form-control"></div>
                        <button type="button" class="btn btn-secondary prev">Atrás</button>
                        <button type="submit" class="btn btn-success">Finalizar</button>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let currentStep = 0;
            const steps = document.querySelectorAll(".step");
            const progressBar = document.getElementById("progressBar");

            function showStep(index) {
                steps.forEach((step, i) => {
                    step.classList.toggle("active", i === index);
                });
                progressBar.style.width = ((index + 1) / steps.length) * 100 + "%";
            }

            document.querySelectorAll(".next").forEach(btn => {
                btn.addEventListener("click", () => {
                    if (currentStep < steps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });

            document.querySelectorAll(".prev").forEach(btn => {
                btn.addEventListener("click", () => {
                    if (currentStep > 0) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            });

            document.getElementById("multiStepForm").addEventListener("submit", function (event) {
                event.preventDefault();
                alert("Formulario enviado correctamente.");
            });

            showStep(currentStep);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php require APPROOT . '/Views/templates/footer.php'; ?>




