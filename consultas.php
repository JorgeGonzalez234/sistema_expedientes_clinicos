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
  <title>Consultas</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <!-- envia un alert cuando se pulsa el boton eliminar -->
  <SCRIPT languaje="JavaScript">
    function pulsar() {
      alert("Esta seguro que desea borrar esta consulta");
    }
  </SCRIPT>
  <head>
    <style>
      .actions {
       white-space: nowrap;
       width: 1px;
     }
   </style>
 </head>
 <body>
  <div class="main-wrapper">
    <?php include "navbar.php"; ?>
    <div class="page-wrapper">
      <div class="content">
        <div class="row">
          <div class="col-sm-4 col-3">
            <h4 class="page-title">Consultas</h4>
          </div>
          <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="agregar-consulta.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Nueva consulta</a>
          </div>
        </div>        
        <div class="table-responsive">
          <table id="mitabla" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%">
            <thead >
              <tr>
               <th>No. consulta</th>
               <th>Paciente</th>
               <th>Atendio</th>
               <th  class="text-center">intervencion de enfermeria</th>
             </tr>
           </thead>
           <tbody>
            <?php 
            require 'conexion.php';
            $sql = mysqli_query($link,"SELECT * FROM consultas");//selecciona la tabla consultas
            while($row = mysqli_fetch_array($sql)){
              $uno = $row['id_afiliado'];
              $dos = $row['id_usuario'];
                    //selecciona dentro de la tabla afiliados el id
              $sql2 = mysqli_query($link,"SELECT * FROM afiliados WHERE id_afiliado = $uno ");
              $row2 = mysqli_fetch_array($sql2);
                    // selecciona dentro de la tabla usuario el id
              $sql3 = mysqli_query($link,"SELECT * FROM usuario WHERE id_usuario = $dos ");
              $row3 = mysqli_fetch_array($sql3);
              ?>
              <tr>
               <td><?php echo $row['id_consulta'] ?></td>
               <td><?php echo $row2['nombre'] ?></td>
               <td><?php echo $row3['nombre'] ?></td>
               <td class="actions">
                 <div class="form-group text-center">
                  <a class="btn btn-danger" value="borrar"  title="eliminar" href="borrarconsulta.php?id=<?php echo $row['id_consulta']?>" onclick="pulsar()" ><i class="fa fa-trash"  aria-hidden="true"></i> </a> 
                </div>
              </td>
            </tr>
               <?php 
            }
            ?>
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
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/datatables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#mitabla').DataTable({
      "language": {        
        "zeroRecords": "No se encontraron resultados en su busqueda",
        "lengthMenu": "Mostrar _MENU_ registros ",
        "searchPlaceholder": "Buscar ",
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