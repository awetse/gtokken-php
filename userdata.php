<?php
////---------DATA BLOCK----------------------------
	//---user access rights #define
	define('_UserFileDB','users.db');
	
	define ('_ALL',0);
	define ('_EDIT',1);
	define ('_VIEWALL',2);
	define ('_VIEWID',3);
	define ('_NONE',-1);
	
	define ('_ADMIN', 'admin');
	define ('_MAN', 'manager');
	define ('_WRK', 'worker');	
	define ('_CLIENT', 'client');
	define ('_EMPTY', 'guest');
	
	define('_BY_PASS',1);
	define('_BY_ID',2);
	
	$login_method=0;
	
	$userType=array(     _ADMIN   => _ALL
					    ,_MAN     => _EDIT
						,_WRK     => _VIEWALL
						,_CLIENT  => _VIEWID
						,_EMPTY   => _NONE
						);
	//---user access rights #define---//
	
function getUsers(){	
		
				   
	  $userList = array();$i=0;
		$userList[$i++] = array('user'=>_EMPTY,  'login'=>'',     'password'=>'',    'id'=>'');		
		$userList[$i++] = array('user'=>_ADMIN,  'login'=>'',     'password'=>'',    'id'=>'7fe5369328ec30cf3cc1072d40005a15');		
		$userList[$i++] = array('user'=>_ADMIN,  'login'=>'admin','password'=>'7fe5369328ec30cf3cc1072d40005a15', 'id'=>'');//admin123456789
		$userList[$i++] = array('user'=>_ADMIN,  'login'=>'manager','password'=>'efa00e957b4c215a38679ab0bc7531b8', 'id'=>'');//manager123456789
	return $userList;
}
function saveUsers($userList)
{
	$tf=_UserFileDB;
	$datfile = fopen($tf, "w");
	$dl = count($userList);
	fwrite($datfile,chr(0xFA));
	for ($i=0;$i<$dl;$i++)
	{
		fwrite($datfile,chr(0xFB));		
		fwrite($datfile,$userList[$i]['user']);
		fwrite($datfile,chr(0xFE));
		fwrite($datfile,$userList[$i]['login']);
		fwrite($datfile,chr(0xFE));
		fwrite($datfile,$userList[$i]['password']);
		fwrite($datfile,chr(0xFE));
		fwrite($datfile,$userList[$i]['id']);	
		fwrite($datfile,chr(0xFE));		
		fwrite($datfile,chr(0xFC));
	}
	fwrite($datfile,chr(0xFD));
	fclose($datfile);
}
function readUsers()
{
	$tf=_UserFileDB;
	if (file_exists($tf))
	{
	$datfile = fopen($tf, "r");
	}else return [];
	$records=array();
	
	if (!file_exists($tf))
          {
            return null;
          } else 
			{
			  $buff=fread($datfile,1);
			   if ($buff==chr(0xFA))
			   {	
				 $row1=0;
				 $col1=0;	
				 $tmpcell='';
				  while(!feof($datfile))
				 {
					 $buff=fread($datfile,1);
					 
					 if ($buff==chr(0xFB)){
						 
						 $records[$row1]=array();
						 
							}
					 elseif ($buff==chr(0xFC))
						{							
							$row1++;$col1=0;
							//$file_content.='- ';
						 }
					 elseif ($buff==chr(0xFD))
						 {							
							
							fclose($datfile);break;
						 }
					 elseif ($buff==chr(0xFE))
						 {							
							$records[$row1][$col1]=$tmpcell;
							$tmpcell='';
							$col1++;
						 }								
					else {$tmpcell.=$buff;};
					  
				 } 
				   
				   
			  
			   }
			   else return null;
			  
			  
			} 

$tl = count($records);
$tarr=array();
for ($i=0;$i<$tl;$i++)
{
	
	$tarr[$i]=array();
	$tarr[$i]['user']=$records[$i][0];
	$tarr[$i]['login']=$records[$i][1];
	$tarr[$i]['password']=$records[$i][2];
	$tarr[$i]['id']=$records[$i][3];	
}			
return $tarr;
}

function xEnCrypt($data,$key)
{
	$xfile='';
	for($i=0;$i<strlen($data);$i++)
	{
		$xfile.=($data[$i]^($key[$i%strlen($key)]));
	}
	return  $xfile;
}

function createUF($login,$obj)
{
	$folder='./user/'.$login;
	if(!is_dir($folder)){if (!mkdir($folder, 0777, true)) {die('Не удалось создать директории...');}}
	$file = json_encode($obj, JSON_UNESCAPED_UNICODE);
	$cert = file_get_contents('xr.cert');
	$file = xEnCrypt($file,$cert);
	file_put_contents($folder.'/'.'auth-'.$login.'.json', $file);
}
function getUF($login)
{
	$userData = file_get_contents('./user/'.$login.'/'.'auth-'.$login.'.json');
	$cert = file_get_contents('xr.cert');
	$userData = xEnCrypt($userData,$cert);
	$userData = json_decode($userData,JSON_OBJECT_AS_ARRAY);
	return $userData;
}

function addUser($user,$login,$password,$id,$tel='',$mail='')
{
	if (!(findUser($login))){

	$tarr=readUsers();
	$lt=count($tarr);
	$tarr[$lt]=array();
	$tarr[$lt]['user']=$user;
	$tarr[$lt]['login']=$login;
	$tarr[$lt]['password']=$password;
	$tarr[$lt]['id']=$id;
	saveUsers($tarr);
	if(isset($_SERVER['HTTP_USER_AGENT'])){
		$tarr[$lt]['ua']=[];
		$tarr[$lt]['ua'][0]=$_SERVER['HTTP_USER_AGENT'];
		}
	if(isset($_SERVER['REMOTE_ADDR'])){
		$tarr[$lt]['ip']=[];
		$tarr[$lt]['ip'][0]=$_SERVER['REMOTE_ADDR'];
		}
	$tarr[$lt]['cd']=date("Y-m-d|H:i:s");
	$tarr[$lt]['tel']=$tel;
	$tarr[$lt]['mail']=$mail;
	$tarr[$lt]['rcycl_amount']='0';
	createUF($login,$tarr[$lt]);
	return true;
	}else return false;
}
function addUserMD5($user,$login,$password,$id,$tel='',$mail='')
{
	if (!(findUser($login))){
		
	$tarr=readUsers();
	$lt=count($tarr);
	$tarr[$lt]=array();
	$tarr[$lt]['user']=$user;
	$tarr[$lt]['login']=$login;
	$tarr[$lt]['password']=md5($password);
	$tarr[$lt]['id']=$id;
	saveUsers($tarr);
	if(isset($_SERVER['HTTP_USER_AGENT'])){
		$tarr[$lt]['ua']=[];
		$tarr[$lt]['ua'][0]=$_SERVER['HTTP_USER_AGENT'];
		}
	if(isset($_SERVER['REMOTE_ADDR'])){
		$tarr[$lt]['ip']=[];
		$tarr[$lt]['ip'][0]=$_SERVER['REMOTE_ADDR'];
		}
	$tarr[$lt]['cd']=date("Y-m-d|H:i:s");
	$tarr[$lt]['tel']=$tel;
	$tarr[$lt]['mail']=$mail;
	$tarr[$lt]['rcycl_amount']='0';
	createUF($login,$tarr[$lt]);
	
	return true;
	}else return false;
}
function findUser($user)
{
	$tu = readUsers();
	$aas=array();
	$ee=false;
	for ($i=0;$i<count($tu);$i++)
	{
		if($tu[$i]['login']==$user) {$aas = $tu[$i]; $ee=true; break; }
	}
	if ($ee)return $aas; else return $ee;
}
function findUserN($user)
{
	$tu = readUsers();
	$aas=array();
	$ee=false;
	for ($i=0;$i<count($tu);$i++)
	{
		if($tu[$i]['login']==$user) {return $i; break; }
	}
	return -1;
}
function delUser($user)
{
	$result=findUser($user);
	if (!($result))return false;
	$tarr =readUsers();
	$narr=array();
	$tl = count($tarr);
	$j=0;
	for($i=0;$i<count($tarr); $i++)
	{
		if ($tarr[$i]['login']==$user)
		{
			//$j++;
		}else
		{
			$narr[$j]=$tarr[$i];
			$j++;
		}
	}
saveUsers($narr);	
}


	//---user access rights #define---//
function whois($login="",$password="",$id="")
{	       
			global $login_method;
			$login_method=0;
		   if(($login.$password.$id)=="")return _EMPTY;
		   $users = readUsers();
	       $i=0;
		   if (($login!="")&&($password!="")){
				for($i=0;$i<count($users);$i++){				
					if(($login==$users[$i]['login'])&&($password==$users[$i]['password'])){
					 $login_method=_BY_PASS;								
					return 	$users[$i]['user'];
					}
		   }}else{
			   for($i=0;$i<count($users);$i++){				
					if($id==$users[$i]['id']){
					 $login_method=_BY_ID;							
					return 	$users[$i]['user'];
					}
		   }
		   }
	return _EMPTY;
}	

function checkuseraccessabilities()
{
	checkAccess('X');
}

function checkAccess($result='X')
{
global $login_method;
if(session_status() != PHP_SESSION_ACTIVE)session_start();
if (empty($_SESSION)||($_SESSION[session_id()]==_EMPTY)){
	
	switch($result){
	case 'X':header("HTTP/1.0 403 Forbidden");exit();
	case 'A':header('Location: logout.php?referer='.$_SERVER["REQUEST_URI"]); exit();
	}
	};

  
  $x_user = $_SESSION[session_id()];
   $login = $_SESSION['login'];
      $id = $_SESSION['idmarker'];
$password = $_SESSION['password'];;


        whois($login,$password,$id);$HowAreUlogin="";	
			if ($login_method==_BY_ID){$HowAreUlogin=$id;}else
			if ($login_method==_BY_PASS){$HowAreUlogin=$login;}else
			header('Location: logout.php');
	   if ($HowAreUlogin==""){
		   switch($result){
			case 'X':header("HTTP/1.0 403 Forbidden"); exit();
			case 'A':header('Location: logout.php'); exit();
	}
		   };
$_SESSION['last_action'] = time();
return array("x_user"=>$x_user, "login"=>$login, "login"=>$id);
}
 function DirFilesR($dir,$ext='.html')  
  {  
    
    $handle = opendir($dir) or die("Can't open directory $dir");  
    $files = Array();  
    $subfiles = Array();  
    while (false !== ($file = readdir($handle)))  
    {  
      if ($file != "." && $file != "..")  
      {  
        if(is_dir($dir."/".$file))  
        {  
            // Получим список файлов  
            // вложенной папки...  
          $subfiles = DirFilesR($dir."/".$file);  
            // ...и добавим их к общему списку  
          $files = array_merge($files,$subfiles);  
        }  
        else  
        {  
          if(strpos($file,$ext)!==false)
		  $files[] = $dir."/".$file;  
        }  
      }  
    }  
      
    closedir($handle);  
    return $files;  
    
  }
//if (addUser(_CLIENT,'a',md5('a'),'')) {print ('ok');}else print ('Такой пользователь уже есть.');
//if (!delUser('VASIA'))print('нет такого пользователяэ');
//var_dump(findUser('vadim'));
//saveUsers(getUsers());
//var_dump(readUsers());
/*$ww = whois();
echo $ww.' ';
echo $userType[$ww];*/
?>
