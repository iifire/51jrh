if (!window.Maya) var Maya = {};

Maya.Cookies = {};
Maya.Cookies.expires  = null;
Maya.Cookies.path     = '/';
Maya.Cookies.domain   = null;
Maya.Cookies.secure   = false;
Maya.Cookies.set = function(name, value){
     var argv = arguments;
     var argc = arguments.length;
     var expires = (argc > 2) ? argv[2] : Maya.Cookies.expires;
     var path = (argc > 3) ? argv[3] : Maya.Cookies.path;
     var domain = (argc > 4) ? argv[4] : Maya.Cookies.domain;
     var secure = (argc > 5) ? argv[5] : Maya.Cookies.secure;
     document.cookie = name + "=" + escape (value) +
       ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
       ((path == null) ? "" : ("; path=" + path)) +
       ((domain == null) ? "" : ("; domain=" + domain)) +
       ((secure == true) ? "; secure" : "");
};

Maya.Cookies.get = function(name){
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    var j = 0;
    while(i < clen){
        j = i + alen;
        if (document.cookie.substring(i, j) == arg)
            return Maya.Cookies.getCookieVal(j);
        i = document.cookie.indexOf(" ", i) + 1;
        if(i == 0)
            break;
    }
    return null;
};

Maya.Cookies.clear = function(name) {
  if(Maya.Cookies.get(name)){
    document.cookie = name + "=" +
    "; expires=Thu, 01-Jan-70 00:00:01 GMT";
  }
};

Maya.Cookies.getCookieVal = function(offset){
   var endstr = document.cookie.indexOf(";", offset);
   if(endstr == -1){
       endstr = document.cookie.length;
   }
   return unescape(document.cookie.substring(offset, endstr));
};
