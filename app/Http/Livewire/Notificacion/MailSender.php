<?php

namespace App\Http\Livewire\Notificacion;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class MailSender extends Component
{
    use WithFileUploads;

    public $file;
    public $emails = []; 
    public $total = 0;
    public $enviados = 0;
    public $progreso = 0;
    public $mensajeCuerpo = "Hola, este es un mensaje informativo de Pan Express.";

    public function cargarExcel()
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls,csv']);

        $data = Excel::toArray([], $this->file->getRealPath());
        
        if (!empty($data[0])) {
            $this->emails = collect($data[0])
                ->map(function($row) {
                    // Limpiamos espacios accidentales
                    $email = isset($row[0]) ? trim($row[0]) : '';
                    return [
                        'email' => $email,
                        'name'  => isset($row[1]) ? trim($row[1]) : 'Cliente',
                    ];
                })
                // FILTRO AUTOMÁTICO: 
                // 1. Elimina si el email está vacío
                // 2. Elimina si el texto no tiene formato de email
                // 3. Elimina si la celda es nula
                ->filter(function($row) {
                    return !empty($row['email']) && filter_var($row['email'], FILTER_VALIDATE_EMAIL);
                })
                ->values()
                ->toArray();

            $this->total = count($this->emails);
            $this->enviados = 0;
        }
    }

    public function iniciarEnvio()
    {
        // Instanciamos el controlador para usar su lógica de envío
        $emailController = new EmailController();

        foreach ($this->emails as $item) {
            // Enviamos los datos al controlador
            $emailController->sendMailInfoInvitacionExcel($item['email'], $item['name'], $this->mensajeCuerpo);

            $this->enviados++;
            $this->progreso = ($this->enviados / $this->total) * 100;

            // Intervalo aleatorio de 3 a 7 segundos para evitar bloqueos
            if ($this->enviados < $this->total) {
                sleep(rand(3, 7));
            }
        }
    }

    public function render()
    {
        return view('livewire.notificacion.mail-sender');
    }
}