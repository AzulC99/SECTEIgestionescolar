<?php
class DateHelper {
    public static function getMonthName($month) {
        $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                   'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        return $months[$month - 1];
    }
    
    public static function getDaysInMonth($year, $month) {
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
    
    public static function getFirstDayOfMonth($year, $month) {
        $date = new DateTime("$year-$month-01");
        return intval($date->format('N'));
    }
}