<?php
session_start();
if(!isset($_SESSION['currentusername'])) 
	header('Location: index.php');

require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Espera.php';


$db= db::dbini();
$nombre = $telefono = $idpunto = $idusuario = " ";
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$idpunto = $_POST["idpunto"];
$idusuario = 0;

$espera = new Espera();
$espera->nombre = $nombre;
$espera->telefono = $telefono;
$espera->idpunto = $idpunto;
$espera->estado = "Esperando";
$espera->idusuario = $idusuario;
$espera->save();

    

header("Location:	espera_lista.php");



?>