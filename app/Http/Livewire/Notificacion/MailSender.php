<?php

namespace App\Http\Livewire\Notificacion;

use App\Jobs\EnviarCorreoMasivo;
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
    public $procesando = false; // Nueva variable para controlar la UI

    public function cargarExcel()
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls,csv']);
        $data = Excel::toArray([], $this->file->getRealPath());
        
        if (!empty($data[0])) {
            $this->emails = collect($data[0])
                ->map(function($row) {
                    return [
                        'email' => isset($row[0]) ? trim($row[0]) : '',
                        'name'  => isset($row[1]) ? trim($row[1]) : 'Cliente',
                    ];
                })
                ->filter(function($row) {
                    return !empty($row['email']) && filter_var($row['email'], FILTER_VALIDATE_EMAIL);
                })
                ->values()
                ->toArray();

            $this->total = count($this->emails);
            $this->enviados = 0;
            $this->progreso = 0;
        }
    }

    // Paso 1: Iniciamos el proceso
    public function iniciarEnvio()
    {
        $this->procesando = true;

        foreach ($this->emails as $index => $item) {
            // Encolamos con un retraso progresivo para no saturar el servidor de correo
            // Por ejemplo: el primero sale ya, el segundo en 5 seg, el tercero en 10 seg...
            EnviarCorreoMasivo::dispatch(
                $item['email'], 
                $item['name'], 
                $this->mensajeCuerpo
            )->delay(now()->addSeconds($index * 5)); 
        }

        // Limpiamos la vista ya que el trabajo quedó en manos del servidor
        $this->enviados = $this->total;
        $this->progreso = 100;
        $this->procesando = false;

        session()->flash('message', '¡Los 100 correos se han programado y se enviarán en los próximos minutos!');
    }

    // Paso 2: Enviamos un correo específico y pedimos el siguiente desde el cliente
    public function enviarSiguiente($index)
    {
        if (!isset($this->emails[$index])) {
            $this->procesando = false;
            return;
        }

        $item = $this->emails[$index];
        
        // Ejecución del envío
        try {
            $emailController = new EmailController();
            $emailController->sendMailInfoInvitacionExcel($item['email'], $item['name'], $this->mensajeCuerpo);
        } catch (\Exception $e) {
            \Log::error("Error enviando a " . $item['email'] . ": " . $e->getMessage());
        }

        $this->enviados++;
        $this->progreso = ($this->enviados / $this->total) * 100;

        // Si faltan correos, disparamos evento para que JS espere y llame al siguiente
        if ($this->enviados < $this->total) {
            $this->dispatchBrowserEvent('procesar-siguiente', ['nextIndex' => $this->enviados]);
        } else {
            $this->procesando = false;
            $this->dispatchBrowserEvent('finalizado');
        }
    }

    public function render()
    {
        return view('livewire.notificacion.mail-sender');
    }
}