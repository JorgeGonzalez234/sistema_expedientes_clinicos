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
  <head>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
   <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
   <title>Pacientes</title>
   <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <style>
        .actions {
         white-space: nowrap;
         width: 1px;
       }
     </style>
        <SCRIPT languaje="JavaScript">
        function pulsar() {
          alert("Esta seguro que desea borrar este paciente");
        }
      </SCRIPT>
  </head>
  <body>
    <div class="main-wrapper">
      <?php include "navbar.php"; ?>
      <div class="page-wrapper">
        <div class="content">
          <div class="row">
            <div class="col-sm-4 col-3">
              <h4 class="page-title">Pacientes</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
              <a href="agregar-paciente.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Agregar Paciente</a>
            </div>
          </div>         
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
               <table id="mitabla" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%"> 
                <thead >
                  <tr>
                    <th>NoControl</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>Curp</th>
                    <th>NSS</th>
                    <th  class="text-center">Intervencion de enfermeria</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $query = "SELECT * FROM afiliados";
                  $result_task = mysqli_query($link,$query);
                  while($row = mysqli_fetch_array($result_task)) {?>
                   <tr>
                    <td><?php echo $row['matricula'] ?></td>
                    <td><?php echo $row['nombre'] ?></td>
                    <td><?php echo $row['direccion'] ?></td>
                    <td><?php echo $row['correo'] ?></td>                   
                    <td><?php echo $row['curp'] ?></td>                   
                    <td><?php echo $row['nss'] ?></td>
                    <td class="actions">
                     <div class="form-group text-center">
                     <a class="btn btn-primary" value="editar"  title="editar"href="editar-paciente.php?id=<?php echo $row['id_afiliado']?>" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;                     
                      <a class="btn btn-danger" value="borrar"  title="eliminar" href="borrarpaciente.php?id=<?php echo $row['id_afiliado']?>" onclick="pulsar()"><i class="fa fa-trash"  aria-hidden="true"></i> </a>                       
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
<?php } ?>