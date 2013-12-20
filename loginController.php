<?php
	require dirname(__FILE__).'/DB/db.php';
	require dirname(__FILE__).'/models/Usuario.php';
	
	
	
	$username = $_POST["user"]; 
	$userpasswd = $_POST["passwd"];
	
	$db= db::dbini();
	
	$u = Usuario::find('all', array('conditions' => array('nombre = ? AND passwd = ?', $username,$userpasswd)));

	if($u != null){
		session_start();
		if($u[0]->tipo=="Admin"){
			$_SESSION['currentusername'] = $u[0]->nombre;
			$_SESSION['currentlugar'] = $u[0]->lugar;
			$_SESSION['currenttype'] = $u[0]->tipo;
			header('Location: croquis.php');
		}else if($u[0]->tipo=="normal"){
			$_SESSION['normalusername'] = $u[0]->nombre;
			$_SESSION['normallugar'] = $u[0]->lugar;
			$_SESSION['normaltype'] = $u[0]->tipo;
			header('Location: croquisNormal.php');
		}
		
	}else {
		header('Location: index.php');
	}
?>