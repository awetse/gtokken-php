
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

function checkStart()
{
	login = fgetId('login');
	pashash=fgetId('clientpass');
	login = login.value.trim();	
	pashash = pashash.value.trim();	
	target = 'checklp.php';
	pS = 'login='+login+'&hash='+pashash;
	var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
    xmlhttp.open('POST', target, true); // Открываем асинхронное соединение
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
	
    xmlhttp.send(pS); // Отправляем POST-запрос
    xmlhttp.onreadystatechange = function() { // Ждём ответа от сервера
      if (xmlhttp.readyState == 4) { // Ответ пришёл
        if(xmlhttp.status == 200) { // Сервер вернул код 200 (что хорошо)
         document.location.href = 'login.php'+glReferer;
		  //registrateUser(xmlhttp.responseText);
			tErrTips = fgetId('auth-error');
			tErrTips.innerHTML=xmlhttp.responseText;
        }else {tErrTips = fgetId('auth-error');
				tErrTips.innerHTML='Неверный логин или пароль';
				errorAuth();
				}
      }
    };
}
function errorAuth()
{
	return false;
}
function checkvalid()
{
	checkStart();
}
function checklp()
{
	console.warn('checklp()');
	pass=fgetId('password'),
	log=fgetId('login'),
	warn = fgetId('auth-error');
	if((log.value=='')||(pass.value=='')){
		warn.innerHTML = 'Введите логин и пароль';
		return false;
	}
	return true;
	
}
function setMD5(){
	
let a=fgetId('password'),	
	b=fgetId('clientpass'),
	c=fgetId('login');
	d=fgetId('save');
	
(a.value=="")?b.value="":b.value=MD5(a.value);

if(c.value!='' && b.value!='')
{
	editCookie.set('userlogin',c.value, 365);
	editCookie.set('userpassword',b.value, 365);
	if (d.checked)
	{		
		editCookie.set('remember','yes', 365);
	}
	else
	{
		//editCookie.set('userlogin',c.value, 365);
		//editCookie.set('userpassword',b.value, 365);
		editCookie.set('remember','no', 365);
	}
}
if(checklp())checkvalid();
};
function initialize()
{
	sButton = document.querySelector('input#loginbutt');
	sButton.setAttribute('type','button');
	sButton.addEventListener('click',setMD5);
}

document.addEventListener("DOMContentLoaded", initialize);	