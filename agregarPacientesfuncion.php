<?php
require 'conexion.php';
// se declaran todas las variables necesariAS
$matricula= $_POST["matricula"];
$tipoAfiliado= $_POST["tipoAfiliado"];
$sistema= $_POST["sistema"];
$carrera= $_POST["carrera"];
$tipoP= $_POST["tipoP"];
$Nocontrol= $_POST["Nocontrol"];
$nombre= $_POST["nombre"];
$apellidos= $_POST["apellidos"];
$gender= $_POST["gender"];
$direccion= $_POST["direccion"];
$mail= $_POST["mail"];
$curp= $_POST["curp"];
$nss= $_POST["nss"];
$fechaN= $_POST["fechaN"];
$telefono= $_POST["telefono"];
$sangre= $_POST["sangre"];
$alergias= $_POST["alergias"];
$enfermedades= $_POST["enfermedades"];
$antescedentes= $_POST["antescedentes"];
$estatura= $_POST["estatura"];
$peso= $_POST["peso"];
if(isset($_POST["alumno"]) ) { //evalua si la variable esta definida
} else {
}
if ($matricula==""){ //si matricula a sido seleccionada almacenara los datos que se registren dentro de los input sistema y carrera
	$control = $Nocontrol;
	$sistema="";
	$carrera="";	
}else{ //en caso contrario almacena los datos que se registren en el campo tipop que en este caso es para almacenar la matricula del personal de la institucion 
	$control = $matricula;
	$tipoP= "";
}
$insertar = "INSERT INTO afiliados(matricula,tipoAfiliado,sistema,carrera,tipoP,nombre,apellidos,gender,direccion,correo,curp,nss,fechaN,telefono,sangre,alergias,enfermedades,antescedentes,estatura,peso) VALUES ('$control','$tipoAfiliado','$sistema','$carrera','$tipoP','$nombre','$apellidos','$gender','$direccion','$mail','$curp','$nss','$fechaN','$telefono','$sangre','$alergias','$enfermedades','$antescedentes', '$estatura','$peso')"; //inserta dentro de la base de datos todos los campos correspondientes
$query = mysqli_query($link, $insertar);
if($query){ //si el query a sido ejecutado correctamente almacena los datos 
	echo "<script> alert('el registro a sido agregado con exito');
	location.href = 'pacientes.php';
	</script>";
}else{ //en caso contrario envia un mensaje de error 
	echo "<script> alert('error');
	location.href = 'agregar-paciente.php';
	</script>";
}?>