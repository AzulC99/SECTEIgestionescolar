<?php
require_once APPROOT . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

class RegistrationMailer {
    private $mailer;
    private $dompdf;

    public function __construct() {
        // Configurar PHPMailer
        $this->mailer = new PHPMailer(true);
        $this->setupMailer();

        // Configurar DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $this->dompdf = new Dompdf($options);
    }

    private function setupMailer() {
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['SMTP_HOST'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['SMTP_USER'];
        $this->mailer->Password = $_ENV['SMTP_PASS'];
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = $_ENV['SMTP_PORT'];
        $this->mailer->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
        $this->mailer->isHTML(true);
    }

    public function sendRegistrationEmail($userData, $password) {
        try {
            // Generar PDF
            $pdfContent = $this->generateRegistrationPdf($userData, $password);
            $pdfPath = tempnam(sys_get_temp_dir(), 'reg_');
            file_put_contents($pdfPath, $pdfContent);

            // Configurar email
            $this->mailer->addAddress($userData['email'], $userData['name']);
            $this->mailer->Subject = 'Bienvenido - Datos de Acceso';
            $this->mailer->Body = $this->generateEmailBody($userData, $password);
            $this->mailer->addAttachment($pdfPath, 'datos_acceso.pdf');

            // Enviar email
            $result = $this->mailer->send();
            unlink($pdfPath);
            return $result;
        } catch (Exception $e) {
            if(isset($pdfPath)) unlink($pdfPath);
            throw new \Exception("Error al enviar email: " . $e->getMessage());
        }
    }

    private function generateRegistrationPdf($userData, $password) {
        $html = $this->generatePdfContent($userData, $password);
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        return $this->dompdf->output();
    }

    private function generatePdfContent($userData, $password) {
        return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    margin: 40px;
                }
                .header {
                    text-align: center;
                    margin-bottom: 30px;
                    padding-bottom: 20px;
                    border-bottom: 2px solid #333;
                }
                .credentials {
                    background-color: #f8f8f8;
                    padding: 20px;
                    margin: 20px 0;
                    border-radius: 5px;
                }
                .important {
                    color: #ff0000;
                    font-weight: bold;
                }
                .footer {
                    margin-top: 40px;
                    padding-top: 20px;
                    border-top: 1px solid #ddd;
                    font-size: 12px;
                    color: #666;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Datos de Acceso al Sistema</h1>
                <p>Fecha de registro: {$this->formatDate(date('Y-m-d H:i:s'))}</p>
            </div>

            <div class="credentials">
                <h2>Credenciales de Acceso</h2>
                <p><strong>Usuario:</strong> {$userData['email']}</p>
                <p><strong>Contraseña:</strong> {$password}</p>
            </div>

            <div class="user-info">
                <h2>Información Personal</h2>
                <p><strong>Nombre:</strong> {$userData['name']}</p>
                <p><strong>Teléfono:</strong> {$userData['phone']}</p>
                <p><strong>Dirección:</strong> {$userData['address']}</p>
            </div>

            <div class="footer">
                <p class="important">IMPORTANTE: Por seguridad, cambie su contraseña después del primer inicio de sesión.</p>
                <p>Este documento es confidencial y contiene información sensible.</p>
                <p>Si usted no realizó este registro, por favor contáctenos inmediatamente.</p>
            </div>
        </body>
        </html>
        HTML;
    }

    private function generateEmailBody($userData, $password) {
        return <<<HTML
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
            <h2>¡Bienvenido {$userData['name']}!</h2>
            
            <p>Su registro ha sido completado exitosamente. A continuación, encontrará sus credenciales de acceso:</p>
            
            <div style="background-color: #f8f8f8; padding: 20px; margin: 20px 0; border-radius: 5px;">
                <p><strong>Usuario:</strong> {$userData['email']}</p>
                <p><strong>Contraseña:</strong> {$password}</p>
            </div>

            <p><strong>Importante:</strong></p>
            <ul>
                <li>Adjunto encontrará un PDF con todos sus datos de registro.</li>
                <li>Por seguridad, cambie su contraseña después del primer inicio de sesión.</li>
                <li>Guarde este correo y el PDF en un lugar seguro.</li>
            </ul>

            <p style="color: #666; font-size: 12px; margin-top: 20px;">
                Si no realizó este registro, por favor contáctenos inmediatamente.
            </p>
        </div>
        HTML;
    }

    private function formatDate($date) {
        return date('d/m/Y H:i:s', strtotime($date));
    }
}