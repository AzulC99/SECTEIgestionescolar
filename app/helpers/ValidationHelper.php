<?php
class ValidationHelper {
    public function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    public function isValidCURP($curp) {
        // Expresión regular para validar CURP mexicana
        $pattern = '/^([A-Z][AEIOUX][A-Z]{2})(\d{2})((0[1-9]|1[0-2])(0[1-9]|1\d|2\d|3[01]))([HM]{1})([A-Z]{2})([BCDFGHJKLMNPQRSTVWXYZ]{3})([0-9A-Z]{1})([0-9]{1})$/';
        return preg_match($pattern, $curp);
    }
}
?>