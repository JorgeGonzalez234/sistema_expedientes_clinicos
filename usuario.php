<?php
session_start();
?>
<?php
date_default_timezone_set("America/Mexico_City");
error_reporting(0);
require_once('conexion.php');
$id = $_SESSION['id'];
if ($id == null){
  header ("Location: index.php" );
}else{
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
  <title>Usuario</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <head>
      <style>
        .actions {
         white-space: nowrap;
         width: 1px;
       }
     </style>
     <SCRIPT languaje="JavaScript">
      function pulsar() {
        alert("Esta seguro que desea borrar este usuario");
      }
    </SCRIPT>
  </head>
  <body>
    <div class="main-wrapper">
      <?php include "navbarConfig.php"; ?>
      <div class="page-wrapper">
        <div class="content">
          <div class="row">
            <div class="col-sm-4 col-3">
              <h4 class="page-title">Usuarios</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
              <a href="agregar-usuario.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Agregar Usuario</a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="mitabla" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%">
                  <thead >
                    <tr>
                      <th>Nombre</th>
                      <th>Usuario</th>
                      <th>Email</th>
                      <th class="text-center">intervencion de enfermeria</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $query = "SELECT * FROM usuario";//selecciona los campos dentro de la tabla usuario
                    $result_task = mysqli_query($link,$query);
                    while($row = mysqli_fetch_array($result_task)) {?>
                     <tr>
                      <td><?php echo $row['nombre'] ?></td>
                      <td><?php echo $row['usuario'] ?></td>
                      <td><?php echo $row['correo'] ?></td>
                      <td class="actions">
                       <div class="form-group text-center">
                        <a class="btn btn-primary" value="editar"  title="editar"href="editar-usuario.php?id=<?php echo $row['id_usuario']?>" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;
                        <a class="btn btn-primary" value="cambiar contraseña"  title="cambiar contraseña " href="cambiar-contrasena.php?id=<?php echo $row['id_usuario']?>" role="button"> <i class="fa fa-key" aria-hidden="true" ></i></a> &nbsp;
                        <a class="btn btn-danger" value="borrar"  title="eliminar" href="borrarusuario.php?id=<?php echo $row['id_usuario']?>" onclick="pulsar()"><i class="fa fa-trash"  aria-hidden="true"></i> </a> 
                      </div>
                    </td>
                  </tr>
                <?php  }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/datatables.min.js"></script>
<!-- permite convertir a tabla al idioma español -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#mitabla').DataTable({ 
      "language": {                
        "zeroRecords": "No se encontraron resultados en su busqueda",
        "searchPlaceholder": "Buscar ",
        "lengthMenu": "Mostrar _MENU_ registros ",  
        "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
        "infoEmpty": "No existen registros",
        "infoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "search": "Buscar:",
        "paginate": {
          "first":    "Primero",
          "last":    "Último",
          "next":    "Siguiente",
          "previous": "Anterior"
        },
      }
    });
  } );
</script>
</body>
</html>
<?php  }?>