	<?php
	require_once('conexion.php');
	$usuario = $contrasenia = $pwd = '';
	$usuario = $_POST['usuario'];
	$pwd = $_POST['contrasenia'];
	$contrasenia = MD5($pwd);//encripta la contraseña
	$sql = "SELECT * FROM usuario WHERE usuario='$usuario' AND contrasenia='$contrasenia'";//selecciona de la tabla usuario el campo usuario y el campo contrasenia
	$result = mysqli_query($link, $sql);
	if(!empty($result) AND mysqli_num_rows($result) > 0)//si al ejecutar el query los campos no estan vacios
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$id = $row["id_usuario"];}//identifica el id
			$usuario = $row["usuario"];//identifica el usuario
			session_start();//inicia la secion
			$_SESSION['id'] = $id;
			$_SESSION['usuario'] = $usuario;
		}
		header("Location: inicio.php");
	}
	else
	{
	echo "<script >alert('usuario no registrado');
		location.href = 'index.php';
		</script>  ";
	}
	?>

