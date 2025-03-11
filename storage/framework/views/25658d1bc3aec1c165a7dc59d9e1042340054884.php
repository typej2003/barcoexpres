<div>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <!-- Booststrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!--  /Booststrap -->

        <link rel="stylesheet" href="css/subirimagen.css">
        <title>Vista previa de imágenes</title>
    </head>
    <body>


        <div class="modal">
        <div class="modal-main">
            <div class="row">
            <div class="c-3-lg c-3-md c-1-sm close-modal"></div>
            <div class="c-6-lg c-6-md c-10-sm c-12-xs close-modal">
                <div class="modal-card" id="loading">
                <div class="preloader"></div>
                <span class="tag">Cargando...</span>
                </div>
                <div class="modal-card" id="Message">
                <span class="tag"></span>
                </div>
            </div>
            <div class="c-3-lg c-3-md c-1-sm close-modal"></div>
            </div>
        </div>
        </div>


        <header></header>


        <main>
            <div class="container">
                <section id="Images" class="images-cards">
                    <form action="guardarImagen" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12" id="add-photo-container">
                                <div class="add-new-photo first" id="add-photo">
                                    <span><i class="icon-camera"></i></span>
                                </div>
                                <input type="file" multiple id="add-new-photo" name="photo-file-hs5jg[]">
                            </div>
                        </div>
                        <div class="button-container">
                            <button type="submit">Subir imágenes</button>
                        </div> 
                    </form> 
                </section>
                <section id="MyImages" class="images-cards">
                    <h2>Mis imágenes</h2>
                    <div class="row">
                        <?php foreach($images as $image): ?>

                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12" data-id="<?= $image ?>">
                            <input type="hidden" name="photo-iohQc" value="test">
                            <div class="image-container">
                                <figure> 
                                    <img src="<?php echo e($image); ?>" alt="Foto del usuario">
                                    <figcaption> 
                                        <i class="icon-cross"></i> 
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </main>

        <!-- Bootstrap y jQuery -->
        
        <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        
        <!--  /Bootstrap y jQuery -->


        <script src="js/subirimagen.js"></script>
    </body>
    </html>
</div>
<?php /**PATH /home/typej/Documentos/github/barcoexpres-1/resources/views/livewire/recursos/subir-imagen.blade.php ENDPATH**/ ?>