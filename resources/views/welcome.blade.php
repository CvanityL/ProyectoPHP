<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>Proyecto PHP MVC con grafico</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="/Prueba-app/public/">Logo</a>
  
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="/Prueba-app/public/indicadores">Indicadores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Prueba-app/public/grafico">Grafico Indicadores (UF)</a>
    </li>
  </ul>
</nav>


<div class="jumbotron text-center">
  <h1>Proyecto PHP </h1>
  <p>Proyecto php MVC con graficos e indicadores</p> 
</div>
  
<div class="container">
  <div class="row">
    <div class="col-sm">
      <h3>Indicadores</h3>
      <a class="nav-link" href="/Prueba-app/public/indicadores">Indicadores</a>
      <p>En esta seccion se pueden ver los indicadores</p>
    </div>
    <div class="col-sm">
      <h3>Graficos</h3>
      <a class="nav-link" href="/Prueba-app/public/grafico">Grafico Indicadores (UF)</a>
      <p>En esta seccion se pueden ver los graficos</p>
    </div>
  </div>
</div>

</body>
</html>


