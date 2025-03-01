<?php require APPROOT . '/Views/templates/header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Consulta de Convocatorias</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Estilos personalizados con escala de rojos -->
    <style>
       :root {
    --color-gris-muy-claro: #f5f5f5;
    --color-gris-claro: #e0e0e0;
    --color-gris-medio: #bdbdbd;
    --color-gris-oscuro: #757575;
    --color-gris-muy-oscuro: #424242;
    --color-texto-claro: #f8f9fa;
    --color-texto-oscuro: #212529;
    --gradient-header: linear-gradient(135deg, #757575 0%, #424242 100%);
}

body {
    background-color: #ffffff;
    font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
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
/* Tarjetas de convocatorias */
.card-convocatoria {
    transition: transform 0.3s, box-shadow 0.3s;
    border: none;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 20px;
}

.card-convocatoria:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.card-header-custom {
    background-color: var(--color-gris-oscuro);
    color: white;
    padding: 15px;
    border-bottom: none;
}

.card-badge {
    background-color: var(--color-gris-medio);
    color: white;
    font-size: 0.8rem;
    padding: 0.3rem 0.7rem;
    border-radius: 20px;
    margin-bottom: 10px;
    display: inline-block;
}

.card-badge.grande {
    font-size: 1rem;
    padding: 0.4rem 0.9rem;
}

/* Estados de convocatorias */
.estado-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
}

.estado-badge i {
    margin-right: 5px;
}

.estado-activa {
    background-color: rgba(128, 128, 128, 0.15);
    color: #606060;
    border: 1px solid rgba(128, 128, 128, 0.3);
}

.estado-cerrada {
    background-color: rgba(169, 169, 169, 0.15);
    color: #808080;
    border: 1px solid rgba(169, 169, 169, 0.3);
}

.estado-evaluacion {
    background-color: rgba(192, 192, 192, 0.15);
    color: #909090;
    border: 1px solid rgba(192, 192, 192, 0.3);
}

/* Filtros */
.filtros-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border-top: 4px solid var(--color-gris-oscuro);
    margin-bottom: 30px;
}

.filtros-title {
    color: var(--color-gris-muy-oscuro);
    font-weight: 600;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.filtros-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 50px;
    background-color: var(--color-gris-medio);
}

/* Botones personalizados */
.btn-guinda {
    background-color: var(--color-gris-oscuro);
    color: white;
    border: none;
    transition: all 0.3s;
}

.btn-guinda:hover {
    background-color: var(--color-gris-muy-oscuro);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-outline-guinda {
    border: 2px solid var(--color-gris-oscuro);
    color: var(--color-gris-oscuro);
    background-color: transparent;
    transition: all 0.3s;
}

.btn-outline-guinda:hover {
    background-color: var(--color-gris-oscuro);
    color: white;
}

/* Sección de detalles */
.detalle-convocatoria {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    padding: 30px;
    margin-bottom: 30px;
}

.seccion-titulo {
    color: var(--color-gris-oscuro);
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--color-gris-claro);
}

.info-bloque {
    background-color: var(--color-gris-muy-claro);
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 20px;
}

.documento-link {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    background-color: #f8f9fa;
    border-radius: 4px;
    margin-bottom: 8px;
    color: var(--color-texto-oscuro);
    text-decoration: none;
    transition: all 0.2s;
}

.documento-link:hover {
    background-color: var(--color-gris-claro);
    color: var(--color-gris-muy-oscuro);
    transform: translateX(5px);
}

.documento-link i {
    color: var(--color-gris-oscuro);
    font-size: 1.2rem;
    margin-right: 10px;
}

/* Breadcrumb personalizado */
.breadcrumb-item a {
    color: var(--color-gris-oscuro);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: var(--color-gris-muy-oscuro);
    font-weight: 500;
}

/* Footer */
.footer-custom {
    background-color: var(--color-gris-muy-oscuro);
    color: var(--color-texto-claro);
    padding: 30px 0;
    margin-top: 50px;
}

/* Paginación */
.pagination .page-item.active .page-link {
    background-color: var(--color-gris-oscuro) !important;
    border-color: var(--color-gris-oscuro) !important;
}

.pagination .page-link {
    color: var(--color-gris-oscuro);
}

/* Animaciones para cargar contenido */
.fade-in {
    animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>
</head>
<body>
    

    <!-- Contenido Principal -->
    <main class="container py-5">
        <div class="row">
            <div class="col-12 mb-4">
                <h2 class="filtros-title display-6"><i class="fas fa-search me-2"></i>Consulta resultados</h2>
            </div>
        </div>

        <!-- Filtros -->
        <div class="row">
            <div class="col-12">
                <div class="filtros-card p-4 fade-in">
                    <h3 class="filtros-title fs-4"><i class="fas fa-filter me-2"></i>Filtrar resultado del aspirante</h3>
                    <form action="" method="GET">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select class="form-select" id="categoria" name="categoria">
                                    <option value="">Todas las categorías</option>
                                    <option value="becas">Becas</option>
                                    <option value="empleo">Empleo</option>
                                    <option value="financiamiento">Financiamiento</option>
                                    <option value="proyectos">Proyectos</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado">
                                    <option value="">Todos los estados</option>
                                    <option value="activa">Activas</option>
                                    <option value="cerrada">Cerradas</option>
                                    <option value="en_evaluacion">En evaluación</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_desde" class="form-label">Fecha desde</label>
                                <input type="date" class="form-control" id="fecha_desde" name="fecha_desde">
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_hasta" class="form-label">Fecha hasta</label>
                                <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta">
                            </div>
                            <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                <button type="reset" class="btn btn-outline-guinda">
                                    <i class="fas fa-undo me-1"></i>Limpiar filtros
                                </button>
                                <button type="submit" class="btn btn-guinda">
                                    <i class="fas fa-search me-1"></i>Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Listado de Convocatorias -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="filtros-title fs-4 mb-0"><i class="fas fa-th-list me-2"></i>Resultados por convocatorias</h3>
                    <div class="d-flex align-items-center">
                        <span class="me-2">Ordenar por:</span>
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option>Más recientes</option>
                            <option>Próximas a vencer</option>
                            <option>Alfabéticamente</option>
                        </select>
                    </div>
                </div>
                
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 fade-in">
                    <!-- Convocatoria 1 -->
                    <div class="col">
                        <div class="card card-convocatoria h-100 shadow-sm">
                            <div class="card-header-custom">
                                <span class="card-badge">Becas</span>
                                <h5 class="card-title">Becas de Posgrado 2025</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-1 small"><i class="far fa-building me-1"></i>CONACYT</p>
                                <p class="card-text">Programa de becas para estudios de maestría y doctorado en ciencias e ingeniería para estudiantes destacados.</p>
                                
                                <div class="d-flex justify-content-between mt-3 mb-2">
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar me-1"></i>Publicación</small>
                                        <strong>15/01/2025</strong>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar-times me-1"></i>Cierre</small>
                                        <strong>15/03/2025</strong>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <span class="estado-badge estado-activa">
                                        <i class="fas fa-clock"></i> 23 días restantes
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0">
                                <a href="detalle.html" class="btn btn-outline-guinda w-100">
                                    <i class="fas fa-info-circle me-1"></i>Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Convocatoria 2 -->
                    <div class="col">
                        <div class="card card-convocatoria h-100 shadow-sm">
                            <div class="card-header-custom">
                                <span class="card-badge">Proyectos</span>
                                <h5 class="card-title">Innovación Tecnológica</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-1 small"><i class="far fa-building me-1"></i>Ministerio de Ciencia</p>
                                <p class="card-text">Financiamiento para proyectos de innovación tecnológica en áreas estratégicas y desarrollo sostenible.</p>
                                
                                <div class="d-flex justify-content-between mt-3 mb-2">
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar me-1"></i>Publicación</small>
                                        <strong>05/01/2025</strong>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar-times me-1"></i>Cierre</small>
                                        <strong>01/03/2025</strong>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <span class="estado-badge estado-activa">
                                        <i class="fas fa-clock"></i> 9 días restantes
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0">
                                <a href="detalle.html" class="btn btn-outline-guinda w-100">
                                    <i class="fas fa-info-circle me-1"></i>Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Convocatoria 3 -->
                    <div class="col">
                        <div class="card card-convocatoria h-100 shadow-sm">
                            <div class="card-header-custom">
                                <span class="card-badge">Empleo</span>
                                <h5 class="card-title">Contratación de Personal</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-1 small"><i class="far fa-building me-1"></i>Instituto Nacional</p>
                                <p class="card-text">Proceso de selección para cubrir puestos en el área de tecnología y sistemas de información.</p>
                                
                                <div class="d-flex justify-content-between mt-3 mb-2">
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar me-1"></i>Publicación</small>
                                        <strong>10/12/2024</strong>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar-times me-1"></i>Cierre</small>
                                        <strong>20/01/2025</strong>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <span class="estado-badge estado-evaluacion">
                                        <i class="fas fa-tasks"></i> En evaluación
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0">
                                <a href="detalle.html" class="btn btn-outline-guinda w-100">
                                    <i class="fas fa-info-circle me-1"></i>Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Convocatoria 4 -->
                    <div class="col">
                        <div class="card card-convocatoria h-100 shadow-sm">
                            <div class="card-header-custom">
                                <span class="card-badge">Financiamiento</span>
                                <h5 class="card-title">Apoyo a PYMES</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-1 small"><i class="far fa-building me-1"></i>Ministerio de Economía</p>
                                <p class="card-text">Financiamiento y asistencia técnica para pequeñas y medianas empresas con proyectos innovadores.</p>
                                
                                <div class="d-flex justify-content-between mt-3 mb-2">
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar me-1"></i>Publicación</small>
                                        <strong>05/11/2024</strong>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar-times me-1"></i>Cierre</small>
                                        <strong>15/12/2024</strong>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <span class="estado-badge estado-cerrada">
                                        <i class="fas fa-lock"></i> Convocatoria cerrada
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0">
                                <a href="detalle.html" class="btn btn-outline-guinda w-100">
                                    <i class="fas fa-info-circle me-1"></i>Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Convocatoria 5 -->
                    <div class="col">
                        <div class="card card-convocatoria h-100 shadow-sm">
                            <div class="card-header-custom">
                                <span class="card-badge">Becas</span>
                                <h5 class="card-title">Intercambio Académico</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-1 small"><i class="far fa-building me-1"></i>Universidad Nacional</p>
                                <p class="card-text">Programa de intercambio académico internacional para estudiantes de pregrado en diversas áreas.</p>
                                
                                <div class="d-flex justify-content-between mt-3 mb-2">
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar me-1"></i>Publicación</small>
                                        <strong>01/02/2025</strong>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar-times me-1"></i>Cierre</small>
                                        <strong>30/03/2025</strong>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <span class="estado-badge estado-activa">
                                        <i class="fas fa-clock"></i> 38 días restantes
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0">
                                <a href="detalle.html" class="btn btn-outline-guinda w-100">
                                    <i class="fas fa-info-circle me-1"></i>Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Convocatoria 6 -->
                    <div class="col">
                        <div class="card card-convocatoria h-100 shadow-sm">
                            <div class="card-header-custom">
                                <span class="card-badge">Proyectos</span>
                                <h5 class="card-title">Investigación Científica</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-1 small"><i class="far fa-building me-1"></i>Fundación de Ciencias</p>
                                <p class="card-text">Apoyo a proyectos de investigación científica en áreas prioritarias de salud, ambiente y seguridad alimentaria.</p>
                                
                                <div class="d-flex justify-content-between mt-3 mb-2">
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar me-1"></i>Publicación</small>
                                        <strong>20/01/2025</strong>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block"><i class="far fa-calendar-times me-1"></i>Cierre</small>
                                        <strong>20/04/2025</strong>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <span class="estado-badge estado-activa">
                                        <i class="fas fa-clock"></i> 59 días restantes
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0">
                                <a href="detalle.html" class="btn btn-outline-guinda w-100">
                                    <i class="fas fa-info-circle me-1"></i>Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-5">
                    <nav aria-label="Navegación de páginas">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                            </li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#" style="background-color: var(--color-guinda); border-color: var(--color-guinda);">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#" style="color: var(--color-guinda);">2</a></li>
                            <li class="page-item"><a class="page-link" href="#" style="color: var(--color-guinda);">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" style="color: var(--color-guinda);">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>

    <!-- Página de Detalle (Vista separada) -->
    <div class="container py-5" style="display: none;">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home me-1"></i>Inicio</a></li>
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-list-alt me-1"></i>Convocatorias</a></li>
                <li class="breadcrumb-item active">Becas de Posgrado 2025</li>
            </ol>
        </nav>
        
        <div class="detalle-convocatoria fade-in">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <span class="card-badge grande mb-2">Becas</span>
                    <h2 class="mb-0">Becas de Posgrado 2025</h2>
                    <p class="text-muted"><i class="far fa-building me-1"></i>CONACYT</p>
                </div>
                <span class="estado-badge estado-activa">
                    <i class="fas fa-clock"></i> 23 días restantes
                </span>
            </div>
            
            <div class="row info-bloque mb-4">
                <div class="col-md-3 mb-3 mb-md-0">
                    <h6 class="text-muted"><i class="far fa-calendar me-2"></i>Publicación</h6>
                    <p class="fw-bold mb-0">15/01/2025</p>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <h6 class="text-muted"><i class="far fa-calendar-times me-2"></i>Cierre</h6>
                    <p class="fw-bold mb-0">15/03/2025</p>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <h6 class="text-muted"><i class="fas fa-globe-americas me-2"></i>Ámbito</h6>
                    <p class="fw-bold mb-0">Nacional</p>
                </div>
                <div class="col-md-3">
                    <h6 class="text-muted"><i class="fas fa-coins me-2"></i>Presupuesto</h6>
                    <p class="fw-bold mb-0">$5,000,000.00</p>
                </div>
            </div>
            
 <?php require APPROOT . '/Views/templates/footer.php'; ?>           