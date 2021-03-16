<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="app/vista/libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="app/vista/libs/bootstrap/css/customstyle.css">
  <title>Inicio de sesion</title>
</head>

<body style="background-color: #fefefe;">

  <div class="formulario">
  <center><h5>SERVICIO SOCIAL UNICAES</h5></center>
  <hr>
    <form id="loginForm">
      <!-- Email input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="usr">Usuario</label>
        <input required placeholder="Usuario" type="text" id="usr" class="form-control" />

      </div>

      <!-- Password input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="pass">Contraseña</label>
        <input required placeholder="Contraseña" type="password" id="pass" class="form-control" />

      </div>

      <!-- 2 column grid layout for inline styling -->

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block form-group">Enviar</button>
      <div id="b-alert" class="alert alert-danger d-none" role="alert">
        Error: Usuario o contraseña incorrecto.
      </div>
    </form>
  </div>


</body>
<script src="app/vista/libs/jquery-3.6.0.min.js"></script>
<script src="app/vista/libs/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $("#loginForm").submit(function(event) {
      event.preventDefault();
      $.ajax({
        dataType: "json",
        url: "<?php echo controlador::$rutaAPP; ?>index.php?action=validar",
        type: "POST",
        data: {
          usr: $("#usr").val(),
          pass: $("#pass").val()
        },
        success: function(data) {
          if (data.success == false) {
            $("#b-alert").removeClass("d-none")
          } else {
            window.location = data.link;
          }
        },
        error: function(response) {

        }
      });
    });
  });
</script>

</html>