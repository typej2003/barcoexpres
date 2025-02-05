<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                        @if($controlActivity)
                            <span>Editar Embarcación</span>
                        @else
                            <span>Crear Embarcación</span>
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Escritorio</a></li>
                        <li class="breadcrumb-item active"><a href="/listBoats/{{$comercio->user_id}}">Embarcaciones</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if($comercio)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card w-50">
                        <div class="row p-2">
                            <div class="col-lg-3">
                                <span>Propietario</span>
                            </div>
                            <div class="col-lg-9">
                                <label class="form-control">{{$comercio->propietario()}}</label>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-lg-3">
                                <span>Comercio </span>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <label class="form-control">{{$comercio->name}}</label>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox"> <span class="ml-1"> Aplicar a mis comercios</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                <form autocomplete="off" wire:submit.prevent="{{ $controlActivity ? 'updateProduct' : 'createProduct' }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <!--  Carateristicas -->
                                        <div class="col-xl-6 col-md-6">
                                            <div class="form-group" wire:ignore>
                                                <label for="area_id">Área</label>
                                                <select wire:model.defer="state.area_id" class="form-control @error('area_id') is-invalid @enderror" id="area_id" disabled>
                                                    <option value="0">Seleccione una opción</option>
                                                    @foreach($areas as $area)
                                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('area_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Categoría<span class="text-danger">*</span></label>
                                                <select wire:model.defer="state.category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id" wire:change="changeCategory( $event.target.value, 0)">
                                                    <option value="0">Seleccione una opción</option>
                                                    @foreach($comercio->categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group" wire:ignore>
                                                <label for="name">Subcategoría</label>
                                                <select wire:model.defer="state.subcategory_id" class="subcategory form-control @error('subcategory_id') is-invalid @enderror" id="subcategory_id" wire:ignore>
                                                </select>
                                                @error('subcategory_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Código de la embarcación<span class="text-danger"> *</span></label>
                                                <input type="text" wire:model.defer="state.code"  id="code" class="font-costo form-control @error('code') is-invalid @enderror" autofocus >
                                                @error('code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Nombre de la embarcación<span class="text-danger"> *</span></label>
                                                <input type="text" wire:model.defer="state.name"  id="name" class="font-costo form-control @error('name') is-invalid @enderror" autofocus >
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="manufacturer_id">Fabricante<span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <select wire:model.defer="state.manufacturer_id"  id="manufacturer_id" class="font-costo form-control @error('manufacturer_id') is-invalid @enderror" autofocus >
                                                        <option value="0">Seleccione una opción</option>
                                                        @foreach($manufacturers as $manufacturer)
                                                            <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <a href=""><span class="fas fa-plus"></span></a>
                                                        </div>
                                                    </div>
                                                    @error('manufacturer_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                        </div>
                                        <!--  Fotos y video -->
                                        <div class="col-xl-6 col-md-6">
                                            <div style="overflow-y: auto; max-height: 600px;">
                                            
                                            <div class="form-group">
                                                <label for="customFile">Imagen 1</label>
                                                <div class="custom-file">
                                                    <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <input wire:model="photo1" type="file" class="custom-file-input" id="customFile">
                                                        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                                <span class="sr-only">40% Completo (exito)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="custom-file-label" for="customFile">
                                                        @if ($photo1)
                                                        {{ $photo1->getClientOriginalName() }}
                                                        @else
                                                        Seleccione la imagen
                                                        @endif
                                                    </label>
                                                </div>

                                                @if ($photo1)
                                                <img src="{{ $photo1->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded" style="width:280px !important;">
                                                @else
                                                <img src="{{ $state['image1_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded" style="width:280px !important;">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="customFile">Imagen 2</label>
                                                <div class="custom-file">
                                                    <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <input wire:model="photo2" type="file" class="custom-file-input" id="customFile">
                                                        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                                <span class="sr-only">40% Completo (exito)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="custom-file-label" for="customFile">
                                                        @if ($photo2)
                                                        {{ $photo2->getClientOriginalName() }}
                                                        @else
                                                        Seleccione la imagen
                                                        @endif
                                                    </label>
                                                </div>

                                                @if ($photo2)
                                                <img src="{{ $photo2->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded" style="width:280px !important;">
                                                @else
                                                <img src="{{ $state['image2_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded" style="width:280px !important;">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="customFile">Imagen 3</label>
                                                <div class="custom-file">
                                                    <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <input wire:model="photo3" type="file" class="custom-file-input" id="customFile">
                                                        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                                <span class="sr-only">40% Completo (exito)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="custom-file-label" for="customFile">
                                                        @if ($photo3)
                                                        {{ $photo3->getClientOriginalName() }}
                                                        @else
                                                        Seleccione la imagen
                                                        @endif
                                                    </label>
                                                </div>

                                                @if ($photo3)
                                                <img src="{{ $photo3->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded" style="width:280px !important;">
                                                @else
                                                <img src="{{ $state['image3_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded" style="width:280px !important;">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="customFile">Imagen 4</label>
                                                <div class="custom-file">
                                                    <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <input wire:model="photo4" type="file" class="custom-file-input" id="customFile">
                                                        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                                <span class="sr-only">40% Completo (exito)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="custom-file-label" for="customFile">
                                                        @if ($photo4)
                                                        {{ $photo4->getClientOriginalName() }}
                                                        @else
                                                        Seleccione la imagen
                                                        @endif
                                                    </label>
                                                </div>

                                                @if ($photo4)
                                                <img src="{{ $photo4->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded" style="width:280px !important;">
                                                @else
                                                <img src="{{ $state['image4_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded" style="width:280px !important;">
                                                @endif
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Precios detal -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price1">Precio 1<span class="text-danger">*</span></label>
                                                <input type="number" wire:model.defer="state.price1" autofocus class="font-costo form-control @error('price1') is-invalid @enderror" id="price1">
                                                @error('price1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price2">Precio 2</label>
                                                <input type="number" wire:model.defer="state.price2" autofocus class="font-costo form-control @error('price2') is-invalid @enderror" id="price2">
                                                @error('price2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Precios al Mayor wholesaler  -->
                                    <div class="row">
                                        
                                    </div>
                                    <!-- Precios de Oferta  -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price_offer">Precio de Oferta</label>
                                                <input type="number" wire:model.defer="state.price_offer" autofocus class="font-costo form-control @error('price_offer') is-invalid @enderror" id="price_offer">
                                                @error('price_offer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            
                                        </div>
                                    </div>
                                    <!-- Precios de Divisa  -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="price_divisa">Precio de la Divisa</label>
                                                <input type="number" wire:model.defer="state.price_divisa" autofocus class="font-costo form-control @error('price_divisa') is-invalid @enderror" id="price_divisa">
                                                @error('price_divisa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delivery  -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            
                                        </div>
                                    </div>
                                    <!-- Stock -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stock_min">Stock Mínimo</label>
                                                <input type="number" wire:model.defer="state.stock_min" autofocus class="font-costo form-control @error('stock_min') is-invalid @enderror" id="stock_min">
                                                @error('stock_min')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stock_max">Stock Máximo</label>
                                                <input type="number" wire:model.defer="state.stock_max" autofocus class="font-costo form-control @error('stock_max') is-invalid @enderror" id="stock_max">
                                                @error('stock_max')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stock">Stock</label>
                                                <input type="number" wire:model.defer="state.stock" autofocus class="font-costo form-control @error('stock') is-invalid @enderror" id="stock">
                                                @error('stock')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Caracteristica del paquete -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fe_fabricacion">Fecha de Fabricación</label>
                                                <select wire:model.defer="state.fe_fabricacion" autofocus class="form-control @error('fe_fabricacion') is-invalid @enderror" id="fe_expedicion">
                                                    <option value="0">Seleccione un año</option>
                                                    <?php foreach($years as $year) : ?>
                                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                @error('fe_fabricacion')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="madein">Lugar de Fabricación</label>
                                                <input type="text" wire:model.defer="state.madein" autofocus class="font-costo form-control @error('madein') is-invalid @enderror" id="madein">
                                                @error('madein')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="checkbox" wire:model.defer="state.in_pickup" autofocus class="my-2 @error('in_pickup') is-invalid @enderror" id="in_pickup"> <span class="font-costo my-2">Pickup</span>
                                                @error('in_pickup')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="checkbox" wire:model.defer="state.in_envio_nacional" autofocus class="my-2 @error('in_envio_nacional') is-invalid @enderror" id="in_envio_nacional"> <span class="font-costo my-2">Envio Nacional</span>
                                                @error('in_envio_nacional')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="checkbox" wire:model.defer="state.in_delivery" autofocus class="my-2 @error('in_delivery') is-invalid @enderror" id="in_delivery"> <span class="font-costo my-2">Delivery</span>
                                                @error('in_delivery')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="checkbox" wire:model.defer="state.in_offer" class="my-2 @error('in_offer') is-invalid @enderror" id="in_offer"> <span class="font-costo my-2">En Oferta</span>
                                                @error('in_offer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">                                            
                                                <input type="checkbox" wire:model.defer="state.in_cart" autofocus class="my-2 @error('in_cart') is-invalid @enderror" id="in_cart"> <span class="font-costo my-2">En Carrito</span>
                                                @error('in_cart')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">                                            
                                                <input type="checkbox" wire:model.defer="state.in_pedido" autofocus class="my-2 @error('in_pedido') is-invalid @enderror" id="in_pedido"> <span class="font-costo my-2">En pedido</span>
                                                @error('in_pedido')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="checkbox" wire:model.defer="state.in_valido" autofocus class="my-2 @error('in_valido') is-invalid @enderror" id="in_valido"> <span class="font-costo my-2">Es Valido</span>
                                                @error('in_valido')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Caracteristica del paquete -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ca_valoracion">Calificación de Valoracion</label>
                                                <input type="text" wire:model.defer="state.ca_valoracion" autofocus class="font-costo form-control @error('ca_valoracion') is-invalid @enderror" id="ca_valoracion">
                                                @error('ca_valoracion')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="condition">Condición</label>
                                                <input type="text" wire:model.defer="state.condition" autofocus class="font-costo form-control @error('condition') is-invalid @enderror" id="condition">
                                                @error('condition')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="eslora">Eslora</label>
                                                <input type="text" wire:model.defer="state.eslora" autofocus class="font-costo form-control @error('eslora') is-invalid @enderror" id="eslora">
                                                @error('eslora')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="manga">Manga</label>
                                                <input type="text" wire:model.defer="state.manga" autofocus class="font-costo form-control @error('manga') is-invalid @enderror" id="manga">
                                                @error('manga')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="color">Color</label>
                                                <input type="text" wire:model.defer="state.color" autofocus class="font-costo form-control @error('color') is-invalid @enderror" id="color">
                                                @error('color')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="material">Material</label>
                                                <input type="text" wire:model.defer="state.material" autofocus class="font-costo form-control @error('material') is-invalid @enderror" id="material">
                                                @error('material')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="maximumcrew">Máximo de pasajero</label>
                                                <input type="text" wire:model.defer="state.maximumcrew" autofocus class="font-costo form-control @error('maximumcrew') is-invalid @enderror" id="maximumcrew">
                                                @error('maximumcrew')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nroengines">Nro de Motores</label>
                                                <input type="number" wire:model.defer="state.nroengines" autofocus class="font-costo form-control @error('nroengines') is-invalid @enderror" id="nroengines">
                                                @error('nroengines')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="anno_motor">Año del motor</label>
                                                <select wire:model.defer="state.anno_motor" autofocus class="form-control @error('anno_motor') is-invalid @enderror" id="fe_expedicion">
                                                    <option value="0">Seleccione un año</option>
                                                    <?php foreach($years as $year) : ?>
                                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                @error('anno_motor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="enginebrand">Marca del motor</label>
                                                <input type="text" wire:model.defer="state.enginebrand" autofocus class="font-costo form-control @error('enginebrand') is-invalid @enderror" id="enginebrand">
                                                @error('enginebrand')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="enginemodel">Modelo del motor</label>
                                                <input type="text" wire:model.defer="state.enginemodel" autofocus class="font-costo form-control @error('enginemodel') is-invalid @enderror" id="enginemodel">
                                                @error('enginemodel')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="enginetype">Tipo de motor</label>
                                                <input type="text" wire:type.defer="state.enginetype" autofocus class="font-costo form-control @error('enginetype') is-invalid @enderror" id="enginetype">
                                                @error('enginetype')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="hoursofuse">Horas de uso</label>
                                                <input type="text" wire:type.defer="state.hoursofuse" autofocus class="font-costo form-control @error('hoursofuse') is-invalid @enderror" id="hoursofuse">
                                                @error('hoursofuse')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="power">Poder</label>
                                                <input type="text" wire:type.defer="state.power" autofocus class="font-costo form-control @error('power') is-invalid @enderror" id="power">
                                                @error('power')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="estereo">Estéreo</label>
                                                <input type="text" wire:type.defer="state.estereo" autofocus class="font-costo form-control @error('estereo') is-invalid @enderror" id="estereo">
                                                @error('estereo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="estereo">Negociable</label>
                                                <select  wire:type.defer="state.negotiable" autofocus class="font-costo form-control @error('negotiable') is-invalid @enderror" id="negotiable">
                                                    <option value="0">Seleccione</option>
                                                    <option value="si">Si</option>
                                                    <option value="no" selected>No</option>
                                                </select>
                                                @error('negotiable')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="matricula">Matricula</label>
                                                <input type="text" wire:type.defer="state.matricula" autofocus class="font-costo form-control @error('matricula') is-invalid @enderror" id="matricula">
                                                @error('matricula')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="distintivollamada">Distintivo de llamada</label>
                                                <input type="text" wire:type.defer="state.distintivollamada" autofocus class="font-costo form-control @error('distintivollamada') is-invalid @enderror" id="distintivollamada">
                                                @error('distintivollamada')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nroomi">Nro Omi</label>
                                                <input type="text" wire:type.defer="state.nroomi" autofocus class="font-costo form-control @error('nroomi') is-invalid @enderror" id="nroomi">
                                                @error('nroomi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nrommsi">Nro Mmsi</label>
                                                <input type="text" wire:type.defer="state.nrommsi" autofocus class="font-costo form-control @error('nrommsi') is-invalid @enderror" id="nrommsi">
                                                @error('nrommsi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="armador">Armador</label>
                                                <input type="text" wire:type.defer="state.armador" autofocus class="font-costo form-control @error('armador') is-invalid @enderror" id="armador">
                                                @error('armador')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="puntal">Puntal</label>
                                                <input type="text" wire:type.defer="state.puntal" autofocus class="font-costo form-control @error('puntal') is-invalid @enderror" id="puntal">
                                                @error('puntal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="arqueobruto">Arqueo Bruto</label>
                                                <input type="text" wire:type.defer="state.arqueobruto" autofocus class="font-costo form-control @error('arqueobruto') is-invalid @enderror" id="arqueobruto">
                                                @error('arqueobruto')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="arqueoneto">Arqueo Neto</label>
                                                <input type="text" wire:type.defer="state.arqueoneto" autofocus class="font-costo form-control @error('arqueoneto') is-invalid @enderror" id="arqueoneto">
                                                @error('arqueoneto')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="capacidadcombustible">Capacidad de combustible</label>
                                                <input type="text" wire:type.defer="state.capacidadcombustible" autofocus class="font-costo form-control @error('capacidadcombustible') is-invalid @enderror" id="capacidadcombustible">
                                                @error('capacidadcombustible')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="capacidadalmacenamiento">Capacidad de almacenamiento</label>
                                                <input type="text" wire:type.defer="state.capacidadalmacenamiento" autofocus class="font-costo form-control @error('capacidadalmacenamiento') is-invalid @enderror" id="capacidadalmacenamiento">
                                                @error('capacidadalmacenamiento')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="puertoregistro">Puerto de registro</label>
                                                <input type="text" wire:type.defer="state.puertoregistro" autofocus class="font-costo form-control @error('puertoregistro') is-invalid @enderror" id="puertoregistro">
                                                @error('puertoregistro')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="artepesca">Arte de pesca</label>
                                                <input type="text" wire:type.defer="state.artepesca" autofocus class="font-costo form-control @error('artepesca') is-invalid @enderror" id="artepesca">
                                                @error('artepesca')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Detalles -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="details1">Detalle 1</label>
                                                <textarea wire:model.defer="state.details1" autofocus class="font-costo form-control @error('details1') is-invalid @enderror" id="details1" rows="5"></textarea>
                                                @error('details1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="additional_information">Información Adicional</label>
                                                <textarea  wire:model.defer="state.additional_information" autofocus class="font-costo form-control @error('additional_information') is-invalid @enderror" id="additional_information" rows="5"></textarea>
                                                @error('additional_information')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="/listProducts/{{$comercio->id}}" type="button" class="btn btn-secondary d-none" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancelar</a>
                            <button type="submit" class="btn btn-app">
                                <i class="fa fa-save mr-1"></i>
                                @if($controlActivity)
                                <span>Guardar Cambios</span>
                                @else
                                <span>Guardar</span>
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    
        <script>

            window.onpageshow = function() {

                window.addEventListener('sendSubcategories', event => {
                    
                    let subcategories = event.detail.subcategories

                    let subcategory = event.detail.subcategory

                    let msg = event.detail.msg

                    let select = document.querySelector('.subcategory')
                    
                    select.innerHTML = ''

                    var option = `<option value="0">${msg}</option>`
                    
                    subcategories.forEach(function(numero) {
                        
                        if(numero['name'] == subcategory){
                            option += `<option value="${numero['id']}" selected>${numero['name']}</option>`
                        }else{
                            option += `<option value="${numero['id']}">${numero['name']}</option>`
                        }
                        
                    });
                    
                    select.innerHTML = option
                
                }) 
            }
        </script>
</div>

