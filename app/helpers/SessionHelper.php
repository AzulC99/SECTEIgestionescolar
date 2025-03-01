

	<?php
     session_start();

        // Flash message helper
        function flash($name = '', $message = '', $class = 'alert alert-success') {
            if(!empty($name)) {
                // Crear mensaje flash
                if(!empty($message) && empty($_SESSION[$name])) {
                    $_SESSION[$name] = $message;
                    $_SESSION[$name.'_class'] = $class;
                } 
                // Mostrar mensaje flash
                elseif(!empty($_SESSION[$name]) && empty($message)) {
                    $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : $class;
                    echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
                    unset($_SESSION[$name]);
                    unset($_SESSION[$name.'_class']);
                }
            }
        }

        // Verificar si el usuario está logueado
        function isLoggedIn() {
            return isset($_SESSION['user_id']);
        }

        // Verificar si el usuario es administrador
        function isAdmin() {
            return isLoggedIn() && $_SESSION['user_role'] === 'admin';
        }

        // Verificar si el usuario es un usuario regular
        function isAspirante() {
            return isLoggedIn() && $_SESSION['user_role'] === 'aspirante';
        }

         function isApoyo() {
            return isLoggedIn() && $_SESSION['user_role'] === 'apoyo';
        }

         function isCoordinador() {
            return isLoggedIn() && $_SESSION['user_role'] === 'coordinacion';
        }

         function isDirector() {
            return isLoggedIn() && $_SESSION['user_role'] === 'director';
        }

         function isDirectora() {
            return isLoggedIn() && $_SESSION['user_role'] === 'directora';
        }

          function isSubdirectora() {
            return isLoggedIn() && $_SESSION['user_role'] === 'subdirectora';
        }



        // Verificar si el usuario es visitante (no está logueado)
        function isGuest() {
            return !isLoggedIn();
        }
?>

?>