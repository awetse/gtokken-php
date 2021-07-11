<?php
header('Content-Type: text/html; charset=utf-8');
require_once('../tokencoinclass.php');
require_once('../token_f.php');
die();
$tokenTypeList = getTokenTypeList();//загружаем все смарт-контракты
$tokenCoinsAll = selectCoinsByUser(getAllCoins(),_ROOT);//выбираем все монеты принадлежащие _ROOT по всем смарт-контрактам
$volume=10;
$counter = 0;
$exTokens=[];
$UserLogin = '7';
$UserId  = '8f14e45fceea167a5a36dedd4bea2543ю0789a732b7e01c81b9ac5fabc47d6c4f';
$SmartId = 'ea085e4d56da329bb974f2d8f2e9b01d-4a2dc69b5a5f551ab46290dbdd90f8a7';
/*
foreach($tokenCoinsAll as $key=>$value)
{
	if($counter>=$volume)break;
	$obj = new ArrayObject($tokenCoinsAll[$key]);
	$exTokens[$key] = $obj->getArrayCopy();
	$counter++;
	echo $key;
}*/
for($i=0;$i<count($tokenCoinsAll);$i++)
{
	//echo $i.' - '.$tokenCoinsAll[$i]['type'].'<br>';continue;
	if(($i%6==0)&&($tokenCoinsAll[$i]['type']==$SmartId)){
		$obj = new ArrayObject($tokenCoinsAll[$counter]);
		$exTokens[$counter] = $obj->getArrayCopy();
		$counter++;
		echo $counter.'<br>';
	}
}
//die();
foreach($exTokens as $key=>$value)
{
		$newCoin = new tokenCoinClass('new');
		$newCoin->importCoin($exTokens[$key]);
		$newCoin->newUser($UserLogin, $UserId);
		$newCoin->updateCoin();
		var_dump($newCoin->getCoin());
		//echo ($newCoin->getCoin()['currentowner'].' -> '.$newCoin->getCoin()['purchasedate'].'<br>');
}
//var_dump($exTokens);
?>
