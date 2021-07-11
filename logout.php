<?php

	session_start();
	//var_dump($_SESSION);die();
	if(session_status() == PHP_SESSION_ACTIVE){
		if(isset($_SESSION[session_id()])) $x_user = $_SESSION[session_id()];else $x_user = false;
		if(isset($_SESSION['login'])) $login = $_SESSION['login'];else $login='*no login';
		if(isset($_SESSION['idmarker']))$id = $_SESSION['idmarker'];else $id='*no id';
		$ip = $_SERVER['REMOTE_ADDR'];		
		if($x_user != false){
		$handle = fopen("log/".date("Y-m-d")."_resource.log", "a+");
		$split = ' | ';
		fwrite($handle, "[".$login."]".$split."[ LOGOUT"." ]".$split.date("Y-m-d H:i:s")."".$split."[".$ip."]"."".$split."[ ".$id."]".$split."[ end ]\n\r");
		fclose($handle);}
	}
	//session_start();	
    session_unset();
    session_destroy();
	$get='';
	setcookie('remember','',time() - 3600,'/');
	//setcookie('userlogin','',time() - 3600,'/');
	setcookie('userpassword','',time() - 3600,'/');
	
	if(isset($_GET["referer"]))$get='?referer='.$_GET["referer"];
	header('Location: login.php'.$get);
?>