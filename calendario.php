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
	?>
	<?php
	$consulta_eventos = "SELECT id, titulo, color, inicio, fin FROM mis_eventos"; //selecciona dentro de la base de datos los campos id, color , inicio fin
	$resultado_eventos = mysqli_query($link, $consulta_eventos);
	?>
	<!DOCTYPE html>
	<html lang="es-es">
	<head>
		<meta charset='utf-8' />
		<title>Agenda Personal</title>	
		<link href='cal/css/fullcalendar.min.css' rel='stylesheet' />
		<link href='cal/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />	
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
		<title>Inicio</title>	
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<style type="text/css">
			body {
				margin: 0px 0px;
				padding: 0;
				font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
				font-size: 14px;
			}
		</style>
		<script src='cal/js/jquery.min.js'></script>
		<script src='cal/js/bootstrap.min.js'></script>
		<script src='cal/js/moment.min.js'></script>
		<script src='cal/js/fullcalendar.min.js'></script>	
		<script src='cal/locale/es-es.js'></script>
		<!-- permite convertir el idioma del calendario a español -->
		<script>
			...
			var calendar = new FullCalendar.Calendar(calendarEl, {
				locale: 'es'
			});
			...
		</script>
		<script>
			$(document).ready(function() {

				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					defaultDate: Date(),
					navLinks: true, // puede hacer clic en los nombres de día / semana para navegar por las vistas
					editable: true,
					eventLimit: true, // permitir el enlace "más" cuando hay demasiados eventos

					eventClick: function(event) {						
						$('#visualizar #id').text(event.id);
						$('#visualizar #title').text(event.title);
						$('#visualizar #start').text(event.start.format('DD/MM/YYYY '));
						$('#visualizar #end').text(event.end.format('DD/MM/YYYY '));
						$('#visualizar').modal('show');
						return false;
					},					
					selectable: true,
					selectHelper: true,
					select: function(start, end){
						$('#cadastrar #start').val(moment(start).format('DD/MM/YYYY '));
						$('#cadastrar #end').val(moment(end).format('DD/MM/YYYY '));
						$('#cadastrar').modal('show');						
					},
					events: [
					<?php
					while($registros_eventos = mysqli_fetch_array($resultado_eventos)){
						?>
						{
							id: '<?php echo $registros_eventos['id']; ?>',
							title: '<?php echo $registros_eventos['titulo']; ?>',
							start: '<?php echo $registros_eventos['inicio']; ?>',
							end: '<?php echo $registros_eventos['fin']; ?>',
							color: '<?php echo $registros_eventos['color']; ?>',
						},<?php
					}
					?>
					]
				});
			});		
			//Máscara para el campo de fecha y hora
			function DataHora(evento, objeto){
				var keypress=(window.event)?event.keyCode:evento.which;
				campo = eval (objeto);
				if (campo.value == '00/00/0000 '){
					campo.value=""
				}				
				caracteres = '0123456789';
				separacao1 = '/';
				separacao2 = ' ';
				separacao3 = ':';
				conjunto1 = 2;
				conjunto2 = 5;
				conjunto3 = 10;
				conjunto4 = 13;
				conjunto5 = 16;
				if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
					if (campo.value.length == conjunto1 )
						campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto2)
						campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto3)
						campo.value = campo.value + separacao2;
					else if (campo.value.length == conjunto4)
						campo.value = campo.value + separacao3;
					else if (campo.value.length == conjunto5)
						campo.value = campo.value + separacao3;
				}else{
					event.returnValue = false;
				}
			}
		</script>
		<SCRIPT languaje="JavaScript">
			function pulsar() {
				alert("Esta seguro que desea borrar este evento");
			}
		</SCRIPT>
		<style type="text/css">
			.linea
			{
				display: inline-block;
			}
		</style>
	</head>
	<body>
		<div class="main-wrapper">
			<?php include "navbar.php"; ?>
			<div class="page-wrapper">
				<div class="content">
					<div class="row">
						<div class="col-sm-8 col-4">
							<h4 class="page-title">Calendario</h4>
						</div>						
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="card-box mb-0">
								<div class="row">
									<div class="col-md-12">
										<!--Inicio elementos contenedor-->
										<?php
										if(isset($_SESSION['mensaje'])){
											echo $_SESSION['mensaje'];
											unset($_SESSION['mensaje']);
										}
										?>									
										<div id='calendar'></div>
									</div>
								</div>
							</div>
							<div class="modal fade " id="visualizar"  role="dialog" aria-labelledby="exampleModalLabel" >
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title text-center">Datos del Evento</h4>
										</div>
										<div class="modal-body">
											<dl class="dl-horizontal">								
												<dt>Titulo de Evento</dt>
												<dd id="title"></dd>
												<dt>Inicio de Evento</dt>
												<dd id="start"></dd>
												<dt>Fin de Evento</dt>
												<dd id="end"></dd> 
												<?php ?>
												<dt>
													<div class="btn-toolbar" role="toolbar">
														<div class="btn-group">

															<a href="calendario.php" class="btn btn-info" role="button" class="linea">Cancelar</a> 
														</div>
													</br>
													<div class="btn-group">
														<a      id-hidden="id"    <?php    
														$query = "SELECT * FROM mis_eventos";
														$result_task = mysqli_query($link,$query);
														if($row = mysqli_fetch_assoc($result_task)) 
															$row['id'];
														{?>
															class="btn btn-danger"  class="linea"   href="eliminarcal.php?id=<?php echo $row['id']?>"    onclick="pulsar()"   role="button">Eliminar	</a> 	<?php }?>  	
														</div>
													</div>
												</dt>									
											</dl>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="cadastrar"  role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">								
											<h4 class="modal-title text-center">Registrar Evento</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" method="POST" action="procesocal.php">
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" name="titulo" placeholder="Titulo del Evento">
													</div>
												</div>
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-2 control-label">Color</label>
													<div class="col-sm-10">
														<select name="color" class="form-control" id="color">
															<option value="">Selecione</option>			
															<option style="color:#FFD700;" value="#FFD700">Amarillo</option	>													
															<option style="color:#228B22;" value="#228B22">Verde</option>
															<option style="color:#8B0000;" value="#8B0000">Rojo</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-2 control-label">Fecha Inicial</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" name="inicio" id="start" onKeyPress="DataHora(event, this)">
													</div>
												</div>
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-2 control-label">Fecha Final</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" name="fin" id="end" onKeyPress="DataHora(event, this)">
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-offset-2 col-sm-10">
														<button type="submit" class="btn btn-info">Registrar</button>
														<!-- selecciona los registros de la tabla eventos y localiza el id -->
														<?php 
														$query = "SELECT * FROM mis_eventos";
														$result_task = mysqli_query($link,$query);
														if($row = mysqli_fetch_array($result_task)) 
															$row['id'];
														{?>
														<?php }?>
													</div>													
												</div>
												<div class="form-group">
													<div class="col-sm-offset-2 col-sm-10">
														<div class="btn-group">
															<a href="calendario.php" class="btn btn-danger" role="button" class="linea">Cancelar</a> 

														</div>
													</div>													
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--Fin elementos contenedor-->								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.slimscroll.js"></script>
	<script src="assets/js/app.js"></script>
</body>
</html>
<?php  }?>