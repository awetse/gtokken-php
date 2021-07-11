<?php
require_once('../userdata.php');
$uLogin='7';
$t_user = _CLIENT;
$xc = getUF($uLogin);
$xc['user'] = $t_user;
createUF($uLogin,$xc);
$users = readUsers();
$npp = findUserN($uLogin);
if($npp>-1)$users[$npp]['user']=$t_user;
saveUsers($users);

$users = readUsers();
foreach($users as $key=>$value)
{
	$login = $value['login'];
	echo($key.' : '.$login.' => '.$value['user'].' id['.$value['id'].']<br>');
	
	$userData = file_get_contents('./user/'.$login.'/'.'auth-'.$login.'.json');
	$cert = file_get_contents('xr.cert');
	$userData = xEnCrypt($userData,$cert);
	$userData = json_decode($userData,JSON_OBJECT_AS_ARRAY);
	$login = $userData['login'];
	echo('<small>'.$key.' : '.$login.' => '.$userData['user'].' id['.$userData['id'].']</small><br>');
}
//var_dump($user);
?>
