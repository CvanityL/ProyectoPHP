<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>

  </style>
  <script>
  let chart;
    $(document).ready(function() {
        $.ajax({
            url:   'api/indicadores',
            type:  'get',
            success:  function (response) {
                const ctx = document.getElementById('chart');
                const data=JSON.parse(response);
                chart=new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(row => row.fechaIndicador),
                        datasets: [{
                            label: 'Valor UF',
                            data: data.map(row => row.valorIndicador),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });

        
    } );

    function buscar()
    {

        chart.destroy();
        $.ajax({
            data:{
                fechaDesde: $("#desde").val(),
                fechaHasta: $("#hasta").val(),
            },
            url:   'api/indicadores/byDate',
            type:  'post',
            success:  function (response) {
                const ctx = document.getElementById('chart');
                const data=JSON.parse(response);
                chart=new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(row => row.fechaIndicador),
                        datasets: [{
                            label: '# of Votes',
                            data: data.map(row => row.valorIndicador),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error:  function (response) {
                console.log(response);
                alert("Error al procesar la busqueda por fecha")
            }
        });
    }
    
  </script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="/Prueba-app/public/">Inicio</a>
  
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="/Prueba-app/public/indicadores">Indicadores (UF)</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Prueba-app/public/grafico">Grafico Indicadores (UF)</a>
    </li>
  </ul>
</nav>


<div class="jumbotron text-center">
  <h1>Grafico Indicadores</h1>
  <p></p> 
</div>
  
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <label for="desde">Fecha desde</label>
            <input class="form-control" type="date" name="desde" id="desde">
        </div>
        <div class="col-sm-4">
            <label for="hasta">Fecha hasta</label>
            <input class="form-control" type="date" name="hasta" id="hasta">
        </div>
        <div class="col-sm-4">
            <br>
            <input type="button" value="Buscar" class="btn btn-success" onclick="buscar()">
        </div>
    </div>
    <br>
    <div class="row">
        <canvas id="chart"></canvas>
    </div>
</div>
</body>
</html>


