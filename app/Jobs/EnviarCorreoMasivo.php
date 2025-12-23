<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Livewire\Notificacion\EmailController;

class EnviarCorreoMasivo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $mensaje;

    public function __construct($email, $name, $mensaje)
    {
        $this->email = $email;
        $this->name = $name;
        $this->mensaje = $mensaje;
    }

    public function handle()
    {
        // Aquí llamamos a tu controlador existente
        $emailController = new EmailController();
        $emailController->sendMailInfoInvitacionExcel($this->email, $this->name, $this->mensaje);
    }
}