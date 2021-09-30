  <?php 
  date_default_timezone_set("America/Mexico_City");
  error_reporting(0);
  require_once('conexion.php');
  session_start();
  $id = $_SESSION['id'];
  if ($id == null){
    header ("Location: index.php" );
  }else{
   if (isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM usuario WHERE id_usuario = $id";//selecciona el id dentro de la tabla usuario
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 1){
      $row = mysqli_fetch_array($result);
      $nombre = $row['nombre'];
      $apellidos= $row['apellidos'];
      $genero = $row['genero'];
      $telefono = $row['telefono'];
      $correo = $row['correo'];
      $direccion = $row['direccion'];
      $usuario = $row['usuario'];
    }
  }
  if (isset($_POST['guardar'])){
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $apellidos= $_POST['apellidos'];
    $genero = $_POST['gender'];
    $telefono = $_POST['telefono'];    
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $usuario = $_POST['usuario'];   
    $query = "UPDATE usuario set  nombre= '$nombre', apellidos ='$apellidos', genero= '$genero',   telefono = '$telefono' , correo = '$correo', direccion = '$direccion' , usuario = '$usuario' WHERE id_usuario = $id" ;//actualiza los registros dentro de la tabla usuario
    mysqli_query($link, $query);
    echo "<script> alert('Registro actualizado con exito');
    location.href = 'usuario.php';
    </script>";
  }?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Editar usuario</title>
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
              <h4 class="page-title">editar usuario</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form action ="editar-usuario.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <div class="row">

                 <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" type="text" name="nombre"  value="<?php echo $nombre; ?>"  onkeypress="return soloLetras(event) " >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Apellidos</label>
                    <input class="form-control" type="text" name="apellidos" value="<?php echo $apellidos; ?>" onkeypress="return soloLetras(event) " >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group gender-select">
                    <label class="gen-label">Género:</label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="gender" class="form-check-input" value="hombre" 
                        <?php 
                        if($genero=='hombre')
                        {
                         echo "checked"; }?> >Hombre                            
                       </label>
                     </div>
                     <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="gender"   value="mujer" class="form-check-input" <?php 
                        if($genero=='mujer')
                        {
                         echo "checked"; }?> >mujer 
                       </label>
                     </div>
                   </div>
                 </div>                     
                 <div class="col-sm-6">
                  <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" class="form-control " name="usuario" value="<?php echo $usuario; ?>" pattern="^([a-z]+[0-9]{0,2}){5,15}$" maxlength="15"  titlte="el nombre de usuario puede contener letras y numeros al menos 5 caracteres">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Teléfono</label>
                    <input class="form-control" type="text"  name="telefono" value="<?php echo $telefono; ?>" maxlength="15"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /  onkeypress="return numtel1(event) ">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Correo</label>
                    <input type="text" class="form-control " name="correo" value="<?php echo $correo; ?>" title="escriba un formato valido de correo "  pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" >
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" class="form-control " name="direccion" value="<?php echo $direccion; ?>" onkeypress="return numeLetras(event)"  >
                  </div>
                </div>      
              </div>
              <div class="m-t-20 text-center">
               <input type="submit"   name="guardar" class="btn btn-primary" value="Guardar"/>
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
