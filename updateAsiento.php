<?php
session_start();
if(!isset($_SESSION['currentusername'])) 
	header('Location: index.php');

require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Asiento.php';
require dirname(__FILE__).'/models/Salida.php';


$db= db::dbini();
$idAsiento=$_POST["idAsiento"];


$idusuario=0;
$nombre=$_POST["nombre"];
$idpunto=$_POST["puntos"];
$origen=$_POST["origen"];
$destino=$_POST["destino"];
$dollares=$_POST["dollares"];
$pesos=$_POST["pesos"];
$notas=$_POST["notas"];
$telefono=$_POST["telefono"];
if (isset($_POST["estado"])) {
	$estado="Pagado";
}
else{
	$estado="Ocupado";	
}


$fecha=$_POST["fecha"];



$asientoUpdate=Asiento::find($idAsiento);


$salidaE=$asientoUpdate->idsalida;
$sActual=Salida::find($salidaE);
$sActual->num_asientos=$sActual->num_asientos+1;
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
$asientoUpdate->fecha=$fecha;
$asientoUpdate->save();

    

header("Location:	croquis.php?id=".$salidaE);



?>