<?php
session_start();
if(!isset($_SESSION['currentusername'])) 
	header('Location: index.php');


require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Asiento.php';
require dirname(__FILE__).'/models/Salida.php';


$db= db::dbini();
$origen = $_POST["origen"];
$destino = $_POST["destino"];
$fecha = $_POST["fecha"];
$max = $_POST["max"];
$idusuario=0;


$salida=new Salida();
$salida->origen=$origen;
$salida->destino=$destino;
$salida->fecha=$fecha;
$salida->max=$max;
$salida->num_asientos=0;
$salida->save();




$times = $max;
$last=Salida::find('last');
$idSalida=$last->id;
for($i=0;$i<$times;$i++){
	//$newDate = DateTime::createFromFormat("l dS F Y", $salidas[$i]->fecha);
	//$newDate = $newDate->format('d/m/Y'); // for example
	$a=new Asiento();
	$a->noasiento=$i+1;
	$a->idusuario=$idusuario;
	$a->nombre=" ";
	$a->idpunto=1;
	$a->idsalida=$idSalida;
	$a->origen=" ";
	$a->destino=" ";
	$a->dollares=0.0;
	$a->pesos=0.0;
	$a->notas=" ";
	$a->telefono=" ";
	$a->estado="Disponible";
	//$a->fecha="";
	$a->save();
}
    

header("Location:	croquis.php");



?>