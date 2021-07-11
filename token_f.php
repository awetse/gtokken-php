<?php
require_once('defpaths.php');

//class tokenTypeClass 
//smart - contract
class tokenTypeClass
{
	private $tokenRaw;
	
public function __construct() {		
		
		$this->tokenRaw = $this->createTokenTypeDummy();
	}	
	
public function defaultAccumulation()
{
	return(array('3'=>'10','6'=>'15','12'=>'25'));
}	
private function createTokenTypeDummy()
{
  /*  Год Месяц День*/
	$dummy = [];
	$dummy['creator'] = _ROOT;
	$dummy['releasedata'] = date("Y/m/d");
	$dummy['random'] = random_int(0,2000000).'X'.str_replace('.','', microtime(true));
	$dummy['id'] = md5(_ROOT.$dummy['releasedata'].$dummy['random']).'-'.md5($dummy['random']);
	$dummy['burndata'] = date("Y").'/12/31';
	$dummy['title'] = 'UntitledRaw';
	$dummy['startcost'] = false;
	$dummy['startprice'] = false;
	$dummy['unit'] = "тонна";
	$dummy['startsale'] = date("Y").'/01/01';;
	$dummy['stopsale'] = $dummy['burndata'];
	$dummy['accumulation'] = $this->defaultAccumulation();	
	
return 	$dummy;
}
public function getToken()
	{
		return $this->tokenRaw;
	}
public function getId()
	{
		return $this->tokenRaw['id'];
	}
public function setTitle($title)
	{
		$this->tokenRaw['title']=$title;
	}
public function getTitle()
	{
		return $this->tokenRaw['title'];
	}
public function setCost($cost)
	{
		$this->tokenRaw['startcost']=$cost;
	}
public function setStartPrice($cost)
	{
		$this->tokenRaw['startcost']=$cost;
	}
public function setSalePeriod($start,$stop)
	{
		$today=date("Y/m/d");
		/*проверить корректность дат*/
		$this->tokenRaw['startsale']=$start;
		$this->tokenRaw['stopsale']=$stop;
	}
}
//end class
function getTokenTypeList()
	{
		if(file_exists(_TokenTypeFile))
		$file = file_get_contents(_TokenTypeFile);
			else $file = '{}';
			$tTList = json_decode($file,JSON_OBJECT_AS_ARRAY);
			if(is_array($tTList)&&$tTList){return $tTList;}	else {return false;}

	}
function saveTokenList($objList)
{
	$file = json_encode($objList, JSON_UNESCAPED_UNICODE);
	if(file_put_contents(_TokenTypeFile,$file))return true; else return false;
}
function checkUniqueId($list,$obj)
{
	if(!isset($obj['id']))return -1;
	if(isset($list[$obj['id']]))return false; else return true;
	
}
function addTokenTypeToList($list,$obj)
{
	if(!isset($obj['id']))return -1;
	$list[$obj['id']]=$obj;
	return $list;
}
