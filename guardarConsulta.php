<?php
require 'conexion.php';
$id_afiliado = $_POST['id_afiliado'];
$id_medicamento = $_POST['id_medicamento'];
date_default_timezone_set("America/Mexico_City");//establece la zona horaria por defecto 
$fecha_consulta =date("Y-m-d ");
date_default_timezone_set("America/Mexico_City");
$hora =date("H:i:s");
$presion = $_POST["presion"];
$temperatura =$_POST["temperatura"];
$frecCardiaca =$_POST["frecCardiaca"];
$frecR =$_POST["frecR"];
$enfermedad =$_POST["enfermedad"];
$indicaciones = $_POST["indicaciones"];
$id_usuario = $_POST["id_usuario"];
$insertar = "INSERT INTO consultas (id_afiliado,id_medicamento,fecha_consulta,hora,presion,temperatura,frecCardiaca,frecR,enfermedad,indicaciones,id_usuario) VALUES ('$id_afiliado','$id_medicamento','$fecha_consulta','$hora','$presion','$temperatura','$frecCardiaca','$frecR','$enfermedad','$indicaciones','$id_usuario') ";//inserta dentro de la tabla consultas los registros correspondientes
$query = mysqli_query($link, $insertar);
if($query){
	echo "<script> alert('l registro a sido guardado con exito');
	location.href = 'consultas.php';
	</script>";
}else{
	echo "<script> alert('error');
	location.href = 'agregar-consulta.php';
	</script>";
}
?>
