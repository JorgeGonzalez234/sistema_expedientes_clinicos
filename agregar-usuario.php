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
  ?><!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Agregar usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="assets/css/strength.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/jquery-3.2.1.min.js"></script>
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
  <script type="text/javascript">
    function numtel1(e){
     var key, numeros, teclado, especiales, teclado_especial, i;
     key = event.keyCode || event.which;
     teclado = String.fromCharCode(key).toLowerCase();
     numeros = " +)(-0123456789";
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
</head>
<body>
  <div class="main-wrapper">
   <?php include "navbarConfig.php"; ?>
   <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <h4 class="page-title">Agregar usuario</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <form action="registros.php"  method= "POST" id="form_reg" >
            <div class="row">
             <div class="col-sm-6">
              <div class="form-group">
                <label>Nombre<span class="form-group"></span></label>
                <input class="form-control" type="text" name="nombre" id="nombre" required onkeypress="return soloLetras(event) " >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Apellidos</label>
                <input class="form-control" type="text" name="apellidos" id="apellidos"  onkeypress="return soloLetras(event) " required >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group gender-select">
                <label class="gen-label">Género:</label>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" name="genero"  id="gender" class="form-check-input" value=hombre  required>Hombre
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" name="genero"  id="gender" class="form-check-input" value=mujer>Mujer
                  </label>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Usuario</label>
                <input type="text" class="form-control " name="usuario" id="usuario" pattern="[a-zA-Z]((\.|_|-)?[a-zA-Z0-9]+){3}" maxlength="15"  titlte="el nombre de usuario puede contener letras y numeros al menos 5 caracteres"   required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Teléfono</label>
                <input class="form-control" type="text" name="telefono" maxlength="15"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /   onkeypress="return numtel1(event)" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Correo</label>
                <input type="email" class="form-control " name="correo" id="email" title="escriba un formato valido de correo "  pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"   required>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control " name="direccion" id="direccion" onkeypress="return numeLetras(event)"   >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Contraseña</label>
                <input type="password" class="form-control " name="contrasenia" id="contrasenna" maxlength="15"  required  value=""  title="Letras ,números, caracteres especiales y al menos una mayuscula, Tamaño mínimo: 8. Tamaño máximo: 15" />
              </div>
            </div>
          </div>
          <div class="m-t-20 text-center">
           <input type="submit"   class="btn btn-primary"  name="crear"      value="Crear"    value="Validar"/>
         </div>
       </form>
     </div>
   </div>
 </div>
</div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/strength.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
<script type="text/javascript" src="assets/js/validar.js"></script>
</html>
<?php } ?>