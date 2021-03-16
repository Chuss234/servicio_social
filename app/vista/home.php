<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="app/vista/libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="app/vista/libs/bootstrap/css/customstyle.css">
  <link rel="stylesheet" href="app/vista/libs/icons/css/all.css">
  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

  <title>Inicio</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <a class="navbar-brand" href="#">SERVICIO SOCIAL UNICAES</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a onclick="salir();" class="nav-link" href="#">Cerrar sesion</a>
        </li>

      </ul>

    </div>

  </nav>
  <br>
  <div class="row content withoutMargin">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">

          <h3 class="text-dark text-center">Registrar alumno</h3>
          <form id="formRegister">
            <div class="form-group">
              <a>Carnet</a>
              <input type="text" id="carnet" name="carnet" placeholder="Carnet" class="campo form-control" required autofocus>
            </div>
            <div class="form-group">
              <a>Apellidos</a>
              <div class="input-group">
                <input id="apellidos" name="apellidos" type="text" placeholder="Apellidos" required Class="campo form-control">
              </div>
            </div>
            <div class="form-group">
              <a>Nombres</a>
              <div class="input-group">
                <input id="nombres" name="nombres" type="text" placeholder="Nombres" required Class="campo form-control">
              </div>
            </div>

            <div class="form-group">
              <a>Carrera</a>
              <div class="input-group">
                <input id="carera" name="carrera" type="text" placeholder="Carrera" required Class="campo form-control">
              </div>
            </div>
            <div class="form-group">
              <a>Fecha de finalizacion</a>
              <div class="input-group">
                <input id="fecha" name="fecha" type="date" placeholder="fecha" required Class="campo form-control">
              </div>
            </div>


            <div>
              <input type="hidden" value="0" name="idForEdit" id="idForEdit">
            </div>


            <button type="submit" class="btn btn-primary form-control">
              Guardar
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="alert alert-primary d-none" id="alertData" role="alert">
        Registrado conrrectamente!
      </div>
      <div class="alert alert-danger d-none" id="alertDataDeleted" role="alert">
        El Registrado fue borrado conrrectamente!
      </div>
      <div class="card">
        <div id="content-table" class="card-body">



          </table>
        </div>
      </div>

    </div>
  </div>
</body>

<script src="app/vista/libs/jquery-3.6.0.min.js"></script>
<script src="app/vista/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="http://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {

    recuperarDatos();

  });

  function recuperarDatos() {

    $.ajax({
      dataType: "json",
      url: "<?php echo controlador::$rutaAPP; ?>index.php?action=get",
      data: {
        op: 1
      },
      type: "POST",
      success: function(data) {

        var makeHtml = " <table id='myTable' class='table text-center table-bordered  table-striped table-responsive-lg'>";
        makeHtml += "<thead class='bg-danger text-white'>";
        makeHtml += "<tr>";
        makeHtml += "<th> Registro </th>";
        makeHtml += "<th> Carnet  </th>";
        makeHtml += "<th>Apellidos</th>";
        makeHtml += "<th>Nombres</th>";
        makeHtml += "<th>Carrera</th>";
        makeHtml += "<th>Fecha de realizacion</th>";
        makeHtml += "<th>Opciones</th>";
        makeHtml += "</tr>";
        makeHtml += "</thead>"
        makeHtml += "</tbody>"

        data.data.forEach(function(item, index) {
          makeHtml += "<tr>";
          makeHtml += "<td> " + item.id_registro + "</td>";
          makeHtml += "<td> <mark>  " + item.carnet + "</mark></td>";
          makeHtml += "<td>" + item.apellidos + "</td>";
          makeHtml += "<td>" + item.nombres + "</td>";
          makeHtml += "<td>" + item.carrera + "</td>";
          makeHtml += "<td>" + item.fecha + "</td>";
          makeHtml += "<td  > <i onclick='borrar(" + item.id_registro + ");' class='icons fas fa-trash text-danger'></i> -  <i onclick='editar(" + item.id_registro + ");' class='icons fas fa-edit text-warning'></i></td>";

        });

        makeHtml += "</tbody>";
        makeHtml += "</table>";
        $("#content-table").html(makeHtml);
        $('#myTable').DataTable({
          "order": [
            [0, "desc"]
          ]
        });
      },
      error: function(response) {

      }

    }); //Objeto ajax para recuperar y mostrar datos en data table

  }



  function borrar(id) {

    const r = confirm("¿Decea borrar el registro?");
    if (r == true) {
      $.ajax({
        dataType: "json",
        url: "<?php echo controlador::$rutaAPP; ?>index.php?action=get",
        data: {
          op: 5,
          id: id
        },
        type: "POST",
        success: function(data) {
          recuperarDatos();
          $("#alertData").addClass("d-none");
          $("#alertDataDeleted").removeClass("d-none");
          $("#idForEdit").val("0");

        },
        error: function(response) {

        }

      });
    }
  }

  function editar(id) {
    $.ajax({
      dataType: "json",
      url: "<?php echo controlador::$rutaAPP; ?>index.php?action=get",
      data: {
        op: 3,
        id: id
      },
      type: "POST",
      success: function(data) {

        $("#idForEdit").val(id);

        $(".campo").each(function() {
          $(this).val(data.data[0][$(this).attr("name")]);
        });

      },
      error: function(response) {

      }

    });
  }

  document.querySelector("#formRegister").addEventListener("submit", async (event) => {
    event.preventDefault();

    let data = new FormData(event.currentTarget);

    if (data.get("idForEdit") === '0') {

      saveData(data, 2);

    } else {

      saveData(data, 4);
    }

  });

  function saveData(data, op) {
    $.ajax({
      dataType: "json",
      url: "<?php echo controlador::$rutaAPP; ?>index.php?action=get",
      type: "POST",
      data: {
        carnet: data.get('carnet'),
        apellidos: data.get('apellidos'),
        id: data.get('idForEdit'),
        nombres: data.get('nombres'),
        carrera: data.get('carrera'),
        fecha: data.get('fecha'),
        op: op,
      },
      success: function(data) {
        if (data.success == false) {
          alert("error");

        } else {

          recuperarDatos();
          document.querySelector("#formRegister").reset();

          $("#alertDataDeleted").addClass("d-none");
          $("#alertData").removeClass("d-none");

          $("#idForEdit").val("0");


        }
      },
      error: function(response) {
        alert("EL servidor no responde");
      }
    });
  }

  function salir() {
    if (window.confirm("¿Desea salir del sistema?")) {
      window.location.replace("/serviciosocial/index.php?action=salir");
    }
  }
</script>

</html>