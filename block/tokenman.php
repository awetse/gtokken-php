<?php
$stringer='';//='Функция не активна';

$tokenTypeList = getTokenTypeList();
$tokenCoinsAll = getAllCoins();

//var_dump($tokenCoinsAll);die();
$stringer.='<div class="row">';
$fullcost=0;
$allcount=0;
$allsold = 0;
$soldcost =0;
foreach($tokenTypeList as $key=>$value)
	{
		//$stringer.= $tokenTypeList[$key]['id'].'<br>';
		$RawType = selectCoinsByType($tokenCoinsAll, $tokenTypeList[$key]['id']);
		$coins = count($RawType);
		$rootcoins = count(selectCoinsByUser($RawType, _ROOT));
		$summary = ((int)$tokenTypeList[$key]['startcost'])*$coins;
		$sold =  ((int)$tokenTypeList[$key]['startcost'])*($coins-$rootcoins);
		$fullcost += $summary;
		$allcount += $coins;
		$allsold += ($coins-$rootcoins);
		$soldcost += $sold;
		//$tokenTypeList[$key]['rCount'] = $coins;
		$stringer.='<div class="col-sm">';
		$stringer.='
		
		<div class="tokenTypeItem-container" id='.$key.'>
			<div class="tokenTypeItem-title">
				'.$tokenTypeList[$key]['title'].'
				<small>( '.$tokenTypeList[$key]['startcost'].'/шт. )</small>
			</div>
			<div class="tokenTypeItem-description">
				<span> Дата выпуска: '.$tokenTypeList[$key]['releasedata'].'</span>
				<span> Срок действия : 1 год с даты продажи</span>
				<span> Период продажи: c '.$tokenTypeList[$key]['startsale'].' по '.$tokenTypeList[$key]['stopsale'].'</span>
			</div>
			<div class="tokenTypeItem-released">
				<span> Выпущено токенов: '.$coins.' шт.'.' На сумму '.$summary.' р.'.' </span>
				<span> Продано токенов: '.($coins-$rootcoins).' шт.'.' На сумму '.$sold.' р.'.'</span>
				<span> <a href="#">[Опции]</a> <a href="#">[Выпустить еще]</a></span>				
			</div>
			
		</div>
		';
		$stringer.='</div>';
	}
	$stringer.='<div class="col-sm">';
		$stringer.='
		
		<div class="tokenTypeItem-container" id="newTokenRawType">
			<div class="tokenTypeItem-title">
				Добавить
			</div>
			<div class="tokenTypeItem-description">
				<span> </span>
				<span> </span>
				<span> </span>
			</div>
			<div class="tokenTypeItem-released">
				<span> </span>
				<span> </span>
			</div>
			
		</div>
		';
		$stringer.='</div>';
$stringer.='</div>';
$stringer.='
	Всего Контрактов: '.count($tokenTypeList).' шт.<br>
	Всего токенов: '.$allcount.' шт.<br>
	 - на сумму: '.$fullcost.' р.<br>
	Продано: '.$allsold.' шт.<br>
	 - на сумму: '.$soldcost.' р.<br>
';
	$stringer.= '------------<br>';
	
$stringer.='</br>';
foreach($_SESSION as $key=>$value)
{
	//$stringer.='$SESSION["'.$key.'"] = '.$value.';<br>';
}

/*foreach($tokenCoinsAll as $key=>$value)
	{
		$stringer.= $tokenCoinsAll[$key]['type'].'<br>';
		$coins = count(selectCoinsByType($tokenCoinsAll, $tokenTypeList[$key]['id']));
	}*/






/*if(true)
	{
		$stringer.=('Всего выпущено: '.count($tokensItems).' токенов<br><br>');
		$stringer.='<div class="row">';
		//var_dump($tokentypes);
		//echo"<br>";
		//echo"<br>";
		//var_dump($tokensItems);die;
		foreach($tokensItems as $key=>$value)
		{
			$stringer.='<div class="col-sm">';
			//if(($x_user==_ADMIN)||$tokensItems[$key]['currentowner']==$userData['login'])
			{
			$stringer.=('Тип токена: '.$tokentypes[$tokensItems[$key]['type']]['title'].'<br>');
			$stringer.=('Стоимость : '.$tokentypes[$tokensItems[$key]['type']]['startcost'].'<br>');
			$stringer.=('Владелец: '.$tokensItems[$key]['currentowner'].'<br>');
			$stringer.=('Дата выпуска: '.$tokensItems[$key]['release'].'<br>');
			$stringer.=('Дата покупки: '.$tokensItems[$key]['purchasedate'].'<br><br>');
			}
			$stringer.='</div>';
		}
		$stringer.='</div>';
		
	}*/
?>