<?php
// se definen las variables  servidor, usuario,contraseña,y base de datos
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', 'X0ztALjyx6nX6zR7');
  define('DB_NAME', 'controlsalud');
  $link = mysqli_connect(DB_SERVER, DB_USERNAME,DB_PASSWORD,DB_NAME);// se realiza la conexion 
  if ($link === false) {
  	die ("error en la conexion" . mysqli_connect_error());
  }
?>