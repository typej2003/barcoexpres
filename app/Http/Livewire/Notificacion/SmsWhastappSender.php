<?php

namespace App\Http\Livewire\Notificacion;

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

        
        // Ejemplo de cómo debe quedar
        $sid = env('TWILIO_SID');
        $sid = env('TWILIO_AUTH_TOKEN');

        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                array(
                        "body" => "Hola Hola"
                )
            );
        dd('Msj: ' . $message->sid);
    }

    public function render()
    {
        return view('livewire.notificacion.sms-whastapp-sender');
    }
}