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
  require 'conexion.php';
  // declaracion de variables
  $where="";
  $matricula=$_POST['matricula'];
  $carrera=$_POST['carrera'];
  $enfermedad=$_POST['enfermedad'];
  // declaracion de variables de tipo fecha
  $date1 = date("Y-m-d", strtotime($_POST['date1']));
  $date2 = date("Y-m-d", strtotime($_POST['date2']));
  if (isset($_POST['buscar']))
  {
    // evalua si ciertos campos estan vacios
    if (empty($_POST['matricula'])&&empty($_POST['carrera'])&&empty($_POST['date1'])&&empty($_POST['date2'])  )
    {
      // donde el dato almacenado dentro del campo enfermedad sea igual al dato introducido
      $where="where m.enfermedad like  '%".$enfermedad."%'";
    }
    else if (empty($_POST['carrera'])&&empty($_POST['enfermedad'])&&empty($_POST['date1'])&&empty($_POST['date2'])  )
    {
     $where="where p.matricula like  '%".$matricula."%'";
   }
   elseif (empty($_POST['matricula'])&&empty($_POST['enfermedad'])&&empty($_POST['date1'])&&empty($_POST['date2'])  )
   {
    $where="where p.carrera like  '".$carrera."'";
  }
  elseif (empty($_POST['matricula'])&&empty($_POST['enfermedad'])&&empty($_POST['carrera']))
  {
    $where="where m.fecha_consulta   BETWEEN '$date1' AND '$date2'";//donde las fechas se encuentren dentro del rango elegido 
  }
  else
  {
   $where="where p.matricula like '%".$matricula."%' and p.carrera like'".$carrera."' and m.enfermedad  like '".$enfermedad."' and m.fecha_consulta like  '".$fecha1."'   and m.fecha_consulta   BETWEEN '$date1' AND '$date2'";
 }
}
?>    
<!DOCTYPE html>
<html lang="es">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
<title>Reportes pacientes</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<head>
</head>
<body>
  <div class="main-wrapper">
    <?php include "navbar.php"; ?>
    <div class="page-wrapper">
      <div class="content">
       <div class="row">
        <div class="col-sm-4 col-3">
          <h4 class="page-title">Reporte de pacientes</h4>
        </div>
      </div>  
      <div class="row">
       <div class="col-sm-12 ">
        <form method="post">
         <div class="row">
          <div class="col-sm-4">
           <div class="form-group">
             <label></label>
             <input class="form-control" type="text"   name="matricula" placeholder="Matricula" >
             <?php 
             $sql="SELECT * FROM afiliados group by carrera";//selecciona los datos almacenados en el campo carrera de la tabla afiliados y agrupa los que sean semejantes
             $resultado = mysqli_query($link,$sql);
             ?>
           </div>
         </div>
         <div class="col-sm-4">
          <div class="form-group">
            <label></label>
            <select class="select"  name="carrera">
              <option value="0" disabled selected>Carrera</option>
              <?php  while ($ver=mysqli_fetch_row($resultado)) { ?>
                <option value=<?php echo $ver[4]; ?> > <?php echo $ver[4]; ?> </option> 
              <?php } ?>
            </select>
          </div>
        </div>
        <?php 
        $sql1="SELECT * FROM consultas group by enfermedad";//selecciona los datos almacenados en el campo enfemedad de la tabla consultas y agrupa los que sean semejantes
        $resultad = mysqli_query($link,$sql1);
        ?>
        <div class="col-sm-4">
          <div class="form-group">
            <label></label>
            <select class="select" name="enfermedad" >
              <option value="0" disabled selected>Enfermedad</option>
              <?php  while ($ver=mysqli_fetch_row($resultad)) { ?>
                <option value=<?php echo $ver[9]; ?> > <?php echo $ver[9]; ?> </option> 
              <?php } ?>
            </select>
          </div>
        </div>
        <?php 
        $sq="SELECT * FROM consultas";//selecciona los registros de la tabla consultas
        $resulta = mysqli_query($link,$sq);
        ?>
        <div class="col-sm-1 ">
          <div class="form-group form-focus">
           <label class="focus-label"> desde</label>                     
         </div>
       </div>
       <div class="col-sm-3 ">
        <input type="date" class="form-control" placeholder="Start"  name="date1"/>      </div>
        <div class="col-sm-1">
          <div class="form-group form-focus">
            <label class="focus-label"> hasta</label>                     
          </div>
        </div>
        <div class="col-sm-3 ">
          <input type="date" class="form-control" placeholder="End"  name="date2"/>         </div>
          <div class="col-sm-4 ">
            <input type="submit" value="buscar" name="buscar"   class="btn btn-primary"  > 
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row"> 
   <div class="table-responsive">  
     <table id="mitabla" class="table table-striped table-bordered table-hover  " cellspacing="0"  width="100%">
      <thead >
        <tr>
         <th>Matricula</th>
         <th>Nombre</th>
         <th>Carrera</th>
         <th>Enfermedad</th>
         <th>Fecha Consulta</th>
         <th>Atendio</th>
       </tr>
     </thead>
     <tbody>
      <?php 
      $sql = mysqli_query($link,"SELECT p.matricula, p.nombre, p.carrera,
        m.enfermedad, m.fecha_consulta, m.id_usuario FROM afiliados p 
        INNER JOIN consultas m on p.id_afiliado = m.id_afiliado $where");//selecciona los campos correspondientes de las tablas afiliados y consultas por medio de inner join
      while($row = mysqli_fetch_array($sql)){
        $dos = $row['id_usuario'];
        $uno = $row['id_afiliado'];
        $sql2 = mysqli_query($link,"SELECT * FROM afiliados WHERE id_afiliado = $uno $where");//selecciona de la tabla afiliados el campo id y evalua si se cumplen las condiciones dentro de la variable where
        $sql3=mysqli_query($link, "SELECT * FROM `consultas` WHERE `fecha_consulta` BETWEEN '$date1' AND '$date2' $where") ;//selecciona de la tabla consultas el campo fecha_consulta y evalua el rango de fechas elegidas
        ?>
        <tr>
          <td><?php echo $row['matricula'] ?></td>
          <td><?php echo $row['nombre'] ?></td>
          <td><?php echo $row['carrera'] ?></td>
          <?php 
          $sql3 = mysqli_query($link,"SELECT * FROM usuario WHERE id_usuario = $dos ");//selecciona de la tabla usuario el campo id  
          $row3 = mysqli_fetch_array($sql3);
          ?>
          <td><?php echo $row['enfermedad'] ?></td>
          <td><?php echo $row['fecha_consulta'] ?></td>
          <td><?php echo $row3['nombre'] ?></td>
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
     dom: 'Blfrtip',
     buttons:  [{
      extend:    'excelHtml5',
      text:      '<i class="fa fa-file-excel-o "></i>',
      titleAttr: 'Excel'
    },
    {
      extend:    'pdfHtml5',
      text:      '<i class="fa fa-file-pdf-o"></i>',
      titleAttr: 'PDF'
    }
    ],
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
<script src="assets/js/buttons/buttons.html5.min.js"></script>
<script src="assets/js/buttons/dataTables.buttons.min"></script>
<script src="assets/js/buttons/jszip.min.js"></script>
<script src="assets/js/buttons/pdfmake.min.js"></script>
<script src="assets/js/buttons/vfs_fonts.js"></script>
</body>
<!-- patients23:19-->
</html>
<?php  }?>