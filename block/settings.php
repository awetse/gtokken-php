<?php
$stringer='<h2>Настройка аккаунта</h2>';
	$title4['user']='Право доступа';
	$title4['login']='Логин';
	$title4['password']='Пароль';
	$title4['id']='ID';

	$title4['cd']='Зарегистрирован';
	$title4['tel']='Телефон';
	$title4['mail']='Почта';
	//$title4['rcycl_amount']='Баланс:';
$usr_set = getUF($login);
//var_dump($usr_set);
$stringer.='<table cellpadding="4">';
foreach($usr_set as $key=>$value)
{
	
	if(!is_array($value)){
		if($key=='user')continue;
		$stringer.='<tr>';
		if($key=='password')
			$stringer.='<td>'.($title4[$key].' </td><td> &bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;</td>');
				else
				{
					if(isset($title4[$key])){
						$stringer.='<td>'.($title4[$key].' </td><td> '.$value.'</td>');
						}
				}
		$stringer.='</tr>';			
	}//else $stringer.=json_encode($value, JSON_UNESCAPED_UNICODE);
}
$stringer.='</table>';
$stringer.='<button type="button" class="btn btn-info text-white d-block my-2">Изменить</button>';

?>