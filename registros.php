<?php
require 'conexion.php';
$nombre  = $_POST["nombre"];
$apellidos  = $_POST["apellidos"];
$genero = $_POST["genero"];
$telefono = $_POST["telefono"];
$correo= $_POST["correo"];
$direccion= $_POST["direccion"];
$contrasenia = md5($_POST["contrasenia"]);
$usuario= $_POST["usuario"];
// esta funcion evalua que el numero de caracteres introducidos dentro del input de contraseña sea mayor de ocho caracteres. menor de 15, si se introdujeron mayusculas , minusculas y numeros, cuando todas las condiciones han sido cumplidas se almacena el dato 
function validar_clave($contrasenia,&$error_clave){
	if(strlen($contrasenia) < 8){
		echo "<script> alert('La contraseña no es segura');
		location.href = 'agregar-usuario.php';
		</script>";
		return false;
	}
	if(strlen($contrasenia) > 15){
		echo "<script> alert('La contraseña no es segura');
		location.href = 'agregar-usuario.php';
		</script>";
		return false;
	}
	if (!preg_match('`[a-z]`',$contrasenia)){
		echo "<script> alert('La contraseña no es segura');
		location.href = 'agregar-usuario.php';
		</script>";
		return false;
	}
	if (!preg_match('`[A-Z]`',$contrasenia)){
		echo "<script> alert('La contraseña no es segura');
		location.href = 'agregar-usuario.php';
		</script>";
		return false;
	}
	if (!preg_match('`[0-9]`',$contrasenia)){
		echo "<script> alert('La contraseña no es segura');
		location.href = 'agregar-usuario.php';
		</script>";
		return false;
	}
	$error_clave = "";
	return true;
}
if ($_POST){
	$error_encontrado="";
	if (validar_clave($_POST["contrasenia"], $error_encontrado)){
		$nuevo_usuario=mysqli_query($link, "select * from usuario where usuario='$usuario'");//selecciona el campo usuario dentro de la tabla usuario
		if(mysqli_num_rows($nuevo_usuario)>0)//si el usuario ya existe se envia un mensaje notificando que ya a sido registrado 
		{
			echo "<script> alert('este usuario ya esta registrado');
			location.href = 'agregar-usuario.php';
			</script>";
		}
		else
		{
			$nuevo_email=mysqli_query($link,"select * from usuario where correo='$correo'");//selecciona dentro de la tabla usuario el campo correo 
			if(mysqli_num_rows($nuevo_email)>0)//si el correo ya a sido registrado envia un mensaje de error
			{
				echo "<script> alert('Esta direccion de correo ya esta registrada');
				location.href = 'agregar-usuario.php';
				</script>";
			}
			else
			{
				$insertar = "INSERT INTO usuario(nombre,apellidos,genero,telefono,correo,direccion,contrasenia,usuario) VALUES ('$nombre','$apellidos','$genero','$telefono','$correo','$direccion','$contrasenia','$usuario') ";//inserta los datos correspondientes dentro de la tabla usuario
				$query = mysqli_query($link, $insertar);
				if($query){
					echo "<script> alert('Usuario agregado con exito');
					location.href = 'usuario.php';
					</script>";
				}else{
					echo "<script> alert('incorrecto');
					location.href = 'agregar-usuario.php';
					</script>";

				}
			}
		}
	}else{
		echo "PASSWORD NO VÁLIDO: " . $error_encontrado;
	}
}
?>