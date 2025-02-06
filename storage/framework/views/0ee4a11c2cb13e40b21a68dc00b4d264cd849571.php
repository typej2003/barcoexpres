    <div class="">    
        <style>
            .img-responsive {
                width:100%; height: 250px;
            }
            .text-azul { font-family: 'Montserrat' !important; font-size: 1.3rem; font-weight: bold; color: var(--azul) !important; padding: 5px;}
            .Text-Uppercase {
            text-transform: uppercase;
            }
            @media  only screen and (max-width: 1070px) {
                .img-responsive {
                    
                }   
            }
        </style>
        <head>
            <?php if(auth()->user()): ?>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <title><?php echo e(config('app.name')); ?></title>
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
                <?php echo $__env->yieldPushContent('styles'); ?>
                <?php echo \Livewire\Livewire::styles(); ?>

                <?php endif; ?>          
            </head>
            
            <div class="row">
                <div class="col-md-12">
                    <?php if(config('app.url').'/nobanner.png' !== $comercio->banner_url ): ?>
                        <img style="width:100%; height: 150px; 
                        <?php if(auth()->user()): ?>
                            margin-top: 60px;
                        <?php endif; ?>
                        " src="<?php echo e($comercio->banner_url); ?>" alt="">
                    <?php else: ?>
                        <img style="width:100%; height: 150px; 
                        <?php if(auth()->user()): ?>
                            margin-top: 60px;
                        <?php endif; ?>
                        " src="/img/banner_barcoexpres.jpg" alt="">
                    <?php endif; ?>
                </div>
            </div>
            <div class="card mx-auto my-3 shadow p-1" style="width: 80%" >
                <div class="row mb-2">
                    <div class="col-sm-6">
                        
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                            <li class="breadcrumb-item active"><?php echo e($comercio->name); ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="row mx-1 d-flex row-cols-4">
                            <?php if($product->image_path1 !== null): ?>
                            <div >
                                <button class="btn btn-light border border-1" wire:click.prevent="cambiarSrc('<?php echo e($product->image1_url); ?>')">1</button>
                            </div>
                            <?php endif; ?>
                            <?php if($product->image_path2 !== null): ?>
                            <div >
                                <button class="btn btn-light border border-1" wire:click.prevent="cambiarSrc('<?php echo e($product->image2_url); ?>')">2</button>
                            </div>
                            <?php endif; ?>
                            <?php if($product->image_path3 !== null): ?>
                            <div >
                                <button class="btn btn-light" wire:click.prevent="cambiarSrc('<?php echo e($product->image3_url); ?>')">3</button>
                            </div>
                            <?php endif; ?>
                            <?php if($product->image_path4 !== null): ?>
                            <div >
                                <button class="btn btn-light border-1" wire:click.prevent="cambiarSrc('<?php echo e($product->image4_url); ?>')">4</button>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex" style="width:100%; height: 100%;">
                                    <img class="img-responsive mx-2" style="width:95%;" src="<?php echo e($product->image1_url); ?>" alt="">
                                </div>                        
                            </div>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="Text-Uppercase text-azul negrita"><?php echo e($product->name); ?></span>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-between d-none">
                            <div class="col-md-12 ">
                                <div>Ver mas productos de<span class="mx-1"><a href=""><?php echo e($product->comercio->name); ?></a></span></div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12">
                                <?php if($product->in_convenir > 0): ?>
                                <span>Precio: a convenir</span>
                                <?php else: ?>
                                <span>Precio: <?php echo e($currencyValue); ?> <?php echo e($product->getPrice1()); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <form class="col-md-12 d-flex justify-content-between" action="/add" method="post">
                                <?php echo csrf_field(); ?>
                                <input name="product_id" type="hidden" value="<?php echo e($product->id); ?>">
                                <input name="name" type="hidden" value="<?php echo e($product->name); ?>">
                                <input name="price1" type="hidden" value="<?php echo e($product->price1); ?>">
                                <div class="col-md-6">
                                    <?php if($product->in_cart > 0): ?>
                                    <div class="input-group input-number-group d-none" style="margin-left: 0px !important; padding:0 !important;">
                                        <div class="input-group-button">
                                            <span class="input-number-decrement">-</span>
                                        </div>
                                        <input name="quantity" class="input-number" type="number" value="1" min="0" max="1000">
                                        <div class="input-group-button">
                                            <span class="input-number-increment">+</span>
                                        </div>                                        
                                    </div>
                                    <?php else: ?>
                                    <div class="h-50" style="height: 45px !important;"></div>
                                    <?php endif; ?>
                                </div>
                                <?php if($product->in_cart > 0): ?>
                                <div class="col-md-6 d-flex justify-content-start">
                                    <?php if($product->incart > 0): ?>
                                        <button class="btn btn-sale m-2"><i class="text-white fa fa-shopping-cart" aria-hidden="true"></i> Comprar</button>
                                    <?php else: ?>
                                        <div class="d-flex align-item-start">
                                            <a class="my-2 mx-3 color-i" href="mailto:<?php echo e($product->comercio->email); ?>">
                                                <i class="fas fa-regular fa-envelope mx-auto fa-lg" title="Correo"></i>
                                            </a>
                                            <a class="my-2 color-i" href="tel:+58<?php echo e(substr($product->comercio->contactcellphone, 1)); ?>">
                                                <i class="fas fa-solid fa-phone mx-auto fa-lg" title="Llamar"></i>                                                
                                            </a>
                                        </div>                                                        
                                    <?php endif; ?>
                                </div>
                                <?php else: ?>
                                <div class="col-md-6 d-flex justify-content-start">                                
                                    <a class="my-2 mx-3 color-i" href="mailto:<?php echo e($product->comercio->email); ?>">
                                        <i class="fas fa-regular fa-envelope mx-auto fa-lg" title="Correo"></i> Correo
                                    </a>
                                    <a class="my-2 color-i" href="tel:+58<?php echo e(substr($product->comercio->contactcellphone, 1)); ?>">
                                        <i class="fas fa-solid fa-phone mx-auto fa-lg" title="Llamar"></i> Llamar                                    
                                    </a>
                                </div>
                                <?php endif; ?>
                                <div class="col-md-3 d-none">
                                    <button class="btn h-75  border border-secondary"><i class="fa fa-solid fa-heart"></i></button>                        
                                </div>
                            </form>
                        </div>
                        <!-- <div class="row">
                            <span>Disponibilidad: </span><span class="mx-1"><?php echo e($product->stock); ?></span>
                        </div> -->
                        <div class="row d-flex justify-content-start">
                            <?php if($product->in_envio_nacional): ?>
                            <div style="width: auto;"><img style="width:60px" src="/img/envio_auto.png" alt=""><span>Envío nacional</span></div>
                            <?php endif; ?>
                            <?php if($product->in_delivery): ?>
                            <div style="width: auto;"><img style="width:60px" src="/img/envio_moto.png" alt=""><span>Delivery</span></div>
                            <?php endif; ?>
                            <?php if($product->in_pickup): ?>
                            <div style="width: auto;"><img style="width:60px" src="/img/envio_pickup.png" alt=""><span>Pickup</span></div>
                            <?php endif; ?>
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
                                            <span>Matrícula: <?php echo e($product->matricula); ?></span>
                                            <br>
                                            <span>Distintivo de llamada: <?php echo e($product->distintivollamada); ?></span>
                                            <br>
                                            <span>Nro omi: <?php echo e($product->nroomi); ?></span>
                                            <br>
                                            <span>Nro mmsi: <?php echo e($product->nrommsi); ?></span>
                                            <br>
                                            <span>Armador: <?php echo e($product->armador); ?></span>
                                            <br>
                                            <span>Puerto de registro: <?php echo e($product->puertoregistro); ?></span>
                                            <br>
                                            <span>Arte de pesca: <?php echo e($product->artepesca); ?></span>
                                            <br>
                                            <span>Año: <?php echo e($product->fe_fabricacion); ?></span>
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
                                            <span>Eslora: <?php echo e($product->eslora); ?></span>
                                            <br>
                                            <span>Manga: <?php echo e($product->manga); ?></span>
                                            <br>
                                            <span>Puntal: <?php echo e($product->puntal); ?></span>
                                            <br>
                                            <span>Arqueo bruto: <?php echo e($product->arqueobruto); ?></span>
                                            <br>
                                            <span>Arqueo neto: <?php echo e($product->arqueoneto); ?></span>
                                            <br>
                                            <span>Capacidad de combustible: <?php echo e($product->capacidadcombustible); ?></span>
                                            <br>
                                            <span>Capacidad de almacenamiento: <?php echo e($product->capacidadalmacenamiento); ?></span>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h4 class="accordion-header" id="headingThree">
                                        <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Información de tienda
                                        </a>
                                    </h4>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Dirección: <?php echo e($product->comercio->address); ?></p>
                                            <p>
                                                <a href="https://api.whatsapp.com/send?phone=+58<?php echo e($product->comercio->contactcellphone); ?>&text=<?php echo e($product->comercio->msgcontact); ?>" target="_blank"><?php echo e($product->comercio->contactcellphone); ?></a> 
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
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('components.show-recommended', [
                            'comercioId' => 1, 
                            'parametro' => $words='',
                            'is_boat' => $is_boat,
                            ])->html();
} elseif ($_instance->childHasBeenRendered('l1223732332-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l1223732332-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l1223732332-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l1223732332-0');
} else {
    $response = \Livewire\Livewire::mount('components.show-recommended', [
                            'comercioId' => 1, 
                            'parametro' => $words='',
                            'is_boat' => $is_boat,
                            ]);
    $html = $response->html();
    $_instance->logRenderedChild('l1223732332-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
            </div>

            
    <?php if(auth()->guard()->check()): ?>
        <script src="/js/bootstrap.bundle.min.js"></script>

        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" /> -->
    <?php endif; ?>

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
    <?php /**PATH /home/typej/Documentos/github/barcoexpres-1/resources/views/livewire/afiliado/view-details.blade.php ENDPATH**/ ?>