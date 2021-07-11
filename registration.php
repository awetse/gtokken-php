<?php
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
?>

<!DOCTYPE HTML >
<html>
<title>[- Авторизация -]</title>
<head>

  <meta name="theme-color" content="#000099">
  <meta name="msapplication-navbutton-color" content="#000099">
  <meta name="apple-mobile-web-app-status-bar-style" content="#000099">
  
  <!--link rel="icon" href="./favicon64.png" type="image/x-icon"/-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css/main.css">
  <link rel="stylesheet" type="text/css" href="">
</head>

<style>

</style>
<script src="" type="text/javascript" charset="utf-8"></script>

<script>


	

</script>
<?php 

//echo "admin: ".md5('awetse123456789');

?>
<body class="a">

  <div class="main-container" style="display: block;float:none;">	
  
      <div class="logoHeader-container" id=logo-header>
	
	 
	 <div class="logoHeader-block id=logoHeader-block-2">	  
	 </div>
	 <div class="mobile-menu-button" id="icon-menu-home" onclick="document.location.href = '../';">
	 </div >
	</div>
  
	<div id="toolHeader2" class="header-2 toolHeader-container">

	<div onclick="javascript:document.location.href='logout.php'; "  style="color:white;cursor:pointer">[Выход]</div>
	</div>
	
	
	<div class="mainForm loginForm" id="loginFormId" data-uid="<?php echo($user_id)?>">
	   <div class="h3 mb-4">Регистрация</div>
	   <div	class="input-box">
	   

	        <form -a-ction="account.html" -target="_self" -method="post" class="loginform">			
			<div class="d-block" -style="position:relative;width: 70%;min-width: 250px;">
				<label for="login" class="form-label">Имя пользователя: </label>		
				<input type="edit" class="edit_field input-login form-control" id="login" name="login" autocomplete="new-password">
				<div class="error-tip" id="login-error"></div>
			</div>
			<div class="d-block" -style="position:relative;width: 70%;min-width: 250px;">
			<label for="password" class="form-label">Пароль: 
			<div class="eye-icon eye-open show">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>
				</div>
			</label>
			<input type="password" class="edit_field input-login form-control" id="password" autocomplete="new-password">
			<div class="error-tip" id="password-error">	</div>	
			</div>
			
			
			<div class="d-block" -style="position:relative;width: fit-content;min-width: 250px;">
			<label for="password2" class="form-label">Повторный пароль: 
			<div class="eye-icon eye-open show">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>
				</div>	
			</label>
			<input type="password" class="edit_field input-login form-control" id="password2" autocomplete="new-password">
			<div class="error-tip" id="password2-error"></div>			
			</div>
			<div class="d-block" -style="position:relative;width: fit-content;min-width: 250px;">
			<label for="mailbox" class="form-label">Почта: </label>
			<input type="edit" class="edit_field input-login form-control" id="mailbox" placeholder="name@example.com">
			<div class="error-tip" id="mailbox-error"></div>
			</div>
			<div class="d-block" -style="position:relative;width: fit-content;min-width: 250px;">
			<label for="phonenumber" class="form-label">Телефон: </label>			
			<input type="tel" class="edit_field input-login form-control" id="phonenumber" placeholder="+7 (999) 888-77-66" >
			<div class="error-tip" id="phonenumber-error"></div>
			</div>	
			
			<!--div class="form-check">
					<input class="form-check-input save-login" type="checkbox" value="" id="save" checked>
					<label class="form-check-label save-login" for="save">
						Запомнить меня
					</label>
			</div-->
			
			<input type="button" id="regsubmit-btn" class="edit_field btn btn-primary d-block my-4" value="Зарегистрироваться" disabled >		
		  </form>
		<div class="info-box">	 
	  <a href="account.html">Войти в аккаунт</a>
	  </div>
	  
	  </div>
	  <div class="info-box">

	  </div>
	
	</div >
	
	<!--div class="mainForm" id="myOrderForm" style="display:block;" >
  
	</div-->

	
	
  </div>	
  
<div id=consoler style=""></div>  
<script src="./js/jquery-3.5.1.js" type="text/javascript" charset="utf-8"></script>
<script src="./js/masked_input.js" type="text/javascript" charset="utf-8"></script>
<script src="./js/editcookie.js" type="text/javascript" charset="utf-8"></script>
<script src="./js/valenok.js" type="text/javascript" charset="utf-8"></script>
<!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

<script src="./js/authhandlers.js?v=44" type="text/javascript" charset="utf-8"></script>
<script>
$(function() {$("#phonenumber").mask("+7(999) 999-99-99");});
document.addEventListener("DOMContentLoaded", initialize);	
</script>
</body>
</html>