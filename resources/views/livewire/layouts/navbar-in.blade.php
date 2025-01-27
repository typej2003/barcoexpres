<!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top "> -->
@if($in_cellphonecontact > 0)            
    <div class="row" id="whatsapp" style="position: fixed; bottom: 20px; right:20px; z-index: 20;">
        <a href="https://api.whatsapp.com/send?phone=+58{{$comercio->contactcellphone}}&text={{ $comercio->msgcontact}}" target="_blank">
            <img style="width: 65px;" src="/img/iconowhatsapp_azul.png" alt="">
        </a>
    </div>
@endif
<nav class="main-header navbar navbar-expand navbar-white navbar-orange">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown my-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ auth()->user()->avatar_url }}" id="profileImage" class="img-circle elevation-1" alt="User Image" style="height: 30px; width: 30px;">
                <span class="ml-1 w-full" x-ref="username">Hola, {{ auth()->user()->name }}</span>
            </a>
            <div class="dropdown-menu my-5" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="profileLink">Perfil</a>
                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="profileLink">Mi Cuenta</a>
                <a class="dropdown-item d-none" href="{{ route('admin.profile.edit') }}" x-ref="profileLink">Mis Listas de Deseos</a>
                <a class="dropdown-item" href="{{ route('listPedidosCliente') }}" x-ref="profileLink">Mis Pedidos</a>
                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" x-ref="changePasswordLink">Cambiar Contraseña</a>
                <a class="dropdown-item" href="{{ route('admin.settings') }}">Configuración</a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesión</a>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <div class="row">
                <div class="col-md-12 mx-2">
                    <div class="dropdown-cart-drop">
                        <a class="btn-cart-drop d-flex justify-content-between botonera">
                            <img  src="/img/icon_carrito.png" style="height:25px !important; cursor:pointer !important;">
                            <span class="text-dark">({{ $totalQuantityCart}} )</span>
                            <!-- <span class="text-dark">({{\Cart::getTotalQuantity()}})</span> -->
                        </a>
                        @livewire('carrito.cart-drop', ['currencyValue' => $currencyValue ])
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="row">
                <div class="col-md-12 my-2">
                    @livewire('components.currency')
                </div>
            </div>
        </li>
    </ul>
</nav>
