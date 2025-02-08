<div class="navigationMap" style="">
    <link rel="stylesheet" href="/css/navigationMap.css">
    <div class="row mx-2">
        <div class="col-left logoNM">
            <img class="logo-responsiveNM" src="/img/barcoexpres_logo_blanco_01.png" alt="">
        </div>
        <div class="col-center d-flex flex-column align-self-start">
            <div class="mapanavegacion" style="height: auto">
                <div class="mt-2 Text-Uppercase">Acerca de {{ $comercio->name }}</div>
                    <div style="heigth: auto !important; color: white !important;">
                        @foreach($categories as $category)
                                @if(count($category->subcategories()) == 0))
                                    <div class="">
                                        <a class="Text-Uppercase" href="{{ route('cat', [
                                            'categ' => $category->name,
                                            ]) }}" style="font-weight: bold; cursor:pointer; color: white !important;">
                                            {{$category->name}}
                                        </a>
                                    </div>
                                @else
                                    <div class="" style="font-weight: bold; ">
                                        <a class="Text-Uppercase text-white" href="#">
                                            <!-- <i class="fa fa-plus mr-3"></i> -->
                                            {{$category->name}}                                                
                                        </a>
                                        @foreach($category->subcategories() as $subcategory)
                                            <div class="">
                                                <div class="d-flex justify-content-between mx-0">
                                                    <a class="Text-Uppercase text-white" href="{{ route('cat', [
                                                                                'categ' => $subcategory->name,
                                                                                ]) }}">
                                                        {{ $subcategory->name}}
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach                                            
                                    </div>
                                @endif                                
                        @endforeach
                    </div>
                <div>
                    <a class="Text-Uppercase text-white" href="https://api.whatsapp.com/send?phone=+58{{substr($comercio->contactcellphone, 1)}}&text={{ $comercio->msgcontact}}" target="_blank">
                        Ayuda
                    </a>
                </div>

            </div>
            <div class="redessociales d-flex flex-row text-start my-3">
                @if(!empty($comercio->instagram))
                <div><a href="{{$comercio->instagram}}"><img style="width: 20px; margin: 5px;" src="/img/redes/instagram_icon.png" alt=""></a></div>
                @endif
                @if(!empty($comercio->tiktok))
                <div><a href="{{$comercio->tiktok}}"><img style="width: 20px; margin: 5px;" src="/img/redes/tiktok_icon.png" alt=""></a></div>
                @endif
                @if(!empty($comercio->facebook))
                <div><a href="{{$comercio->facebook}}"><img style="width: 13px; margin: 5px;" src="/img/redes/facebook_icon.png" alt=""></a></div>
                @endif
                @if(!empty($comercio->twitter))
                <div><a href="{{$comercio->twitter}}"><img style="width: 20px; margin: 5px;" src="/img/redes/x_icon.png" alt=""></a></div>
                @endif
            </div>
            <img class="logo-qr qr-movil" src="/img/qr_barcoexpres.png" alt="">
        </div>
        <div class="col-right">
            <img class="logo-qr mx-auto" src="/img/qr_barcoexpres.png" alt="">
        </div>
    </div>
   
</div>
