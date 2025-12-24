<?php

namespace App\Http\Livewire\Notificacion;

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

    public function iniciarEnvioPrimerNumero()
    {
        // 1. Obtener las credenciales
        $sid = config('services.twilio.sid') ?? env('TWILIO_SID');
        $token = config('services.twilio.token') ?? env('TWILIO_AUTH_TOKEN');
        
        // 2. Obtener tu número de Twilio desde el .env
        $fromNumber = env('TWILIO_NUMBER'); // Ejemplo: +12603683354
        $fromNumber = "+12603683354";

        $twilio = new Client($sid, $token);

        // El primer argumento es el destinatario (ejemplo: '+123456789')
        // El segundo argumento es el array con el cuerpo y el remitente
        $message = $twilio->messages->create(
            "+584165800403", // <--- REEMPLAZA por el número de destino (string)
            [
                "from" => $fromNumber, 
                "body" => "Hola Hola"
            ]
        );

        dd('Msj enviado con SID: ' . $message->sid);
    }

    public function enviarWhatsApp($numero = '+584165800403', $mensaje='Hola, este es un mjs de prueba con https://ultramsg.com')
    {
        $response = Http::post("https://api.ultramsg.com/" . env('ULTRAMSG_INSTANCE_ID') . "/messages/chat", [
            'token' => env('ULTRAMSG_TOKEN'),
            'to' => $numero, // Formato: +584120000000
            'body' => $mensaje,
        ]);

        if ($response->successful()) {
            return "Mensaje enviado con éxito";
        }

        return "Error al enviar: " . $response->body();
    }

    public function render()
    {
        return view('livewire.notificacion.sms-whastapp-sender');
    }
}