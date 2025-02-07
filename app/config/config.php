<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'escolar_sectei');

// Constantes de Email
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USER', 'tu@gmail.com');
define('SMTP_PASS', 'tu_password');
define('SMTP_PORT', 587);
// App Root
define('APPROOT', dirname(dirname(__FILE__)));
// URL Root
define('URLROOT', 'http://localhost/SECTEIgestionescolar');
// Site Name
define('SITENAME', 'Sistema de Gestión Escolar');
// App Version
define('APPVERSION', '1.0.0');

// Directorios para archivos
define('UPLOAD_PATH', APPROOT . '/uploads/');
define('PDF_PATH', APPROOT . '/pdfs/');