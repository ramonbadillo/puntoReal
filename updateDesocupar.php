<?php
session_start();
if(!isset($_SESSION['currentusername'])) 
	header('Location: index.php');

require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Asiento.php';
require dirname(__FILE__).'/models/Salida.php';


$db= db::dbini();

$idAsiento=$_GET["idAsiento"];



$idusuario=0;
$nombre = "";
$idpunto=1;
$origen = "";
$destino = "";
$dollares=0;
$pesos=0;
$notas="";
$telefono="";
$estado="Disponible";




$asientoUpdate=Asiento::find($idAsiento);


$salidaE=$asientoUpdate->idsalida;
$sActual=Salida::find($salidaE);
$sActual->num_asientos=$sActual->num_asientos-1;
$pasajero=$sActual->num_asientos;
$sActual->save();


$asientoUpdate->pasajero=$pasajero;
$asientoUpdate->idusuario=$idusuario;
$asientoUpdate->nombre=$nombre;
$asientoUpdate->idpunto=$idpunto;
$asientoUpdate->origen=$origen;
$asientoUpdate->destino=$destino;
$asientoUpdate->dollares=$dollares;
$asientoUpdate->pesos=$pesos;
$asientoUpdate->notas=$notas;
$asientoUpdate->telefono=$telefono;
$asientoUpdate->estado=$estado;
$asientoUpdate->save();

    

header("Location:	lista.php?id=".$salidaE);



?>