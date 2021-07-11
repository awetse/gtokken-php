<?php
//$stringer='У вас нет токенов';
$stringer='';
$tokenTypeList = getTokenTypeList();
$tokenCoinsAll = getAllCoins();

$stringer.='<div class="row">';
$fullcost=0;
$allcount=0;
$allsold = 0;
$soldcost =0;
$RawType = selectCoinsByUser($tokenCoinsAll, $login);
$coins = count($RawType);
$modalid='buyModalId';
$m_titleid='buy-ModalLabel';
$summ;
foreach($tokenTypeList as $key=>$value)
	{			
		$tokensBuType = selectCoinsByType($RawType, $tokenTypeList[$key]['id']);
		$tCoins = count($tokensBuType);
		if ($tCoins==0)continue;
		$rootcoins = $coins;
		$summary = ((int)$tokenTypeList[$key]['startcost'])*$tCoins;
		
		
		$allcount += $coins;
		$allsold += ($coins-$rootcoins);
		$activedate=[];
		//echo gettype($tokensBuType[0]['purchasedate']);
		$activedate = explode("/",$tokensBuType[0]['purchasedate']);
		//var_dump($activedate);
		//die();
		$buymonth = (int)$activedate[0];
		$curmonth = (int)date("m");
		if  ($curmonth<=$buymonth)$curmonth+=12;
		$period = $curmonth-$buymonth;
		$percent='';
		foreach($tokenTypeList[$key]['accumulation'] as $ky=>$value)
		{
			$percent = (float)$tokenTypeList[$key]['accumulation'][$ky];
			if($period<=(int)$ky)break;
		}
		$owninglength = $ky;
		$percent = 1+$percent/100;
		$activedate[0] = (int)$activedate[0]+1;
		$strdate = $activedate[0].'/'.$activedate[1].'/'.$activedate[2];
		$price = $tokenTypeList[$key]['startprice']*$percent;
		$fullcost += $price*$tCoins;
		//$soldcost += $sold;
		$stringer.='<div class="col-sm">';
		$stringer.='
		
		<div class="tokenTypeItem-container" id='.$key.'>
			<div class="tokenTypeItem-title">
				'.$tokenTypeList[$key]['title'].'
				<small>( '.$price.'/ шт. )</small>
			</div>
			<div class="tokenTypeItem-description">
				<span> Дата покупки: '.$tokensBuType[0]['purchasedate'].' ( '.$tCoins.' шт)'.'</span>
				<span> Активен до: '.$strdate.'</span>
			</div>
			<div class="tokenTypeItem-released">				
				<span> Срок инвестиции: &le;'.($owninglength).' мес. ('.$tokenTypeList[$key]['accumulation'][$ky].' % )'.'</span>
				<span> Куплено токенов: '.($tCoins).' шт.'.'</span>
				<span> Стоимость : '.($price*$tCoins).' р.'.' </span>
				<span> 
				<button type="button" class="btn btn-info text-white d-block mx-auto my-2 w-75 buy-token" id="sale-'.$key.'" data-toggle="modal" data-target="#'.$modalid.'">Продать</button>
				</span>
			</div>
			
		</div>
		';
		$stringer.='</div>';
	}
	$stringer.='<div class="col-sm">';
	
		$stringer.='</div>';
$stringer.='</div>';

	$stringer.= '------------<br>';
	$stringer.='Всего токенов: '.$coins.'<br>';
	$stringer.='Всего на сумму: '.$fullcost.'<br>';
	//$stringer.= render_modal($modalid,$m_titleid);
	
if($coins==0)$stringer='<div>У вас нет токенов</div>'.$stringer;
	$stringer.= '------------<br>';
/*	$stringer.='
	<div class="popup-form-container">
		<div class="popup-form">
			<div class="load-spinner">
			loading...
			</div>
		</div>
	</div>
	';*/
	
?>