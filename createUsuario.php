<?php
session_start();
if(!isset($_SESSION['currentusername'])) 
	header('Location: index.php');

require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Usuario.php';


$db= db::dbini();
$nombre= $passwd = $tipo = $lugar = "";
$nombre = $_POST["nombre"];
$passwd = $_POST["passwd"];
$tipo = $_POST["tipo"];
$lugar = $_POST["lugar"];

$usuario = new Usuario();
$usuario->nombre = $nombre;
$usuario->passwd = $passwd;
$usuario->lugar = $tipo;
$usuario->tipo = $lugar;
$usuario->save();

    

header("Location:	usuario_lista.php");



?>