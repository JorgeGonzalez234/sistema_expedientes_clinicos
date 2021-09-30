<?php
include ("conexion.php");
$busca1="";
$busca1=$_POST['busca1'];
if ($busca1!=""){
    $busqueda1="SELECT * FROM medicamentos WHERE nombrem LIKE '%".$busca1."%'";//selecciona dentro de la tabla medicamentos el campo nombrem y evalua si lo que se introduce dentro del input es igual a lo que se encuentra almacenado en el campo nombrem
    $result1 = mysqli_query($link, $busqueda1);
    while($r=mysqli_fetch_array($result1)){
        $nombrem = $r['nombrem'];
        $concentracion = $r['concentracion'];
        $presentacion = $r['presentacion'];
        $fechaCad = $r['fechaCad'];
        $cantidad = $r['cantidad'];
        $id_medicamento = $r['id_medicamento'];
    }
}
if($result1){
  header ("Location: agregar-consulta.php" ); 
}else{
}?>