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

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
<div id="loader" class="center"></div>
<!DOCTYPE html>
<html lang="en">
<head>
    @if(!auth()->user())
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
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
    @stack('styles')
    <livewire:styles />
    @endif
</head> 
<body>
    <div class="row"> 
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">
            @if($in_cellphonecontact > 0)            
                <div class="row" id="whatsapp" style="position: fixed; bottom: 20px; right:20px; z-index: 20;">
                    <a href="https://api.whatsapp.com/send?phone=+58{{$comercio->contactcellphone}}&text={{ $comercio->msgcontact}}" target="_blank">
                        <img style="width: 65px;" src="/img/iconowhatsapp_azul.png" alt="">
                    </a>
                </div>
            @endif
            @livewire('layouts.navbar-nuevo', [
                    'comercioId' => 1,
                    ])
            <div class="wrapper">
                @livewire('afiliado.view-details', [
                        'productId' => $productId
                    ])
            </div>
        </div>
    </div>
    
    @livewire('layouts.footer', [
                'comercioId' => 1,
                ])

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
@if(!auth()->user())
    <script src="/js/app.js"></script>
    <script src="/js/backend.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>

    @stack('js')
    @stack('before-livewire-scripts')
    <livewire:scripts />
    @stack('after-livewire-scripts')

    @stack('alpine-plugins')
    <!-- Alpine Core -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" /> -->
@endif

</div>