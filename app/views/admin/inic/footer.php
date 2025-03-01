</div>
   
    <script src="<?php echo URLROOT; ?>/js/calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@8.0.0/dist/umd/simple-datatables.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/[YOUR-TINYMCE-API-KEY]/tinymce/6/tinymce.min.js"></script>
        <!-- Footer -->
            <footer class="py-3 mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div>© 2025 LUXURY ADMIN. Todos los derechos reservados.</div>
                        <div>
                            <a href="#">Política de Privacidad</a>
                            &middot;
                            <a href="#">Términos de Uso</a>
                            &middot;
                            <a href="#">Soporte</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle sidebar
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.getElementById('sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
                });
            }
            
            // Check for previous sidebar state
            if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                document.body.classList.add('sb-sidenav-toggled');
            }
        });
    </script>
</body>
</html>