<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style-welcome.css">

</head>
<body class="bg-azul">
  <div class="container-fluid d-flex" style="height: 100vh !important;">
    <div class="card mx-auto my-auto" style="width: 36rem !important;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 titulo c-a text-center">
                    <a href="/"><img class="logo-login-register mx-auto " src="/img/logo_barcoexpres.jpg" alt=""></a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 titulo c-a text-center">
                    <p class="text-center textoreg">¿Ya tienes una cuenta? <span><a href="/login" class="c-n">click aquí</a></span></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 titulo c-a text-center">
                    <p class="titulo">Registro</p>
                </div>
            </div>

            <form action="{{ route('register') }}" method="post">           
                @csrf
                <div class="group-control mb-3">
                    <label for="roleS">Tipo de usuario</label>
                    <select class="form-control" name="roleS" id="roleS">
                        <option value="cliente" selected>CLIENTE</option>
                        <option value="afiliado">AFILIADO</option>
                    </select>
                </div>
                <input type="hidden" value="cliente" id="role" name="role">
                <script>
                    let selectElement = document.querySelector('#roleS')
                    selectElement.addEventListener("change", (event) => {
                        document.querySelector('#role').value = event.target.value;
                    });
                </script>
                <div class="form-group">
                    <div class="row ">
                        <div class="col-xs-6 col-md-4 col-sm-4 col-4">
                            <label for="tipodocumento">Tipo <span class="text-danger">*</span></label>
                            <select wire:model.defer="stateDatosBasicos.identificationNac" class="form-control inputForm inputType" name="identificationNac" id="identificationNac" placeholder="Tipo">
                                <option value="J">J-</option>
                                <option value="E">E-</option>
                                <option value="G">G-</option>
                                <option value="P">P-</option>
                                <option value="V" selected>V-</option>
                            </select>
                        </div>
                        <div class="col-xs-6 col-md-8 col=sm-8 col-8">
                            <label for="documento">Documento <span class="text-danger">*</span></label>
                            <input wire:model.defer="stateDatosBasicos.identificationNumber" type="text" name="identificationNumber" id="identificationNumber" class="form-control inputForm" placeholder="Documento">
                        </div>
                    </div>
                    
                </div>

                <div class="form-group">
                    <label for="documento">Usuario <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">                
                        <input type="text" name="name" class="form-control" placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text titulo">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="documento">Email <span class="text-danger">*</span></label>            
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text titulo">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="documento">Contraseña <span class="text-danger">*</span></label>            
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="">
                        <div class="input-group-append">
                        <div class="input-group-text titulo">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="documento">Repita la contraseña <span class="text-danger">*</span></label>        
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="password confirmation" value="">
                        <div class="input-group-append">
                        <div class="input-group-text titulo">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="documento">Teléfono </label>        
                    <div class="row ">
                        <div class="col-xs-6 col-md-5 col-sm-4 col-4">
                            <select class="form-control" name="cellphonecode" id="cellphonecode">
                                <option value="0">Seleccione</option>
                                <option value="0412">0412</option>
                                <option value="0414">0414</option>
                                <option value="0424">0424</option>
                                <option value="0416">0416</option>
                                <option value="0426">0426</option>
                            </select>
                        </div>
                        <div class="col-xs-6 col-md-7 col-sm-8 col-8">
                            <input type="text" class="form-control" name="cellphone" id="cellphone">
                        </div>
                    </div>                
                </div>

                <div class="form-group my-3 d-flex">
                    <button type="submit" class="btn btn-app mx-auto"><span class="fas fa-user-plus"></span>Unete</button>
                </div>

            </form>

        </div>
        <!-- /.card-body -->
    </div>
  <!-- /.card -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
</body>
</html>

