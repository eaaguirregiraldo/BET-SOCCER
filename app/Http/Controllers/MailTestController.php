<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailTestController extends Controller
{
    public function testMail()
    {
        try {
            Log::info('Iniciando prueba de envío de correo');
            
            Mail::raw('Este es un correo de prueba enviado a las ' . now(), function ($message) {
                $message->to('test@example.com')
                        ->subject('Prueba MailerSend desde Laravel');
            });
            
            Log::info('Correo enviado correctamente');
            
            return 'Correo enviado correctamente. Revisa los logs para más detalles.';
        } catch (\Exception $e) {
            Log::error('Error al enviar correo: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return 'Error al enviar correo: ' . $e->getMessage();
        }
    }
}