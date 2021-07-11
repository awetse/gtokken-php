<?php
require_once('defpaths.php');
//class tokenCoinClass
//token for smart-contract
class tokenCoinClass
{
	public $tokenCoin;
	
	
public function __construct($tokenCoin) {		
		
		$this->tokenCoin = $this->createTokenTypeDummy($tokenCoin);//$tokenCoin -> smart-contract`s ID
	}	
private function createTokenTypeDummy($typeid='')
{
	if($typeid==''|| $typeid==false)return -1;
	$dummy = [];
	$dummy['type'] = $typeid;
	$dummy['owner'] = _ROOT;
	$dummy['release'] = date("Y/m/d");
	$dummy['random'] = random_int(0,2000000).'c'.str_replace('.','', microtime(true));
	$dummy['id'] =md5($dummy['type'].$dummy['owner']).'-'.md5(_ROOT.$dummy['type'].$dummy['release'].$dummy['random']).'-'.md5($dummy['random']);
	$dummy['currentowner'] = $dummy['owner'];
	$dummy['currowid'] = $dummy['id'];
	$dummy['purchasedate'] = $dummy['release'];
	$dummy['history'] = [];
	
return 	$dummy;
}
public function getCoin()
{
	return $this->tokenCoin;
}
public function importCoin($coinObj)
{
	$check=true;
	foreach($this->tokenCoin as $key=>$value)
	{
		if(!isset($coinObj[$key]))return -1;
	}
	$obj = new ArrayObject($coinObj);	
	$this->tokenCoin=$obj->getArrayCopy();
}

public function checkUnicCoin()
{
	$unique=true;
	$files = glob(_TokensFolder.'*.{json}', GLOB_BRACE);
	for($i=0;$i<count($files);$i++)
	{
		$files[$i] = str_replace(array(_TokensFolder,'.json'),array('',''),$files[$i]);
		if($this->tokenCoin['id']==$files[$i])return false;
	}
	return $this->tokenCoin['id'];
}

public function newUser($login, $id)
{
	
	if(($this->tokenCoin['currentowner']==$login)||($this->tokenCoin['currowid']==$id))return-1;
	
	$today=date("Y/m/d");
	$this->tokenCoin['history'][]=array('previousowner'=>$this->tokenCoin['currentowner'],
										'prevownid'=>$this->tokenCoin['id'],
										'date'=>$this->tokenCoin['purchasedate']);
	$this->tokenCoin['currentowner']=$login;								
	$this->tokenCoin['currowid']=$id;								
	$this->tokenCoin['purchasedate']=$today;								
}
public function saveNewCoin()
{
	if  (!($this->checkUnicCoin()))return-1;
	$tObj=[];
	$tObj[$this->tokenCoin['id']] = $this->tokenCoin;
	$tFile = json_encode($tObj, JSON_UNESCAPED_UNICODE);
	return file_put_contents(_TokensFolder.$this->tokenCoin['id'].'.json',$tFile);
	
}
public function updateCoin()
{
	if  (($this->checkUnicCoin()))return-1;
	$tObj=[];
	$tObj[$this->tokenCoin['id']]=$this->tokenCoin;
	$tFile = json_encode($tObj, JSON_UNESCAPED_UNICODE);
	return  file_put_contents(_TokensFolder.$this->tokenCoin['id'].'.json',$tFile);
}
}
//class tokenCoinClass end

function getAllCoins()
{
	$tokensfilelist = glob(_TokensFolder.'*.{json}', GLOB_BRACE);
	$tokensItems=[];
		for($i=0;$i<count($tokensfilelist);$i++)
			{
				$tFile = file_get_contents($tokensfilelist[$i]);
				if($tFile=json_decode($tFile,JSON_OBJECT_AS_ARRAY))
				{
					$tokensItems = array_merge($tokensItems,$tFile);
				}
			}
	return 	$tokensItems	;
}
function selectCoinsByType($obj, $tokenType)
{
	$tList=[];
	foreach($obj as $key=>$value)
	{
		if($obj[$key]['type']==$tokenType)
		{
			$tList[]=$obj[$key];
		}
	}
	return $tList;
}

function selectCoinsByUser($obj, $user)
{
	$tList=[];
	foreach($obj as $key=>$value)
	{
		if($obj[$key]['currentowner']==$user)
		{
			$tList[]=$obj[$key];
		}
	}
return $tList;
}

?>
