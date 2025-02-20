<?php
require_once APPROOT . '/../vendor/autoload.php';

use setasign\Fpdf\Fpdf;

class PDFHelper extends FPDF {
    public function generatePDF($data) {
        $this->AddPage();
        
        // Título
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, utf8_decode($data['titulo']), 0, 1, 'C');
        $this->Ln(10);
        
        // Contenido
        $this->SetFont('Arial', '', 12);
        foreach($data['contenido'] as $seccion => $texto) {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, utf8_decode($seccion), 0, 1);
            $this->SetFont('Arial', '', 12);
            $this->MultiCell(0, 10, utf8_decode($texto));
            $this->Ln(5);
        }
        
        // Generar nombre único
        $filename = 'document_' . uniqid() . '.pdf';
        $filepath = PDF_PATH . $filename;
        
        $this->Output('F', $filepath);
        return $filepath;
    }
}