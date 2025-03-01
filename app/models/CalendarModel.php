<?php
class CalendarModel extends Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function getEventsByMonth($year, $month) {
        $this->db->query("SELECT * FROM events WHERE YEAR(date) = :year AND MONTH(date) = :month");
        $this->db->bind(':year', $year);
        $this->db->bind(':month', $month);
        return $this->db->resultSet();
    }
}