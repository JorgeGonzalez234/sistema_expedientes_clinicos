<?php
include ("conexion.php");
if (isset($_GET['id'])){//verifica que  la variable id este definida
	$id = $_GET['id'];
	$query = "DELETE FROM consultas WHERE id_consulta =$id";//borra dentro de la tabla consultas el registro con el id que se haya seleccionado anteriormente 
	$result = mysqli_query($link,$query);
	if (!result){
		die("fallo");
	}	
	header("Location: consultas.php"); //si la consulta a sido ejecutada correctamente regresa a la pantalla de consultas 
}
?>
