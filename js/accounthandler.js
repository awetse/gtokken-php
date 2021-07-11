var 	trigerWidth='991';//px
var		trigerWorkwidth='700';//px
const availableScreenWidth = window.screen.availWidth;
function fgetId(str){
return 	document.getElementById(str);
}
function fgetClass(str){
return 	document.getElementsByClassName(str);
}
function getXmlHttp(){
var t;try{t=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){try{t=new ActiveXObject("Microsoft.XMLHTTP")}catch(c){t=!1}}return t||"undefined"==typeof XMLHttpRequest||(t=new XMLHttpRequest),t
}
function showMenu()
{
	//console.warn('showMenu()');
	menu_items = fgetClass('left-menu')[0];
	menu_tabs = fgetClass('work-sheet')[0];
	menu_button = fgetId('hamburger-menu');

	
	if(availableScreenWidth>trigerWidth)
	{
		menu_items.style.display='block';
		menu_tabs.style.display='block';
		menu_items.style.position='relative';
		return;
	}
	if(menu_button.checked)
	{
		menu_items.style.display='block';
		menu_items.style.position='absolute';
		menu_items.style.transform = "translateX(0px)";
		//if(availableScreenWidth<trigerWorkwidth) menu_tabs.style.display='none';
	
	}
	else
	{
		//menu_items.style.display='none';
		menu_items.style.position='absolute';
		menu_tabs.style.display='block';
		//menu_items.style.position='relative';
		menu_items.style.transform = "translateX(-350px)";
	}
}
function hideMenu()
{
	if(availableScreenWidth<trigerWidth)
	{
		menu_button = fgetId('hamburger-menu');
		menu_items = fgetClass('left-menu')[0];
		//menu_items.style.position='absolute';
		menu_items.style.transform = "translateX(-350px)";	
		menu_button.checked = false;
	}
}

function leftmenulistener()
{
	menu_items = fgetClass('left-menu')[0];
	menu_butt = fgetClass('nav-link');
	menu_button = fgetId('hamburger-menu');
	menu_button.addEventListener('click',showMenu);
	for(i=0;i<menu_butt.length;i++)
	{
		menu_butt[i].addEventListener('click',hideMenu);
	}


	if(availableScreenWidth<trigerWidth)
	{
		menu_items.style.display='block';
		menu_items.style.position='absolute';
		menu_items.style.transform = "translateX(-350px)";	
	}
	showMenu();
}
function buyitemslistener()
{
	buttons = document.querySelectorAll('.buy-token, .sale-token');
	for(i=0;i<buttons.length;i++)
		{
			buttons[i].addEventListener('click', buyformshow);
		}
}
var myModal;
var myModalEl;
function operateTokens(operator,id,count=1)
{
	console.warn('operator '+operator);
	console.warn('id '+id);
	console.warn('e '+event.target);
	item_id='buyModalId';
	$('#'+item_id).modal('hide');
}

function buyformshow()
{
	target_text = event.target.innerText;
	console.warn('++ '+event.target.id);
	action = event.target.id.split('-');
	for(cx=2;cx<action.length;cx++)
	{
		action[1]+=''+action[cx];
	}
	while(action.length>2)
	{
		action.pop();
	}
	//console.warn('+- '+action[0]);
	//console.warn('+- '+action[1]);
	//console.warn('+- '+action.length);
	item_id='buyModalId';
	label_id='buy-ModalLabel';
	
	var myModal = new bootstrap.Modal(document.getElementById(item_id), {keyboard: false});
	asd = document.querySelector('#'+label_id);
	modalform = event.target.parentElement.parentElement.parentElement;
	console.log('id: '+modalform.parentElement.id);
	sItem =modalform.querySelector('.tokenTypeItem-title');
	modalbody = document.querySelector('.modal-body');
	console.log(sItem.parentElement.id);
	asd.innerText=''+sItem.innerText;
	tStr='';
	spans = modalform.querySelectorAll('span');
	for (u=0;u<spans.length;u++)
	{
		tStr+='<div>'+spans[u].innerText+'</div>';
	}
	tStr+='<div class="input-group mb-3">';
	tStr+='<span class="input-group-text">TOKEN AMOUNT</span>';	
	tStr+='<input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" value="1">';
	tStr+='</div>';
	ttext = document.querySelector('.btn-target-text');
	zzzz = 'javascript:operateTokens("'+action[0]+'","'+action[1]+'",1);';
	ttext.setAttribute('onclick',zzzz);
	ttext.innerHTML = target_text;
	modalbody.innerHTML=tStr;
	myModal.show();
}
function initialize()
{
	leftmenulistener();
	buyitemslistener();
	

}
document.addEventListener("DOMContentLoaded", initialize);	