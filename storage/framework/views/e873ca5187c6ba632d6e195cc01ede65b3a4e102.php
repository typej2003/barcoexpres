<div id="contenedor-loader" style="visibility: hidden;">
<style>
        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 12px solid #444444;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }

        .center {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

        @keyframes  spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
<div id="loader" class="center"></div>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php if(!auth()->user()): ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo e(config('app.name')); ?></title>
    <meta name="description" content="Compra y vende Embarcaciones">
    <meta name="keywords" content="vende, compra, Barco, Bote, Embarcación, Embarcaciones, Barcoexprés, Barcoexpres">
    <link rel="shortcut icon" type="x-icon" href="/img/logo_barcoexpre.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style-welcome.css">
    <link rel="stylesheet" href="/css/navigationMap.css">
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <!-- <link rel="stylesheet" href="/css/bootstrap.min.css"> -->
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
<body>
    <div class="row"> 
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">
            <?php if($in_cellphonecontact > 0): ?>            
                <div class="row" id="whatsapp" style="position: fixed; bottom: 20px; right:20px; z-index: 20;">
                <a href="https://api.whatsapp.com/send?phone=+58<?php echo e(substr($comercio->contactcellphone, 1)); ?>&text=<?php echo e($comercio->msgcontact); ?>" target="_blank">
                        <img style="width: 65px;" src="/img/iconowhatsapp_azul.png" alt="">
                    </a>
                </div>
            <?php endif; ?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('layouts.navbar-nuevo', [
                    'comercioId' => 1,
                    ])->html();
} elseif ($_instance->childHasBeenRendered('I0xh8Ev')) {
    $componentId = $_instance->getRenderedChildComponentId('I0xh8Ev');
    $componentTag = $_instance->getRenderedChildComponentTagName('I0xh8Ev');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('I0xh8Ev');
} else {
    $response = \Livewire\Livewire::mount('layouts.navbar-nuevo', [
                    'comercioId' => 1,
                    ]);
    $html = $response->html();
    $_instance->logRenderedChild('I0xh8Ev', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <div class="wrapper">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('afiliado.view-details', [
                        'productId' => $productId
                    ])->html();
} elseif ($_instance->childHasBeenRendered('fNVKccO')) {
    $componentId = $_instance->getRenderedChildComponentId('fNVKccO');
    $componentTag = $_instance->getRenderedChildComponentTagName('fNVKccO');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('fNVKccO');
} else {
    $response = \Livewire\Livewire::mount('afiliado.view-details', [
                        'productId' => $productId
                    ]);
    $html = $response->html();
    $_instance->logRenderedChild('fNVKccO', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>
    
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('layouts.footer', [
                'comercioId' => 1,
                ])->html();
} elseif ($_instance->childHasBeenRendered('UJAn3zf')) {
    $componentId = $_instance->getRenderedChildComponentId('UJAn3zf');
    $componentTag = $_instance->getRenderedChildComponentTagName('UJAn3zf');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('UJAn3zf');
} else {
    $response = \Livewire\Livewire::mount('layouts.footer', [
                'comercioId' => 1,
                ]);
    $html = $response->html();
    $_instance->logRenderedChild('UJAn3zf', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

</body>
    
</html>
<script>
    document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
        document.querySelector("#contenedor-loader").style.visibility = "hidden";
        document.querySelector("#loader").style.visibility = "visible";
    } else {
        document.querySelector("#loader").style.display = "none";
        document.querySelector("#contenedor-loader").style.visibility = "visible";
    }
};
</script>
<?php if(!auth()->user()): ?>
    <script src="/js/app.js"></script>
    <script src="/js/backend.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>

    <?php echo $__env->yieldPushContent('js'); ?>
    <?php echo $__env->yieldPushContent('before-livewire-scripts'); ?>
    <?php echo \Livewire\Livewire::scripts(); ?>

    <?php echo $__env->yieldPushContent('after-livewire-scripts'); ?>

    <?php echo $__env->yieldPushContent('alpine-plugins'); ?>
    <!-- Alpine Core -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" /> -->
<?php endif; ?>

</div><?php /**PATH /home/typej/Documentos/github/barcoexpres-1/resources/views/externalviews/view-details.blade.php ENDPATH**/ ?>