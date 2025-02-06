    <div class="">    
        <style>
            .img-responsive {
                width:100%; height: 250px;
            }
            .text-azul { font-family: 'Montserrat' !important; font-size: 1.3rem; font-weight: bold; color: var(--azul) !important; padding: 5px;}
            
            .Text-Uppercase {
            text-transform: uppercase;
            }
            @media only screen and (max-width: 1070px) {
                .img-responsive {
                    
                }   
            }
        </style>
        <head>
            @if(auth()->user())
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <title>{{config('app.name')}}</title>
                <meta name="description" content="Compra y vende Embarcaciones">
                <meta name="keywords" content="vende, compra, Barco, Bote, Embarcación, Embarcaciones, Barcoexprés, Barcoexpres">
                <link rel="shortcut icon" type="x-icon" href="/img/logo_barcoexpre.jpg" />
                
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <link rel="stylesheet" href="/css/bootstrap.min.css">
                <link rel="stylesheet" href="/css/navigationMap.css">
                
                
                <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                
                <script src="/js/jquery-3.6.4.min.js"></script>  
                <script src="/js/slick.min.js"></script>

                <link rel="stylesheet" href="/css/slick-theme.min.css">
                <link rel="stylesheet" href="/css/slick.min.css">
                <link rel="stylesheet" href="/css/carouselOffer.css">
                <link rel="stylesheet" href="/css/showProducts.css">
                <link rel="stylesheet" href="/css/star.css">
                @stack('styles')
                <livewire:styles />
                @endif          
            </head>
            
            <div class="row">
                <div class="col-md-12">
                    @if (config('app.url').'/nobanner.png' !== $comercio->banner_url )
                        <img style="width:100%; height: 150px; 
                        @if(auth()->user())
                            margin-top: 60px;
                        @endif
                        " src="{{ $comercio->banner_url}}" alt="">
                    @else
                        <img style="width:100%; height: 150px; 
                        @if(auth()->user())
                            margin-top: 60px;
                        @endif
                        " src="/img/banner_barcoexpres.jpg" alt="">
                    @endif
                </div>
            </div>
            <div class="card mx-auto my-3 shadow p-1" style="width: 80%" >
                <div class="row mb-2">
                    <div class="col-sm-6">
                        
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                            <li class="breadcrumb-item active">{{ $comercio->name }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="row mx-1 d-flex row-cols-4">
                            @if($product->image_path1 !== null)
                            <div >
                                <button class="btn btn-light border border-1" wire:click.prevent="cambiarSrc('{{ $product->image1_url }}')">1</button>
                            </div>
                            @endif
                            @if($product->image_path2 !== null)
                            <div >
                                <button class="btn btn-light border border-1" wire:click.prevent="cambiarSrc('{{ $product->image2_url }}')">2</button>
                            </div>
                            @endif
                            @if($product->image_path3 !== null)
                            <div >
                                <button class="btn btn-light" wire:click.prevent="cambiarSrc('{{ $product->image3_url }}')">3</button>
                            </div>
                            @endif
                            @if($product->image_path4 !== null)
                            <div >
                                <button class="btn btn-light border-1" wire:click.prevent="cambiarSrc('{{ $product->image4_url }}')">4</button>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex" style="width:100%; height: 100%;">
                                    <img class="img-responsive mx-2" style="width:95%;" src="{{ $product->image1_url }}" alt="">
                                </div>                        
                            </div>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="Text-Uppercase text-azul negrita">{{ $product->name}}</span>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-between d-none">
                            <div class="col-md-12 ">
                                <div>Ver mas productos de<span class="mx-1"><a href="">{{ $product->comercio->name}}</a></span></div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12">
                                @if($product->in_convenir > 0)
                                <span>Precio: a convenir</span>
                                @else
                                <span>Precio: {{ $currencyValue }} {{ $product->getPrice1() }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <form class="col-md-12 d-flex justify-content-between" action="/add" method="post">
                                @csrf
                                <input name="product_id" type="hidden" value="{{ $product->id }}">
                                <input name="name" type="hidden" value="{{ $product->name }}">
                                <input name="price1" type="hidden" value="{{ $product->price1 }}">
                                <div class="col-md-6">
                                    @if($product->in_cart > 0)
                                    <div class="input-group input-number-group d-none" style="margin-left: 0px !important; padding:0 !important;">
                                        <div class="input-group-button">
                                            <span class="input-number-decrement">-</span>
                                        </div>
                                        <input name="quantity" class="input-number" type="number" value="1" min="0" max="1000">
                                        <div class="input-group-button">
                                            <span class="input-number-increment">+</span>
                                        </div>                                        
                                    </div>
                                    @else
                                    <div class="h-50" style="height: 45px !important;"></div>
                                    @endif
                                </div>
                                @if($product->in_cart > 0)
                                <div class="col-md-6 d-flex justify-content-start">
                                    @if($product->incart > 0)
                                        <button class="btn btn-sale m-2"><i class="text-white fa fa-shopping-cart" aria-hidden="true"></i> Comprar</button>
                                    @else
                                        <div class="d-flex align-item-start">
                                            <a class="my-2 mx-3 color-i" href="mailto:{{$product->comercio->email}}">
                                                <i class="fas fa-regular fa-envelope mx-auto fa-lg" title="Correo"></i>
                                            </a>
                                            <a class="my-2 color-i" href="tel:+58{{substr($product->comercio->contactcellphone, 1)}}">
                                                <i class="fas fa-solid fa-phone mx-auto fa-lg" title="Llamar"></i>                                                
                                            </a>
                                        </div>                                                        
                                    @endif
                                </div>
                                @else
                                <div class="col-md-6 d-flex justify-content-start">                                
                                    <a class="my-2 mx-3 color-i" href="mailto:{{$product->comercio->email}}">
                                        <i class="fas fa-regular fa-envelope mx-auto fa-lg" title="Correo"></i> Correo
                                    </a>
                                    <a class="my-2 color-i" href="tel:+58{{substr($product->comercio->contactcellphone, 1)}}">
                                        <i class="fas fa-solid fa-phone mx-auto fa-lg" title="Llamar"></i> Llamar                                    
                                    </a>
                                </div>
                                @endif
                                <div class="col-md-3 d-none">
                                    <button class="btn h-75  border border-secondary"><i class="fa fa-solid fa-heart"></i></button>                        
                                </div>
                            </form>
                        </div>
                        <!-- <div class="row">
                            <span>Disponibilidad: </span><span class="mx-1">{{ $product->stock }}</span>
                        </div> -->
                        <div class="row d-flex justify-content-start">
                            @if($product->in_envio_nacional)
                            <div style="width: auto;"><img style="width:60px" src="/img/envio_auto.png" alt=""><span>Envío nacional</span></div>
                            @endif
                            @if($product->in_delivery)
                            <div style="width: auto;"><img style="width:60px" src="/img/envio_moto.png" alt=""><span>Delivery</span></div>
                            @endif
                            @if($product->in_pickup)
                            <div style="width: auto;"><img style="width:60px" src="/img/envio_pickup.png" alt=""><span>Pickup</span></div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h4 class="accordion-header" id="headingOne">
                                        <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Información de la embarcación
                                        </a>
                                    </h4>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <br>
                                            <span>Matrícula: {{$product->matricula}}</span>
                                            <br>
                                            <span>Distintivo de llamada: {{$product->distintivollamada}}</span>
                                            <br>
                                            <span>Nro omi: {{$product->nroomi}}</span>
                                            <br>
                                            <span>Nro mmsi: {{$product->nrommsi}}</span>
                                            <br>
                                            <span>Armador: {{$product->armador}}</span>
                                            <br>
                                            <span>Puerto de registro: {{$product->puertoregistro}}</span>
                                            <br>
                                            <span>Arte de pesca: {{$product->artepesca}}</span>
                                            <br>
                                            <span>Año: {{$product->fe_fabricacion}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-header" id="headingTwo">
                                        <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Especificaciones de la embarcación
                                        </a>
                                    </h4>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <br>
                                            <span>Eslora: {{$product->eslora}}</span>
                                            <br>
                                            <span>Manga: {{$product->manga}}</span>
                                            <br>
                                            <span>Puntal: {{$product->puntal}}</span>
                                            <br>
                                            <span>Arqueo bruto: {{$product->arqueobruto}}</span>
                                            <br>
                                            <span>Arqueo neto: {{$product->arqueoneto}}</span>
                                            <br>
                                            <span>Capacidad de combustible: {{$product->capacidadcombustible}}</span>
                                            <br>
                                            <span>Capacidad de almacenamiento: {{$product->capacidadalmacenamiento}}</span>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-header" id="headingThree">
                                        <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Información de tienda
                                        </a>
                                    </h4>
                                    <div id="collapseThree" class="accordion-collapse collapse d-none" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Dirección: {{$product->comercio->address}}</p>
                                            <p>
                                                <a href="https://api.whatsapp.com/send?phone=+58{{$product->comercio->contactcellphone}}&text={{ $product->comercio->msgcontact}}" target="_blank">{{$product->comercio->contactcellphone}}</a> 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div>
        
            <div class="row my-2">
                <div class="col-md-12">
                    @livewire('components.show-recommended', [
                            'comercioId' => 1, 
                            'parametro' => $words='',
                            'is_boat' => $is_boat,
                            ] )
                </div>
            </div>

            
    @auth
        <script src="/js/bootstrap.bundle.min.js"></script>

        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" /> -->
    @endauth

    <script>
        window.addEventListener('addSrc', function (event) {
            var img = document.querySelector('.img-responsive');
            img.src = event.detail.src;
        });
    </script>
    <script>
        $('.input-number-increment').click(function() {
        var $input = $(this).parents('.input-number-group').find('.input-number');
        var val = parseInt($input.val(), 10);
        $input.val(val + 1);
        });

        $('.input-number-decrement').click(function() {
        var $input = $(this).parents('.input-number-group').find('.input-number');
        var val = parseInt($input.val(), 10);
        if(val > 0)
            $input.val(val - 1);
        })

    </script>


    </div>
    