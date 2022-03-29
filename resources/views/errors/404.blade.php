{{-- @extends('adminlte::page')

@section('title', 'Tabela - Consumo de Produto Base')

@section('css')
    <link rel="stylesheet" href="{{ asset('dist/css/estilo_global.css') }}">
@stop

@section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | 404 Page not found</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    

<div class="section">
    <div class="container">

<br>
        <div class="error-page">
            <h2 class="headline text-warning"> 404</h2>
    
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Página não encontrada.</h3>
    
                <h5>
                    Não foi possível encontrar a página que você está procurando dentro do <strong>Lista de Contatos</strong>.<br><br>
                    Deseja retornar a <a href="{{ route('home') }}">página Home</a>?
                </h5>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </div>
</div>
</body>
    
{{-- @stop --}}
