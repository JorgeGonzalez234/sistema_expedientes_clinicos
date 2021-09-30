<div class="main-wrapper">
    <div class="header">
     <div class="header-left">
        <div class="logo">
           <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>ITSPe</span>
       </div>
   </div>
   <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
   <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
   <ul class="nav user-menu float-right">                
   </ul>  
</div>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Menú</li>
                <li > <a href="inicio.php"><i class="fa fa-home"></i> <span>Inicio</span></a>  </li>          
                 <li> <a href="pacientes.php"><i class="fa fa-user-o"></i> <span>Pacientes</span></a>  </li>
                <li> <a href="medicamentos.php"><i class="fa fa-medkit"></i> <span>Medicamentos</span></a> </li>
                <li><a href="consultas.php"><i class="fa fa-clock-o"></i> <span>Consultas medicas</span></a></li>
                <li><a href="calendario.php"><i class="fa fa-calendar"></i> <span>Calendario</span></a> </li>	
                <li class="submenu"> <a href="#"><i class="fa fa-flag-o"></i> <span> Reportes </span> <span class="menu-arrow"></span></a>
                 <ul >
                    <li><a href="Rep-pacientes.php" class="dropdown-item"> Historial paciente </a></li>
                    <li><a href="Rep-medicamentos.php" class="dropdown-item">Rep. medicamentos </a></li>
                </ul>                
            </li>
            <li class="submenu">
                <a href="#">  <i class="user-img">
                    <img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="Admin">
                    <span class="status online"></span>
                </i><span> Admin </span> <span class="menu-arrow"></span></a>
                <ul >
                    <li><a class="dropdown-item" href="configuraciones.php">Configuraciones</a></li>
                    <li><a class="dropdown-item" onclick="cerrarCesion.php" href="cerrarCesion.php">Salir</a></li>
                </ul>               
            </li>
        </ul>
    </div>
</div>
</div>
</div>

