<?php

$toopltips = 
[
'ГЛАВНАЯ/ОБЩАЯ. На странице размещается краткая информация о денежных средствах, купленных токенах по контрактам, доступные для покупки токены размещаемые пользователем _ROOT и выставленными на перепродажу токенами от пользователей _CLIENT, возможно дополнительные графики по изменению цен на сырье, прогнозы от площадки и др статистическая информация. Статистика операций клиента. Уведомления от системы.',
'ИНВЕСТИЦИИ.  Подробная информация о купленных токенах  // с возможность сортировать/группировать по разным критериям (тип контракта, срок истечения контракта/текщего токена, сумма и тп — ОПРЕДЕЛИТЬ.)',
'СЫРЬЕВАЯ ПЛОЩАДКА — Подробная информация  о токенах выставленных на продажу пользователем _ROOT. ( _CLIENT только покупает)',
'B2b ПОЩАДКА (возможно полностью перенести в раздел ГЛАВНАЯ/ОБЩАЯ или СЫРЬЕВАЯ ПЛОЩАДКА).  Подробная информация о токенах выставленных на продажу другими пользователям _CLIENT. ( _CLIENT  покупает или выставляет на продажу )//с возможность сортировать/группировать по разным критериям (тип контракта, срок истечения контракта/текщего токена, сумма и тп — ОПРЕДЕЛИТЬ.)',

'АККАУНТ. Раздел с информацией о пользователе.
- возможность изменить контактную информацию  и пароль.
- добавить документы необходимые для проведения финансовых операций.
-  Дополнить по необходимости.',
'Выпуск токенов : Панель администратора - создать/удалить токенб передать пользователю<br><br>
<i>
По мере поступления сырья F-токены превращаются в сырьевые токены:<br>
например:<br>
<ul>
	<li>F-ПЭТ -> ПЭТ-крошка</li>
	<li>F-Стеклоа -> Стеклотара</li>
	<li>F-Бумага -> Бумага</li>
	<li>и тд</li>
<ul>
</i>
', 	
'Договор - если необходимо подписать в электронном или бумажнов виде // форма заполнения если необходимо', 	
'ТЕХ.ПОДДЕРЖКА.
- Сервис поддержки пользователей и FAQ.
- средства поддержки пользователя — ОПРЕДЕЛИТЬ.'];

$c=1;
$menu=[];
//$menu[]=array('title'=>'Общая информация', 'file'=>'statistic.php','access'=>_CLIENT);
$menu[]=array('title'=>'Мои инвестиции', 'file'=>'wallet.php','access'=>_CLIENT,'tooltip'=>$toopltips[$c++]);
$menu[]=array('title'=>'Сырьевая площадка', 'file'=>'basetrader.php','access'=>_CLIENT,'tooltip'=>$toopltips[$c++]);
$menu[]=array('title'=>'B2B площадка', 'file'=>'b2btrader.php','access'=>_CLIENT,'tooltip'=>$toopltips[$c++] );
$menu[]=array('title'=>'Аккаунт', 'file'=>'settings.php','access'=>_CLIENT,'tooltip'=>$toopltips[$c++]);
$menu[]=array('title'=>'Выпуск токенов <small><i>[root]</i></small>', 'file'=>'tokenman.php','access'=>_ADMIN,'tooltip'=>$toopltips[$c++]);
$menu[]=array('title'=>'Договор', 'file'=>'contracts.php','access'=>_CLIENT,'tooltip'=>$toopltips[$c++]);
$menu[]=array('title'=>'Тех.поддержка', 'file'=>'tech.php','access'=>_CLIENT,'tooltip'=>$toopltips[$c++]);

//include('./block/leftmenu.html');

?>

<div class="main-sheet">
  <div class="row">
    <div class="col-sm  left-menu" >
      <?php
			
			$pils='';
			$pilsTab='<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">';
			$cSel=0;
			for($i=0;$i<count($menu);$i++)
			{
				$target=str_replace('.php','',$menu[$i]['file']);
				$pilsTab.='
				<button class="nav-link '.(($i==$cSel)?'active':'').'" id="v-pills-'.$target.'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.$target.'" type="button" role="tab" aria-controls="v-pills-'.$target.'" aria-selected="'.(($i==$cSel)?'true':'false').'">'.$menu[$i]['title'].'
				
				</button>				
				';
				if(is_file('./block/'.$menu[$i]['file']))require('./block/'.$menu[$i]['file']); 
					else $stringer='<div class="alert alert-info" role="alert">'.'Page empty'.'</div>';
				$pils.='<div class="tab-pane fade '.(($i==$cSel)?'show active':'').'" id="v-pills-'.$target.'" role="tabpanel" aria-labelledby="v-pills-'.$target.'-tab">'.
			'<div class="alert alert-warning" role="alert">'.$menu[$i]['tooltip'].'</div>'.((isset($stringer)&&($stringer!=''))?$stringer:$i).'</div>'."\n";
				$stringer='';
			}
			$pilsTab.='</div>';
			$pils=' <div class="tab-content" id="v-pills-tabContent">'."\n".$pils;;
			$pils.='</div>'."\n";
			echo $pilsTab;
			
	  ?>
    </div>
    <div class="col-lg bg-white work-sheet">
      <div class="work-sheet-container">
	  <?php
	  
	  echo $pils;
	  echo render_modal($modalid,$m_titleid);
	if(false)
	{
		echo('Всего выпущено: '.count($tokensItems).' токенов<br><br>');
		echo'<div class="row">';
		foreach($tokensItems as $key=>$value)
		{
			echo'<div class="col-sm">';
			//if(($x_user==_ADMIN)||$tokensItems[$key]['currentowner']==$userData['login'])
			{
			echo('Тип токена: '.$tokentypes[$tokensItems[$key]['type']]['title'].'<br>');
			echo('Стоимость : '.$tokentypes[$tokensItems[$key]['type']]['startcost'].'<br>');
			echo('Владелец: '.$tokensItems[$key]['currentowner'].'<br>');
			echo('Дата выпуска: '.$tokensItems[$key]['release'].'<br>');
			echo('Дата покупки: '.$tokensItems[$key]['purchasedate'].'<br><br>');
			}
			echo'</div>';
		}
		echo'</div>';
		
	}
	?>
	</div>
    </div>    
  </div>
</div>