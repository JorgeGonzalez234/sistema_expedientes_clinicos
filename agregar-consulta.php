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
    // se declaran dos variables para ser usadas posteriormente en los cuadros de busqueda de los registros
    $busca="";
    $busca=$_POST['busca'];
    $busca1="";
    $busca1=$_POST['busca1'];
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
      <title>Agregar consulta</title>
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <script type="text/javascript" src="assets/js/jquery-3.4.1.js">  </script>
      <!-- valida que solo se acepten numeros y diagonal -->
      <script>
        function validar2(e){
          tecla = (document.all) ? e.keyCode : e.which;
          tecla = String.fromCharCode(tecla)
          return /^[0-9\ /]+$/.test(tecla);
        }
      </script>
      <!-- valida que solo se acepte el signo de grados y numeros -->
      <script>
        function validar3(e){
          tecla = (document.all) ? e.keyCode : e.which;
          tecla = String.fromCharCode(tecla)
          return /^[0-9\ ° \  C]+$/.test(tecla);
        }
      </script>
      <!-- vaida que solo se acepten numeros y guion -->
      <script>
        function validar4(e){
          tecla = (document.all) ? e.keyCode : e.which;
          tecla = String.fromCharCode(tecla)
          return /^[0-9\-]+$/.test(tecla);
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
  </head>
  <body>
    <div class="main-wrapper">
      <?php include "navbar.php"; ?>
      <div class="page-wrapper">
        <div class="content">
         <div class="row">
          <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Nueva consulta</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 offset-lg-2">
           <form method="POST"   action ="agregar-consulta.php" >
            <div class="row">
              <div class="row filter-row">
                <div class="col-sm-6 ">
                  <div class="form-group form-focus" >
                    <label class="focus-label" required>id Paciente</label>
                    <?php
                    if($busca!=""){
                      ?>
                      <input type="text" class="form-control floating"  name="busca"  id="busca" value="<?php echo $busca;?>"   >
                      <?php
                    }else{
                      ?>
                      <input type="text" class="form-control floating"  name="busca"  id="busca" >

                      <?php
                    }
                    ?>
                  </div>
                </div>
                <div class="col-sm-6 ">
                  <input type="submit" value="buscar" name="buscar"   class="btn btn-primary"  > 
                </div>
              </div>
              <div class="row">
               <div class="row">
                <?php
                if ($busca!=""){
                  ?>
                  <input type="hidden" name="busca1" id="busca1" value="<?php echo $busca1;?>">
                  <?php
                  $busqueda="SELECT * FROM afiliados WHERE matricula LIKE '%".$busca."%'"; //busca en el campo matricula dentro de la base de datos palabras semejantes a las que se introducen
                  $result = mysqli_query($link, $busqueda);
                  while($f=mysqli_fetch_array($result)){
                    $nombre = $f['nombre'];
                    $apellidos = $f['apellidos'];
                    $sexo = $f['gender'];
                    $peso = $f['peso'];
                    $estatura = $f['estatura'];
                    $id_afiliado = $f['id_afiliado'];

                  }
                }
                ?>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nombre de paciente</label>
                    <input class="form-control" type="text" value="<?php echo $nombre; ?>" name="nombre" disabled required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Apellidos</label>
                    <input class="form-control" type="text"  value=" <?php echo $apellidos; ?> " name=apellidos disabled>
                  </div>
                </div>
                <?php
                if($sexo == ''){    
                  ?>
                  <div class="col-sm-6">
                    <div class="form-group gender-select">
                      <label class="gen-label">Género:</label>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" name="gender" class="form-check-input" value=hombre disabled>Hombre
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" name="gender" class="form-check-input" value="mujer" disabled>Mujer
                        </label>
                      </div>
                    </div>
                  </div>
                  <?php
                }
                else{
                  if($sexo == 'mujer'){
                    ?>
                    <div class="col-sm-6">
                      <div class="form-group gender-select">
                        <label class="gen-label">Género:</label>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" name="gender" class="form-check-input" value="hombre" disabled>Hombre
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" name="gender" class="form-check-input" disabled checked="checked" value="mujer">Mujer
                          </label>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                  else{
                    ?> 
                    <div class="col-sm-6">
                      <div class="form-group gender-select">
                        <label class="gen-label">Género:</label>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" name="gender" class="form-check-input"  disabled checked="checked" value="hombre">Hombre
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" name="gender" class="form-check-input" value=mujer disabled>Mujer
                          </label>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                }
                ?>
                <div class="col-sm-6">
                  <div class="form-group">
                    <?php                           
                    $ss = "SELECT TIMESTAMPDIFF(YEAR,FechaN,CURDATE()) AS edad FROM afiliados where id_afiliado= ".$id_afiliado;//esta consulta permite calcular la edad a partir de un registro de fecha en este caso la fecha de nacimiento 
                    $resu = mysqli_query($link, $ss);
                    $pp=mysqli_fetch_array($resu);
                    ?>
                    <label>Edad</label>
                    <input class="form-control" type="text" name="edad" id="edad"  value="<?php echo $pp[0];?>" disabled>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Peso</label>
                    <input class="form-control" type="text"  value=" <?php echo $peso; ?> " disabled >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>estatura</label>
                    <input class="form-control" type="text"   value=" <?php echo $estatura; ?> " disabled>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <form method="POST"   action ="agregar-consulta.php" >
          <input type="hidden" name="busca" id="busca" value="<?php echo $busca;?>">
          <div class="row">
            <div class="row filter-row">
              <div class="col-sm-6 ">
                <div class="form-group form-focus">
                  <label class="focus-label">Medicamento </label>
                  <?php
                  if ($busca1!=""){
                    ?>
                    <input type="text" class="form-control floating"  name="busca1"  id="busca1" value="<?php echo $busca1;?>">
                    <?php
                  }else{
                    ?>
                    <input type="text" class="form-control floating"  name="busca1"  id="busca1">
                    <?php
                  }
                  ?>
                </div>
              </div>
              <div class="col-sm-6 ">
                <input type="submit" value="buscar" name="buscar1"   class="btn btn-primary"> 
              </div>
            </div>
          </div>
          <div class="row">

            <?php
            if ($busca1!=""){
              $busqueda1="SELECT * FROM medicamentos WHERE nombrem LIKE '%".$busca1."%'";//busca dentro de la base de datos en la tabla medicamentos resultados semejantes a los que se encuentran dentro del campo nombrem
              $result1 = mysqli_query($link, $busqueda1);
              while($r=mysqli_fetch_array($result1)){
                $nombrem = $r['nombrem'];
                $concentracion = $r['concentracion'];
                $presentacion = $r['presentacion'];
                $fechaCad = $r['fechaCad'];
                $id_medicamento = $r['id_medicamento'];
              }
            }  ?>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nombre de medicamento</label>
                <input class="form-control" type="text" disabled value="<?php echo $nombrem; ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Concentración</label>
                <input class="form-control" type="text" disabled value=" <?php echo $concentracion; ?> " >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Presentación</label>
                <input class="form-control" type="text" disabled  value=" <?php echo $presentacion; ?> " >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Fecha de caducidad</label>
                <div >
                  <input type="date"  id="fechaCad" name="fechaCad" class="form-control datepicker"   disabled value="<?php echo $fechaCad; ?>" >
                </div>
              </div>
            </div>

          </div></form>       
          <form action="guardarConsulta.php" method="post">
            <div class="row">
             <?php 
             $id = $_SESSION['id'];
             $query = "SELECT * FROM usuario where id_usuario='$id'"; //selecciona dentro de la base de datos en la tabla usuario el id del usuario 
             $result = mysqli_query($link,$query);
             while($row2 = mysqli_fetch_array($result))
              {?>
               <input type="hidden" name="id_usuario" value="<?php echo $row2['id_usuario'] ?>">
             <?php   }?>  
             <h1 class="page-title"><p class="text-dark">Datos generales</p></h1>
             <input type="hidden" name="id_afiliado" value="<?php echo $id_afiliado;?>">
             <input type="hidden" name="id_medicamento" value="<?php echo $id_medicamento;?>">
           </div>
           <div class="row">             
             <?php
             $anio = date('d-m-Y');                                       
             ?>
             <div class="col-sm-6">
              <div class="form-group">
                <label>Fecha de consulta</label>

                <input type="text" class="form-control datepicker" name="fecha_consulta" value="<?php echo $anio;?>" disabled>

              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Hora</label>
                <?php
                $time= date('H:i:s');
                ?>
                <input class="form-control"   type="time"  name="hora" value="<?php echo $time;?>"  disabled id="hora">
              </div>
            </div>
            <div class="col-sm-6">
             <div class="form-group">
               <label>Presión</label>
               <!-- el atributo oninput en este caso valida que dentro del campo se acepte solo cierto numero de caracteres -->
               <input class="form-control" type="text" name="presion" maxlength="7" title=" utilize diagonales para expresar la presión ejemplo : 70/100"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" / onkeypress="return validar2(event)" > 
             </div>
           </div>                  <div class="col-sm-6">
             <div class="form-group">
               <label>Temperatura</label>
               <input class="form-control" type="text" name="temperatura" maxlength="6" title=" exprese la temperatura en el siguente formato ejemplo : 35 °C"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" / onkeypress="return validar3(event)">
             </div>
           </div>
           <div class="col-sm-6">
             <div class="form-group">
               <label>Frecuencia cardiaca</label>
               <input class="form-control" type="text"name="frecCardiaca"  maxlength="8" title=" exprese la temperatura en el siguente formato ejemplo : 35 °C"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" / onkeypress="return validar4(event)">
             </div>
           </div>
           <div class="col-sm-6">
             <div class="form-group">
               <label>Frecuencia respiratoria</label > 
               <input class="form-control" type="text" name="frecR"  maxlength="8" title=" exprese la temperatura en el siguente formato ejemplo : 35 °C"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /  onkeypress="return validar4(event)">
             </div>
           </div>
           <div class="col-sm-12 >
            <div class="form-group form-focus select-focus>
              <label class="focus-label">Enfermedad</label>
              <select class="select floating"  name="enfermedad" required>
               <option value="">Opciones</option>
               <option value="Revision">Revision</option>
               <option value="Diarrea">Diarrea</option>
               <option value="Dolor de cabeza">Dolor de cabeza</option>
               <option value="Fiebre">Fiebre</option>
               <option value="Tos">Tos</option>
               <option value="Herida">Herida</option>
               <option value="Gripe">Gripe</option>
               <option value="Nauseas">Nauseas</option>
               <option value="Alergia">Alergia</option>
               <option value="Dolor de muela">Dolor de muela</option>
               <option value="Hipertension">Hipertension</option>
               <option value="Colitis">Colitis</option>
               <option value="Dolor de estomago">Dolor de estomago</option>
               <option value="Mareo">Mareo</option>
               <option value="Dolor muscular">Dolor muscular</option>
               <option value="Colico">Colico</option>
               <option value="Irritacion de Ojos">Irritacion de ojos</option>
               <option value="Gastritis">Gastritis</option>
             </select>
           </div>
           <div class="col-md-12">
            <div class="form-group">
             <label>Indicaciones </label>
             <textarea rows="4" cols="5" class="form-control" name="indicaciones" value="indicaciones" onkeypress="return numeLetras(event)"></textarea>
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
</html>
<?php } ?>