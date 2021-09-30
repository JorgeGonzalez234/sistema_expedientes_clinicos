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
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
  <title>Cambiar contraseña</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
  <div class="main-wrapper">      
   <?php include "navbarConfig.php"; ?>
   <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <h4 class="page-title">Cambiar contraseña</h4>
          <?php
    if(isset($_SESSION['id'])) { // comprobamos que la sesión esté iniciada
      if(isset($_POST['enviar'])){
        $usuario_clave = md5($_POST["usuario_clave"]);//se encripta la contraseña con md5
        function validar_clave($usuario_clave,&$error_clave){
         if(strlen($usuario_clave) < 8){ //si el numero de caracteres introducidos es menos a ocho enviara un mensaje notificando que la contraseña es muy corta
          echo "<script> alert('La contraseña es muy corta ');
          location.href = 'cambiar-contrasena.php';
          </script>";
          return false;
        }
        if(strlen($usuario_clave) > 15){//si el numero de caracteres introducidos es mayor a quince enviara un mensaj notificando que la contraseña es muy larga 
         echo "<script> alert('la contraseña es muy larga');
         location.href = 'cambiar-contrasena.php';
         </script>";
         return false;
       }
       if (!preg_match('`[a-z]`',$usuario_clave)){// si solo se han introducido letras minusculas se envia un mensaje notificando que la contraseña no es segura 
         echo  "<script> alert('La contraseña no es segura');
         location.href = 'cambiar-contrasena.php';
         </script>";
         return false;
       }
       if (!preg_match('`[A-Z]`',$usuario_clave)){//si solo se han introducido letras mayusculas se envia un mensaje notificando que la contraseña es insegura
        echo  "<script> alert('La contraseña no es segura');
        location.href = 'cambiar-contrasena.php';
        </script>";
        return false;
      }
      if (!preg_match('`[0-9]`',$usuario_clave)){// si solo se han introducido numeros se envia un mensaje de contraseña insegura 
        echo "<script> alert('La contraseña no es segura');
        location.href = 'cambiar-contrasena.php';
        </script>";
        return false;
      }
      $error_clave = "";
      return true;
    }if ($_POST){
     $error_encontrado="";
     if (validar_clave($_POST["usuario_clave"], $error_encontrado)){
      if($_POST['usuario_clave'] != $_POST['usuario_clave_conf']) {// si las contraseñas introducidas son diferentes se envia un mensaje de contraseñas que no coinciden
        echo "Las contraseñas ingresadas no coinciden. <a href='javascript:history.back();'>Reintentar</a>";
      }else {
        $usuario_nombre = $_SESSION['id'];               
        $usuario_clave = mysqli_real_escape_string($link,$_POST["usuario_clave"]); // se declara la variable usuario_clave
                $usuario_clave = md5($usuario_clave); // encriptamos la nueva contraseña con md5              
                $sql = "UPDATE usuario SET contrasenia='$usuario_clave' WHERE id_usuario=$usuario_nombre";// se actualiza la contraseña
                mysqli_query($link, $sql);
                if($sql) {     //si el script es ejecutado correctamente se actualiza la contraseña              
                 echo "<script> alert('la contraseña se actualizó con exito');
                 location.href = 'index.php';
                 </script>";
               }else {
                 echo "<script> alert('error no se pudo actualizar la contraseña');
                 location.href = 'cambiar-contrasena.php';
                 </script>";                
               }
             }
           }
           else{
            echo "PASSWORD NO VÁLIDO: " . $error_encontrado;
          }
        }
      }
      else {
        ?>     
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nueva contraseña</label>
                <input type="password" class="form-control" name="usuario_clave" maxlength="15"   title="Letras ,números y al menos una mayuscula, Tamaño mínimo: 8. Tamaño máximo: 15" required >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>confirmar contraseña</label>
                <input type="password" class="form-control newPass"    name="usuario_clave_conf" maxlength="15" required >
              </div>
            </div>
            <div class="col-sm-12 text-center m-t-20">
              <button type="submit" class="btn btn-primary btnChangePass"   name="enviar" >Actualizar contraseña</button>
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
<script src="assets/js/app.js"></script>
</body>
</html>
<?php
}
}else {
  echo "Acceso denegado.";
}?>
<?php }?>