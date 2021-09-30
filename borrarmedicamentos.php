<?php
include ('conexion.php');
if (isset($_GET['id'])){//verifica que la variable id este definida 
	$id = $_GET['id'];
	$query = "DELETE FROM medicamentos WHERE id_medicamento =$id";//borra dentro de la tabla medicamentos el registro con el id que se haya seleccionado anteriormente 
	$resultado= mysqli_query($link,$query);
	if (!$resultado){
		die("fallo");
	}	
	header('Location: medicamentos.php');//si la consulta a sido ejecutada correctamente regresa a la pantalla de medicamentos
}?>