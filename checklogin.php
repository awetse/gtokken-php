<?php
require_once('userdata.php');
require_once('defpaths.php');
$postString=file_get_contents('php://input');
//$usrData=json_decode($postString);
$user = $postString;
if( $user == _ROOT ){header("HTTP/1.0 403 user exist");die();}
$user=false;
$user = findUser($postString);
if ($user){header("HTTP/1.0 403 user exist");die();
}else {header("HTTP/1.0 200 OK");
echo $postString;}
//header("HTTP/1.0 200 error");
?>