<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Escala de Grises</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
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
    </style>
</head>
<body>

<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form>

                <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Logo</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" class="form-control" required>
                    </div>

                    <div class="d-grid mb-3">
                        <button class="btn btn-dark btn-lg" type="submit">Ingresar</button>
                    </div>

                    <div class="text-center">
                        <a href="#" class="small text-muted">¿Olvidaste tu contraseña?</a>
                        <p class="mt-2 text-secondary">¿No tienes cuenta? <a href="#" class="text-dark">Regístrate</a></p>
                    </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
