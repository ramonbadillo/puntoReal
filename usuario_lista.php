<?
session_start();
if(!isset($_SESSION['currentusername'])) 
	header('Location: index.php');
require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Asiento.php';
require dirname(__FILE__).'/models/Punto.php';
require dirname(__FILE__).'/models/Salida.php';
require dirname(__FILE__).'/models/Usuario.php';

$db= db::dbini();




	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Punto Real del Fresno</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="index.php" class="logo">Real <span>del</span> Fresno</a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
						<?
						$fecha= date("Y-m-d");
					  $salidas=Salida::find('all', array('conditions' => array('fecha >= ?', $fecha)));
					  
					  $times = count($salidas);
							
						?>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-tasks"></i>
                            <span class="badge bg-success"><?echo $times; ?></span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green"><?echo $times; ?> Salidas pendientes</p>
                            </li>
                               
							<?
							
			  	 		    for($i=0;$i<$times;$i++){
							echo'<li>';
							echo'<a href="croquis.php?id='.$salidas[$i]->id.'">';	
							echo'<div class="task-info">';	  
			  			    echo '<div class="desc">Salida  '.$salidas[$i]->fecha->format('d/m/Y').'</div>';
			  				echo '<div class="percent">'.$salidas[$i]->num_asientos.'/'.$salidas[$i]->max.'</div>';
							
							
							echo '</div><div class="progress progress-striped">';	
							$porcentaje=$salidas[$i]->num_asientos/$salidas[$i]->max;
							$porcentaje=$porcentaje*100;
							echo '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$salidas[$i]->num_asientos.'" aria-valuemin="0" aria-valuemax="'.$salidas[$i]->max.'" style="width: '.$porcentaje.'%">';			
							echo '
                                        </div>
                                    </div>
                                </a>
                            </li>';
										?>
                                        
                                  
                                        
                                          
                            <?
									}
								
                            ?>

                            <li class="external">
                                <a href="salidas_lista.php">Ver Todas las Salidas</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                  
                    <!-- notification dropdown start-->
					
					<?
						$listaEspera=Espera::find('all');
						$timesEspera = count($listaEspera);
						
					?>
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="icon-bell-alt"></i>
                            <span class="badge bg-warning"><? echo $timesEspera; ?></span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <p class="yellow">Hay <? echo $timesEspera; ?> en lista de espera </p>
                            </li>
                            <?
                            	for($i=0;$i<$timesEspera;$i++){
									echo '<li><a href="#">';
									echo '<span class="label label-warning"><i class="icon-user"></i></span>';
									echo $listaEspera[$i]->nombre;
									echo '<span class="small italic">';	
									echo ' - '.$listaEspera[$i]->telefono;
									echo '</span>';						
									echo '</a></li>';
								}
                            ?>
                            
                                    
                                   
                            
                            
                            <li>
                                <a href="espera_lista.php">Ver toda la lista de espera</a>
                            </li>
                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            
                            <span class="username"><? echo $_SESSION['currentusername']; ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
							
                            <li><a href="#"><i class="icon-home"></i> <? echo $_SESSION['currentlugar']; ?></a></li>
							<li><a href="#"><i class="icon-key"></i> Usuario: <? echo $_SESSION['currenttype']; ?></a></li>
                            <li><a href="logout.php"><i class="icon-key"></i> Salir</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
      </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  

                  <li class="sub-menu">
                      <a  href="javascript:;" >
                          <i class="icon-road"></i>
                          <span>Salidas</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="salida_new.php"><i class="icon-plus"></i>Nueva Salida</a></li>
						  <li><a  href="salidas_lista.php"><i class="icon-eye-open"></i>Ver Todas</a></li>
						  <?
						  
						  for($i=0;$i<$times;$i++){
						  	echo '<li><a  href="croquis.php?id='.$salidas[$i]->id.'"><i class=" icon-caret-right"></i>Salida  '.$salidas[$i]->fecha->format('d/m/Y').'</a></li>';
						  }
							
						  ?>

                      </ul>
                  </li>


                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" icon-list-ul"></i>
                          <span>Lista de Espera</span>
                      </a>
                      <ul class="sub">
						  <li><a  href="espera_new.php"><i class="icon-plus"></i>Agregar</a></li>
                          <li><a  href="espera_lista.php"><i class="icon-eye-open"></i>Ver Todos</a></li>
                      </ul>
                  </li>
				  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-group"></i>
                          <span>Puntos</span>
                      </a>
                      <ul class="sub">
						  <li><a  href="punto_new.php"><i class="icon-plus"></i>Agregar</a></li>
                          <li><a  href="punto_lista.php"><i class="icon-eye-open"></i>Ver Todos</a></li>
                      </ul>
                  </li>
				  
                  <li class="sub-menu">
                      <a class="active" href="javascript:;" >
                          <i class="icon-user"></i>
                          <span>Usuarios</span>
                      </a>
                      <ul class="sub">
						  <li><a  href="usuario_new.php"><i class="icon-plus"></i>Agregar</a></li>
                          <li class="active"><a  href="usuario_lista.php"><i class="icon-eye-open"></i>Ver Todos</a></li>
                      </ul>
                  </li>
                  
				  
                  

                  
               

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
			  
			  
			  
			 
			 
			 
              <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Ver todos los Usuarios
                          </header>
                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
								  <th><i class=" icon-edit"></i> Nombre</th>
								  
                                  <th><i class="icon-bullhorn"></i> Lugar</th>
								  <th><i class="icon-bullhorn"></i> Tipo</th>
                              </tr>
                              </thead>
                              <tbody>
								  
								  
                              
							  
							  
							  
							  <?
							  
  							$usuariosTodas=Usuario::find("all");
							$times = count($usuariosTodas);	
							  
							  for($i=0;$i<$times;$i++){
                                echo '<tr>
  								  ';
  								
  								echo  '<td>'.$usuariosTodas[$i]->nombre.'</td>';
								echo  '<td>'.$usuariosTodas[$i]->lugar.'</td>';
								echo '<td>'.$usuariosTodas[$i]->tipo.'</td>';
  								
                                  echo  '
								  
                                </tr>';
							
							
						  	  }
						  ?>
							  
							  
							  
                              
                              
                              </tbody>
                          </table>
                      </section>
                  </div>
              </div>
			 
			 
			 
			 
			 
			
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              R-link.co
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="js/owl.carousel.js" ></script>
    <script src="js/jquery.customSelect.min.js" ></script>
    <script src="js/respond.min.js" ></script>

    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/count.js"></script>

  

  </body>
</html>
