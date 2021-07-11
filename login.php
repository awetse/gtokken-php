<?php
/*Список заказов по всем ClientID*/
//include('datablock.php');
$user_id='';
	if(isset($_SERVER['HTTP_USER_AGENT']))
		{
			$user_id.=$_SERVER['HTTP_USER_AGENT'];
		}
	if(isset($_SERVER['REMOTE_ADDR']))
		{
			$user_id.=$_SERVER['REMOTE_ADDR'];
		}
$user_id=md5($user_id);
$tstr='';
for($i=0;$i<strlen($user_id);$i++)
{
	$tstr=$user_id[$i].$tstr;
}
$user_id=$tstr;
if(!isset($_COOKIE['userid']))
{
	setcookie('userid',$user_id,time() + 3600,'/');
}
else {
	setcookie('userid',$_COOKIE['userid'],time() + 3600,'/');
}
$tSalt=md5($user_id.time());
setcookie('tS',$tSalt,time() + 3600,'/');

include('userdata.php');
$a = array();
$id="";
$login='';
$password='';
$x_user=_EMPTY;
$id_valid=false;
$display='none';
$str='';
$referer=false;
if(isset($_GET["referer"]))
{
	$http = 'https://';
	if((stripos($_SERVER["SERVER_NAME"],'192.168')===false))$http = 'https://';else $http = 'http://';
	$referer = $http.$_SERVER["SERVER_NAME"].$_GET["referer"];
	//echo $referer;
}
if (isset($_COOKIE['userlogin'])){$login=$_COOKIE['userlogin'];};
if (isset($_COOKIE['userpassword'])){$password=$_COOKIE['userpassword'];};
/*echo'';echo'<br>';
echo $x_user;
echo'<br>';
echo $login;
echo'<br>';
echo $password;
echo'';echo'<br>';*/
$x_user = whois($login,$password,$id);
setcookie('t_UI',md5($login.$password.$id),time() + 3600,'/');
setcookie('t_At',md5($x_user),time() + 3600,'/');

if((isset($_COOKIE['remember']))&&($_COOKIE['remember']=='yes'))
{
	//$x_user = whois($_COOKIE['userlogin'],$_COOKIE['userpassword'],'');
	setcookie('remember','yes',time() + 3600,'/');
	setcookie('userlogin',$_COOKIE['userlogin'],time() + 3600,'/');
	setcookie('userpassword',$_COOKIE['userpassword'],time() + 3600,'/');
	//setcookie('userid',$user_id,time() + 3600,'/');
}else{
	/*setcookie('remember','',time() + 3600,'/');
	setcookie('userlogin','',time() + 3600,'/');
	setcookie('userpassword','',time() + 3600,'/');
	setcookie('userid','',time() + 3600,'/');*/
	//$x_user = whois($login,$password,$id);
}

//die();
//$x_user = whois($login,$password,$id);
if ($x_user==_EMPTY){
	/*setcookie('remember','',time() - 3600,'/');
	setcookie('userlogin','',time() - 3600,'/');
	setcookie('userpassword','',time() - 3600,'/');
	setcookie('userid','',time() - 3600,'/');*/
	//header('Location: logout.php');
	$display='block';	
}


if ((true)){
$str="";
			
		if ($i=0)echo"";
		if ($x_user!=_EMPTY)
		{
			session_start();
			$_SESSION[session_id()]=$x_user;
			$_SESSION['login']=$login;
			$_SESSION['idmarker']=$user_id;
			$_SESSION['password']=$password;
			$_SESSION['user_id']=$user_id;
			if(isset($_COOKIE['tS']))$_SESSION['tSalt']=$_COOKIE['tS'];
			if($referer)
			{
				header('Location: '.$referer);
			}else {header('Location: account.html?user='.$login);};		
		}
}

?>

<!DOCTYPE HTML >
<html>
<title>[- Авторизация -]</title>
<head>

  <meta name="theme-color" content="#000099">
  <meta name="msapplication-navbutton-color" content="#000099">
  <meta name="apple-mobile-web-app-status-bar-style" content="#000099">
  
  <link rel="icon" href="./favicon64.png" type="image/x-icon"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css/main.css">
  <link rel="stylesheet" type="text/css" href="">
</head>

<style>

</style>
<script src="editcookie.js" type="text/javascript" charset="utf-8"></script>
<script src="valenok.js" type="text/javascript" charset="utf-8"></script>
<script>
</script>
<?php 

//echo "admin: ".md5('awetse123456789');

?>
<body class="a">
  <div class="main-container" style="display: block;float:none;">	
  
      <div class="logoHeader-container" id=logo-header>
	
	 <div class="mobile-menu-button" id="icon-menu-home" onclick="document.location.href = '../';">
	 </div >
	 <div class=logoHeader-block id=logoHeader-block-2>	  
	 </div>
	</div>
  
	<div id="toolHeader2" class="header-2 toolHeader-container">
	<?php
	
	global $login_method;
	//echo "<a href='../' class=light-link>← home </a><br>";
/*	echo "User status: ".$x_user."<br>";
	
	if ($x_user==_EMPTY){
		echo "LOGIN REQUIRE<BR>";
		//setcookie('remember','no',time() + 3600,'/');
		}else{
		//if ($login_method==_BY_ID){echo "User ID: ".$id."<br>";}
		if ($login_method==_BY_PASS){echo "User : ".$login."<br>";}
	}
*/		
		
	
	?>
	<div onclick="javascript:document.location.href='logout.php'; "  style="color:white;cursor:pointer">[Выход]</div>
	</div>
	
	
	<div class="mainForm loginForm" id="loginFormId" style="display:<?php echo $display?>">
	   <div class="h3 mb-4">Авторизация</div>
	   <div	class="input-box">
	   
	   <?php
	   if($referer)
	   {
		   $tGet = '?referer='.$_GET["referer"];
	   } else $tGet='';
	   ?>
	   <?php

		if(isset($_COOKIE['remember'])&&($_COOKIE['remember']=='yes')&&$x_user!=_EMPTY)
		{
			echo $x_user;
		}else {
			if($referer)
	   {
		   $tGet = '?referer='.$_GET["referer"];
	   } else $tGet='';
			 ?>
	      <form action="login.php<?php  echo $tGet ?>" -target="_self" method="post" class="loginform">			
			<label for="login" class="form-label">Имя пользователя: </label>
			<input type="edit" class="edit_field input-login form-control" id="login" name="login">
			<label for="password" class="form-label">Пароль: </label>
			<input type="password" class="edit_field input-login form-control" id="password" >
			<input type="hidden" id="clientpass" name="password">	
			<div class="form-check">
					<input class="form-check-input save-login" type="checkbox" value="" id="save" checked>
					<label class="form-check-label save-login" for="save">
						Запомнить меня
					</label>
			</div>
			
			<input type="submit" class="edit_field btn btn-primary d-block" id="loginbutt" value="Войти">
			<div class="error-tip" id="auth-error"></div>			
		  </form>
		<?php
				}
		?>
	  
	  </div>
	  <div class="info-box">
	  <a href="#">Забыли пароль?</a><br><br>
	  <a href="registration.php">Зарегистрироваться</a>
	  </div>
	
	</div >
	
	<div class="mainForm" id="myOrderForm" style="display:block;" >
    


	<?php

//addUserMD5(_ADMIN,'7','7',$user_id);
	?>



	</div>

	
	
  </div>	
<script>
glReferer=<?php echo '"'.$tGet.'"' ?>;
</script>  
<script src="./js/loginhandler.js" type="text/javascript" charset="utf-8"></script>  
<div id=consoler style=""></div>  
</body>
</html>