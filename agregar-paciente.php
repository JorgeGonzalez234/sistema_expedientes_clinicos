<?php 
   session_start();
?>
<?php

  date_default_timezone_set("America/Mexico_City");//Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script
  error_reporting(0);
  require_once('conexion.php');
  $id = $_SESSION['id'];
  if ($id == null){
    header ("Location: index.php" );
  }else{
    ?><!DOCTYPE html >
    <html lang="es">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
      <title>Agregar paciente</title>
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <script type="text/javascript">
          function mostrarReferencia(){
            if (document.fcontacto.tipoAfiliado[1].checked == true) {
          //muestra (cambiando la propiedad display del estilo) el div con id 'desdeotro'
          document.getElementById('personal').style.display='block';
          document.getElementById('alumno').style.display='none';
          //por el contrario, si no esta seleccionada
        } else {
          //oculta el div con id 'desdeotro'
          document.getElementById('personal').style.display='none';
          document.getElementById('alumno').style.display='block';
        }
      }
    </script>  
      <!-- valida que solo se acepten numeros -->
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
  <!-- valida que solo se acepten numeros y letras -->
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
<!-- valida que se se acepten numeros guiones signo de mas y parentesis -->
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
<!-- valida que solo se acepten letras -->
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
<script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>   
<!-- calcula la edad a partir de los datos introducidos en un input de tipo fecha , en este caso la fecha de nacimiento  -->
<script>
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
</script>
<!-- valida que  que se acepten numeros y las letras k ,g en este caso para expresar los kilogramos -->
  <script>
    function validarpeso(e){
      tecla = (document.all) ? e.keyCode : e.which;
      tecla = String.fromCharCode(tecla)
      return /^[0-9\ kg]+$/.test(tecla);
    }
  </script>
  <!-- valida que solo se acepten numeros y el punto en este caso para expresar la estatura -->
  <script>
    function validarestatura(e){
      var key, numeros, teclado, especiales, teclado_especial, i;
      key = event.keyCode || event.which;
      teclado = String.fromCharCode(key);
      numeros = '.0123456789';
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
  <!-- valida que solo se acepten numeros  y los caracteres  ADMDOCDIR -->
  <script>
    function matrPersonal(e){
      tecla = (document.all) ? e.keyCode : e.which;
      tecla = String.fromCharCode(tecla)
      return /^[ADMDOCDIR\u00C0-\u00DC\-0-9]+$/.test(tecla);     
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
          <h4 class="page-title">Agregar paciente</h4>
        </div>
      </div>
      <div class="row">
       <div class="col-lg-8 offset-lg-2">
         <form action="agregarPacientesfuncion.php" method="post" name="fcontacto">
           <div class="row">
            <div class="col-sm-6">
              <div class="form-check-inline">
                <label class="form-check-label">
                 <input type="radio" name="tipoAfiliado" value="alumno" class="form-check-input" id="Conocido_1" onclick="mostrarReferencia()"   required >Alumno
               </label>
             </div>
             <div id="alumno">
               <div class="col-sm-12">
                <div class="form-group">
                  <label>Matrícula <span class="text"></span></label>
                  <input class="form-control" type="text" name="matricula" id="matricula" maxlength="8"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" / onkeypress="return solonumeros(event)"  title="este campo debe tener maximo 8 caracteres" />
                </div>
              </div>
              <div class="col-sm-12 >
                <div class="form-group form-focus select-focus>
                  <label class="focus-label">Sistema</label>
                  <select class="select floating" name="sistema" >
                   <option value="">Opciones</option>
                   <option value="escolarizado">Escolarizado</option>
                   <option value="semiescolarizado">Semiescolarizado</option>
                 </select>
               </div>
               <div class="col-sm-12 >
                <div class="form-group form-focus select-focus>
                  <label class="focus-label">Carrera</label>
                  <select class="select floating"  name="carrera">
                   <option value="">Opciones</option>
                   <option value="Forestal">Ing. Forestal</option>
                   <option value="Informática">Ing. Informática</option>
                   <option value="Alimentarias">Ing. Industrias alimentarias</option>
                   <option value="Industrial">Ing. Industrial</option>
                   <option value="Electromecanica">Ing. Electromecanica</option>
                   <option value="Gestión empresarial">Gestión empresarial</option>
                   <option value="Energias renovables">Energias renovables</option>
                 </select>
               </div>
             </div>
           </div>
           <div class="col-sm-6">
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio"  onclick="mostrarReferencia()"  value="personal" name="tipoAfiliado" id="Conocido_0" class="form-check-input"  >Personal
              </label>
            </div>
            <br>
            <div class="row"  id="personal">
             <div class="col-sm-12 >
              <div class="form-group form-focus select-focus">
                <label class="focus-label"></label>
                <select class="select floating" name="tipoP">
                  <option value="">Opciones</option>
                  <option value="adm">ADM</option>
                  <option value="doc">DOC</option>
                  <option value="dir">DIR</option>
                </select>
                <br>
                <br>
                <br>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>No de control <span class="text"></span></label>
                    <input class="form-control" type="text"  id="Nocontrol" name="Nocontrol" title="el formato para este campo es ejemplo:  ADM-1234" maxlength="9"  onkeypress="return matrPersonal(event)">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <h1 class="page-title"><p class="text-black">Datos generales</p></h1>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" type="text" id="nombre" name="nombre" type="text" name="nombre"   Required value=""  title=" procure no intruducir caracteres extraños" onkeypress="return soloLetras(event)">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Apellidos</label>
                <input class="form-control" type="text" id="apellidos" name="apellidos" Required value="" title="procure no intruducir caracteres extraños" onkeypress="return soloLetras(event)">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group gender-select">
                <label class="gen-label">Género</label>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" name="gender" class="form-check-input" value="hombre" >Hombre
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" name="gender" class="form-check-input" value="mujer" >Mujer
                  </label>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Peso</label>
                <input class="form-control" type="text" id="peso" name="peso" maxlength="7" title="el formato para este campo es ejemplo: 70 kg" value="" onkeypress="return validarpeso(event)" >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Estatura</label>
                <input class="form-control" type="text" id="estatura"  maxlength="5" name="estatura"  title="puede utilizar decimales " oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" / onkeypress="return validarestatura(event)"   >
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control " name="direccion"  id="direccion" onkeypress="return numeLetras(event)" >
              </div>
            </div>
           <div class="col-sm-6">
      <div class="form-group">
        <label>Fecha de nacimiento</label>
        
          <input type="date"  id="fechaN" name="fechaN" class="form-control datepicker" Required value="" >
      
      </div>
    </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Edad</label>
                <input class="form-control" type="text" name="edad"  id="edad"  value="" disabled>
              </div>
            </div> 
            <div class="col-sm-6">
              <div class="form-group">
                <label>Correo electrónico</label>
                <input class="form-control" type="email"  name="mail" id="mail" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" title="escriba su correo electronico en un formato valido " />
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <!-- el atributo pattern en este caso valida que se introduzca un formato valido para curp  -->
                <label>CURP</label>
                <input type="text" class="form-control " id="curp" name="curp"   maxlength="18"  Required title="introduzca la CURP  en el formato correcto" pattern="([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[A-Z]{3}[0-9A-Z]\d)" >
              </div>
            </div>            
            <div class="col-sm-6">
              <div class="form-group">
                <label>NSS</label>
                <!-- el atributo  oninput en este caso valida que solo se acepte un cierto numero de caracteres -->
                <input type="number" class="form-control "  id="nss_input"  maxlength="11"     name="nss"  id="resultado" pattern="/^(\d{2})(\d{2})(\d{2})\d{5}$/"   oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" / onkeypress="return solonumeros(event)"  >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Teléfono </label>
                <input class="form-control" type="text" name="telefono" maxlength="15" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"    id="telefono"  onkeypress="return numtel1(event)" >
              </div>
            </div>
            <div class="col-sm-6 >
              <div class="form-group form-focus select-focus >
                <label class="focus-label">Tipo de sangre</label>
                <select class="select floating" name="sangre" >
                 <option value="">Opciones</option>
                 <option value="A+">A+</option>
                 <option value="A-">A-</option>
                 <option value="O+">O+</option>
                 <option value="O-">O-</option>
                 <option value="B+">B+</option>
                 <option value="B-">B-</option>
                 <option value="AB+">AB+</option>
                 <option value="AB-">AB-</option>
               </select>
             </div>
             <div class="col-md-12">
               <div class="form-group">
                <label>Alergias </label>
                <textarea rows="4" cols="5" class="form-control" name="alergias" id="alergias"  value="alergias" onkeypress="return soloLetras(event)"></textarea>
              </div>
            </div>
            <div class="col-md-12">
             <div class="form-group">
              <label>Enfermedades </label>
              <textarea rows="4" cols="5" class="form-control" name="enfermedades"  id="enfermedades" value="enfermedades" onkeypress="return soloLetras(event)"></textarea>
            </div>
          </div>
          <div class="col-md-12">
           <div class="form-group">
            <label>Antescedentes </label>
            <textarea rows="4" cols="5" class="form-control" name="antescedentes" id="antescedentes" value="antescedentes" onkeypress="return soloLetras(event)"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="m-t-20 text-center">
     <input type="submit"   class="btn btn-primary"  name="crear"  id="crear" value="Crear"/>
   </div>
 </form>
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
</html>
<?php } ?>