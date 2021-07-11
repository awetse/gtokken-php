function fgetId(str){
return 	document.getElementById(str);
}
function fgetClass(str){
return 	document.getElementsByClassName(str);
}
  function getXmlHttp() {
    var xmlhttp;
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }
function setListeners()
{
	console.warn("setListeners called");
	tInputs = fgetClass('form-control');
	subButton = fgetId('regsubmit-btn');
	tLength = tInputs.length;
	approved = false;
	for(i=0;i<tLength;i++)
	{
		tInputs[i].addEventListener('keyup',checkCorrectRegData)
	}
	subButton.addEventListener('click',sendRegInformation);
}
function sendRegInformation()
{
	if (checkCorrectRegData())
	{
		registrationStart();
	}
	else
	return false;
}
function registrationStart()
{
	login = fgetId('login');
	login = login.value.trim();	
	target = 'checklogin.php';
	var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
    xmlhttp.open('POST', target, true); // Открываем асинхронное соединение
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
	
    xmlhttp.send(login); // Отправляем POST-запрос
    xmlhttp.onreadystatechange = function() { // Ждём ответа от сервера
      if (xmlhttp.readyState == 4) { // Ответ пришёл
        if(xmlhttp.status == 200) { // Сервер вернул код 200 (что хорошо)
          registrateUser(xmlhttp.responseText);
			tErrTips = fgetId('login-error');
			//tErrTips.innerHTML='ok';
        }else {tErrTips = fgetId('login-error');
				tErrTips.innerHTML='Пользователь с таким именем существует';
				}
      }
    };
}
function registrateUser(tStr)
{
x_user={};
tInputs = fgetClass('form-control');
tLength = tInputs.length;
for(i=0;i<tLength;i++)
{
	x_user[tInputs[i].id] = tInputs[i].value;
}
delete x_user['password2'];
x_user['phonenumber']=x_user['phonenumber'].replaceAll('+','');
x_user['password']=MD5(x_user['password']);
x_user['tS'] = editCookie.get('tS');
x_user['userid'] = editCookie.get('userid');
x_user_json = JSON.stringify(x_user);
//console.warn('login - '+tStr);
//console.warn(x_user_json);
sendRegistrationData(x_user_json);

}
function sendRegistrationData(x_user_data)
{
	target = 'reguserdata.php';
	var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
    xmlhttp.open('POST', target, true); // Открываем асинхронное соединение
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
	
    xmlhttp.send(x_user_data); // Отправляем POST-запрос
    xmlhttp.onreadystatechange = function() { // Ждём ответа от сервера
      if (xmlhttp.readyState == 4) { // Ответ пришёл
        if(xmlhttp.status == 200) { // Сервер вернул код 200 (что хорошо)
          console.warn(xmlhttp.responseText);
			document.location.href='account.html';
        }else {tErrTips = fgetId('login-error');
				tErrTips.innerHTML='Что-то пошло не так, обновите страницу';
				}
      }
    };
}

function checkCorrectRegData()
{
	//console.warn("checkCorrectRegData called");
	let alertcolor='#ee0000';
	let aprovecolor='#aaaaaa';
	tInputs = fgetClass('form-control');
	tErrTips = fgetClass('error-tip');
	tLength = tInputs.length;
	approved = true;
	for(i=0;i<tLength;i++)
	{
		switch(tInputs[i].id)
		{
			case'login':{
						tInputs[i].value = tInputs[i].value.replace(/\s/g, '');
						if(tInputs[i].value.length<8)
						{
						approved=false;
						tInputs[i].style.border='2px solid '+alertcolor;
						tErrTips[i].innerHTML='* Логин должен содержать не менее 8 сиволов';
						}
						else {tInputs[i].style.border='2px solid '+aprovecolor;
							tErrTips[i].innerHTML='';
						}

								break;
						}
			case'password':{
								tInputs[i].value = tInputs[i].value.replace(/\s/g, '');
								regexp = /[^A-Za-z0-9_.]/;
								regexp = /^[\w.]+/;
								valid = regexp.test(tInputs[i].value);
								//console.warn(tInputs[i].value+ ' -> '+valid);
								if((tInputs[i].value.length<8)||(!valid))
								{
								approved=false;
								tInputs[i].style.border='2px solid '+alertcolor;
								
								if(!valid)tErrTips[i].innerHTML='* Пароль должен содержать латинские буква и цифры';
								else tErrTips[i].innerHTML='* Пароль должен содержать не менее 8 сиволов';
								}
									else {
										tInputs[i].style.border='2px solid '+aprovecolor;
										tErrTips[i].innerHTML='';
									}
								break;
							}
			case'password2':
							{
								tInputs[i].value = tInputs[i].value.replace(/\s/g, '');
								if((tInputs[i].value!=tInputs[i-1].value))
						{
						approved=false;
						tInputs[i].style.border='2px solid '+alertcolor;
						tInputs[i-1].style.border='2px solid '+alertcolor;
						tErrTips[i].innerHTML='* Пароль не совпадает';
						}
						else {tInputs[i].style.border='2px solid '+aprovecolor;
						tInputs[i-1].style.border='2px solid '+aprovecolor;
						tErrTips[i].innerHTML='';}
								break;
							}
			case'mailbox': {
						regexp=/^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i;
						str = tInputs[i].value;
						valid = regexp.test(str);
						if (valid){
								tInputs[i].style.border='1px solid '+aprovecolor;
								tErrTips[i].innerHTML='';	
									}else{
								tInputs[i].style.border='2px solid '+alertcolor;
								tErrTips[i].innerHTML='* Не корректный адрес электонной почты';
								approved=false;
								};
							break;
							}
			case'phonenumber':{
								tel = tInputs[i].value.replaceAll('-','');
								tel = tel.replaceAll('+','');
								tel = tel.replaceAll('(','');
								tel = tel.replaceAll(')','');
								tel = tel.replaceAll(' ','');
								tel = tel.replaceAll('_','');								
								if((tel.length<11))
								{
								approved=false;
								tInputs[i].style.border='2px solid '+alertcolor;
								tErrTips[i].innerHTML='* Не корректный номер телефона';
								}
									else {
										tInputs[i].style.border='2px solid '+aprovecolor;
										tErrTips[i].innerHTML='';
									}
									
								break;
								}
		}
	}
	tButton = fgetId('regsubmit-btn');
	if (approved){
		
		tButton.disabled=false;
	}else tButton.disabled=true;
return approved;
}
function showPwd(sender)
{
	eye_open='<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>';
	eye_close='<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">  <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>  <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/></svg>';	
	pLogo=this;
	pDiv=this.parentNode;
	pInput = this.parentNode.parentNode.querySelector('input.edit_field');
	if (pInput.getAttribute('type')=='password'){
		pLogo.innerHTML = eye_close;
		pInput.setAttribute('type','edit');
		
	}else {
		pLogo.innerHTML = eye_open;
		pInput.setAttribute('type','password');
	}
	
}
function pweyelistener()
{
	
	eye_ico = fgetClass('eye-icon');
	for(yu=0;yu<eye_ico.length;yu++)
	{
		
		eye_ico[yu].addEventListener('click',showPwd);
	}
}
function initialize()
{
		console.warn("initialize called");
	setListeners();
		pweyelistener();
}