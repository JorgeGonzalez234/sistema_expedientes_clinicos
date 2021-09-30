<?php
require 'conexion.php';
$lote = $_POST["lote"];
$nombrem  = $_POST["nombrem"];
$concentracion = $_POST["concentracion"];
$presentacion= $_POST["presentacion"];
$fechaC= $_POST["fechaC"];
$stock= $_POST["stock"];
$insertar = "INSERT INTO medicamentos(lote,nombrem,concentracion,presentacion,fechaCad,cantidad) VALUES ('$lote','$nombrem','$concentracion','$presentacion','$fechaC','$stock') ";//inserta los registro correspondientes dentro de la tabla medicamentos 
$query = mysqli_query($link, $insertar);
if($query){
	echo "<script> alert('el registro a sido agregado con exito');
	location.href = 'medicamentos.php';
	</script>";
}else{
	echo "<script> alert('error');
	location.href = 'agregar-medicamento.php';
	</script>";
}
?>