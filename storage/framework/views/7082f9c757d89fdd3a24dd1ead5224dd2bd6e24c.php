<div class="navigationMap" style="">
    <link rel="stylesheet" href="/css/navigationMap.css">
    <div class="row mx-2">
        <div class="col-left logoNM">
            <img class="logo-responsiveNM" src="/img/barcoexpres_logo_blanco_01.png" alt="">
        </div>
        <div class="col-center d-flex flex-column align-self-start">
            <div class="mapanavegacion" style="height: auto">
                <div class="mt-2 Text-Uppercase">Acerca de <?php echo e($comercio->name); ?></div>
                <div class="mt-2 myt-3 Text-Uppercase">Embarcaciones de pesca</div>
                <div style="heigth: auto !important; color: white !important;">
                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($this->validar($menu)): ?>
                                <div class="">
                                    <a class="Text-Uppercase" href="<?php echo e(route('cat', [
                                        'categ' => $menu->texto,
                                        ])); ?>" style="font-weight: bold; cursor:pointer; color: white !important;">
                                        <?php echo e($menu->texto); ?>

                                    </a>
                                </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="my-3">
                    <a class="Text-Uppercase text-white" href="https://api.whatsapp.com/send?phone=+58<?php echo e(substr($comercio->contactcellphone, 1)); ?>&text=<?php echo e($comercio->msgcontact); ?>" target="_blank">
                        Ayuda
                    </a>
                </div>

            </div>
            <div class="redessociales d-flex flex-row text-start my-3">
                <?php if(!empty($comercio->instagram)): ?>
                <div><a href="<?php echo e($comercio->instagram); ?>"><img style="width: 20px; margin: 5px;" src="/img/redes/instagram_icon.png" alt=""></a></div>
                <?php endif; ?>
                <?php if(!empty($comercio->tiktok)): ?>
                <div><a href="<?php echo e($comercio->tiktok); ?>"><img style="width: 20px; margin: 5px;" src="/img/redes/tiktok_icon.png" alt=""></a></div>
                <?php endif; ?>
                <?php if(!empty($comercio->facebook)): ?>
                <div><a href="<?php echo e($comercio->facebook); ?>"><img style="width: 13px; margin: 5px;" src="/img/redes/facebook_icon.png" alt=""></a></div>
                <?php endif; ?>
                <?php if(!empty($comercio->twitter)): ?>
                <div><a href="<?php echo e($comercio->twitter); ?>"><img style="width: 20px; margin: 5px;" src="/img/redes/x_icon.png" alt=""></a></div>
                <?php endif; ?>
            </div>
            <img class="logo-qr qr-movil" src="/img/qr_barcoexpres.png" alt="">
        </div>
        <div class="col-right">
            <img class="logo-qr mx-auto" src="/img/qr_barcoexpres.png" alt="">
        </div>
    </div>
   
</div>
<?php /**PATH /home/typej/Documentos/github/barcoexpres-1/resources/views/livewire/components/navigation-map.blade.php ENDPATH**/ ?>