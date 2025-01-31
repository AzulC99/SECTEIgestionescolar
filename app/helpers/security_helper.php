<?php




function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generateToken() {
    return bin2hex(random_bytes(32));
}