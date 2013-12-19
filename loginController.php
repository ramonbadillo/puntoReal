<?php
	require dirname(__FILE__).'/DB/db.php';
	require dirname(__FILE__).'/models/Usuario.php';
	
	
	
	$username = $_POST["user"]; 
	$userpasswd = $_POST["passwd"];
	
	$db= db::dbini();
	
	$u = Usuario::find('all', array('conditions' => array('nombre = ? AND passwd = ?', $username,$userpasswd)));

	if($u != null){
		session_start();
		$_SESSION['currentusername'] = $u[0]->nombre;
		$_SESSION['currentlugar'] = $u[0]->lugar;
		$_SESSION['currenttype'] = $u[0]->tipo;
		
		
		
		header('Location: croquis.php');
	}else {
		header('Location: index.php');
	}
?>