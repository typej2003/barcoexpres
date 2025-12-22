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
                    <small class="text-muted d-block mt-2">Formato: Col A (Email), Col B (Nombre)</small>
                    <button wire:click="cargarExcel" class="btn btn-outline-primary btn-sm mt-3" wire:loading.attr="disabled">
                        <i class="fas fa-list"></i> Previsualizar Lista
                    </button>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label><strong>2. Redactar Mensaje</strong></label>
                    <textarea wire:model="mensajeCuerpo" class="form-control" rows="5" placeholder="Escribe aquí el contenido del correo..."></textarea>
                </div>
            </div>
        </div>

        @if($total > 0)
            <hr>
            <div class="alert alert-info py-2">
                <i class="fas fa-info-circle"></i> Se han detectado <strong>{{ $total }}</strong> correos válidos para enviar.
            </div>

            <div class="progress mb-3" style="height: 30px; border-radius: 15px;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                     role="progressbar" style="width: {{ $progreso }}%">
                    <span class="font-weight-bold">{{ round($progreso) }}% Completado</span>
                </div>
            </div>

            <div class="text-center mb-4">
                <button wire:click="iniciarEnvio" class="btn btn-lg btn-success shadow" 
                        wire:loading.attr="disabled" {{ $enviados == $total ? 'disabled' : '' }}>
                    <i class="fas fa-play-circle"></i> Iniciar Proceso de Envío (3-7s aleatorio)
                </button>
            </div>

            <div class="table-responsive" style="max-height: 350px;">
                <table class="table table-striped table-hover shadow-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre del Destinatario</th>
                            <th>Correo Electrónico</th>
                            <th class="text-center">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($emails as $index => $item)
                            <tr class="{{ $index < $enviados ? 'table-success' : '' }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['name'] ?? 'N/A' }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td class="text-center">
                                    @if($index < $enviados)
                                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> Enviado</span>
                                    @else
                                        <span class="badge badge-pill badge-warning"><i class="fas fa-clock"></i> Esperando</span>
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