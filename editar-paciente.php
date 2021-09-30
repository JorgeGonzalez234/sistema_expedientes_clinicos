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
 if (isset($_GET['id'])){
  $id = $_GET['id'];
  $query = "SELECT * FROM afiliados WHERE id_afiliado = $id";//selecciona el id dentro de la tabla afiliados
  $result = mysqli_query($link, $query);
  if (mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_array($result);//declara las variable necesarias
    $matricula = $row['matricula'];  
    $tipoAfiliado = $row['tipoAfiliado'];
    $sistema = $row ['sistema'];
    $carrera = $row ['carrera'];
    $tipoP = $row ['tipoP'];
    $nombre = $row['nombre'];
    $apellidos = $row['apellidos'];
    $gender = $row['gender'];
    $direccion = $row['direccion'];
    $mail = $row['correo'];
    $curp = $row['curp'];
    $nss = $row['nss'];
    $fechaN = $row['fechaN'];
    $telefono = $row['telefono'];
    $sangre = $row['sangre'];
    $alergias = $row['alergias'];
    $enfermedades = $row['enfermedades'];
    $antescedentes = $row['antescedentes'];
    $estatura = $row['estatura'];
    $peso = $row['peso'];
    $id_afiliado = $row['id_afiliado'];
  }
}
if (isset($_POST['guardar'])){//si la variable guardar esta definida
  $id = $_GET['id'];
  $matricula = $row['matricula'];  
  $tipoAfiliado = $row['tipoAfiliado'];
  $sistema = $row ['sistema'];
  $carrera = $row ['carrera'];
  $tipoP = $row ['tipoP'];
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $gender = $_POST['gender'];
  $direccion = $_POST['direccion'];
  $mail = $_POST['mail'];
  $curp = $_POST['curp'];
  $nss = $_POST['nss'];
  $fechaN = $_POST['fechaN'];
  $telefono = $_POST['telefono'];
  $sangre = $_POST['sangre'];
  $alergias = $_POST['alergias'];
  $enfermedades = $_POST['enfermedades'];
  $antescedentes = $_POST['antescedentes'];
  $estatura = $_POST['estatura'];
  $peso = $_POST['peso'];
  $query = "UPDATE afiliados set matricula='$matricula',tipoAfiliado = '$tipoAfiliado', sistema='$sistema',carrera='$carrera',tipoP='$tipoP', nombre = '$nombre', apellidos = '$apellidos', gender = '$gender',direccion = '$direccion', correo= '$mail', curp = '$curp' , nss = '$nss', fechaN = '$fechaN', telefono = '$telefono', sangre = '$sangre', alergias = '$alergias' , enfermedades= '$enfermedades',antescedentes ='$antescedentes' ,estatura='$estatura',peso='$peso' WHERE id_afiliado = $id" ;//actualiza los registros de la tabla afiliados
  mysqli_query($link, $query);
  if($query){
   echo "<script> alert('Registro actualizado con exito');
   location.href = 'pacientes.php';
   </script>";
 }else{
  echo "<script> alert('incorrecto');
  location.href = 'editar-paciente.php';
  </script>";
}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
  <title>Editar paciente</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <script type="text/javascript" src="assets/js/jquery-3.4.1.js">  </script>
        </script>
        <script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>   
        <!-- calcula la edad a partir de los datos introducidos en un input de tipo date -->
        <script>
          $(document).ready( function(){
            $(function(){
              $('#fechaN').on('change', calcularEdad);
            });           
            function calcularEdad() {
              fecha = $(this).val();
              var hoy = new Date();
              var cumpleanos = new Date(fecha);
              var edad = hoy.getFullYear() - cumpleanos.getFullYear();
              var m = hoy.getMonth() - cumpleanos.getMonth();
              if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                edad--;
              }
              $('#edad').val(edad); 
            }
          });
        </script>
        <!-- evalua que solo se hayan introducido numeros -->
        <script type="text/javascript">
          function solonumeros(e){
           var key, numeros, teclado, especiales, teclado_especial, i;
           key = event.keyCode || event.which;
           teclado = String.fromCharCode(key);
           numeros = '0123456789';
           especiales = [8,9,37,38,39,40,46]; 
           teclado_especial = false;
           for ( i in especiales ) {
            if ( key == especiales[i] ) {
              teclado_especial = true;
            }
          }
          if ( numeros.indexOf(teclado) == -1 && !teclado_especial ) {
            return false;
          }
        }
      </script>
      <!-- evalua que que introduzcan solo numeros, guiones -->
      <script>
        function validartel(e){
          tecla = (document.all) ? e.keyCode : e.which;
          tecla = String.fromCharCode(tecla)
          return /^[0-9\-]+$/.test(tecla);
        }
      </script>
      <!-- evalua que solo se introduzcan letras -->
      <script>
        function soloLetras(e){
         key = e.keyCode || e.which;
         tecla = String.fromCharCode(key).toLowerCase();
         letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
         especiales = "8-37-39-46";
         tecla_especial = false
         for(var i in especiales){
          if(key == especiales[i]){
            tecla_especial = true;
            break;
          }
        }
        if(letras.indexOf(tecla)==-1 && !tecla_especial){
          return false;
        }
      }
    </script>
    <!-- evalua que solo se introduzcan numeros y las letras kg en este caso para expresar el pesos  -->
    <script>
      function validarpeso(e){
        tecla = (document.all) ? e.keyCode : e.which;
        tecla = String.fromCharCode(tecla)
        return /^[0-9\ kg]+$/.test(tecla);
      }
    </script>
    <!-- evalua que solo se hayan introducido numeros y el punto decimal , en este caso para expresar el peso  -->
    <script>
      function validarestatura(e){
        tecla = (document.all) ? e.keyCode : e.which;
        tecla = String.fromCharCode(tecla)
        return /^[0-9\.]+$/.test(tecla);
      }
    </script>
    <!-- evalua que solo se hayan introducido numero, signo de mas y parentesis en este caso para el formato de telefono  -->
    <script type="text/javascript">
      function numtel1(e){
       var key, numeros, teclado, especiales, teclado_especial, i;
       key = event.keyCode || event.which;
       teclado = String.fromCharCode(key).toLowerCase();
       numeros = " +)(-0123456789";
       especiales = [8,37,39,46]; 
       teclado_especial = false;
       for ( i in especiales ) {
        if ( key == especiales[i] ) {
          teclado_especial = true;
        }
      }
      if ( numeros.indexOf(teclado)   == -1 && !teclado_especial) {
        return false;
      }
    }
  </script>
  <!-- evalua que solo se hayan introducido numeros y letras -->
  <script type="text/javascript">
    function numeLetras(e){
     var key, numeros, teclado, especiales, teclado_especial, i;
     key = event.keyCode || event.which;
     teclado = String.fromCharCode(key).toLowerCase();
     numeros = " 0123456789áéíóúabcdefghijklmnñopqrstuvwxyz";
     especiales = [8,37,39,46]; 
     teclado_especial = false;
     for ( i in especiales ) {
      if ( key == especiales[i] ) {
        teclado_especial = true;
      }
    }
    if ( numeros.indexOf(teclado)   == -1 && !teclado_especial) {
      return false;
    }
  }
</script>
</head>
<body>
  <div class="main-wrapper">
    <?php include "navbar.php"; ?>
    <div class="page-wrapper">
     <div class="content">
       <div class="row">
         <div class="col-lg-8 offset-lg-2">
          <h4 class="page-title">Editar paciente</h4>
        </div>
      </div>
      <div class="row">
       <div class="col-lg-8 offset-lg-2">
         <form action="editar-paciente.php?id=<?php echo $_GET['id']; ?>" method="post" >
           <div class="row">
            <div class="col-sm-6">
              <div class="form-check-inline">
                <label class="form-check-label">
                 <input type="radio" name="tipoAfiliado" value="alumno" class="form-check-input" id="Conocido_1" disabled  <?php  if($tipoAfiliado=='alumno')
                 {
                   echo "checked";
                 }
                 ?>>Alumno
               </label>
             </div>
             <div id="alumno">
              <?php
              if($tipoAfiliado == 'alumno'){?>
               <div class="col-sm-12">
                <div class="form-group">
                  <label>matricula <span class="text"></span></label>
                  <input class="form-control" type="text"  id="matricula" name="matricula"   value="<?php echo $matricula; ?>"  disabled>
                </div>
              </div>
            <?php }?>
            <div class="col-sm-12 >
              <div class="form-group form-focus select-focus>
                <label class="focus-label">Sistema</label>
                <select class="select floating" name="sistema"  disabled>
                 <option value="">Opciones</option>

                 <option value="escolarizado"<?php 
                 if($sistema=='escolarizado')
                 { echo "selected"; }
                 ?>>Escolarizado </option>
                 <option value="semiescolarizado" <?php 
                 if($sistema=='semiescolarizado')
                 {echo "selected";}
                 ?>>Semiescolarizado</option>
               </select>
             </div>
             <div class="col-sm-12 >
              <div class="form-group form-focus select-focus>
                <label class="focus-label">Carrera</label>
                <select class="select floating"  name="carrera" disabled>
                  <option value="">Opciones</option>

                  <option id="forestal"<?php 
                  if($carrera=='forestal')
                  {  echo "selected";}
                 ?>>Ing. Forestal</option>
                 <option value="informatica"<?php 
                 if($carrera=='informatica')
                 {   echo "selected"; }
                 ?>>Ing. Informática</option>
                 <option value="alimentarias"<?php 
                 if($carrera=='alimentarias')
                 {   echo "selected"; }
                 ?>>Ing. Industrias alimentarias</option>
                 <option value="industrial"<?php 
                 if($carrera=='industrial')
                 {    echo "selected";  }
                 ?>>Ing. Industrial</option>
                 <option value="electromecanica"<?php 
                 if($carrera=='electromecanica')
                 {   echo "selected"; }
                 ?>>Ing. Electromecanica</option>
                 <option value="gestion"<?php 
                 if($carrera=='gestion')
                 {   echo "selected"; }
                 ?>>Gestión empresarial</option>
                 <option value="energias"<?php 
                 if($carrera=='energias')
                 {     echo "selected";   }
                 ?>>Energias renovables</option>
               </select>
             </div>
           </div>
         </div>
         <div class="col-sm-6">
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio"  onclick="mostrarReferencia()"  disabled name="tipoAfiliado" id="Conocido_0" class="form-check-input" value="personal"  <?php  if($tipoAfiliado=='personal')
              {    echo "checked";  }
             ?>>personal
           </label>
         </div>
         <br>
         <div class="row"  id="docente">
           <div class="col-sm-12 >
            <div class="form-group form-focus select-focus">
              <label class="focus-label"></label>
              <select class="select floating" name="tipoP" disabled>
                <option value="">Opciones</option>
                <option value="adm"  <?php 
                if($tipoP=='adm'){
                  echo "selected";
               }
               ?>>ADM</option>
               <option value="doc"<?php 
               if($tipoP=='doc'){
                 echo "selected";
               }
               ?>>DOC</option>
               <option value="dir"<?php 
               if($tipoP=='dir'){
                 echo "selected";
               }
               ?>>DIR</option>
             </select>
             <br>
             <br>
             <br>
             <?php
             if($tipoAfiliado == 'personal'){?>
               <div class="col-sm-12">
                <div class="form-group">
                  <label>No de control<span class="text"></span></label>
                  <input class="form-control" type="text"  id="Nocontrol" name="Nocontrol"   value="<?php echo $matricula; ?>"  disabled>
                </div>
              </div>
            <?php }?>
          </div>
        </div>
      </div>
      <h1 class="page-title"><p class="text-black">Datos generales</p></h1>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Nombre</label>
            <input class="form-control" type="text" id="nombre" name="nombre"   value="<?php echo $nombre; ?>"  onkeypress="return soloLetras(event)">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Apellidos</label>
            <input class="form-control" type="text" id="apellidos" name="apellidos"  value="<?php echo $apellidos; ?>"  onkeypress="return soloLetras(event)">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group gender-select">
            <label class="gen-label">Género:</label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" name="gender" class="form-check-input" value="hombre" 
                <?php 
                if($gender=='hombre')
                {
                 echo "checked";
               }
               ?> >Hombre
             </label>
           </div>
           <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" name="gender" class="form-check-input" value="mujer"  <?php 
              if($gender=='mujer')
              {
               echo "checked";
             }
             ?>>Mujer
           </label>
         </div>
       </div>
     </div>
     <div class="col-sm-6">
      <div class="form-group">
        <label>Peso</label>
        <input class="form-control" type="text" id="peso" name="peso" maxlength="7" value="<?php echo $peso; ?>" onkeypress="return validarpeso(event)" title="el formato para este campo es ejemplo: 70 kg" >
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>Estatura</label>
        <input class="form-control" type="text" id="estatura" name="estatura" value="<?php echo $estatura; ?>"  maxlength="5" title="puede usar numeros decimales" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" / onkeypress="return validarestatura(event)"    >
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        <label>Dirección</label>
        <input type="text" class="form-control " name="direccion"  id="direccion"  value="<?php echo $direccion; ?>" onkeypress="return numeLetras(event)">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>Fecha de nacimiento</label>
        
        <input type="date"  id="fechaN" name="fechaN" class="form-control datepicker" value="<?php echo $fechaN; ?>" >

      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        <!-- calcula la edad a partir de una fecha introducida , en este caso la fecha de nacimiento -->
        <?php
        $ss = "SELECT TIMESTAMPDIFF(YEAR,FechaN,CURDATE()) AS edad FROM afiliados where id_afiliado= ".$id_afiliado;
        $resu = mysqli_query($link, $ss);
        $pp=mysqli_fetch_array($resu);
        ?>
        <label>Edad</label>
        <input class="form-control" type="text" name="edad" id="edad"  value="<?php echo $pp[0];?>" disabled>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>Correo electrónico</label>
        <input class="form-control" type="e-mail"  name="mail" id="mail"  value="<?php echo $mail; ?>" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" title="escriba su correo electronico en un formato valido " >
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <!-- el atributo pattern evalua que so introduzca una curp en el formato correcto  -->
        <label>CURP</label>
        <input type="text" class="form-control " id="curp" name="curp"  value="<?php echo $curp; ?>"  pattern="([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[A-Z]{3}[0-9A-Z]\d)" maxlength="18"   title="introduzca la CURP  en el formato correcto">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>NSS</label>
        <input type="number" class="form-control " id="nss" name="nss" maxlength="11"  id="nss_input"  value="<?php echo $nss; ?>"  pattern="/^(\d{2})(\d{2})(\d{2})\d{5}$/"   oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" / onkeypress="return solonumeros(event)"  >
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>Teléfono </label>
        <input class="form-control" type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>"   maxlength="15"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /  id="telefono"  onkeypress="return numtel1(event)" >
      </div>
    </div>
    <div class="col-sm-6 >
      <div class="form-group form-focus select-focus >
        <label class="focus-label">Tipo de sangre</label>
        <select class="select floating" name="sangre"   >
          <option value="">Opciones</option>
          <option value="a+" <?php if($sangre=='a+')
          { echo "selected";   }
         ?>>A+</option>
         <option value="a-"<?php if($sangre=='a-')
         {     echo "selected";   }
         ?>>A-</option>
         <option value="o+"<?php if($sangre=='o+')
         {    echo "selected";  }
         ?>>O+</option>
         <option value="o-"<?php if($sangre=='o-')
         {    echo "selected";  }
         ?>>O-</option>
         <option value="b+"<?php if($sangre=='b+')
         {    echo "selected";  }
         ?>>B+</option>
         <option value="b-"<?php if($sangre=='b-')
         {    echo "selected";  }
         ?>>B-</option>
         <option value="ab+"<?php if($sangre=='ab+')
         {    echo "selected";  }
         ?>>AB+</option>
         <option value="ab-"<?php if($sangre=='ab-')
         {    echo "selected";  }
         ?>>AB-</option>
       </select>
     </div>
     <div class="col-md-12">
       <div class="form-group">
        <label>Alergias </label>
        <textarea rows="4" cols="5" class="form-control" name="alergias" id="alergias"  value="alergias" onkeypress="return soloLetras(event)"><?php echo $alergias; ?></textarea>
      </div>
    </div>
    <div class="col-md-12">
     <div class="form-group">
      <label>Enfermedades </label>
      <textarea rows="4" cols="5" class="form-control" name="enfermedades"  id="enfermedades" value="enfermedades" onkeypress="return soloLetras(event)"><?php echo $enfermedades; ?></textarea>
    </div>
  </div>
  <div class="col-md-12">
   <div class="form-group">
    <label>Antescedentes </label>
    <textarea rows="4" cols="5" class="form-control" name="antescedentes" id="antescedentes" value="antescedentes" onkeypress="return soloLetras(event)"><?php echo $antescedentes; ?></textarea>
  </div>
</div>
</div>
</div>
<div class="m-t-20 text-center">
 <input type="submit"   class="btn btn-primary"  name="guardar"  id="guardar" value="Guardar"/>
</div>
</form>
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
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html><?php } ?>