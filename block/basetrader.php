<?php
//$stringer='Нет свободных токенов';
$tokenTypeList = getTokenTypeList();
$tokenCoinsAll = getAllCoins();

$stringer.='<div class="row">';
$fullcost=0;
$allcount=0;
$allsold = 0;
$soldcost =0;
$modalid='buyModalId';
$m_titleid='buy-ModalLabel';
foreach($tokenTypeList as $key=>$value)
	{
		$RawType = selectCoinsByType($tokenCoinsAll, $tokenTypeList[$key]['id']);
		$coins = count($RawType);
		$rootcoins = count(selectCoinsByUser($RawType, _ROOT));
		$summary = ((int)$tokenTypeList[$key]['startcost'])*$coins;
		$sold =  ((int)$tokenTypeList[$key]['startcost'])*($coins-$rootcoins);
		$fullcost += $summary;
		$allcount += $coins;
		$allsold += ($coins-$rootcoins);
		$soldcost += $sold;
		$stringer.='<div class="col-sm">';
		$stringer.='
		
		<div class="tokenTypeItem-container" id='.$key.'>
			<div class="tokenTypeItem-title">
				'.$tokenTypeList[$key]['title'].'
				<small>( '.$tokenTypeList[$key]['startcost'].'/шт. )</small>
			</div>
			<div class="tokenTypeItem-description">
				<span> Активен до: '.$tokenTypeList[$key]['burndata'].'</span>
			</div>
			<div class="tokenTypeItem-released">				
				<span> Доступно токенов: '.($rootcoins).' шт.'.'</span>
				<span> Стоимость : '.$tokenTypeList[$key]['startcost'].' р. / шт.'.' </span>
				<span> <button type="button" class="btn btn-info text-white d-block mx-auto my-2 w-75 buy-token" id="buy-'.$key.'" data-toggle="modal" data-target="#'.$modalid.'">Купить</button></span>
			</div>
			
		</div>
		';
		$stringer.='</div>';
	}
	$stringer.='<div class="col-sm">';		
		$stringer.='</div>';
$stringer.='</div>';

	$stringer.= '------------<br>';
	//$stringer.= render_modal($modalid,$m_titleid);
?>