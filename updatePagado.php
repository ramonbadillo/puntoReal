<?php
session_start();
if(!isset($_SESSION['currentusername'])) 
	header('Location: index.php');

require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Asiento.php';


$db= db::dbini();
$idAsiento=$_GET["idAsiento"];



$estado="Pagado";



$asientoUpdate=Asiento::find($idAsiento);


$salidaE=$asientoUpdate->idsalida;
$asientoUpdate->estado=$estado;
$asientoUpdate->save();

    

header("Location:	lista.php?id=".$salidaE);



?>