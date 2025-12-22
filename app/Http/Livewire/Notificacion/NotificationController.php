<?php

namespace App\Http\Livewire\Notificacion;

use App\Http\Controllers\Controller;
use Twilio\Rest\Client;

class NotificationController extends Controller
{
    private $sid;
    private $token;
    private $from_sms;
    private $from_whatsapp;

    public function __construct()
    {
        $this->sid = env('TWILIO_SID');
        $this->token = env('TWILIO_AUTH_TOKEN');
        $this->from_sms = env('TWILIO_SMS_FROM'); // Ej: +123456789
        $this->from_whatsapp = env('TWILIO_WHATSAPP_FROM'); // Ej: +14155238886
    }

    public function sendSms($to, $message)
    {
        $client = new Client($this->sid, $this->token);
        return $client->messages->create($to, [
            'from' => $this->from_sms,
            'body' => $message
        ]);
    }

    public function sendWhatsApp($to, $message, $imageUrl = null)
    {
        $client = new Client($this->sid, $this->token);
        $params = [
            'from' => "whatsapp:" . $this->from_whatsapp,
            'body' => $message
        ];

        if ($imageUrl) {
            $params['mediaUrl'] = [$imageUrl];
        }

        // Importante: El número de destino debe ir con el prefijo whatsapp:
        return $client->messages->create("whatsapp:" . $to, $params);
    }
}