<?php 
date_default_timezone_set("America/Mexico_City");//Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script
error_reporting(0);
require_once('conexion.php');//invoca a la 
session_start();
$id = $_SESSION['id'];
if ($id == null){
  header ("Location: index.php" );
}else{
  include ("conexion.php");
  if (isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM medicamentos WHERE id_medicamento = $id";//seleccciona de la tabla medicamentos el id
    $result = mysqli_query($link, $query);//realiza la conexion
    if (mysqli_num_rows($result) == 1){
      $row = mysqli_fetch_array($result);//declara las variables correspondientes
      $lote = $row['lote'];
      $nombrem= $row['nombrem'];
      $concentracion = $row['concentracion'];
      $presentacion = $row['presentacion'];
      $fechaC = $row['fechaCad'];
      $stock = $row['cantidad'];
    }
  }
  if (isset($_POST['guardar'])){//evalua si la variable guardar esta definida 
    $id = $_GET['id'];
    $lote = $_POST['lote'];
    $nombrem= $_POST['nombrem'];
    $concentracion = $_POST['concentracion'];
    $presentacion = $_POST['presentacion'];
    $fechaC = $_POST['fechaC'];
    $stock = $_POST['stock'];       
    $query = "UPDATE medicamentos set  lote= '$lote', nombrem ='$nombrem', concentracion= '$concentracion', presentacion = '$presentacion', fechaCad = '$fechaC', cantidad = '$stock' WHERE id_medicamento = $id" ;//actualiza los datos dentro de la tabla medicamentos
    mysqli_query($link, $query);
    echo "<script> alert('Registro actualizado con exito');
    location.href = 'medicamentos.php';
    </script>";
  }
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Editar medicamento</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- valida que solo se hayan introducido numeros -->
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
<!-- valida que solo se hayan introducido numeros y letras -->
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
<!-- valida que solo se hayan introducido letras -->
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
            <h4 class="page-title">Editar medicamento</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 offset-lg-2">
           <form action ="editar-medicamento.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Lote </label>
                  <input class="form-control" type="number"  name='lote' value="<?php echo $lote; ?>" onkeypress="return numeLetras(event)">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nombre</label>
                  <input class="form-control" type="text" name='nombrem'  value="<?php echo $nombrem; ?>"  onkeypress="return soloLetras(event)">
                </div>
              </div>                           
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Concentración</label>
                  <input type="text" class="form-control " name='concentracion' value="<?php echo $concentracion; ?>"    onkeypress="return numeLetras(event)"  >
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Presentación</label>
                  <input type="text" class="form-control " name='presentacion' id='concentracion'    onkeypress="return soloLetras(event)"  value="<?php echo $presentacion; ?>" >
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Fecha de caducidad</label>
                  <input type="date"  id="fechaC" name="fechaC" class="form-control datepicker" value="<?php echo $fechaC; ?>" >
                </div>
              </div>                 
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Stock inicial</label>
                  <input class="form-control" type="text"  value="<?php echo $stock; ?>"  name="stock"    maxlength="4"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" / onkeypress="return solonumeros(event)"  >
                </div>
              </div>
            </div>
            <div class="m-t-20 text-center">
             <input type="submit"   name="guardar" class="btn btn-primary" value="Guardar"/>
           </div>  
         </div>                   
       </form>                           
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
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
<?php } ?>