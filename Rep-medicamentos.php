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
    <title>Reportes medicamentos</title>
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
</head>
<body>
    <div class="main-wrapper">
        <?php include "navbar.php"; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12 col-4">
                        <h4 class="page-title">Reporte de medicamentos</h4>
                    </div>
                </div>               
                <div class="row">                   
                    <div class="table-responsive">                       
                        <table id="mitabla" class="table table-striped table-bordered table-hover  " cellspacing="0" width="100%">
                            <thead >
                                <tr>
                                    <th>lote</th>
                                    <th>Nombre</th>
                                    <th>Concentración</th>                                    
                                    <th>Presentación</th>
                                    <th>fecha de caducidad</th>
                                    <th>Stock</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                               <?php 
                                $query = "SELECT * FROM medicamentos";//selecciona los campos dentro de la tabla medicamentos
                                $result_task = mysqli_query($link,$query);
                                while($row = mysqli_fetch_array($result_task)) {?>
                                   <tr>
                                    <td><?php echo $row['lote'] ?></td>
                                    <td><?php echo $row['nombrem'] ?></td>
                                    <td><?php echo $row['concentracion'] ?></td>
                                    <td><?php echo $row['presentacion'] ?></td>                                   
                                    <td><?php echo $row['fechaCad'] ?></td>                                   
                                    <td><?php echo $row['cantidad'] ?></td> 
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
</html>
<?php  }?>