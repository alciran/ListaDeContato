<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Patronum</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

  <!-- Custom login css -->
  <link rel="stylesheet" href="{{ asset('dist/css/estilo_global.css') }}">
</head>
<body class="hold-transition login-page">

<div class="login-box">

  <!-- /.login-logo -->
  <div class="card card-outline  card-login">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1">Contatos<b></b></a>
    </div>
    <div class="card-body">
     <form id="loginForm" action="{{ route('login.access') }}" method="post">
     @csrf
      <div class="form-group">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
      </div>
        <div class="form-group">
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Senha" id="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
        </div>
          @if(isset($login_incorreto))
            <label style="color: rgb(247, 58, 58);">{{$login_incorreto}}</label>      
          @endif
          <div class="capslook_alert" id="capslock_section" hidden>
            <img src="{{ asset('dist/img/capslook_alert.png') }}" width="23" height="23"/><span style="color: green;">  Caps Lock Ativado!</span>
          </div><br>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" onclick="mostrarSenha()">
              <label for="remember">
                Mostrar Senha
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-login">Logar</button>
          </div>
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

<script>
$(function () {
  $('#password').keypress(function(e) { 
    var s = String.fromCharCode( e.which );
    if ( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey ) {
      document.getElementById("capslock_section").removeAttribute("hidden");
    }else{
      document.getElementById("capslock_section").setAttribute("hidden","true");
    }
});

$('#loginForm').validate({
  rules: {
      email: {
        required: true,
        email: true,
        minlength: 3
      },
      password: {
        required: true
      }
  },
  messages: {
    email: {
      required: "Por favor digite um email",
      minlength: "O nome de usuário deve ter ao menos 3 caracteres",
      email: "Por favor, digite um endereço de e-mail válido  " 
    },
    password: {
      required: "Por favor digite uma senha"
    }
  },
  errorElement: 'span',
  errorPlacement: function (error, element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
  }
});
});

function mostrarSenha(){
  if(document.getElementById('remember').checked)
    $('#password').attr('type', 'text');
  else
    $('#password').attr('type', 'password');
}
</script>
</body>
</html>
