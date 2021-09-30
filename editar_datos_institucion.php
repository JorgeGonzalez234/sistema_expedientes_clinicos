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
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Editar datos institucion</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    </head>
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
  <script>
    function validar(e){
      tecla = (document.all) ? e.keyCode : e.which;
      tecla = String.fromCharCode(tecla)
      return /^[0-9\-]+$/.test(tecla);
    }
  </script>
  <script>
    function validar1(e){
      tecla = (document.all) ? e.keyCode : e.which;
      tecla = String.fromCharCode(tecla)
      return /^[0-9]+$/.test(tecla);
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
<body>
  <div class="main-wrapper">
   <?php include "navbarConfig.php"; ?>
    <div class="page-wrapper">
      <div class="content">
       <div class="row">
        <div class="col-sm-4 col-3">
        </div>
        <?php include 'conexion.php';
        $query = "SELECT * FROM datosgenerales WHERE id_datos = id_datos";
        $result = mysqli_query($link, $query); 
        while ($filas=mysqli_fetch_assoc($result)) {
         ?>
       </div>
       <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <form action ="editar_datos_institucion.php" method="POST">
            <h3 class="page-title">Datos de la institución</h3>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Nombre de la institución </label>
                  <input class="form-control" id="nombreInstitucion" type="text"   name="nombreInstitucion"  value="<?php echo $filas['nombreInstitucion']; ?>" onkeypress="return soloLetras(event)" >
                </div>
              </div>            
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Dirección</label>
                  <input class="form-control" id="direccion" type="text"  name="direccion" value="<?php echo $filas['direccion']; ?>"  onkeypress="return numeLetras(event)" >
                </div>
              </div>
              <div class="col-sm-6 ">
                <div class="form-group">
                  <label>Ciudad</label>
                  <input class="form-control" id="ciudad" type="text"  name="ciudad" value="<?php echo $filas['ciudad']; ?>" onkeypress="return soloLetras(event)"> 
                </div>
              </div>
              <div class="col-sm-6 ">
                <div class="form-group">
                  <label>Código postal</label>
                  <input class="form-control" id="codigopostal" type="text"  name="codigopostal" value="<?php echo $filas['codigopostal']; ?>" onkeypress="return validar1(event)"  maxlength="8">
                </div>
              </div>                            
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email </label>
                  <input class="form-control"  type="email"  id="email"  name="correo" value="<?php echo $filas['correo']; ?>"    title="escriba un formato valido de correo "  pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" title="Letras ,números y al menos una mayuscula, Tamaño mínimo: 8. Tamaño máximo: 15"  > 
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Teléfono</label>
                  <input class="form-control" id="telefono" type="text"  name="telefono" maxlength="15" value="<?php echo $filas['telefono']; ?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="return numtel1(event)" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Fax</label>
                  <input class="form-control" id="fax" type="text"  name="fax" value="<?php echo $filas['fax']; ?>" onkeypress="return validar(event)"  >
                </div>
              </div>                          
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Sitio web</label>
                  <input class="form-control" id="sitioweb" type="text"   name="sitioweb" value="<?php echo $filas['sitioweb']; ?>" >
                </div>
              </div>              
            </div>
            <div class="m-t-20 text-center">
             <input type="submit"   name="guardar" class="btn btn-primary" value="Guardar"/>
           </div>          
         </div>
       </form>
     </div>
   <?php } ?>
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
<script src="assets/js/app.js"></script>
</body>
</html>
<?php
if (isset($_POST['guardar'])){
  $nombreInstitucion = $_POST['nombreInstitucion']; 
  $direccion= $_POST['direccion'];
  $ciudad = $_POST['ciudad'];
  $codigopostal = $_POST['codigopostal'];
  $correo = $_POST['correo'];
  $telefono = $_POST['telefono'];
  $fax = $_POST['fax'];
  $sitioweb = $_POST['sitioweb'];  
  $query = "UPDATE datosgenerales  set  nombreInstitucion= '$nombreInstitucion', direccion ='$direccion', ciudad= '$ciudad', codigopostal = '$codigopostal', correo = '$correo', telefono = '$telefono', fax = '$fax', sitioweb = '$sitioweb'  WHERE id_datos = id_datos";
  mysqli_query($link, $query);
  if($query){
    echo "<script> alert('Los datos se han actualizado correctamente');
    location.href = 'configuraciones.php';
    </script>";
  }else{
    echo "<script> alert('incorrecto');
    location.href = 'editar_Datos_institucion.php';
    </script>";
  }
}
?>
<?php } ?>


