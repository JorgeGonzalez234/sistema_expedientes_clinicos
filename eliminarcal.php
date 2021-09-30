<?php
include_once ("conexion.php");
if (isset($_GET['id'])){
	$id = $_GET['id'];
	$query = "DELETE FROM mis_eventos WHERE id =$id";//elimina el registro con el id del campo seleccionado anteriormente
	$result = mysqli_query($link,$query);
	if (!$result){
		die("fallo");
	}
	header("Location: calendario.php");
}
?>
