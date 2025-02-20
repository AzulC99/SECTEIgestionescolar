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
            
                                <form id="multiStepForm">
                                    <!-- Paso 1 -->
                                    <div class="step active">
                                        <h5>Paso 1: Información Básica</h5>
                                            <div class="mb-3">
                                                <label class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Correo Electrónico</label>
                                                    <input type="email" class="form-control" required>
                                            </div>
                                            <button type="button" class="btn btn-dark next">Siguiente</button>
                                    </div>

                                    <!-- Paso 2 -->
                                    <div class="step">
                                        <h5>Paso 2: Selecciona una Opción</h5>
                                            <div class="form-check">
                                                <input type="radio" name="option" class="form-check-input" id="option1" required>
                                                    <label class="form-check-label" for="option1">Opción 1</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="option" class="form-check-input" id="option2">
                                                    <label class="form-check-label" for="option2">Opción 2</label>
                                            </div>
                                            <button type="button" class="btn btn-secondary prev">Anterior</button>
                                            <button type="button" class="btn btn-dark next">Siguiente</button>
                                    </div>

                                    <!-- Paso 3 -->
                                    <div class="step">
                                        <h5>Paso 3: Confirmación</h5>
                                            <p>Revisa tu información antes de enviar.</p>
                                            <button type="button" class="btn btn-secondary prev">Anterior</button>
                                            <button type="submit" class="btn btn-success">Enviar</button>
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
