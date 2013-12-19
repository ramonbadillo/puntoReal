<?
session_start();
if(!isset($_SESSION['currentusername'])) 
	header('Location: index.php');

require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Asiento.php';
require dirname(__FILE__).'/models/Salida.php';


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
	
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />

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
            <a href="index.html" class="logo">Real <span>del</span> Fresno</a>
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
                            <span class="badge bg-success"><?echo $times ?></span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green"><?echo $times ?> Salidas pendientes</p>
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
                            <img alt="" src="img/avatar1_small.jpg">
                            <span class="username">Nombre de Usuario</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class="icon-cog"></i> Configuración</a></li>
                            <li><a href="login.html"><i class="icon-key"></i> Salir</a></li>
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
                  <li>
                      <a href="index.html">
                          <i class="icon-dashboard"></i>
                          <span>Inicio</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a class="active" href="javascript:;" >
                          <i class="icon-tasks"></i>
                          <span>Salidas</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="salida_new.php"><i class="icon-plus"></i>Nueva Salida</a></li>
						  <?
						  
						  for($i=0;$i<$times;$i++){
						  	echo '<li><a  href="croquis.php?id='.$salidas[$i]->id.'"><i class=" icon-caret-right"></i>Salida  '.$salidas[$i]->fecha->format('d/m/Y').'</a></li>';
						  }
							
						  ?>

                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-book"></i>
                          <span>Configuraciones</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="general.html">General</a></li>
                          <li><a  href="buttons.html">Buttons</a></li>
                          <li><a  href="widget.html">Widget</a></li>
                          <li><a  href="slider.html">Slider</a></li>
                          <li><a  href="nestable.html">Nestable</a></li>
                          <li><a  href="font_awesome.html">Font Awesome</a></li>
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
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Form Elements
                          </header>
                          <div class="panel-body">
                              <form id="newSalida" class="form-horizontal tasi-form" action="createSalida.php" method="post">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Origen</label>
                                      <div class="col-sm-10">
                                          <input name="origen" type="text" class="form-control">
                                      </div>
                                  </div>
								  
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Destino</label>
                                      <div class="col-sm-10">
                                          <input name="destino" type="text" class="form-control">
                                      </div>
                                  </div>
                                  
								  
			                      <div class="form-group">
			                          <label class="control-label col-md-3">Fecha de la Salida</label>
			                          <div class="col-md-3 col-xs-11">
			                              <input name="fecha" class="form-control form-control-inline input-medium default-date-picker"  size="16" type="text" value="" />
			                              <span class="help-block">Selecciona la fecha</span>
			                          </div>
								  </div>
                                  
								  
                                  <div class="form-group ">
                                      <label class="control-label col-md-3">No. Asientos</label>
                                      <div class="col-md-9">
                                          <div id="spinner4" class="spinner">
                                              <div class="input-group" style="width:150px;">
                                                  <div class="spinner-buttons input-group-btn">
                                                      <button type="button" class="btn spinner-up btn-warning">
                                                          <i class="icon-plus"></i>
                                                      </button>
                                                  </div>
                                                  <input name="max" type="text" class="spinner-input form-control" value="40" maxlength="3" readonly>
                                                  <div class="spinner-buttons input-group-btn">
                                                      <button type="button" class="btn spinner-down btn-danger">
                                                          <i class="icon-minus"></i>
                                                      </button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
								  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-info">Crear Salida</button>
										  
                                      </div>
                                  </div>
								  
								  
                              </form>
                          </div>
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
    <script src="js/count.js"></script>
	<script type="text/javascript" src="assets/fuelux/js/spinner.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
	<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
	<script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="assets/bootstrap-daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
	<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
	<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>

  
  <!--this page  script only-->
  <script src="js/advanced-form-components.js"></script>

  </body>
</html>
