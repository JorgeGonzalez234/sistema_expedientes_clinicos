<?php 
date_default_timezone_set("America/Mexico_City");//Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script
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
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Agregar medicamento</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- valida que solo se acepten numeros -->
    <script type="text/javascript">
      function solonumeros(e){
       var key, numeros, teclado, especiales, teclado_especial, i;
       key = event.keyCode || event.which;
       teclado = String.fromCharCode(key);
       numeros = '0123456789';
       especiales = [8,9,37,38,39,40,46]; 
       teclado_especial = false;
       for ( i in especiales ) {
        if ( key == especiales[i] ) {
          teclado_especial = true;
        }
      }
      if ( numeros.indexOf(teclado) == -1 && !teclado_especial ) {
        return false;
      }
    }
  </script>
  <!-- valida que solo se acepten numeros y letras -->
  <script type="text/javascript">
    function numeLetras(e){
     var key, numeros, teclado, especiales, teclado_especial, i;
     key = event.keyCode || event.which;
     teclado = String.fromCharCode(key).toLowerCase();
     numeros = " 0123456789áéíóúabcdefghijklmnñopqrstuvwxyz";
     especiales = [8,37,39,46]; 
     teclado_especial = false;
     for ( i in especiales ) {
      if ( key == especiales[i] ) {
        teclado_especial = true;
      }
    }
    if ( numeros.indexOf(teclado)   == -1 && !teclado_especial) {
      return false;
    }
  }
</script>
<!-- valida que solo se acepten letras -->
<script>
  function soloLetras(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
   especiales = "8-37-39-46";
   tecla_especial = false
   for(var i in especiales){
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
  }
  if(letras.indexOf(tecla)==-1 && !tecla_especial){
    return false;
  }
}
</script>
</head>
<body>
  <div class="main-wrapper">
   <?php include "navbar.php"; ?>
   <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <h4 class="page-title">Agregar medicamento</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <form action="funcionAgregarMedicamento.php"  method= "POST" >
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Lote </label>
                  <input class="form-control" type="text" name='lote' id="lote" onkeypress="return numeLetras(event)" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nombre</label>
                  <input class="form-control" type="text" name='nombrem' id='nombrem' required onkeypress="return soloLetras(event)">
                </div>
              </div>            
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Concentración</label>
                  <input type="text" class="form-control " name='concentracion' id='' required onkeypress="return numeLetras(event)" >
                </div>
              </div>            
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Presentación</label>
                  <input type="text" class="form-control " name='presentacion' id='concentracion' required   onkeypress="return soloLetras(event)">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Fecha de caducidad</label>
                  <input type="date"  id="fechaC" name="fechaC" class="form-control datepicker" required value="" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Stock inicial</label>
                  <input class="form-control" type="number"  name='stock' id='stock' required maxlength="4"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" / onkeypress="return solonumeros(event)"  >
                </div>               
              </div>
            </div>
            <div class="m-t-20 text-center">
             <input type="submit"   class="btn btn-primary"  name="crear"  id="crear" value="Crear"/>
           </div>          
         </form>                   
       </div>
     </div>
   </div>
 </div>
 <div class="sidebar-overlay" data-reff=""></div>
 <script src="assets/js/jquery-3.2.1.min.js"></script>
 <script src="assets/js/popper.min.js"></script>
 <script src="assets/js/bootstrap.min.js"></script>
 <script src="assets/js/jquery.slimscroll.js"></script>
 <script src="assets/js/select2.min.js"></script>
 <script src="assets/js/moment.min.js"></script>
 <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
 <script src="assets/js/app.js"></script>
</body>
</html>
<?php } ?>