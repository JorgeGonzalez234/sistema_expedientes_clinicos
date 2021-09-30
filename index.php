<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css"> 
 <style type="text/css">
    .colorear { 
background-image: linear-gradient(
     rgba(0, 0, 0, 0.3),
      rgba(0, 0, 0, 0.3)
    ),
 url(assets/img/46.webp); 
loading="lazy";
background-size: cover;
height: auto;
max-width: 100%;
}
  </style>
</head>
<body  class="colorear"  >
  <div class="main-wrapper account-wrapper">
    <div class="account-page">
     <div class="account-center">
      <div class="account-box " >       
        <form action ="formUsuario.php" method="post">         
          <div class="account-logo">
            <img src="assets/img/logo.png" alt="">
          </div>
          <div class="form-group">
            <label>Usuario</label>
            <input type="text" autofocus="" class="form-control" id="usuario" pattern="[a-zA-Z]((\.|_|-)?[a-zA-Z0-9]+){3}" name="usuario" required>
          </div>
          <div class="form-group">
            <label>Contraseña</label>
            <input type="password" class="form-control" id="contrasenia" name="contrasenia" required  >           
          </div>                      
          <div class="form-group text-center">
           <input type="submit"   class="btn btn-primary" value="Ingresar"/>
         </div>   
       </form>
     </div>
   </div>
 </div>
</div>
</div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
<!-- login23:12-->
</html>
            