var _$QAuthor;
var _SCountIframe;
var _SLoadTime;
var _$QPageType;
var _$QPagePic;
var _$QPageId;
var _$Qformlist = '';
var _$Qformdetails = {};
var _$Qformfielddetails = {};
var _$Qwebsite = _$Qpartner_website = '10000001';
var _Spartner_website_id;
var _Schannel_website_id;
var _Schannel_webshop_id;
var _Sorder_encode_url;
var _$Qdocument = window.document;
var _$Qdocumentcookie = window.document;
var _$Qdocumentbody = _$Qdocument.getElementsByTagName('body')[0];
var _$Qprotocol = _$Qdocument.location.protocol;
var _trackDataType;
var _trackData = _trackData || [];
if (_SCountIframe === true)
{
	try {_$Qdocument = top.window.document;} catch(e) {}
	try {_$Qdocument = window.parent.document;} catch(e) {}
}

var _$Qflashid = 'PHPStat_Nru_' + _$Qwebsite;
var _$Qcounturl = 'http://phpstat.228.cn/phpstat/';
var _$Qcounturl_client = _$Qcounturl;
var _$Qmediumsource = _$Qmediumsourcetype = _$Qmediumsourcefirst = _$Qkeywordsource = _$Qedmemail = _$Qfriendlink = _$QfriendlinkN = _$Qkeywordkey = '';
var _$Qstarttime = _$Qtimestart = _$Qloadtime = _$Qdowntime = _$Qgettime = (new Date()).getTime();
var _$Qrandomid = (parseInt(_$Qstarttime/1000)+'').substr(4,8);
function _$Qerr()
{
	return true;
}
window.onerror = _$Qerr;
function _$Qunicode(s){
   var len=s.length;
   var rs="";
   for(var i=0;i<len;i++){
          rs+= s.charCodeAt(i)%10;
   }
   return rs;
}
function _$Qreadmapcookie(name)
{
	var cV = end = '';
	var v = name + '=';
	if (_$Qdocument.cookie) 
	{
		var p = _$Qdocument.cookie.indexOf(v);
		if (p > -1) {
			p += v.length;
			end = _$Qdocument.cookie.indexOf(";", p);
			if (end == -1) {end = _$Qdocument.cookie.length;};
			cV = _$Qdocument.cookie.substring(p, end);
		}
		return cV;
	}
}
(function() {
	var CHARS = '01234567891357924680'.split('');
	Math.uuid = function (len, radix) 
	{
		var chars = CHARS, uuid = [], i;
		radix = radix || chars.length;

		if (len)
		{
			for (i = 0; i < len; i++) uuid[i] = chars[0 | (Math.random()*radix)];
		}
		return uuid.join('');
	};
})();
function _$Qflash_cookie()
{
	var f=0;
	var v=0;
	var swf;
	var ie = _$Quseragent.match(/msie ([\d.]+)/);
	if(ie)
	{
		try {
		swf = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
		if(swf) 
		{
			f=1;
			var vs=swf.GetVariable("$version");
			v=parseInt(vs.split(" ")[1].split(",")[0]);
		}
		}
		catch (e) {
        }
	}
	else
	{
		if (navigator.plugins && navigator.plugins.length > 0)
		{
			swf=navigator.plugins["Shockwave Flash"];
			if (swf)
			{
				f=1;
				var ws = swf.description.split(" ");
				for (var i = 0; i < ws.length; ++i)
				{
					if (isNaN(parseInt(ws[i]))) continue;
					v = parseInt(ws[i]);
				}
			}
		}
	}
	return {f:f,v:v};
}
var _$Quseragent = navigator.userAgent.toLowerCase();
var _$Qtelphone = /(nokia|sony|ericsson|moto|samsung|htc|sgh|lg|sharp|philips|panasonic|alcatel|lenovo|iphone|ipod|ipad|blackberry|meizu|android|netfront|symbian|ucweb|windowsce|palm|operamini|openwave|nexusone|playstation|nintendo|symbianos|dangerhiptop|dopod|midp)/.exec(_$Quseragent);
_$Qtelphone = _$Qtelphone === null ? '' : _$Qtelphone[0];
var _$Qflashok = _$Qflash_cookie();
var _$Qphpstat_flash_object;
function _$Qdownloadflash(){

	"use strict";
	var counter = 0;	
	var alpnum = /[^a-z0-9_]/ig;

	window.phpstatCookie = function(config){
		config = config || {};
		var defaults = {
			swf_url: _$Qcounturl+'/cookie/storage.swf',
			namespace: 'namespace_phpstat',
			debug: true,
			timeout: 10,
			onready: null,
			onerror: null
		};
		var key;
		for(key in defaults){
			if(defaults.hasOwnProperty(key)){
				if(!config.hasOwnProperty(key)){
					config[key] = defaults[key];
				}
			}
		}
		function _$Qdiv(visible){
			var d = _$Qdocument.createElement('div');
				d.id = "phpstat_js_div_id_10000001";
			var s = (_$Qfgid('phpstat_js_id_10000001')||_$Qfgid('phpstat_js_id')); 
			if (s)
			{				
				d.async = true; 
				s.parentNode.insertBefore(d, s);
			}
			return d;
		}
		var swfContainer = _$Qdiv(config.debug);
		config.namespace = config.namespace.replace(alpnum, '_');
		this.config = config;		
		function _$Qfid(){
			return "phpstatCookie_" + config.namespace + "_" +  (counter++);
		}
		function _$Qfgid(id){
			return _$Qdocument.getElementById(id);
		}
		phpstatCookie[config.namespace] = this;
		
		var swfName = _$Qfid();
			
		var flashvars = "logfn=phpstatCookie." + config.namespace + ".log&amp;" + 
			"onload=phpstatCookie." + config.namespace + ".onload&amp;" + 
			"onerror=phpstatCookie." + config.namespace + ".onerror&amp;" + 
			"LSOName=" + config.namespace;
			
		swfContainer.innerHTML = '<object height="1" width="1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab" id="' + 
			swfName + '" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">' +
			'	<param value="' + config.swf_url + '" name="movie">' + 
			'	<param value="' + flashvars + '" name="FlashVars">' +
			'	<param value="always" name="allowScriptAccess">' +
			'	<embed height="1" align="middle" width="1" pluginspage="http://www.macromedia.com/go/getflashplayer" ' +
			'flashvars="' + flashvars + '" type="application/x-shockwave-flash" allowscriptaccess="always" quality="high" loop="false" play="true" ' +
			'name="' + swfName + '" bgcolor="#ffffff" src="' + config.swf_url + '">' +
			'</object>';
		
		this.swf = _$Qdocument[swfName] || window[swfName];
		
		this._timeout = setTimeout(function(){
			if(config.onerror){
				config.onerror();
			}
		}, config.timeout * 1000);
	};

	phpstatCookie.prototype = {
  
		version: "1.5",
		ready: false,
		set: function(key, value){
			this._checkReady();
			this.swf.set(key, value);
		},
		get: function(key){
			this._checkReady();
			return this.swf.get(key);
		},
		getAll: function(){
			this._checkReady();
			var data = this.swf.getAll();
			if(data.__flashBugFix){
				delete data.__flashBugFix;
			}
			return data;
		},
		clear: function(key){
			this._checkReady();
			this.swf.clear(key);
		},
		_checkReady: function(){
		},
		"onload": function(){
			var that = this;
			setTimeout(function(){
			  clearTimeout(that._timeout);
			  that.ready = true;
			  that.set('__flashBugFix','1');
			  if(that.config.onready){
			    that.config.onready();
			  }
			}, 0);
		},
		onerror: function(){
			clearTimeout(this._timeout);
			if(this.config.onerror){
				this.config.onerror();
			}
		}
		
	};
}
var _$Qisdownloadflash = 0;
if(_$Qflashok.v >= 88 && _$Qdocument.location.hash.toString().indexOf('clickmapcode') <= -1 && typeof(_$Qdocumentbody) !== 'undefined' && _$Qtelphone === '' && _$Qreadmapcookie('PHPStatMap') === '')
{
	_$Qisdownloadflash = 1;
}
if(_$Qisdownloadflash === 1)
{
	_$Qdownloadflash();
}
var _$Qclienturl = new Array();
;
var _$Qthehostname = _$Qdocument.location.hostname;
var _$Qgetclienthost;
for (_$Qgetclienthost in _$Qclienturl) {
    if (_$Qgetclienthost == _$Qthehostname) {
        _$Qcounturl_client = _$Qclienturl[_$Qgetclienthost];
        break
    }
}
function _$Qphpstat(cookietype) {
	var _$Qdoimgerr_1 = 1;
    var _$Qreferrer = _$Qdocument.referrer;
    var _$Qtitle = _$Qdocument.title;
    var _$Qlanguage = (navigator.systemLanguage ? navigator.systemLanguage : navigator.language);
    var _$Qcolor = screen.colorDepth;
    var _$Qclientwidth = _$Qdocument.documentElement.clientWidth;
    var _$Qclientheight = _$Qdocument.documentElement.clientHeight;
    var _$Qscreensize = screen.width + '*' + screen.height;
    var _$Qlastmodify = new Date(_$Qdocument.lastModified).getTime();
    var _$Qcookie = navigator.cookieEnabled ? 1 : 0;
    var _$Qsearchkey = ['baidu','baidu','google','yahoo','sogou','bing','youdao','soso','haosou','sm','baidu','haosou','baidu','baidu','baidu','baidu','baidu','','chinaso','sm','zhongsou'];var _$Qkeyword = ['wd','word','q','p','query','q','q','w','q','q','word','q','wd','wd','word','wd','word','','q','q','w'];var _$Qsearchtype = ['default','default','default','default','default','default','default','default','default','default','default','default','default','default','default','default','default','customer','default','default','default'];var _$Qkeywordrelated = ['bs','bs','','','','','lq','bs','','','','','','','','','','','','',''];;
    var _$Qhostname = _$Qdocument.location.hostname;
    var _$Qcounturl_logcount = _$Qcounturl_client + '/logcount.php';
    var _$Qfirsttime;
    var _$Qlasttime;
    var _$Qreturncount;
    var _$Qusercookie;
    var _$Qlusercookie;
    var _$Qusername;
    var _$Quserid;
    var _$Quserregtime;
    var _$Quserage;
    var _$Qusersex;
	var _$Qdomain='';
	var _$Qrefid = new Array();
	_$Qrefid['p_recom_id'] = '';
	_$Qgd(_$Qhostname);
	_$QAuthor	= _$Qtypeof(_$QAuthor);
	_$QPageType	= _$Qtypeof(_$QPageType);
	_$QPagePic	= _$Qtypeof(_$QPagePic);
	_$QPageId	= _$Qtypeof(_$QPageId);
    if (typeof(_SLoadTime) == 'undefined') {
        _$Qdowntime = 0
    } else {
        _$Qstarttime = parseInt(_SLoadTime);
        _$Qdowntime = _$Qdowntime - parseInt(_SLoadTime)
    }
    _$Qfirsttime = _$Qreadflashcookie('PHPStat_First_Time_' + _$Qwebsite);
    if (_$Qfirsttime === '') {
        _$Qfirsttime = _$Qgettime;
        _$Qsetflashcookie('PHPStat_First_Time_' + _$Qwebsite, _$Qfirsttime, 3650, _$Qdomain)
    } 
    _$Qreturncount = _$Qreadflashcookie('PHPStat_Return_Count_' + _$Qwebsite);
    _$Qreturncount = _$Qreturncount === '' ? 0 : _$Qreturncount; 
    _$Qusername = _$Qreadflashcookie('PHPSTATNULLCOOKIE') ? _$Qreadflashcookie('PHPSTATNULLCOOKIE') : (_$Qreadflashcookie('PHPStat_Set_User_Name')?_$Qreadflashcookie('PHPStat_Set_User_Name'):_$Qreadflashcookie('PHPStat_Set_User_Id'));	
    _$Quserid = _$Qreadflashcookie('PHPSTATNULLCOOKIE') ? _$Qreadflashcookie('PHPSTATNULLCOOKIE') : (_$Qreadflashcookie('PHPStat_Set_User_Id')?_$Qreadflashcookie('PHPStat_Set_User_Id'):_$Qreadflashcookie('PHPStat_Set_User_Name'));	
    _$Quserage = _$Qreadflashcookie('PHPSTATNULLCOOKIE') ? _$Qreadflashcookie('PHPSTATNULLCOOKIE') : _$Qreadflashcookie('PHPStat_Set_User_Age');
    _$Quserregtime = _$Qreadflashcookie('PHPSTATNULLCOOKIE') ? _$Qreadflashcookie('PHPSTATNULLCOOKIE') : _$Qreadflashcookie('PHPStat_Set_User_Regtime');	
    _$Qusersex = _$Qreadflashcookie('PHPSTATNULLCOOKIE') ? _$Qreadflashcookie('PHPSTATNULLCOOKIE') : _$Qreadflashcookie('PHPStat_Set_User_Sex');
    _$Qusercookie = _$Qreadflashcookie('PHPStat_Set_User_Id')?_$Qreadflashcookie('PHPStat_Set_User_Id'):_$Qreadflashcookie('PHPStat_Cookie_Global_User_Id');
	_$Qlusercookie = _$Qreadflashcookie('PHPStat_Cookie_Global_User_Id');
	if (_$Qusercookie === '') {
        _$Qlusercookie = _$Qusercookie = _$Qunique();
		_$Qsetflashcookie('PHPStat_Cookie_Global_User_Id', _$Qusercookie, 3650, _$Qdomain);
    }
	if( _$Qusercookie !== _$Qlusercookie ){
		_$Qsetflashcookie('PHPStat_Cookie_Global_User_Id', '', 3650, _$Qdomain);
	}
    if (_$Qtypeof(_$Qusercookie) === '') {
        _$Qusercookie = _$Qunique();
    }

    _$Qlasttime = _$Qreadflashcookie('PHPStat_Return_Time_' + _$Qwebsite);
    if (_$Qlasttime === '') {
        _$Qlasttime = _$Qgettime;
        _$Qsetflashcookie('PHPStat_Return_Time_' + _$Qwebsite, _$Qlasttime, 3650, _$Qdomain)
    }
    if (_$Qgettime - _$Qlasttime >= 43200000) {
        _$Qsetflashcookie('PHPStat_Return_Count_' + _$Qwebsite, ++_$Qreturncount, 3650, _$Qdomain);
        _$Qsetflashcookie('PHPStat_Return_Time_' + _$Qwebsite, _$Qgettime, 3650, _$Qdomain)
    } else {
        _$Qreturncount = _$Qreturncount
    }
	function _$Qgd(d)
	{
		if( _$Qdomain.length <= 0 )
		{
			var s = d.split('.');
			if( s.length >= 3 )
			{
				s[0] = '';
				_$Qdomain = s.join('.');
			}
			else
			{
				_$Qdomain = '.'+d;
			}
		}
	}
	function _$Qgt() {
		return (new Date()).getTime();
	}
	function _$Qencode(s){
		return (typeof(encodeURIComponent)=="function")?encodeURIComponent(s):escape(s);
	}
	function _$Qdecode(s){
		return (typeof(decodeURIComponent)=="function")?decodeURIComponent(s):unescape(s);
	} 
	function _$Qid(id)
	{
		return _$Qdocument.getElementById(id);
	}
	function _$Qname(name)
	{
		return _$Qdocument.getElementsByName(name);
	}
    function _$Qunique() {
		var T = new Date();
        var Y = T.getYear();
        var M = T.getMonth()+1;
        var D = T.getDate();
        var H = T.getHours();
        var I = T.getMinutes();
        var S = T.getSeconds();
        var MS = T.getMilliseconds();
		Y = Y < 1900 ? Y + 1900 : Y;
		Y = (Y - 2000) <= 0 ? '10' : (Y - 2000);
		M = M < 10 ? '0'+''+M : M;
		D = D < 10 ? '0'+''+D : D;
		H = H < 10 ? '0'+''+H : H;
		I = I < 10 ? '0'+''+I : I;
		S = S < 10 ? '0'+''+S : S;
		MS = (MS + 999)+'';
		return '_ck'+Y+''+M+''+D+''+H+''+I+''+S+''+MS.substr(0,3)+''+Math.uuid(14,14);
    }

    function _$Qreadflashcookie(name) 
	{
		var cV = fcV = '';
		if ( !_$Qphpstat_flash_object && !_$Qcookie ) 
		{
			return 'not_support_cookie';
		}
        if (_$Qphpstat_flash_object) 
		{
            fcV = _$Qtypeof(_$Qphpstat_flash_object.get(name));
        }
        if (_$Qcookie) 
		{
			cV = _$Qtypeof(_$Qreadcookie(name));
			if( cV !== fcV && fcV )
			{
				cV = fcV;
				_$Qsetcookie(name, fcV, 3650, _$Qdomain);
			}
			if( fcV === '' && cV && _$Qphpstat_flash_object )
			{
				_$Qsetflashcookie(name, cV, 3650, _$Qdomain);
			}
        }
        return cV;
    }
	function _$Qreadcookie(name)
	{
        var cV = end = '';
        var v = name + '=';
		if (_$Qcookie) 
		{
			var p = _$Qdocument.cookie.indexOf(v);
			if (p > -1) {
				p += v.length;
				end = _$Qdocument.cookie.indexOf(";", p);
				if (end == -1) {end = _$Qdocument.cookie.length;};
				cV = _$Qdecode(_$Qdocument.cookie.substring(p, end));
			}
			return _$Qtypeof(cV);
		}
		else
		{
			return 'not_support_cookie';
		}
	}
    function _$Qsetflashcookie(name, gv, h, d) 
	{
		if ( !_$Qphpstat_flash_object && !_$Qcookie ) 
		{
			return 'not_support_cookie';
		}
        if (_$Qphpstat_flash_object) {
            _$Qphpstat_flash_object.set(name, gv);
        }
		if (_$Qcookie)
		{
			_$Qsetcookie(name, gv, h, d);
		}
    }
    function _$Qsetcookie(name, gv, h, d) 
	{
        var v = '';
        if (_$Qcookie) {
            v = new Date(_$Qgt() + parseInt(h)*24*60*60*1000);
            v = '; expires=' + v.toGMTString();
            _$Qdocument.cookie = name + '=' + _$Qencode(gv) + v + ';domain='+d+';path=/;';
        }
		else
		{
			return 'not_support_cookie';
		}
    }
	function _$Qtestnull(r)
	{
		if( typeof(r) === null || r === null )
		{
			return false;
		}
		else if( typeof(r) === 'undefined' || r === 'undefined' )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function _$Qteststr(r)
	{
		if( typeof(r) === null || r === null )
		{
			return '';
		}
		else if( typeof(r) === 'undefined' || r === 'undefined' )
		{
			return '';
		}
		else if( r === '' )
		{
			return '';
		}
		else
		{
			return r;
		}
	}
    function _$Qgeturlparam(u) {
        var i = 0,j = 0;
		var h = '',p = '';
        if ((i = u.indexOf("://")) < 0 && u.length > 0) {return {h:u,p:''}};
        u = u.substring(i + 3);
		h = u.substring(0, u.indexOf('/'));
        if ((i = u.indexOf("/")) > -1) {			
			if ((j = u.indexOf('#clickmapcode=')) > -1) 
			{
				p = u.substring(i, j);
			}
			else
			{
				p = u.substring(i);
			}
        };
        return {h:h,p:p}
    }
	function _$Qgeturlkey(u,k)
	{
		var i,j,h='';
		if ((i = u.indexOf('?'+k+'=')) > -1 || (i = u.indexOf('&'+k+'=')) > -1)
		{
			h = u.substring(i+2+k.length);
			j = h.indexOf('&');
			j = j <= 0 ? h.length : j;
			{
				h = h.substring(0,j);
			}
		}
		return h;
	}
    function _$Qgetkeyword(u,b) {
        var v,dv,i, j, h, k, rk, e, ek, f, p = 10;
        u = u.toLowerCase();
        h = _$Qgeturlparam(u).h;
		if( b == '_' ){b = '';}
        for (var ii = 0; ii < _$Qsearchkey.length; ii++) {
            if (h.toLowerCase().indexOf('.'+_$Qsearchkey[ii].toLowerCase()+'.') > -1) {
                if ((i = u.indexOf('?' + _$Qkeyword[ii] + '=')) > -1 || (i = u.indexOf('&' + _$Qkeyword[ii] + '=')) > -1) {
                    k = u.substring(i + _$Qkeyword[ii].length + 2);
					if(_$Qsearchtype[ii]=='default')
					{_$Qkeywordsource = _$Qsearchkey[ii]+b+'::'+k;}
					_$Qkeywordkey = k;
                    v = '&KW=' + k + '&WC=' + _$Qsearchtype[ii] + '&WP=' + _$Qsearchkey[ii]+b;
                    if ((i = k.indexOf('&')) > -1) {
                        k = k.substring(0, i);
						if(_$Qsearchtype[ii]=='default')
						{_$Qkeywordsource = _$Qsearchkey[ii]+b+'::'+k;}
						_$Qkeywordkey = k;
                        v = '&KW=' + k + '&WC=' + _$Qsearchtype[ii] + '&WP=' + _$Qsearchkey[ii]+b
                    }
                }
                if ((i = u.indexOf('?' + _$Qkeywordrelated[ii] + '=')) > -1 || (i = u.indexOf('&' + _$Qkeywordrelated[ii] + '=')) > -1) {
                    k = u.substring(i + _$Qkeywordrelated[ii].length + 2);
                    rk = '&RW=' + k;
                    if ((i = k.indexOf('&')) > -1) {
                        k = k.substring(0, i);
                        rk = '&RW=' + k
                    }
                }
            }
        };
		v = v ? v : dv;
        if (_$Qtypeof(v) === '') {return '';}
        else if (rk) {return v + rk;}
        else {return v}
    }
    function _$Qgetmap(u) {
        var c = '';
        var s = new Array();
        if (u.indexOf('#clickmapcode=') > -1) {
            c = u.substring(14);
            s = c.split('|');
			s[2] = s[2] === '' ? _$Qwebsite : s[2];
            _$Qsetcookie('PHPStatMap', s[0], 1, _$Qdomain);
            _$Qsetcookie('PHPStatMap_Type', s[1], 1, _$Qdomain);
            _$Qsetcookie('PHPStatMap_Code', s[2], 1, _$Qdomain);
            _$Qsetcookie('PHPStatMap_Site', s[3], 1, _$Qdomain);
            _$Qsetcookie('PHPStatMap_Position', s[4], 1, _$Qdomain);
            _$Qsetcookie('PHPStatMap_Start_Date', s[5], 1, _$Qdomain);
            _$Qsetcookie('PHPStatMap_End_Date', s[6], 1, _$Qdomain);
            _$Qsetcookie('PHPStatMap_Server', s[7], 1, _$Qdomain);
            return {
                a: s[0],
                b: s[1],
                c: s[2],
                d: s[3],
                e: s[4],
                f: s[5],
                g: s[6],
                h: s[7]
            }
        } else if (_$Qreadcookie('PHPStatMap') && _$Qreadcookie('PHPStatMap_Code') && _$Qreadcookie('PHPStatMap_Site')) {
            s[0] = _$Qreadcookie('PHPStatMap');
			s[1] = _$Qreadcookie('PHPStatMap_Type');
            s[2] = _$Qreadcookie('PHPStatMap_Code');
            s[3] = _$Qreadcookie('PHPStatMap_Site');
            s[4] = _$Qreadcookie('PHPStatMap_Position');
            s[5] = _$Qreadcookie('PHPStatMap_Start_Date');
            s[6] = _$Qreadcookie('PHPStatMap_End_Date');
            s[7] = _$Qreadcookie('PHPStatMap_Server');
            return {
                a: s[0],
                b: s[1],
                c: s[2],
                d: s[3],
                e: s[4],
                f: s[5],
                g: s[6],
                h: s[7]
            }
        } else {return {
            a: '',
            b: '',
            c: '',
            d: '',
            e: '',
            f: '',
            g: '',
            h: ''
        }}
    }
	function _$Qgettag(u) {
        var c = '';
        var s = new Array();
        if (u.indexOf('#tagcontent=') > -1) {
            c = u.substring(12);
            s = c.split('|');
			return {
                a: s[0],
                b: s[1]
            }
		}
		else
		{
			return {
                a: '',
                b: ''
            }
		}
    }
	function _$Qgetpagetag(u) {
        var c = '';
        var s = new Array();
        if (u.indexOf('#pagecontent=') > -1) {
            c = u.substring(13);
            s = c.split('|');
			return {
                a: s[0],
                b: s[1],
                c: s[2]
            }
		}
		else
		{
			return {
                a: '',
                b: '',
                c: ''
            }
		}
    }
    function _$Qjsgif(gs) {
        var gif = new Image();
        gif.onload = function () {
            gif.onload = null;
        };
        gif.onerror = function () {
            
        };
		if( _$Qdoimgerr_1 <= 2 )
		{
			gif.src = gs;
		};
    }
	function _$Qparseurl(u) {
		var p = new Array();
		u = u + '&phpstat';
		var c = u.replace(/^\?/,'').split('&');
		for (var b = 0; b < c.length; b++) {
			var e = c[b].split('=');
			p[e[0]] = e[1];
		}
		return p;
	}
	function _$Qtypeof(tp)
	{
		var rp=tp;
		if( tp === null ){rp = '';}
		else if( typeof(tp) === 'undefined' ){rp = '';}
		else if( typeof(tp) === 'object' ){rp = '';}
		return rp;
	}
	function _$Qsetfirst(fvar, nvalue)
	{
		if( _$Qtypeof(fvar) == '' )
		{			
			_$Qsetcookie('PHPStat_Msrc_First_' + _$Qwebsite, nvalue, 30, _$Qdomain);
		}
	}
	function _$Qeneight(txt)
	{
		var monyer = new Array();var i,s;
		for(i=0;i<txt.length;i++)
			monyer+="\\"+txt.value.charCodeAt(i).toString(8); 
		return monyer;
	}
	var _$Qjava = 0;
    if (navigator.javaEnabled()) {_$Qjava = '1';}
    var _$Qbrowser = /(firefox|netscape|opera|myie|tencenttraveler|theworld|safari|maxthon|webtv|msn|konqueror|lynx|ucweb|360se|se|sogou|greenbrowser|netcaptor|chrome)/.exec(_$Quseragent);
    if (!_$Qbrowser) {_$Qbrowser = /(msie) ([0-9\.]*)[^;)]/.exec(_$Quseragent);}
    _$Qbrowser = _$Qbrowser === null ? 'other' : _$Qbrowser[0];
    var _$Qsystem = /(windows nt|windows|unix|linux|sunos|bsd|redhat|macintosh) ([0-9\.]*)[^;)]/.exec(_$Quseragent);
	_$Qsystem = _$Qsystem === null ? 'other' : _$Qsystem[0];
    var _$Qalexa			= (_$Quseragent.indexOf('alexa') !== -1) === false ? '0' : '1';
	var _$Qflash			= _$Qflashok.f;
    var _$Qpathname		= _$Qdocument.location.pathname;
	var _$Qfreferrer		= _$Qgeturlparam(_$Qreferrer);
    var _$Qfreferrerhost = _$Qfreferrer.h;
    var _$Qref			= _$Qencode(_$Qfreferrer.p);
    var _$Qmapcode		= _$Qgetmap(_$Qdocument.location.hash);
    var _$Qtagcode		= _$Qgettag(_$Qdocument.location.hash);
    var _$Qpagecode		= _$Qgetpagetag(_$Qdocument.location.hash);
    var _$Qsearch		= _$Qdocument.location.search;
	_$Qpathname			= _$Qencode(_$Qpathname + _$Qsearch);
	var _$Qmain_website	= _$Qreadflashcookie('PHPStat_Main_Website_'+ _$Qwebsite);
	_$Qpartner_website	= _$Qreadflashcookie('PHPStat_Partner_' + _$Qwebsite);
	_$Qmediumsource		= _$Qreadflashcookie('PHPStat_Msrc_'  + _$Qwebsite);
	_$Qmediumsourcetype	= _$Qreadflashcookie('PHPStat_Msrc_Type_'  + _$Qwebsite);
	_$Qmediumsourcefirst	= _$Qreadflashcookie('PHPStat_Msrc_First_'  + _$Qwebsite);
	_$Qedmemail			= _$Qreadflashcookie('PHPStat_Edm_' + _$Qwebsite);
	_$Qfriendlink		= _$Qreadcookie('PHPStat_Market_QQ_' + _$Qwebsite);
	_$QfriendlinkN		= _$Qreadcookie('PHPStat_Market_QQ_Number_' + _$Qwebsite);
	var _$Qparseurlarr	= _$Qparseurl(_$Qsearch);
	var _$Qpmf_key		= _$Qtypeof(_$Qparseurlarr['k']);
	var _$Qpmf_from		= _$Qtypeof(_$Qparseurlarr['f']);
	var _$Qpmf_key_macth = _$Qtypeof(_$Qparseurlarr['m']);
	var _$Qpmf_key_word  = _$Qtypeof(_$Qparseurlarr['w']);
	var _$Qpmf_key_id	= _$Qtypeof(_$Qparseurlarr['kid']);
	var _$Qpmf_key_tid	= _$Qtypeof(_$Qparseurlarr['tid']);
	var _$Qpmf_gclid		= _$Qtypeof(_$Qparseurlarr['gclid']);
	var _$Qpmf_bdclkid	= _$Qtypeof(_$Qparseurlarr['bdclkid']);
    var _$Qpmf_group		= _$Qtypeof(_$Qparseurlarr['pmf_group']);
    var _$Qpmf_medium	= _$Qtypeof(_$Qparseurlarr['pmf_medium']);
    var _$Qpmf_source	= _$Qtypeof(_$Qparseurlarr['pmf_source']);
    var _$Qpmf_match		= _$Qtypeof(_$Qparseurlarr['pmf_match']);
    var _$Qpmf_keyword	= _$Qtypeof(_$Qparseurlarr['pmf_keyword']);
    var _$Qpmf_partner	= _$Qtypeof(_$Qparseurlarr['pmf_partner']);
    var _$Qpmf_email		= _$Qtypeof(_$Qparseurlarr['pmf_email']);
    var _$Qpmf_area		= _$Qtypeof(_$Qparseurlarr['pmf_area']);
    var _$Qpmf_id		= _$Qtypeof(_$Qparseurlarr['pmf_id']);
    var _$Qpmf_tid		= _$Qtypeof(_$Qparseurlarr['pmf_tid']);
	var _$Qpmf_tui_id	= _$Qpmf_tid ? _$Qpmf_tid : _$Qpmf_key_tid;
	if (_$Qpmf_tui_id) {
        _$Qsetflashcookie('PHPStat_From_Id_' + _$Qwebsite, _$Qpmf_tui_id, 3650, _$Qdomain);
    }
	else
	{
		_$Qpmf_tui_id = _$Qreadflashcookie('PHPStat_From_Id_' + _$Qwebsite);
	}
	if(_$Qpagecode.a && _$Qpagecode.b && _$Qpagecode.c)
	{
		var ac = 'pageab_'+_$Qpagecode.a+'_'+_$Qpagecode.c;
		_$Qsetflashcookie('PHPStat_Page_AB_' + _$Qpagecode.a, _$Qpagecode.c, 3650, _$Qdomain);
		_trackData.push(['clk','HTML',ac,'','','','','','','1','1','1','','','','0']);
	}
	
	var _$Qutm_array = new Array();
	var _$Qutm_array_str = new Array();
    _$Qutm_array['utm_source']	= _$Qtypeof(_$Qparseurlarr['utm_source']);
	_$Qutm_array['utm_content']	= _$Qtypeof(_$Qparseurlarr['utm_content']);
	_$Qutm_array['utm_term']		= _$Qtypeof(_$Qparseurlarr['utm_term']);
    _$Qutm_array['utm_medium']	= _$Qtypeof(_$Qparseurlarr['utm_medium']);
    var _$Qutm_id		= _$Qtypeof(_$Qparseurlarr['utm_id']);
	var _$Qsid = 0;
	for(var $kk in _$Qutm_array)
	{
		if( _$Qutm_array[$kk] )
		{
			_$Qutm_array_str[_$Qsid] = _$Qutm_array[$kk];_$Qsid++;
		}
	}
	if( _$Qutm_array['utm_source'] && _$Qpmf_medium === '' )
	_$Qpmf_medium = 'market_type_'+_$Qutm_array['utm_source'];
	if( _$Qutm_array['utm_term'] && _$Qpmf_keyword === '' )
	_$Qpmf_keyword = _$Qutm_array['utm_term'];
	if( _$Qutm_id && _$Qpmf_id === '' )
	_$Qpmf_id = _$Qutm_id;
	_$Qpmf_source = _$Qpmf_source === '' ? _$Qutm_array_str.join("_") : _$Qpmf_source;
	_$Qpmf_source = _$Qpmf_source.substring(0, 128).toLowerCase();

    var _$Qpstac			= _$Qtypeof(_$Qparseurlarr['pstac']);
	if( ( _$Qpmf_medium && _$Qpmf_source ) || ( ( _$Qpmf_gclid || _$Qpmf_bdclkid ) && _$Qpmf_key !== 'ppc' ) )
	{
		_$Qpmf_key = 'ppc';
	}
	var _$Qsearchkeyword  = _$Qgetkeyword(_$Qreferrer,'_'+_$Qpmf_key);
	if (_$Qpmf_medium && _$Qpmf_source) {
        _$Qmediumsource = _$Qpmf_group+'::'+_$Qpmf_medium+'::'+_$Qpmf_source+'::'+_$Qkeywordsource+'::'+_$Qpmf_match+'::'+_$Qpmf_keyword+'::'+_$Qfreferrerhost+'::'+_$Qpmf_id+'::pmf_from_adv';
        _$Qsetflashcookie('PHPStat_Msrc_' + _$Qwebsite, _$Qmediumsource, 3650, _$Qdomain);
        _$Qsetflashcookie('PHPStat_Msrc_Type_' + _$Qwebsite, 'pmf_from_adv', 3650, _$Qdomain);
        _$Qsetfirst(_$Qmediumsourcefirst, _$Qmediumsource);
    }
	else if (_$Qpmf_key && _$Qpmf_from && _$Qmediumsourcetype !== 'pmf_from_adv') {
		_$Qmediumsource = _$Qpmf_group+'::market_type_paid_search::::'+_$Qkeywordsource+'::'+_$Qpmf_key_macth+'::'+_$Qpmf_key_word+'::'+_$Qfreferrerhost+'::'+_$Qpmf_key_id+'_'+_$Qpmf_from+'_'+_$Qpmf_key+'::pmf_from_paid_search';
        _$Qsetflashcookie('PHPStat_Msrc_' + _$Qwebsite, _$Qmediumsource, 3650, _$Qdomain);
        _$Qsetflashcookie('PHPStat_Msrc_Type_' + _$Qwebsite, 'pmf_from_paid_search', 3650, _$Qdomain);
        _$Qsetfirst(_$Qmediumsourcefirst, _$Qmediumsource);
    }
	else if (_$Qkeywordsource && _$Qmediumsourcetype !== 'pmf_from_paid_search') {
		_$Qmediumsource = _$Qpmf_group+'::market_type_free_search::::'+_$Qkeywordsource+'::::::'+_$Qfreferrerhost+'::::pmf_from_free_search';
        _$Qsetflashcookie('PHPStat_Msrc_' + _$Qwebsite, _$Qmediumsource, 3650, _$Qdomain);
        _$Qsetflashcookie('PHPStat_Msrc_Type_' + _$Qwebsite, 'pmf_from_free_search', 3650, _$Qdomain);
        _$Qsetfirst(_$Qmediumsourcefirst, _$Qmediumsource);
    }
	if (_$Qpmf_partner) {
        _$Qpartner_website = _$Qpmf_partner;
        _$Qsetflashcookie('PHPStat_Partner_' + _$Qwebsite, _$Qpartner_website, 3650, _$Qdomain)
    }
	if (_$Qpmf_email) {
        _$Qedmemail = _$Qpmf_group+'::'+_$Qpmf_medium+'::'+_$Qpmf_source+'::'+_$Qpmf_email+'::'+_$Qpmf_area+'::pmf_from_edm';
        _$Qsetflashcookie('PHPStat_Edm_' + _$Qwebsite, _$Qedmemail, 3650, _$Qdomain)
    }
	var _$Qmain_website_str = _$Qusercookie+'|'+_$Qwebsite+'|'+_$Qteststr(_$Qpartner_website)+'|'+_$Qteststr(_Schannel_website_id)+'|'+_$Qteststr(_Schannel_webshop_id);
	if( _$Qmain_website === '' || _$Qmain_website !== _$Qmain_website_str )
	{
		_$Qsetflashcookie('PHPStat_Main_Website_'+ _$Qwebsite, _$Qmain_website_str, 3650, _$Qdomain);
	}
	_$Qmediumsourcefirst = _$Qmediumsourcefirst == _$Qmediumsource ? 'same' : _$Qmediumsource;
    var _$Qcourl = _$Qcounturl_logcount + '?WS=' + _$Qwebsite + '&CountUrl='+_$Qcounturl_logcount+'&SWS='+_$Qteststr(_$Qpartner_website)+'&SWSID='+_$Qteststr(_Schannel_website_id)+'&SWSPID='+_$Qteststr(_Schannel_webshop_id)+'&RD=common&TDT='+_$Qteststr(_trackDataType)+'&UC=' + _$Qusercookie + '&LUC=' + (_$Qlusercookie==_$Qusercookie?'same':_$Qlusercookie) + '&USAG=' + _$Qunicode(_$Quseragent) + '&FS=' + _$Qfreferrerhost + '&RF=' + _$Qencode(_$Qref) + '&PS=' + _$Qhostname + '&PU=' + _$Qpathname + _$Qsearchkeyword + '&PT=' + _$QPageType + '&PC=' + _$Qencode(_$QPagePic) + '&PI=' + _$QPageId + '&LM=' + _$Qlastmodify + '&LG=' + _$Qlanguage + '&CL=' + _$Qcolor + '&CK=' + _$Qcookie + '&SS=' + _$Qscreensize + '&SSW=' + _$Qclientwidth + '&SSH=' + _$Qclientheight + '&FT=' + _$Qfirsttime + '&LT=' + _$Qlasttime + '&DL=' + _$Qdowntime + '&FL='+_$Qflash+'&CKT='+cookietype+'&JV='+_$Qjava+'&AL=' + _$Qalexa + '&SY=' + _$Qencode(_$Qsystem) + '&BR=' + _$Qencode(_$Qbrowser) + '&TZ=' + (new Date()).getTimezoneOffset() / 60 + '&AU=' + _$QAuthor + '&UN=' + _$Qencode(_$Qusername) + '&UID=' + _$Qencode(_$Quserid) + '&URT=' + _$Qencode(_$Quserregtime) + '&UA=' + _$Qencode(_$Quserage) + '&US=' + _$Qencode(_$Qusersex) + '&TID=' + _$Qencode(_$Qpmf_tui_id) + '&MT=' + _$Qtelphone + '&FMSRC='+_$Qencode(_$Qmediumsourcefirst)+'&MSRC='+_$Qencode(_$Qmediumsource)+'&EDM='+_$Qencode(_$Qedmemail)+'&RC=' + _$Qreturncount + '&SHPIC=&MID=' + _$Qrandomid + '&TT=' + _$Qencode(_$Qtitle);
	var _$Qclickhotokstr = true;
	function _$Qcreatejs()
	{
		if (_$Qmapcode.a && _$Qmapcode.b && _$Qmapcode.c) 
		{
			_$Qclickhotokstr = false;
			var _$Qurl = _$Qcounturl + '/clickareamap.js.php';
			var _$Qobj = _$Qdocument.createElement('script');
			_$Qobj.type = 'text/javascript';
			_$Qobj.async = true;
			_$Qobj.id = 'clickareamap_id';
			_$Qobj.charset = 'utf-8';
			var $dabc = _$Qurl + '?clicktype=' + _$Qmapcode.a + '&areatype=' + _$Qmapcode.b + '&website=' + _$Qmapcode.d + '&server=' + _$Qmapcode.h + '&starttime=' + _$Qreadcookie('PHPStatMap_Start_Date') + '&endtime=' + _$Qreadcookie('PHPStatMap_End_Date') + '&fromtype=' + _$Qreadcookie('PHPStatMap_Fromtype') + '&pagesite=' + _$Qhostname + '&pageurl=' + _$Qpathname + '&rand=' + Math.random() + '&clickmapcode=' + _$Qmapcode.c+'&clickmapposition=' + _$Qmapcode.e+'&counturl='+_$Qencode(_$Qcounturl);
			_$Qdocumentcookie.getElementsByTagName('head').item(0).appendChild(_$Qobj);
			setTimeout("document.getElementById('clickareamap_id').src='"+$dabc+"'; ",3000);
		}
		if( false )
		{
			if (_$Qtagcode.a && _$Qtagcode.b)
			{
				var _$Qturl = _$Qcounturl + '/optimizer.js.php';
				var _$Qtobj = _$Qdocument.createElement('script');
				_$Qtobj.type = 'text/javascript';
				_$Qtobj.async = true;
				_$Qtobj.charset = 'utf-8';
				_$Qtobj.src = _$Qturl + '?abtype=test&website=' + _$Qwebsite + '&abtestid=' + _$Qtagcode.a + '&tagcheckcode=' + _$Qtagcode.b;
				_$Qdocumentcookie.getElementsByTagName('head').item(0).appendChild(_$Qtobj)
			}
			else
			{
				var _$Qturl = _$Qcounturl + '/optimizer.js.php';
				var _$Qtobj = _$Qdocument.createElement('script');
				_$Qtobj.type = 'text/javascript';
				_$Qtobj.async = true;
				_$Qtobj.charset = 'utf-8';
				_$Qtobj.src = _$Qturl + '?abtype=show&website=' + _$Qwebsite + "&prefix=_$Q";
				_$Qdocumentcookie.getElementsByTagName('head').item(0).appendChild(_$Qtobj)
			}
		}
	}
	var _$Qformhiddenloop = 1;	
var _$Qclickhot;
var _$Qdoimgerr_2 = 1;
var _$Qclickhotok = 0;
var _$Qmessageid = '';
var _$Qformhidden = 0||0;
var _$Qclickarray = new Array();
var _$Qcf_f = 0||0;
var _$Qcfre_f = 0||0;
_$Qclickarray[0]='(*)';;
var _$Qclickreg = '';
if (_$Qclickarray[0] == 'clickhotall') {
    _$Qclickhotok = 1
}
function _$Qdotest(r)
{
	r = r+'';
	r = r.replace(/\\/g, '\\/');
	r = r.replace(/\//g, '\\/');
	r = r.replace(/\*/g, '(.*)');
	return r;
}
if (_$Qclickhot !== 'clickhot' && _$Qclickarray[0] !== 'clickhotall') {
    for (var ci = 0; ci < _$Qclickarray.length; ci++) {
        if (_$Qclickarray[ci].lastIndexOf('*') > - 1) {
            _$Qclickarray[ci] = _$Qdotest(_$Qclickarray[ci]);
            if (_$Qclickarray[ci].indexOf('/') === 0) {
                _$Qclickarray[ci] = _$Qclickarray[ci].substring(1)
            }
            _$Qclickreg = eval('/' + _$Qclickarray[ci] + '/ig');
            if (_$Qclickreg.test(_$Qpathname)) {
                _$Qclickhotok = 1;
                break
            }
        } else {
            if (_$Qclickarray[ci].indexOf('/') !== 0) {
                _$Qclickarray[ci] = '/' + _$Qclickarray[ci]
            }
            if (_$Qclickarray[ci] == _$Qpathname) {
                _$Qclickhotok = 1;
                break
            }
        }
    }
}
var _$Qclienturlstr = '';
var _$Qposarr = new Array();

function _$Qtimelong(ini) {
    var tl = _$Qgt() - _$Qstarttime;
    if (tl >= 1800000) {
        tl = 1000
    }
    if (ini) {
        tl = _$Qgt() - _$Qtimestart;
        _$Qtimestart = _$Qgt()
    }
    tl <= 0 ? 0 : tl;
    return tl
}
function _$Qsetformfield(a,b)
{
	if( typeof( _$Qformfielddetails[a][b] ) == null || typeof( _$Qformfielddetails[a][b] ) == 'undefined' )
	{
		_$Qformfielddetails[a][b] = {change:0,onkey:0,times:0,focus:0,errors:0,submits:0,inputinfo:0};
	}
}
function _$Qinitevent(init) {
	var _$Qfn;
	var _$Qfc;
    _$Qaddlistener(window, 'unload', _$Qunload);
    _$Qaddlistener(window, 'blur', _$Qunload);
	
	if( _$Qcf_f )
	{
		for (var a = 0; a < _$Qdocument.forms.length; a++) {
			_$Qfn = _$Qdocument.forms.item(a);
			_$Qfc = _$Qfn.name || _$Qfn.id;
			if( _$Qfc && _$Qcfre_f )
			{
				_$Qformlist = _$Qformlist + _$Qfc + "::" + _$Qfn.action + "||";
				_$Qformdetails[_$Qfc] = {change:0,onkey:0,times:0,focus:0,submits:0,errors:0,inputinfo:0};
				_$Qformfielddetails[_$Qfc] = {};
			}
			_$Qinitform(_$Qfn);
		}
		_$Qgetelementby(['form'], ['submit'], _$Qsubmit);
		_$Qgetelementby(['select', 'input', 'textarea'], ['change'], _$Qchangeselect);
		_$Qgetelementby(['select', 'input', 'textarea','button','iframe','object'], ['blur'], _$Qfocus);
		_$Qgetelementby(['select', 'input', 'textarea','button','iframe','object'], ['click'], _$Qclick);
	}

     if (init && 1) {
        _$Qaddlistener(_$Qdocument, 'click', _$Qclick);
    }
    if (init && _$Qcf_f) {
		_$Qaddlistener(_$Qdocument, 'keyup', _$Qkeyup);
    }
}
function _$Qrecord(a) {
    var s = '';
    if (parseInt(Math.random() * 100) < 0*10 && a.a === 'msmv') return;
    switch (a.a) {
    case 'msmv':
        s = '||' + a.a + '::' + a.t + '::' + a.x + '::' + a.y;
        _$Qcountdourl(s);
        break;
    case 'clk':
    case 'fus':
    case 'link':
    case 'chn':
    case 'down':
    case 'onkey':
    case 'clkout':
    case 'submit':
        s = '||' + a.a + '::' + _$Qencode(a.tn) + '::' + _$Qencode(a.i) + '::' + _$Qencode(a.n) + '::' + a.tp + '::' + _$Qencode(a.v) + '::' + _$Qencode(a.h) + '::' + _$Qencode(a.u) + '::' + a.t + '::' + a.x + '::' + a.y + '::' + a.p + '::' + _$Qencode(a.fn) + '::' + _$Qencode(a.fa) + '::' + a.e + '::' + a.ef + '::' + _$Qencode(a.msg) + '::' + _$Qencode(a.ak);
        _$Qcountdourl(s);
        break;
    default:
        _$Qcountdourl(a.a);
        break
    }
}
function _$Qunload() {
	_$Qloadgif(_$Qclienturlstr);
	_$Qclienturlstr = ''
}
function _$Qcountdourl(s) {
    _$Qclienturlstr += s;
    if (_$Qclienturlstr.length > 1024 && s) {
        _$Qloadgif(_$Qclienturlstr);
        _$Qclienturlstr = ''
    }
}
function _$Qdownload(p) {
    var ckda = new Array();
    ckda[0]='.doc';ckda[1]='.csv';ckda[2]='.xls';ckda[3]='.pdf';ckda[4]='.rar';ckda[5]='.zip';;
    var _pin = p.toLowerCase();
    for (var ckdi = 0; ckdi < ckda.length; ckdi++) {
        if (_pin.indexOf(ckda[ckdi]) > - 1) {
            return 1
        }
    }
    return 0
}
function _$Qclickout(h) {
    var ckoa = new Array();
    ckoa[0]='(*).228.cn';ckoa[1]='www.228.com.cn/(*)';ckoa[2]='m.228.com.cn/(*)';;
    var hi = h.toLowerCase();
    for (var ci = 0; ci < ckoa.length; ci++) {
            ckoa[ci] = _$Qdotest(ckoa[ci]);
    }
	var reg = eval('/'+ckoa.join('|')+'/ig');
	return (!reg.test(hi));
}
function _$Qtrackevent()
{
	var s = '';
	var rs = '';
	var td = window._trackData;
	if( typeof(_trackEvent) !== 'undefined' && _trackEvent.trackActionUrl.length )
	{
		s = _trackEvent.trackActionUrl;
		_trackEvent.trackActionUrl = '';
	}
	else if( td && td.length )
	{
		for(var k in td)
		{
			if( !isNaN(k) )
			{
				for(var kk in td[k])
				{
					if( td[k]['0'] == 'viewgoods' )
					{
						for(var rd in _$Qrefid)
						{
							rs = _$Qtypeof(_$Qparseurlarr[rd]);
							if( rs )
							{
								td[k]['9'] = rs;
							}
						}
					}
					if( td[k]['0'] == 'userset' && td[k]['1'] == 'userid' && td[k]['2'].length )
					{					
						_$Qsetflashcookie('PHPStat_Set_User_Id', td[k]['2'], 3650, _$Qdomain);
					}
					if( td[k]['0'] == 'userset' && td[k]['1'] == 'username' && td[k]['2'].length )
					{					
						_$Qsetflashcookie('PHPStat_Set_User_Name', td[k]['2'], 3650, _$Qdomain);
					}
					if( td[k]['0'] == 'userset' && td[k]['1'] == 'age' && td[k]['2'].length )
					{					
						_$Qsetflashcookie('PHPStat_Set_User_Age', td[k]['2'], 3650, _$Qdomain);
					}
					if( td[k]['0'] == 'userset' && td[k]['1'] == 'sex' && td[k]['2'].length )
					{					
						_$Qsetflashcookie('PHPStat_Set_User_Sex', td[k]['2'], 3650, _$Qdomain);
					}
					if( td[k]['0'] == 'userregtime' && td[k]['1'] == 'regtime' && td[k]['2'].length )
					{					
						_$Qsetflashcookie('PHPStat_Set_User_Regtime', td[k]['2'], 3650, _$Qdomain);
					}
					if( _$Qtestnull(_Sorder_encode_url) === false )
					td[k][kk] = _$Qencode(td[k][kk]);
				}
				if( td[k].length == 1 )
				{
					s += '||'+td[k]['0'];
				}
				else
				{
					s += '||'+(td[k].join('::'));
				}
			}
		}
		window._trackData = [];
	}
	return s;
}
function _$Qdirecttrackevent()
{
	if( typeof(_trackEvent) !== 'undefined' && _trackEvent.trackActionUrl.length )
	{
		_$Qloadgif('');
	}
	else if( window._trackData && window._trackData.length )
	{
		_$Qloadgif('');
	}
}
function _$Qloadgif(gs) {
    var gif = new Image();
	var clestr = gs + _$Qtrackevent();
	if( clestr.length <= 0 ) {return;}
    gif.onload = function () {
        gif.onload = null;
    };
    gif.onerror = function () {
    };
	if( _$Qdoimgerr_2 <= 3 )
	{
		gif.src = _$Qcounturl_logcount + '?WS=' + _$Qwebsite + '&SWS='+_$Qteststr(_$Qpartner_website)+'&SWSID='+_$Qteststr(_Schannel_website_id)+'&SWSPID='+_$Qteststr(_Schannel_webshop_id)+'&RD=record&TDT='+_$Qteststr(_trackDataType)+'&UC=' + _$Qusercookie + '&LUC=' + _$Qlusercookie + '&PS=' + _$Qhostname + '&PU=' + _$Qpathname + '&FS=' + _$Qfreferrerhost + '&RF=' + _$Qencode(_$Qref) + '&SW=' + _$Qscreenwidth() + '&SSW=' + _$Qclientwidth + '&SSH=' + _$Qclientheight + '&BR=' + _$Qencode(_$Qbrowser) + '&LTL=' + Math.ceil(_$Qtimelong(1) / 1000) + '&MSRC='+_$Qencode(_$Qmediumsource)+'&EDM='+_$Qencode(_$Qedmemail)+'&CLE=' + clestr + '&MID=' + _$Qrandomid+'&random='+Math.random();
	}
	if( _$Qpstac.toLowerCase() == 'debug' )
	_$Qmessage(gif.src);
}
function _$Qaddlistener(a, b, c) {
    if (a.addEventListener) {
        a.addEventListener(b, c, false)
    } else {
        if (a.attachEvent) {
            a.attachEvent('on' + b, c)
        }
    }
}
function _$Qclick(ev) {
    _$Qcountimg(ev);
    var b = ev.srcElement || ev.target;
    if (b && /input/i.test(b.tagName) && /checkbox|radio/i.test(b.type)) {
        _$Qchange(b, b.checked)
    }
	if (b && /button|img|input/i.test(b.tagName) && /submit|button/i.test(b.type)) {
        _$Qsubmit_button(b, ev)
    }
}
function _$Qrecodeelement(ele,eleev,eleslt,type,host,url,eff,fname)
{
	var $v = $e = $x = $y = $fn = $fa = $gfn = $typekey = $p = '';
	$x = _$Qposition(ele).x;
	$y = _$Qposition(ele).y;
	$p = ele.type;
	if(type == 'fus')
	{
		$v = _$Qgetvalue(ele);
	}
	if((type == 'clk' || type == 'down' || type == 'clkout')&&ele.tagName=='A')
	{
		$v = _$Qencode(ele.innerHTML.replace(/<[^>].*?>/g, '') || '');
		$x = _$Qcltxy(eleev).x;
		$y = _$Qcltxy(eleev).y;
		$e = _$Qencode(ele.getAttribute('phpstatevent') || '');
	}
	if(type == 'clk' && ele.tagName!=='A')
	{
		$v = _$Qgetvalue(ele);
		$x = _$Qcltxy(eleev).x;
		$y = _$Qcltxy(eleev).y;
	}
	if(type == 'chn')
	{
		$e = (eleslt === true ? 1 : (eleslt === false ? 0 : eleslt));
		$v = _$Qgetvalue(ele);
	}
	if(type == 'onkey')
	{
		$v = eff;
		$typekey = eleslt;
	}
	if(type == 'msmv')
	{
		$x = _$Qcltxy(eleev).x;
		$y = _$Qcltxy(eleev).y;
	}
	if((/input|textarea|select|button/i.test(ele.tagName)) || (/img/i.test(ele.tagName) && /submit|button/i.test(ele.type)))
	{		
		$gfn = _$Qgetformname(ele);
		$fn = $gfn.n;
		$fa = $gfn.a;
	}
	if(type == 'submit')
	{
		$gfn	= _$Qgetformname(ele);
		$fn		= $gfn.n;
		$fa		= $gfn.a;
	}	
	if( fname !== '' )
	{
		$fn = fname;
	}
	if( $p === 'password' && $v )
	{
		$v = '********';
	}
	$fa = '';
	var $ig={pose:'',tagid:''};
	if(type !== 'msmv')
	{
		$ig = _$Qinindeof(ele);
	}
	var $fmsg = '';
	if( $fn && window._trackFormMsg && window._trackFormMsg.length > 0 )
	{
		$fmsg = window._trackFormMsg;
	}
	window._trackFormMsg = '';
	
	if( $fn && $fa && _$Qcfre_f )
	{
		var $eln_id = ele.name || ele.id;
		$eln_id = $eln_id || 'unname';
		_$Qsetformfield($fn,$eln_id);
		if( $eln_id != 'unname' )
		{
			if(type == 'chn')
			{
				_$Qformdetails[$fn].change++;
				_$Qformfielddetails[$fn][$eln_id].change++;
				_$Qformdetails[$fn].inputinfo = $v;
				_$Qformfielddetails[$fn][$eln_id].inputinfo = $v;
			}
			if(type == 'onkey')
			{
				_$Qformdetails[$fn].onkey++;
				_$Qformfielddetails[$fn][$eln_id].onkey++;
			}
			if(type == 'fus')
			{
				_$Qformdetails[$fn].focus++;
				_$Qformfielddetails[$fn][$eln_id].focus++;
			}
			if(type == 'submit')
			{
				_$Qformdetails[$fn].submits++;
				_$Qformfielddetails[$fn][$eln_id].submits++;
			}
			if( $fmsg && $fmsg.indexOf('==failed') )
			{			
				_$Qformdetails[$fn].errors++;
				_$Qformfielddetails[$fn][$eln_id].errors++;
			}
			_$Qformdetails[$fn].times = _$Qtimelong(0);
			_$Qformfielddetails[$fn][$eln_id].times = _$Qtimelong(0);
		}
	}

	_$Qrecord({
            a:  type,
            ak:  $typekey,
            p:  $ig.pose,
			h:  host,
            u:  url,
            t:  _$Qtimelong(0),
            n:  (_$Qtestobject(ele.name) || ''),
            i:  (_$Qtestobject(ele.id) || $ig.tagid),
            v:  $v,
            x:  $x,
            y:  $y,
            e:  $e,
            tp: (_$Qtestobject(ele.type) || ''),
            tn: (_$Qtestobject(ele.tagName) || ''),
			fn: $fn,
			fa: $fa,
            ef: eff,
			msg:$fmsg
        });
}
function _$Qfocus(ev) {
    if (!ev) {
        var ev = event
    }
    var b = ev.srcElement || ev.target;
    if (b && /input|textarea|select/i.test(b.tagName)) {
		_$Qrecodeelement(b,ev,'','fus','','',0,'');
    }
}
function _$Qonkey(ev,vc) {
    if (!ev) {
        var ev = event
    }
    var b = ev.srcElement || ev.target;
	var c = ev.keyCode || ev.charCode;
    if (/input|textarea|select/i.test(b.tagName)) {
		_$Qrecodeelement(b,ev,vc,'onkey','','',c,'');
    }
}
function _$Qkeydown(ev)
{
	_$Qonkey(ev,'k_d');
}
function _$Qkeyup(ev)
{
	_$Qonkey(ev,'k_u');
}
function _$Qkeypress(ev)
{
	_$Qonkey(ev,'k_p');
}
function _$Qcountimg(ev) {
    if (!ev) {
        var ev = event
    }
    var b = ev.srcElement || ev.target;
    var c = b;
    while (b && (!b.href || /img/i.test(b.tagName))) {
        b = b.parentNode
    }
    var gettype = 'clk';
    var chu = clkhost = clkurl = '';
    if (b) {
		chu = _$Qgeturlparam(b.href);
        clkhost = chu.h;
        clkurl = chu.p;
		_$Qrecodeelement(b,ev,'',gettype,clkhost,clkurl,0,'');
        if (_$Qdownload(b.href)) {
            gettype = 'down';
			_$Qrecodeelement(b,ev,'',gettype,clkhost,clkurl,0,'');
        }
        if (_$Qclickout(clkhost)) {
            gettype = 'clkout';			
			_$Qrecodeelement(b,ev,'',gettype,clkhost,clkurl,0,'');
        }
    }
    if (c&&b!=c) {
        var eff = 0;var effid = 'id';
        if ((/img|input|textarea|select|a/i.test(c.tagName))) {
            eff = 1
        }
		if ((/img/i.test(c.tagName)) && chu) {
			effid = c.id || '';
		}
		if( effid == 'id' || effid )
		{
			_$Qrecodeelement(c,ev,'','clk','','',eff,'');
		}
    }
}
function _$Qscreenwidth() {
    return _$Qdocument.documentElement.scrollWidth
}
function _$Qtestnull(r)
{
	if( typeof(r) === null )
	{
		return false;
	}
	else if( typeof(r) === 'undefined' )
	{
		return false;
	}
	else
	{
		return true;
	}
}
function _$Qtestobject(r)
{
	if( typeof(r) === 'object' )
	{
		return '';
	}
	else
	{
		return r;
	}
}
function _$Qinindeof(c) {
    while (c && !c.tagName) {
        c = c.parentNode
    }
    var i = 0;
    var b = c;
	var psttag = '';
    var parentnodes = new Array();
    var resultarray = new Array();
    var resultarraystr = new Array();
    while (b && b !== _$Qdocument.body && b !== _$Qdocument.documentElement) {
        var ch = 1;
        var g = new Array();
		if(!_$Qtestnull(b.parentNode)||!b.parentNode) break;
        g = b.parentNode.childNodes;
        for (var e = 0; e < g.length; e++) {
            if (g[e].tagName && g[e].tagName !== '!' && g[e].tagName !== 'SCRIPT') {
                if (g[e] == b) {
                    break
                }
                ch++
            }
        }
        parentnodes[i] = ch;
        b = b.parentNode;
		if( b !== _$Qdocument.body )
		{
			psttag = psttag == '' ? (b.getAttribute('psttag')?b.getAttribute('psttag'):b.id) : psttag;
		}
        i++
    }
    resultarray = parentnodes.reverse();
    resultarraystr = resultarray.join('-');
    return {pose:resultarraystr,tagid:psttag}
}
function _$Qgetformname(c)
{
	while (c && !c.tagName) {
        c = c.parentNode
    }
	var b = c;
	if(/input|textarea|select|img|button/i.test(c.tagName))
	{
		var i = 0;
		while ( b && b.tagName !== 'FORM' ) 
		{
			if( b.tagName == 'BODY' )break;
			b = b.parentNode;
			i++;
		}
	}
	if( b && b.tagName == 'FORM' )
	{
		return {
			n: ((b.getAttribute('name') || b.getAttribute('id')) || ''),
			a: (b.getAttribute('action') || _$Qpathname)
		}
	}
	else
	{
		return {
			n: '',
			a: ''
		}
	}
}
function _$Qposition(b) {
    var a = {
        x: 0,
        y: 0
    };
    while (b.offsetParent) {
        a.x += parseInt(b.offsetLeft);
        a.y += parseInt(b.offsetTop);
        b = b.offsetParent
    }
    a.x += parseInt(b.offsetLeft);
    a.y += parseInt(b.offsetTop);
    return a
}
function _$Qgetxy() {
    var x = 0;
    var y = 0;
    if (_$Qdocument.body.scrollTop) {
        x = parseInt(_$Qdocument.body.scrollLeft);
        y = parseInt(_$Qdocument.body.scrollTop);
    } else {
        x = parseInt(_$Qdocument.documentElement.scrollLeft);
        y = parseInt(_$Qdocument.documentElement.scrollTop);
    };
    return {
        x: x,
        y: y
    }
}

function _$Qistable(a) {
    return (a.tagName == 'TBODY' || a.tagName == 'TR')
}
function _$Qchangeselect(c) {
    var b = c.srcElement || c.target;
    if (/input/i.test(b.tagName) && /checkbox|radio/i.test(b.type)) {
        _$Qchange(b, b.checked)
    } else if (/input/i.test(b.tagName) && /text/i.test(b.type)) {
        _$Qchange(b, b.value.length)
    } else if (/textarea/i.test(b.tagName)) {
        _$Qchange(b, _$Qtxt_len(b.value))
    } else if (/select/i.test(b.tagName)) {
        _$Qchange(b, b.selectedIndex)
    }
}
function _$Qchange(b, a) {
    if (b.lastvalue && b.lastvalue == a) {
        return;
    };
	_$Qhiddenele(b,b);
	_$Qgetby_idname(b);
	_$Qrecodeelement(b,'',a,'chn','','',0,'');
    b.lastvalue = a;
}
function _$Qchange_com(b, a) {
    if (b.lastvalue && b.lastvalue == a) {
        return
    };
    b.lastvalue = a;
}
function _$Qinitform(b) 
{
	for (var a = 0; a < b.elements.length; a++) {
		var c = b.elements[a];
		if (/input/i.test(c.tagName) && /checkbox|radio/i.test(c.type)) 
		{
			_$Qchange_com(c, c.checked);
		} 
		else
		{
			if (/input/i.test(c.tagName) && /text/i.test(c.type)) 
			{
				_$Qchange_com(c, c.value.length);
			} 
			else 
			{
				if (/textarea/i.test(c.tagName)) 
				{
					_$Qchange_com(c, _$Qtxt_len(c.value));
				} 
				else 
				{
					if (/select/i.test(c.tagName)) 
					{
						_$Qchange_com(c, c.selectedIndex);
					}
				}
			}
		}
	}
}
function _$Qtxt_len(a) {
    return a.length - (a.split("\r").length - 1)
}
function _$Qcltxy(ev) {
    if (!ev) {
        var ev = event
    }
    var y = parseInt(ev.clientY) + parseInt(_$Qgetxy().y) - parseInt(_$Qdocument.getElementsByTagName('body')[0].offsetTop);
    var x = parseInt(ev.clientX) + parseInt(_$Qgetxy().x) - parseInt(_$Qdocument.getElementsByTagName('body')[0].offsetLeft);
    if (x > 3000 || x < 0) {
        x = 0
    }
    if (y > 20000 || y < 0) {
        y = 0
    }
    return {
        x: x,
        y: y
    }
}
function _$Qmousemove(ev) {
    var t = _$Qgt();
    if ((t - _$Qloadtime) > (parseInt(0) + 1) * 1000) {_$Qrecodeelement('',ev,0,'msmv','','','','');}
    _$Qloadtime = t
}

function _$Qgetvalue(a) {
    var rv = '';
    if (a.tagName == 'SELECT') {
        rv = a.options[a.selectedIndex].text || ''
    } else {
        rv = a.value || ''
    }
    rv = _$Qteststr(_$Qencode(rv.replace(/\s/g, '')));
    return rv.substring(0, 512)
}
function _$Qsubmit(ev) {
    if (!ev) {
        var ev = event
    }
    var b = ev.srcElement || ev.currentTarget;
	if( b )
	{
		_$Qrecodeelement(b,ev,'','submit','','',0,'');
	}
}
function _$Qhiddenele(f,t)
{
	var loop = 1;
	while ( f && f.tagName !== 'FORM' && loop <= 10 ) 
	{
		if( f && f.tagName === 'BODY' )break;
		f = f.parentNode;
		t = f;
		loop++;
	}
	if( f && f.tagName === 'FORM' && _$Qformhiddenloop <= 10 ) 
	{
		var b = t.childNodes;
		for (var i = 0; i < b.length; i++) 
		{
			if(b[i] && b[i].tagName === 'INPUT' && (b[i].type === 'hidden'||b[i].style.display==='none')) 
			{
				var b_lastvalue = _$Qteststr(_$Qgetvalue(b[i]));
				b[i].lastvalue = _$Qteststr(b[i].lastvalue);
				if( b_lastvalue && b[i].lastvalue !== b_lastvalue )
				{
					_$Qrecodeelement(b[i],'','','chn','','',0,'');
					b[i].lastvalue = b_lastvalue;
				}
			}
			else
			{
				_$Qhiddenele(f,b[i]);
				_$Qformhiddenloop++;
			}
		}
	}
}
function _$Qsubmit_button(b,ev) {
	var i = 0;
	while ( b && b.tagName !== 'FORM' && i <= 10 ) 
	{
		if( b && b.tagName == 'BODY' )break;
		b = b.parentNode;
		i++;
	}
	if( b && b.tagName == 'FORM' )
	{
		_$Qhiddenele(b,b);
		_$Qgetby_idname(b);
		_$Qrecodeelement(b,ev,'','submit','','',0,'');
	}
}
function _$Qgetby_idname(b)
{
	var i = 0;
	while ( b && b.tagName !== 'FORM' && i <= 10 ) 
	{
		if( b && b.tagName == 'BODY' )break;
		b = b.parentNode;
		i++;
	}

	if( b && b.tagName === 'FORM' && b.name && _$Qformlist && _$Qformhidden )
	{
		var gh = phpstat_do_hidden_form(b.name);
		for(var ghk in gh)
		{
			var _fidv = _$Qteststr(_$Qid(gh[ghk]['ffield']));
			if( _fidv === '' )
			{
				var _fidva = _$Qname(gh[ghk]['ffield']);	
				if( _fidva.length > 0 )
				{
					_fidv = _fidva['0'];
				}
			}
			if( _fidv )
			{
				var b_lastvalue = _$Qteststr(_$Qgetvalue(_fidv));
				_fidv.lastvalue = _$Qteststr(_fidv.lastvalue);
				if( b_lastvalue && _fidv.lastvalue !== b_lastvalue )
				{
					_$Qrecodeelement(_fidv,'','','chn','','',0,b.name);
					_fidv.lastvalue = b_lastvalue;
				}
			}
		}
	}
}
function _$Qgetelementby(b, f, a) {
    for (var d = 0; d < b.length; d++) {
        var j = _$Qdocument.getElementsByTagName(b[d]);
        for (var c = 0; c < j.length; c++) {
            for (var g = 0; g < f.length; g++) {
                _$Qaddlistener(j[c], f[g], a)
            }
        }
    }
}
function _$Qgetmessageid(a) {
    if (a.toLowerCase() == 'debug') {
		setTimeout(function(){var div = _$Qdocument.createElement("div");
        div.innerHTML = '<textarea id="pst_messageid" name="message" rows="12" cols="100" style="position: absolute; left:10px; bottom:20px; border: solid #6C358D;">'+_$Qcourl+'</textarea>';
        _$Qdocument.getElementsByTagName('body').item(0).appendChild(div);_$Qmessageid = _$Qdocument.getElementById('pst_messageid');},3000);     
    }
}
function _$Qmessage(a) {
    if (_$Qmessageid) {
        _$Qmessageid.value = a;
    }
}
_$Qgetmessageid(_$Qpstac);
_$Qclickhotokstr ? _$Qinitevent(_$Qclickhotok) : '';
function _$Qcreateformtrans()
{
	var _$Qturl = _$Qcounturl + '/formtrans.js.php';
	var _$Qtobj = _$Qdocument.createElement('script');
	_$Qtobj.type = 'text/javascript';
	_$Qtobj.async = true;
	_$Qtobj.charset = 'utf-8';
	if( _$Qformlist && _$Qcfre_f )
	{
		_$Qtobj.src = _$Qturl + '?action=reaction&website=' + _$Qwebsite + '&swebsite=' + _$Qpartner_website + '&swebsiteid=' + _Schannel_website_id + '&swebshopid=' + _Schannel_webshop_id + '&uipcode=' + _$Qusercookie + '&luipcode=' + _$Qlusercookie + '&formlist=' + _$Qencode(_$Qformlist) + '&pagesite=' + _$Qhostname + '&phone='+_$Qencode(_$Qtelphone)+'&system='+_$Qencode(_$Qsystem)+'&medium='+_$Qencode(_$Qmediumsource)+'&marknum='+_$Qrandomid+'&prefix=_$Q&rand='+Math.random();
	}
	if( _$Qformhidden )
	{
		_$Qtobj.src = _$Qturl + '?action=hidden&website=' + _$Qwebsite + '&swebsite=' + _$Qpartner_website + '&swebsiteid=' + _Schannel_website_id + '&swebshopid=' + _Schannel_webshop_id + '&formlist=' + _$Qencode(_$Qformlist) + '&prefix=_$Q&rand='+Math.random();
	}
	_$Qdocumentcookie.getElementsByTagName('head').item(0).appendChild(_$Qtobj)
}
if( _$Qformlist && ( _$Qformhidden || _$Qcfre_f ) )
{
	_$Qcreateformtrans();
}
window.setInterval(function(){_$Qunload();}, 5000);
_$Qdirecttrackevent();
	_$Qjsgif(_$Qcourl);
	_$Qcreatejs();
	_$Qshare(_$Qusercookie);
}
function _$Qshare(userunique){};;
if( _$Qprotocol.toString().toLowerCase().indexOf('http') > -1 )
{
	if(_$Qisdownloadflash === 0)
	{
		_$Qphpstat('HttpCookie');
	}
	else
	{
		_$Qphpstat_flash_object = new phpstatCookie({

				namespace: 'namespace_phpstat',
				swf_url: _$Qcounturl+'/cookie/storage.swf?'+Math.random(), 
				debug: false,
				onready: function() {
				_$Qphpstat('FlashCookie');
				},
				onerror: function() {
				_$Qphpstat('FlashCookie-err');
				}
			});
	}
}