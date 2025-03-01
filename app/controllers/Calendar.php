<?php
class Calendar extends Controller {
    private $calendarModel;
    
    public function __construct() {
        $this->calendarModel = $this->model('CalendarModel');
    }
    
    public function index() {
        $currentYear = date('Y');
        $currentMonth = date('n');
        
        $data = [
            'year' => $currentYear,
            'month' => $currentMonth
        ];
        
        $this->view('calendar/index', $data);
    }
    
    public function month($year = null, $month = null) {
        $year = $year ?? date('Y');
        $month = $month ?? date('n');
        
        $data = [
            'year' => $year,
            'month' => $month,
            'events' => $this->calendarModel->getEventsByMonth($year, $month)
        ];
        
        $this->view('calendar/month', $data);
    }
}