  <?php 
  session_start();
  ?>
  <?php
  require_once('conexion.php');
  error_reporting(0);
  $id = $_SESSION['id'];
  if ($id == null){
    header ("Location: index.php" );
  }else{
    ?>
    <!DOCTYPE html>
    <html lang="es" >
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
      <title>Inicio</title>        
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <style type="text/css">
        .colorear { 
          background-image: linear-gradient(
           rgba(0, 0, 0, 0.3),
           rgba(0, 0, 0, 0.3)
           ),
          url(assets/img/1.webp); 
          loading="lazy";
          background-size: cover;
          height: auto;
          max-width: 100%;
        }
      </style>
      <style>
        h1 { color: #FFFFFF; }
      </style>
    </head>
    <body class="colorear" >
      <div class="main-wrapper">   
       <?php include "navbar.php"; ?>    
     </div>
   </div>
 </div>
 <script src="assets/js/jquery-3.2.1.min.js"></script>
 <script src="assets/js/popper.min.js"></script>
 <script src="assets/js/bootstrap.min.js"></script>
 <script src="assets/js/jquery.slimscroll.js"></script>
 <script src="assets/js/select2.min.js"></script>
 <script src="assets/js/app.js"></script>
</body>
</html>
<?php } ?>