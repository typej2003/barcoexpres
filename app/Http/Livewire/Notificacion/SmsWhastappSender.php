<?php

namespace App\Http\Livewire\Notificacion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Twilio\Rest\Client;

class SmsWhastappSender extends Component
{
    use WithFileUploads;

    public $file;
    public $destinatarios = [];
    public $total = 0, $enviados = 0, $progreso = 0;
    public $mensaje = "Hola [nombre], gracias por preferir Pan Express.";
    public $urlImagen = ""; // URL pública para WhatsApp
    public $tipoEnvio = 'sms'; // 'sms' o 'whatsapp'

    // Nuevo codigo
    public $sid    = "AC1d6aafb3b8d19ad606afc02438d825ae";
    public $token  = "[AuthToken]";

    // fin nuevo codigo

    public function cargarExcel()
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls,csv']);
        $data = Excel::toArray([], $this->file->getRealPath());

        if (!empty($data[0])) {
            $this->destinatarios = collect($data[0])
                ->skip(1)
                ->map(function($row) {
                    return [
                        'phone' => trim($row[0]),
                        'name'  => $row[1] ?? 'Cliente',
                    ];
                })
                ->filter(fn($row) => !empty($row['phone']))
                ->values()->toArray();

            $this->total = count($this->destinatarios);
            $this->enviados = 0;
        }
    }

    public function iniciarEnvio()
    {
        $notificador = new NotificationController();

        foreach ($this->destinatarios as $item) {
            // Reemplazar [nombre] por el nombre real del Excel
            $mensajePersonalizado = str_replace('[nombre]', $item['name'], $this->mensaje);

            try {
                if ($this->tipoEnvio == 'sms') {
                    $notificador->sendSms($item['phone'], $mensajePersonalizado);
                } else {
                    $notificador->sendWhatsApp($item['phone'], $mensajePersonalizado, $this->urlImagen);
                }
            } catch (\Exception $e) {
                // Opcional: registrar error de envío
            }

            $this->enviados++;
            $this->progreso = ($this->enviados / $this->total) * 100;

            sleep(rand(3, 7)); // Evitar bloqueos de Twilio/Meta
        }
    }

   

    public function enviarWhatsApp($numero = '+584165800403', $mensaje = 'Hola, este es un mjs de prueba con UltraMsg')
    {
        // 1. Usamos asForm() para que sea compatible con la API de UltraMsg
        // 2. Usamos config() o aseguramos que env() lea bien los datos
        
        $instanceId = env('ULTRAMSG_INSTANCE_ID');
        $token = env('ULTRAMSG_TOKEN');

        $response = Http::asForm()->post("https://api.ultramsg.com/{$instanceId}/messages/chat", [
            'token' => $token,
            'to'    => $numero,
            'body'  => $mensaje,
        ]);

        if ($response->successful()) {
            return "Mensaje enviado con éxito: " . $response->body();
        }

        // Si falla, esto nos dirá exactamente por qué (ej: token inválido, instancia desconectada)
        return "Error al enviar (" . $response->status() . "): " . $response->body();
    }

    public function enviarWhatsAppConImagen($numero = '+584165800403')
    {
        // 1. Obtenemos las variables del .env
        $instanceId = env('ULTRAMSG_INSTANCE_ID');
        $token = env('ULTRAMSG_TOKEN');

        // 2. Definimos la URL de la imagen y el texto (puedes usar emojis y negritas)
        // NOTA: La imagen debe ser una URL pública (ej: de tu servidor o S3)
        $urlImagen = "https://barcoexpres.com/img/panexpres_navidad.jpg"; 
        
        $mensaje = "*¡INVITACIÓN ESPECIAL!* 🚢\n\n" .
                "Hola, te invitamos a conocer nuestros nuevos servicios.\n" .
                "Haz clic aquí para más info: https://panexpres.com";

        
        // 3. Usamos el endpoint /messages/image
        $response = Http::asForm()->post("https://api.ultramsg.com/{$instanceId}/messages/image", [
            'token'   => $token,
            'to'      => $numero,
            'image'   => $urlImagen, // URL de la imagen
            'caption' => $mensaje,   // El texto que acompaña a la imagen
        ]);

        dd($response);

        if ($response->successful()) {
            return "Imagen enviada con éxito: " . $response->body();
        }

        return "Error al enviar (" . $response->status() . "): " . $response->body();
    }

    public function handle(Request $request)
    {
        $data = $request->all();

        // Loguear para ver qué llega (útil para pruebas)
        Log::info('WhatsApp Webhook:', $data);

        // Verificar si es un mensaje recibido
        if (isset($data['event_type']) && $data['event_type'] == 'message_received') {
            $remitente = $data['data']['from']; // Quién escribe
            $texto = $data['data']['body'];     // Qué escribió

            // Aquí puedes disparar una lógica de Laravel (ej: guardar en DB o responder)
        }

        return response('OK', 200);
    }

    public function render()
    {
        return view('livewire.notificacion.sms-whastapp-sender');
    }
}