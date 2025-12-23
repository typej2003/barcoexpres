<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        <h3 class="card-title"><i class="fas fa-mail-bulk me-2"></i> Campaña de Correo Masivo</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group border p-3 rounded bg-light">
                    <label><strong>1. Cargar archivo Excel</strong></label>
                    <input type="file" wire:model="file" class="form-control-file">
                    <button wire:click="cargarExcel" class="btn btn-outline-primary btn-sm mt-3" wire:loading.attr="disabled">
                        <i class="fas fa-list"></i> Previsualizar Lista
                    </button>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label><strong>2. Redactar Mensaje</strong></label>
                    <textarea wire:model="mensajeCuerpo" class="form-control" rows="5" @if($procesando) disabled @endif></textarea>
                </div>
            </div>
        </div>

        @if($total > 0)
            <hr>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="alert alert-info py-1 px-3 mb-0">
                    <i class="fas fa-info-circle"></i> Correos válidos: <strong>{{ $total }}</strong>
                </div>
                <div class="text-muted">
                    Enviados: <strong>{{ $enviados }}</strong> de <strong>{{ $total }}</strong>
                </div>
            </div>

            <div class="progress mb-3" style="height: 30px; border-radius: 15px;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                     role="progressbar" style="width: {{ $progreso }}%; transition: width 0.5s ease;">
                    <span class="font-weight-bold">{{ round($progreso) }}% Completado</span>
                </div>
            </div>

            <div class="text-center mb-4">
                @if(!$procesando && $enviados < $total)
                    <button wire:click="iniciarEnvio" class="btn btn-lg btn-success shadow">
                        <i class="fas fa-play-circle"></i> Iniciar Envío
                    </button>
                @elseif($procesando)
                    <button class="btn btn-lg btn-secondary shadow" disabled>
                        <i class="fas fa-spinner fa-spin"></i> Procesando... (Espera aleatoria)
                    </button>
                @else
                    <div class="alert alert-success"><strong><i class="fas fa-check-double"></i> Proceso Finalizado con éxito</strong></div>
                @endif
            </div>

            <div class="table-responsive" style="max-height: 350px;">
                <table class="table table-striped table-hover shadow-sm">
                    <thead class="thead-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th class="text-center">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($emails as $index => $item)
                            <tr class="{{ $index < $enviados ? 'table-success' : '' }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td class="text-center">
                                    @if($index < $enviados)
                                        <span class="badge badge-success"><i class="fas fa-check"></i> Enviado</span>
                                    @elseif($procesando && $index == $enviados)
                                        <span class="badge badge-primary"><i class="fas fa-sync fa-spin"></i> Enviando...</span>
                                    @else
                                        <span class="badge badge-light text-muted"><i class="fas fa-clock"></i> Pendiente</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@push('js')
<script>
    window.addEventListener('procesar-siguiente', event => {
        // Generar espera aleatoria entre 3 y 7 segundos en el navegador
        let delay = Math.floor(Math.random() * (7000 - 3000 + 1) + 3000);
        
        setTimeout(() => {
            // Llamamos al método de Livewire para el siguiente correo
            @this.enviarSiguiente(event.detail.nextIndex);
        }, delay);
    });

    window.addEventListener('finalizado', event => {
        alert('¡Campaña finalizada correctamente!');
    });
</script>
@endpush