<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .btn {
    background-color:  #ff0000;
    border: none;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 15px;
    cursor: pointer;
    }

    /* Darker background on mouse-over */
    .btn:hover {
    background-color: #4d0000;
    }
    .btn2 {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 15px;
    cursor: pointer;
    }

    /* Darker background on mouse-over */
    .btn2:hover {
    background-color: RoyalBlue;
    }
    
  </style>
  <script>
  function cargar()
  {
    $.ajax({
        url:   'api/indicadores',
        type:  'get',
        success:  function (response) {
            JSON.parse(response).forEach((element) => {
                var newRowContent = 
                `<tr>
                    <td>${element.nombreIndicador}</td>
                    <td>${element.codigoIndicador}</td>
                    <td>${element.fechaIndicador}</td>
                    <td>${element.unidadMedidaIndicador}</td>
                    <td>${element.valorIndicador}</td>
                    <td>${element.tiempoIndicador}</td>
                    <td>${element.origenIndicador}</td>
                    <td>
                        <button onclick="showUpdate(${element.id})"class="btn2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 15 15">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg></button>
                        <button onclick="borrar(${element.id})" class="btn"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>`;
                $("#table tbody").append(newRowContent); 

            });
            $('#table').DataTable();   
        }
    });
  }

  $(document).ready(function() {
    cargar();
    
  } );

  function borrar(id)
  {
    if(confirm(`Eliminar registro id ${id} ?`) == true)
    {
        $.ajax({
            url:   'api/indicadores/'+id,
            type:  'delete',
            success:  function (response) {
                $("#table tbody").empty();
                cargar();
            }
         });
    }

  }
  function crear()
  {
    
    if($("#id").val()=='' && $("#nombreIndicador").val()!='' && 
    $("#codigoIndicador").val()!='' && $("#fechaIndicador").val()!='' && $("#unidadMedidaIndicador").val()!='' &&
    $("#valorIndicador").val()!='' && $("#origenIndicador").val()!='')
    {
        console.log($("#fechaIndicador").val());
        $.ajax({
            data:{
                nombreIndicador: $("#nombreIndicador").val(),
                codigoIndicador: $("#codigoIndicador").val(),
                unidadMedidaIndicador: $("#unidadMedidaIndicador").val(),
                valorIndicador: $("#valorIndicador").val(),
                fechaIndicador: $("#fechaIndicador").val(),
                tiempoIndicador: $("#tiempoIndicador").val(),
                origenIndicador: $("#origenIndicador").val()
            },
            url:   'api/indicadores',
            type:  'post',
            success:  function (response) {
                alert("creado");
                $("#table tbody").empty();
                cargar();
            }
         });
    }else if($("#id").val()!='')
    {
        actualizar($("#id").val());
    }
    
  }

  function showUpdate(id)
  {
    $.ajax({
        url:   'api/indicadores/'+id,
        type:  'get',
        success:  function (response) {
            const data =JSON.parse(response);
            $("#id").val(data.id);
            $("#nombreIndicador").val(data.nombreIndicador);
            $("#codigoIndicador").val(data.codigoIndicador);
            $("#unidadMedidaIndicador").val(data.unidadMedidaIndicador);
            $("#valorIndicador").val(data.valorIndicador);
            $("#fechaIndicador").val(data.fechaIndicador);
            $("#tiempoIndicador").val(data.tiempoIndicador);
            $("#origenIndicador").val(data.origenIndicador);
            $('#modal').modal('show');
        }
    });
  }

  function actualizar(id)
  {
    if(confirm(`Eliminar registro id ${id} ?`) == true)
    {
        $.ajax({
            url:   'api/indicadores/'+id,
            type:  'delete',
            success:  function (response) {
                $("#table tbody").empty();
                cargar();
            }
         });
    }

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
  <h1>Indicadores</h1>
  <p></p> 
</div>
  
<div class="container">
    <div class="row">
        <!-- Button trigger modal -->
        <button type="button" class="btn2 btn-primary" data-toggle="modal" data-target="#modal">
        Crear indicador
        </button>
    </div>
    <br>
    <div class="row">
    <table id="table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nombre Indicador</th>
                <th>Codigo Indicador</th>
                <th>fecha Indicador</th>
                <th>Unidad Medida Indicador</th>
                <th>Valor Indicador</th>
                <th>Tiempo Indicador</th>
                <th>Origen Indicador</th>
                <th>Acciones a realizar</th>
                
            </tr>
        </thead>
        <tbody id="indicadores">
        </tbody>
    
    </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal" name="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Crear indicador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
      <div class="form-group" hidden="true" >
            <label for="id">Id Indicador</label>
            <input type="text" name="id" id="id" class="form-control">
        </div>
        <div class="form-group">
            <label for="nombreIndicador">Nombre Indicador</label>
            <input required type="text" name="nombreIndicador" id="nombreIndicador" class="form-control">
        </div>
        <div class="form-group">
            <label for="codigoIndicador">Codigo Indicador</label>
            <input required type="text" name="codigoIndicador" id="codigoIndicador" class="form-control">
        </div>
        <div class="form-group">
            <label for="fechaIndicador">fecha Indicador</label>
            <input required type="date" name="fechaIndicador" id="fechaIndicador" class="form-control">
        </div>
        <div class="form-group">
            <label for="unidadMedidaIndicador">Unidad Medida Indicador</label>
            <input required type="text" name="unidadMedidaIndicador" id="unidadMedidaIndicador" class="form-control">
        </div>
        <div class="form-group">
            <label for="valorIndicador">Valor Indicador</label>
            <input required type="number" step="0.01" name="valorIndicador" id="valorIndicador" class="form-control">
        </div>
        <div class="form-group">
            <label for="tiempoIndicador">Tiempo Indicador</label>
            <input type="text" name="tiempoIndicador" id="tiempoIndicador" class="form-control">
        </div>
        <div class="form-group">
            <label for="origenIndicador">Origen Indicador</label>
            <input required type="text" name="origenIndicador" id="origenIndicador" class="form-control">
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn2 btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn2 btn-primary" onclick="crear()">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>


