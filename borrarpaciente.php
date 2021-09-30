<?php
include ("conexion.php");
if (isset($_GET['id'])){//verifica que la variable id este definida 
	$id = $_GET['id'];
	$query = "DELETE FROM afiliados WHERE id_afiliado =$id";//borra dentro de la tabla afiliados el registro con el id que se haya seleccionado anteriormente 
	$result = mysqli_query($link,$query);
	if (!$result){
		die("fallo");
	}	
	header("Location: pacientes.php");//si la consulta a sido ejecutada correctamente regresa a la pantalla de pacientes
}
?>