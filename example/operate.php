<?php
header('Content-Type: text/html; charset=utf-8');
require_once('../tokencoinclass.php');
require_once('../token_f.php');
//die();


/*
//handle test. 
$tTList = getTokenTypeList();
$newTypeToken = new tokenTypeClass();
$newTypeToken->setTitle('Nokenpoken');
$newTypeToken->setSalePeriod('24/06/21','31/09/21');
$newTypeToken->setCost('18000');
if ( checkUniqueId( $tTList, $newTypeToken->getToken() )>0 )
	{
		$tTList = addTokenTypeToList( $tTList, $newTypeToken->getToken() );
	} else echo 'такой токен есть';

//saveTokenList($tTList);
var_dump($tTList);
*/

//handle test. 
//$newCoin = new tokenCoinClass('id1234567890');
//$newCoin->newUser('vasya','rc25436b4566');
//$newCoin->newUser('petya','asdv11111111');
//var_dump($newCoin->getCoin());
//var_dump(getAllCoins());




//Список смарт контрактов
$titles=[];
$titles[]='ПЭТ';
$titles[]='Бутылка Малышка';
$titles[]='Стеклоа';
$titles[]='Бумага';
$titles[]='Алюминиевая банка';

//var_dump($titles);die;
//Создаем тип монет ( смарт-контракты ) и сохраняем ----------------
$newTypeToken=[];
$tokenTypeList = getTokenTypeList();
for($i=0;$i<count($titles);$i++)
{
	$newTypeToken = new tokenTypeClass();
	$newTypeToken->setTitle($titles[$i]);
	$newTypeToken->setSalePeriod(date("Y/m/d"),date("Y").'/09/31');
	$newTypeToken->setCost('1'.$i.'000');
	$newTypeToken->setStartPrice('1'.$i.'033');
	
	//$tokenTypeList = addTokenTypeToList( $tokenTypeList, $newTypeToken->getToken() );
	echo($newTypeToken->getTitle());
	if ( checkUniqueId( $tokenTypeList, $newTypeToken->getToken() )>0 )
		{
			$tokenTypeList = addTokenTypeToList( $tokenTypeList, $newTypeToken->getToken() );
		} else echo 'такой токен есть';
}
// var_dump($tokenTypeList);
//die();
saveTokenList($tokenTypeList);
//----------------

//die();
$tokenTypeList = getTokenTypeList();
$tokenCoinsAll = getAllCoins();
//Создаем монетy----------------
foreach($tokenTypeList as $key=>$value)
{
	$count=random_int(30,100);
	for($i=0;$i<$count;$i++)
	{
		$newCoin = new tokenCoinClass($tokenTypeList[$key]['id']);
		($newCoin->saveNewCoin());
		echo ($newCoin->getCoin()['currentowner'].' -> '.$newCoin->getCoin()['purchasedate'].'<br>');
		
	}	
}	
//$newCoin = new tokenCoinClass($newTypeToken->getId());
//var_dump(glob(_TokensFolder.'*.{json}', GLOB_BRACE));
?>
