<!DOCTYPE html>

<?

require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Asiento.php';
require dirname(__FILE__).'/models/Punto.php';
require dirname(__FILE__).'/models/Salida.php';
require dirname(__FILE__).'/models/Usuario.php';

$db= db::dbini();



$last=Salida::find('last');
$idSalida=$last->id;


if(isset($_GET['id'])) 
	$idSalida=$_GET["id"];

	
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
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
            <a href="index.html" class="logo">Real <span>del</span> Fresno</a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
						<?
					  $salidas=Salida::find("all");
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
							echo'<a href="#">';	
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
                                <a href="#">Ver Todas las Salidas</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                  
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="icon-bell-alt"></i>
                            <span class="badge bg-warning">7</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <p class="yellow">You have 7 new notifications</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-danger"><i class="icon-bolt"></i></span>
                                    Server #3 overloaded.
                                    <span class="small italic">34 mins</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-warning"><i class="icon-user"></i></span>
                                    Juan Agregado
                                    <span class="small italic">1 Hours</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-danger"><i class="icon-bolt"></i></span>
                                    Database overloaded 24%.
                                    <span class="small italic">4 hrs</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-success"><i class="icon-plus"></i></span>
                                    New user registered.
                                    <span class="small italic">Just now</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-info"><i class="icon-bullhorn"></i></span>
                                    Application error.
                                    <span class="small italic">10 mins</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">See all notifications</a>
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
							  if ($idSalida == $salidas[$i]->id) {
							  	echo '<li class="active"><a  href="croquis.php?id='.$salidas[$i]->id.'"><i class=" icon-caret-right"></i>Salida  '.$salidas[$i]->fecha->format('d/m/Y').'</a></li>';
							  }else{
							  	echo '<li><a  href="croquis.php?id='.$salidas[$i]->id.'"><i class=" icon-caret-right"></i>Salida  '.$salidas[$i]->fecha->format('d/m/Y').'</a></li>';
							  }
						  	
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
			
			
			
			<!--INICIO DEL FORM--> 
			
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Añadir pesona a la lista de espera
                        </header>
                        <div class="panel-body">
                            <form role="form" action="createEspera.php" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefono</label>
                                    <input type="text" name="telefono" class="form-control" placeholder="Telefono">
                                </div>
		                        <div class="form-group">
		                            <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Puntos</label>
		                            <div class="col-lg-10">
		                                <select name="idpunto" class="form-control m-bot15">
		  		  						<?php 
		  		  							$puntos=Punto::all();
		  		  							for($i=0;$i<count($puntos);$i++)
		  		  						  		echo '<option id="idpunto" value="'.$puntos[$i]->id.'">'.$puntos[$i]->nombre.'</option>';
		  		  						 ?>
		                                </select>

                              
		                            </div>
		                        </div>
                                <button type="submit" class="btn btn-info">Añadir</button>
                            </form>

                        </div>
                    </section>
                </div>
			
            <!--FIN DEL FORM-->
			 
			 
			 
			 
			
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