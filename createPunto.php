<?php
session_start();
if(!isset($_SESSION['currentusername'])) 
	header('Location: index.php');

require dirname(__FILE__).'/DB/db.php';
require dirname(__FILE__).'/models/Punto.php';


$db= db::dbini();
$nombre = "";
$nombre = $_POST["nombre"];


$punto = new Punto();
$punto->nombre = $nombre;
$punto->save();

    

header("Location:	punto_lista.php");



?>