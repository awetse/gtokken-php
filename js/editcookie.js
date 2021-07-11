editCookie =
{
  set: function(key, value, expires, path, domain, secure)  ///editCookie.set()
  {
    let sCookie = key+'='+escape(value)+'; ';

    if(expires !== undefined) {
      let date = new Date();
      date.setTime(date.getTime()+(expires*24*60*60*1000));
      sCookie+= 'expires='+date.toGMTString()+'; ';
    }

    sCookie+= (path === undefined) ? 'path=/;' : 'path='+path+'; ';
	sCookie+= (domain === undefined) ? '' : 'domain='+domain+'; '
	sCookie+= (secure === true) ? 'secure; ' : '';

    document.cookie = sCookie;
  },

  get: function(sKey)   ///editCookie.get()
  {
    let sValue = '';
    let sKeyEq = sKey+ '=';
    let aCookies = document.cookie.split(';');

    for(let iCounter = 0, iCookieLength = aCookies.length; iCounter < iCookieLength; iCounter++) {
      while(aCookies[iCounter].charAt(0) === ' ') {aCookies[iCounter] = aCookies[iCounter].substring(1);}
      if(aCookies[iCounter].indexOf(sKeyEq) === 0) {
        sValue = aCookies[iCounter].substring(sKeyEq.length);
      }
    }

    return unescape(sValue);
  },
  
  getR : function (name)  ///editCookie.getR()
  {
  
  if (name){
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
  }else return undefined;
},
  
  

  remove: function(key)   ///editCookie.remove()
  {
    editCookie.set(key, '', -1);
  },

  clear: function()
  {
    let aCookies = document.cookie.split(';');
    
    for(let iCounter = 0, iCookieLength = aCookies.length; iCounter < iCookieLength; iCounter++) {
      while(aCookies[iCounter].charAt(0) === ' ') {aCookies[iCounter] = aCookies[iCounter].substring(1);}
      let iIndex = aCookies[iCounter].indexOf('=', 1);
      if(iIndex > 0) {
        cookie.set(aCookies[iCounter].substring(0, iIndex), '', -1);
      }
    }
  },

  isEnabled: function()   ///editCookie.isEnabled()
  {
    editCookie.set('test_cookie', 'test');

    let val = (editCookie.get('test_cookie') === 'test') ? true : false;

    editCookie.remove('test_cookie');

    return val;
  }
};