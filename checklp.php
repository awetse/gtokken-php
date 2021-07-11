<?php
require_once('userdata.php');
require_once('defpaths.php');

function savelog($msg='NULL')
{
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$login = isset($_POST['login'])?$_POST['login']:'no_login';
	$stamp = isset($_COOKIE['userid'])?$_COOKIE['userid']:'no_id';
	$handle = fopen("log/".date("Y-m-d")."_resource.log", "a+");
	$split = ' | ';
fwrite($handle, "[".$ip."]".$split."[ WHOIS ".$msg."]".$split.date("Y-m-d H:i:s")."".$split."[".$login."]".$split."[".$ua."]"."".$split."[ ".$stamp."]".$split."[ end ]\n\r");
fclose($handle);
}

if(
	(isset($_POST['login'])) && (isset($_POST['hash']))
	)
{
$login = $_POST['login'];
$pass = $_POST['hash'];
$x_user=whois($login,$pass,'');
if( $x_user == _EMPTY ){
	header("HTTP/1.0 403 incorrect data");
	savelog('EMPTY');
	die();
	}else {
		header("HTTP/1.0 200 OK");
		}
}else{
	header("HTTP/1.0 403 incorrect data");
	savelog();
	die();
	}
?>