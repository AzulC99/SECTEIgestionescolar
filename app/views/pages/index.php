<?php require APPROOT . '/Views/templates/header.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convocatoria Bachillerato</title>
    
    <style>
        body {
            background-color: #f1f1f1;
            color: #6c757d;
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }
        header {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        footer {
            background-color: #ffffff;
            padding: 1rem 0;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .section-header {
            margin-top: 30px;
            margin-bottom: 20px;
        }
        .section {
            padding: 40px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #495057;
        }
        .section p {
            font-size: 1.1rem;
            color: #6c757d;
        }
        .btn-custom {
            background-color: #adb5bd;
            border-color: #6c757d;
        }
        .btn-custom:hover {
            background-color: #6c757d;
            border-color: #495057;
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        /* Scroll animation */
        .section-scroll {
            opacity: 0;
            transition: opacity 1s ease-out;
        }
        .section-scroll.visible {
            opacity: 1;
        }
        /* Ajuste de diseño para dispositivos móviles */
        @media (max-width: 768px) {
            .section {
                padding: 30px 0;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">Convocatoria Bachillerato</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#inicio">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#acerca-de">Acerca de</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#convocatorias">Convocatorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#requisitos">Requisitos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contacto">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Sección Inicio -->
    <section id="inicio" class="container text-center section fade-in">
        <h2>Convocatoria Abierta para Bachillerato</h2>
        <p>¡Inscríbete ahora y empieza tu camino hacia el futuro! Consulta las bases y requisitos para participar en la convocatoria.</p>
         <a class="btn btn-primary btn-lg" href="<?php echo URLROOT; ?>/pages/login" role="button">Iniciar sesión</a>
         <a class="btn btn-primary btn-lg" href="<?php echo URLROOT; ?>/pages/registro" role="button">Registrarse</a>
    </section>

    <!-- Sección Acerca de -->
    <section id="acerca-de" class="container section fade-in section-scroll">
        <h3 class="section-title">Acerca de la Convocatoria</h3>
        <p>Esta convocatoria está dirigida a estudiantes interesados en continuar con su formación en el nivel de bachillerato. Nuestra institución ofrece programas educativos de alta calidad, preparados para los retos del futuro.</p>
    </section>

    <!-- Sección Convocatorias -->
    <section id="convocatorias" class="container section fade-in section-scroll">
        <h3 class="section-title">Convocatorias Disponibles</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Convocatoria 1">
                    <div class="card-body">
                        <h5 class="card-title">Convocatoria 2025</h5>
                        <p class="card-text">Convocatoria para el ingreso al ciclo 2025. Inscripciones abiertas hasta el 30 de marzo.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Convocatoria 2">
                    <div class="card-body">
                        <h5 class="card-title">Convocatoria 2026</h5>
                        <p class="card-text">Convocatoria para el ciclo escolar 2026. Inscripciones abiertas desde el 1 de junio.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Convocatoria 3">
                    <div class="card-body">
                        <h5 class="card-title">Convocatoria Especial</h5>
                        <p class="card-text">Convocatoria especial para estudiantes con discapacidades. Consulta más detalles.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Requisitos -->
    <section id="requisitos" class="container section fade-in section-scroll">
        <h3 class="section-title">Requisitos para Participar</h3>
        <ul>
            <li>Ser mayor de 15 años.</li>
            <li>Tener el certificado de secundaria o equivalente.</li>
            <li>Presentar una carta de recomendación.</li>
            <li>Acreditar un examen de admisión.</li>
        </ul>
    </section>

    <!-- Sección Contacto -->
    <section id="contacto" class="container section fade-in section-scroll">
        <h3 class="section-title">Contacto</h3>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensaje</label>
                <textarea class="form-control" id="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Enviar</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; 2025 Convocatoria Bachillerato | Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Detectar cuando una sección entra en vista para aplicar la animación
        const sections = document.querySelectorAll('.section-scroll');

        function checkScroll() {
            const triggerBottom = window.innerHeight / 5 * 4;

            sections.forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;

                if (sectionTop < triggerBottom) {
                    section.classList.add('visible');
                } else {
                    section.classList.remove('visible');
                }
            });
        }

        window.addEventListener('scroll', checkScroll);
        checkScroll(); // Para que se active la animación al cargar
    </script>
</body>
</html>
 

<?php require APPROOT . '/Views/templates/footer.php'; ?>