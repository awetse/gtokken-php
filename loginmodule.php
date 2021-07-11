<?php
//setlocale(LC_ALL, 'ru_RU.utf8');
//header('Content-Type: text/html; charset=utf-8');
//require_once('data.php');
require_once('userdata.php');

$login='';
$password='';
$x_user=_EMPTY;
$id_valid=false;
///*************LOGIN***************////////////////
if(isset($_COOKIE['remember'])&&($_COOKIE['remember']=='yes'))
		{
			if(isset($_COOKIE['userpassword']) && isset($_COOKIE['userlogin'])){
				$login=$_COOKIE['userlogin'];
				$password=$_COOKIE['userpassword'];
				$user_id=$_COOKIE['userid'];
				$x_user = whois($login, $password,$user_id);
				//echo'$x_user='.$x_user.';<br>';
				if ($x_user!=_EMPTY){
					
					if(session_status() != PHP_SESSION_ACTIVE)session_start();
					$_SESSION[session_id()]=$x_user;
					$_SESSION['login']=$login;
					$_SESSION['idmarker']=$user_id;
					$_SESSION['password']=$password;
					$_SESSION['user_id']=$user_id;
					if(isset($_COOKIE['tS']))$_SESSION['tSalt']=$_COOKIE['tS'];
				}
				
			}
			
			//echo $x_user;
		}


checkAccess('A');
$x_user = $_SESSION[session_id()];
$login = $_SESSION['login'];
$id = $_SESSION['idmarker'];
$password = $_SESSION['password'];
/*************************************////

/*$folder='./user/'.$login.'';
if(!is_dir($folder)){if (!mkdir($folder, 0777, true)) {die('Не удалось создать директории...');}}
*/
?>