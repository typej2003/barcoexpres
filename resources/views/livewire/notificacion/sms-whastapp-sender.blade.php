<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4 class="card-title">📱 Envío Masivo SMS / WhatsApp</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 border-right">
                <label>1. Configuración</label>
                <select wire:model="tipoEnvio" class="form-control mb-3">
                    <option value="sms">Envío por SMS Clásico</option>
                    <option value="whatsapp">Envío por WhatsApp</option>
                </select>

                <input type="file" wire:model="file" class="form-control mb-2">
                <button wire:click="cargarExcel" class="btn btn-outline-success btn-block shadow-sm">
                    <i class="fas fa-file-excel"></i> Cargar Teléfonos
                </button>
            </div>
            
            <div class="col-md-8">
                <label>2. Contenido del Mensaje</label>
                <textarea wire:model="mensaje" class="form-control" rows="3"></textarea>
                <small class="text-muted">Usa <b>[nombre]</b> para personalizar.</small>

                @if($tipoEnvio == 'whatsapp')
                    <div class="mt-3">
                        <label>URL de Imagen (Para WhatsApp)</label>
                        <input type="text" wire:model="urlImagen" class="form-control" placeholder="https://tusitio.com/imagen.jpg">
                    </div>
                @endif
            </div>
        </div>

        @if($total > 0)
            <hr>
            <div class="progress mb-3" style="height: 25px; border-radius: 12px;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                     style="width: {{ $progreso }}%">{{ round($progreso) }}%</div>
            </div>

            <div class="text-center">
                <button wire:click="iniciarEnvio" class="btn btn-primary px-5 shadow" wire:loading.attr="disabled">
                    🚀 Iniciar Envío Masivo
                </button>
            </div>

            <table class="table mt-4 table-sm">
                <thead>
                    <tr><th>Teléfono</th><th>Nombre</th><th>Estado</th></tr>
                </thead>
                <tbody>
                    @foreach($destinatarios as $index => $item)
                        <tr class="{{ $index < $enviados ? 'table-success' : '' }}">
                            <td>{{ $item['phone'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{!! $index < $enviados ? '✅ Enviado' : '⏳ Pendiente' !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>