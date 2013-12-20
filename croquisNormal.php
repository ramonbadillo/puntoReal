<?
session_start();
if(!isset($_SESSION['normalusername'])) 
	header('Location: index.php');



require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Asiento.php';
require dirname(__FILE__).'/models/Punto.php';
require dirname(__FILE__).'/models/Salida.php';
require dirname(__FILE__).'/models/Usuario.php';

$db= db::dbini();



$last=Salida::find('last');
$idSalida=$last->id;
$numAsiento=1;


if(isset($_GET['id'])) 
	$idSalida=$_GET["id"];
if(isset($_GET['asiento'])) 
	$numAsiento=$_GET["asiento"];

	
?>
<!DOCTYPE html>
<html lang="es">
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

    <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />


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
                            <span class="username"><? echo $_SESSION['normalusername'];?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
							
                            <li><a href="#"><i class="icon-home"></i> <? echo $_SESSION['normallugar']; ?></a></li>
							<li><a href="#"><i class="icon-key"></i> Usuario: <? echo $_SESSION['normaltype']; ?></a></li>
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
                      <a class="active" href="javascript:;" >
                          <i class="icon-road"></i>
                          <span>Salidas</span>
                      </a>
                      <ul class="sub">
						  <?
						  
						  for($i=0;$i<$times;$i++){
							  if($salidas[$i]->id==$idSalida)
						  		 echo '<li class="active"><a  href="croquisNormal.php?id='.$salidas[$i]->id.'"><i class=" icon-caret-right"></i>Salida  '.$salidas[$i]->fecha->format('d/m/Y').'</a></li>';
							  else
								  echo '<li><a  href="croquisNormal.php?id='.$salidas[$i]->id.'"><i class=" icon-caret-right"></i>Salida  '.$salidas[$i]->fecha->format('d/m/Y').'</a></li>';
						  }
							
						  ?>

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
			  
              <!--navigation start-->
              <nav class="navbar navbar-inverse" role="navigation">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">
						  Salida del
					      <?
						  $sActual=Salida::find($idSalida);
						  echo $sActual->fecha->format('d/m/Y');
							
					      ?>
					  
					  </a>
                  </div>

                  
                      <ul class="nav navbar-nav navbar-right">
                          <li class="active" ><a href="javascript:;">Croquis</a></li>
                          <li><a href="listaNormal.php?id=<? echo $idSalida;?>">Lista</a></li>
                      </ul>
                  </div><!-- /.navbar-collapse -->
              </nav>

              <!--navigation end-->
			  
			  
			 <div class="col-sm-4">
			<section class="panel">
  			  <header class="panel-heading">
				  <? echo $sActual->origen .' - '.$sActual->destino?>
  			  </header>
             
  			  <?php 
			  
			  
			  
			  
			  
			  $maxAsientos=$sActual->max;
			  
  			  $rows = ceil(($maxAsientos)/4); // define number of rows
  			  $cols = 5;// define number of columns
  			  
  			  echo "<table class='table'>"; 
  			  
  			  $nAsi = 1;
			  $numero=" ";
  			  for($tr=1;$tr<=$rows;$tr++){ 
  			      echo "<tr>"; 
  			          for($td=1;$td<=$cols;$td++){
						  if ($td!=3) {
						  	
						  
						  if ($nAsi<10) {
						  	$numero = "0".$nAsi;
						  }else
						  $numero = "".$nAsi;
  						  	echo "<td>";
							
  			                 $a=Asiento::find('all', array('conditions' => array('noasiento = ? AND idsalida = ?', $nAsi,$idSalida)));	
							 //print_r($a);
							 if ($a[0]->estado=="Disponible") {
							 	echo "<a id='".$nAsi."' class='asiento' href='croquisNormal.php?id=$idSalida&asiento=$nAsi'><strong>$numero</strong><img class='imgAsi' src='http://i.imgur.com/ryymACv.jpg'></a>";
							 }else{
							 	echo "<a id='".$nAsi."' class='asiento' href='croquisNormal.php?id=$idSalida&asiento=$nAsi'><strong>$numero</strong><img class='imgAsi' src='http://i.imgur.com/8E0FlNk.jpg'></a>";
							 }
							 
  							 
							 
							 //http://i.imgur.com/8E0FlNk.jpg
							 
  							 echo "</div></div>";
							 
  							 echo "</td>";
  							 $nAsi++;
  							 if ($nAsi>=$maxAsientos+1) {
  								 break;
  							 }
						}else {
							echo "<td>";
							echo "<div></td>";
							echo "</td>";
						}
  			          } 
  			      echo "</tr>"; 
  			  } 
  			  echo "</table>"; 
			  
			      
			      
			    
  			  //$e= Estado::find(2);
  			  //echo $e->descripcion;
  			  ?>
			 
			 
			 
			 </section>
		    </div>
			
			<div class="col-sm-8">
				<?
					$a=Asiento::find('all', array('conditions' => array('noasiento = ? AND idsalida = ?', $numAsiento,$idSalida)));
					
				?>
				<section class="panel">
	  			  <header class="panel-heading">
					  
	  			  	Asiento #
					<? 
					echo $numAsiento." ";
					if($a[0]->estado=="Disponible")
						echo '<span class="label label-primary">'.$a[0]->estado;
					elseif($a[0]->estado=="Ocupado")
						echo '<span class="label label-danger">'.$a[0]->estado;
					elseif($a[0]->estado=="Pagado")
						echo '<span class="label label-success">'.$a[0]->estado; 
					
					
					?>
					
					</span>
	  			  </header>
				  <div class="panel-body">
				  
	                  <form class="form-horizontal tasi-form" >
						  <input type="hidden" name="idAsiento" value="<? echo $a[0]->id; ?>" />
                      
	                      <div class="form-group">
	                          <label class="col-sm-2 col-sm-2 control-label">Nombre: </label>
							  <div class="col-lg-10">
	                          <? echo $a[0]->nombre; ?>
							  </div>
	                      </div>
					  
	                      <div class="form-group">
	                          <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Puntos</label>
							  <div class="col-lg-10">
							  <? echo $a[0]->idpunto; ?>
							   </div>
	                      </div>
					  
	                      <div class="form-group">
	                          <label class="control-label col-md-3">Fecha del Boleto</label>
							  <div class="col-lg-10">
							 <? if ($a[0]->fecha!=null)
							  echo $a[0]->fecha->format('d/m/Y'); ?>
							  </div>
						  </div>
					  
	                      <div class="form-group">
	                          <label class="col-sm-2 control-label col-lg-2" >Precio</label>
	                          <div class="col-lg-5">
	                              <div class="input-group m-bot15">
	                                  $<? echo $a[0]->pesos; ?> Pesos
	                              </div>

	                              <div class="input-group m-bot15">
	                                   $<? echo $a[0]->dollares; ?> Dolares
	                              </div>
	                          </div>
	                      </div>
					  
	                      <div class="form-group">
	                          <label class="col-sm-2 col-sm-2 control-label">Origen</label>
							  <div class="col-lg-10">
	                          <? echo $a[0]->origen; ?>
							   </div>
	                      </div>
					  
	                      <div class="form-group">
	                          <label class="col-sm-2 col-sm-2 control-label">Destino</label>
							  <div class="col-lg-10">
	                          <? echo $a[0]->destino; ?>
							   </div>
	                      </div>
	                      <div class="form-group">
	                          <label class="col-sm-2 col-sm-2 control-label">Observaciones</label>
							  <div class="col-lg-10">
	                          <? echo $a[0]->notas; ?>
							   </div>
	                      </div>
	                      <div class="form-group">
	                          <label class="col-sm-2 col-sm-2 control-label">Telefono</label>
							  <div class="col-lg-10">
	                          <? echo $a[0]->telefono; ?>
							  </div>
	                      </div>
                      
					  
                     
                      
                     

	                  </form>
                  </div>
				  
				 
				  
					
				  
				  
				</section>
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
  <script src="js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="js/respond.min.js" ></script>

  <!--this page plugins-->
  <!--custom checkbox & radio-->
  <script type="text/javascript" src="js/ga.js"></script>

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

  <!--common script for all pages-->
  <script src="js/common-scripts.js"></script>
  <!--this page  script only-->
  <script src="js/advanced-form-components.js"></script>

  </body>
</html>
