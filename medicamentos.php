<?php 
date_default_timezone_set("America/Mexico_City");
error_reporting(0);
require_once('conexion.php');
session_start();
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
  <title>Medicamentos</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <!-- patients23:17-->
  <head>
    <SCRIPT languaje="JavaScript">
      function pulsar() {
        alert("Esta seguro que desea borrar este medicamento");
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
              <h4 class="page-title">Administración de medicamentos</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
              <a href="agregar-medicamento.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Agregar Medicamentos</a>
            </div>
          </div>            
          <div class="row">
           
            <div class="table-responsive">
              <table id="mitabla" class="table table-striped table-bordered table-hover  table-sm" cellspacing="0" width="100%">
                <thead >
                  <tr>
                    <th>Lote</th>
                    <th>Nombre</th>
                    <th>Concentración</th>                        
                    <th>Presentación</th>
                    <th>Fecha de caducidad</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th  class="text-center">Intervencion de enfermeria</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $query = "SELECT * FROM medicamentos";//seleccio dentro de la tabla medicamentos todos sus campos
                  $result_task = mysqli_query($link,$query);
                  while($row = mysqli_fetch_array($result_task)) {?>
                   <tr>
                    <td><?php echo $row['lote'] ?></td>
                    <td><?php echo $row['nombrem'] ?></td>
                    <td><?php echo $row['concentracion'] ?></td>
                    <td><?php echo $row['presentacion'] ?></td>                       
                    <td><?php echo $row['fechaCad'] ?></td>                        
                    <td><?php echo $row['cantidad'] ?></td>   
                     <!-- el bloque de codigo hasta la linea 103 permite evaluar la diferencia de meses entre dos fechas y colorea un boton de acuerdo a la fecha introducida , si la diferencia de fechas es mayor a un año se colorea en verde, si es menor a 6 meses se colorea en amarillo , si es menor a 5 meses se colorea en rojo -->
                    <?php 
                    $fecha_actual = date('d-m-Y');
                    $fechaCaducida = $row['fechaCad'];
                    $fechainicial = new DateTime($fecha_actual);
                    $fechafinal = new DateTime($fechaCaducida);
                    $diferencia = $fechainicial->diff($fechafinal); 
                    $meses = ( $diferencia->y * 12 ) + $diferencia->m;                        
                    $verde= 12;
                    $rojo= 5;
                    $amarillo= 6;
                    switch( true )
                    {
                     case ( $meses <= $rojo || $fechafinal < $fechainicial) :
                     echo '   <td> <a class="btn btn-danger"  ></a></td>';
                     break;
                     case (  $meses <= $amarillo  ) :
                     echo '<td> <a class="btn btn-warning"  ></a></td>';
                     break;
                     case (  $meses >= $verde  ) :
                     echo '<td> <a class="btn btn-success"  ></a></td>';
                     break;
                     default:
                     echo "";
                   }?>
                   <td class="actions">
                     <div class="form-group text-center">
                      <a class="btn btn-primary" value="editar"  title="editar"href="editar-medicamento.php?id=<?php echo $row['id_medicamento']?>" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;                                                 
                      <a class="btn btn-danger" value="borrar"  title="eliminar" href="borrarmedicamentos.php?id=<?php echo $row['id_medicamento']?>" onclick="pulsar()"  ><i class="fa fa-trash"  aria-hidden="true"></i> </a>                          
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
<!-- patients23:19-->
</html>
<?php  }?>