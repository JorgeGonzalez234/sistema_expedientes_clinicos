<?php 
 session_start();
?>
<?php
 date_default_timezone_set("America/Mexico_City");
 error_reporting(0);
 require_once('conexion.php');
 $id = $_SESSION['id'];
 if ($id == null){
    header ("Location: index.php" );
}else{    
  if($resultado = mysqli_query($link, "SELECT * FROM datosgenerales WHERE id_datos = id_datos", MYSQLI_USE_RESULT)) {//selecciona dentro de la tabla datosgenerales el id
   $formulario = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Configuraciones</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="main-wrapper">
        <?php include "navbarConfig.php"; ?>
        <div class="page-wrapper">
            <div class="content">
             <div class="row">
                <div class="col-sm-4 col-3">                
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form action="editar_datos_institucion.php" class="formulario" method="post"  >                     
                       <h3 class="page-title">Datos de la institución</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nombre de la institución </label>
                                    <input class="form-control" id="nombreInstitucion" type="text" disabled style="background-color:transparent;" name="nombreInstitucion" value="<?php echo $formulario['nombreInstitucion']?>" >
                                </div>
                            </div>                           
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" id="direccion" type="text" disabled style="background-color:transparent;" name="direccion" value="<?php echo $formulario['direccion']?>">
                                </div>
                            </div>                           
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Ciudad</label>
                                    <input class="form-control" id="ciudad" type="text" disabled style="background-color:transparent;" name="ciudad" value="<?php echo $formulario['ciudad']?>"> 
                                </div>
                           </div>                          
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label>Código postal</label>
                                    <input class="form-control" id="codigopostal" type="text" disabled style="background-color:transparent;" name="codigopostal" value="<?php echo $formulario['codigopostal']?>" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email </label>
                                    <input class="form-control"  type="email" disabled style="background-color:transparent;" id="correo"  name="correo" value="<?php echo $formulario['correo']?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input class="form-control" id="telefono" type="text" disabled style="background-color:transparent;" name="telefono" value="<?php echo $formulario['telefono']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">                         
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input class="form-control" id="fax" type="text" disabled style="background-color:transparent;" name="fax" value="<?php echo $formulario['fax']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Sitio web</label>
                                    <input class="form-control" id="sitioweb" type="text" disabled style="background-color:transparent;"  name="sitioweb" value="<?php echo $formulario['sitioweb']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 col-9 text-right m-b-20">
                            <a href="editar_datos_institucion.php" class="btn btn btn-primary" role="button" ></i> Actualizar datos</a>
                        </div> 
                    </form>
                </div>
            </div>
        </div>       
    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
<?php  }?>