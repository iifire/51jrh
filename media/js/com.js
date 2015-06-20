function setLocation(url){
    window.location.href = url;
}
function decorateGeneric(elements, decorateParams) {
    var allSupportedParams = ['odd', 'even', 'first', 'last'];
    var _decorateParams = {};
    var total = elements.length;
    if (total) {
        // determine params called
        if (typeof(decorateParams) == 'undefined') {
            decorateParams = allSupportedParams;
        }
        if (!decorateParams.length) {
            return;
        }
        for (var k in allSupportedParams) {
            _decorateParams[allSupportedParams[k]] = false;
        }
        for (var k in decorateParams) {
            _decorateParams[decorateParams[k]] = true;
        }

        // decorate elements
        // elements[0].addClassName('first'); // will cause bug in IE (#5587)
        if (_decorateParams.first) {
            $(elements[0]).addClass('first');
        }
        if (_decorateParams.last) {
            $(elements[total-1]).addClass('last');
        }
        for (var i = 0; i < total; i++) {
            if ((i + 1) % 2 == 0) {
                if (_decorateParams.even) {
                    $(elements[i]).addClass( 'even');
                }
            }
            else {
                if (_decorateParams.odd) {
                    $(elements[i]).addClass('odd');
                }
            }
        }
    }
}
function decorateTable(table, options) {
    var table = $('#'+table);
    if (table) {
        // set default options
        var _options = {
            'tbody'    : false,
            'tbody tr' : ['odd', 'even', 'first', 'last'],
            'thead tr' : ['first', 'last'],
            'tfoot tr' : ['first', 'last'],
            'tr td'    : ['last']
        };
        // overload options
        if (typeof(options) != 'undefined') {
            for (var k in options) {
                _options[k] = options[k];
            }
        }
        // decorate
        if (_options['tbody']) {
            decorateGeneric(table.find('tbody'), _options['tbody']);
        }
        if (_options['tbody tr']) {
            decorateGeneric(table.find('tbody tr'), _options['tbody tr']);
        }
        if (_options['thead tr']) {
            decorateGeneric(table.find('thead tr'), _options['thead tr']);
        }
        if (_options['tfoot tr']) {
            decorateGeneric(table.find('tfoot tr'), _options['tfoot tr']);
        }
        if (_options['tr td']) {
            var allRows = table.find('tr');
            if (allRows.length) {
                for (var i = 0; i < allRows.length; i++) {
                    decorateGeneric(allRows[i].getElementsByTagName('TD'), _options['tr td']);
                }
            }
        }
    }
}
function decorateList(list, nonRecursive) {
    if ($('#'+list)) {
        if (typeof(nonRecursive) == 'undefined') {
            var items = $('#'+list).find('li')
        }
        else {
            var items = $('#'+list).find('li')
        }
        decorateGeneric(items, ['odd', 'even', 'last']);
    }
}


//ds.base js动态加载
;(function(global, document, undefined){
	var 
	rblock = /\{([^\}]*)\}/g,
	ds = global.ds = {
		noop: function(){},
		//Object
		mix: function(target, source, cover){
			if(typeof source !== 'object'){
				cover = source;
				source = target;
				target = this;
			}
			for(var k in source){
				if(cover || target[k] === undefined){
					target[k] = source[k];
				}
			}
			return target;
		},
		//String
		mixStr: function(sStr){
			var args = Array.prototype.slice.call(arguments, 1);
			return String(sStr).replace(rblock, function(a, i){
				return args[i] != null ? args[i] : a;
			});
		},
		trim: function(str){
			return String(str).replace(/^\s*/, '').replace(/\s*$/, '');
		},
		//Number
		getRndNum: function(max, min){
			min = isFinite(min) ? min : 0;
			return Math.random() * ((isFinite(max) ? max : 1000) - min) + min;
		},
		//BOM
		scrollTo: (function(){
			var 
			duration = 480,
			view = $(global),
			setTop = function(top){ global.scrollTo(0, top);},
			fxEase = function(t){return (t*=2)<1?.5*t*t:.5*(1-(--t)*(t-2));};
			return function(top, callback){
				top = Math.max(0, ~~top);
				var 
				tMark = new Date(),
				currTop = view.scrollTop(),
				height = top - currTop,
				fx = function(){
					var tMap = new Date() - tMark;
					if(tMap >= duration){
						setTop(top);
						return (callback || ds.noop).call(ds, top);
					}
					setTop(currTop + height * fxEase(tMap/duration));
					setTimeout(fx, 16);
				};
				fx();
			};
		})(),
		//DOM
		loadScriptCache: {},
		loadScript: function(url, callback, args){
			var cache = this.loadScriptCache[url];
			if(!cache){
				cache = this.loadScriptCache[url] = {
					callbacks: [],
					url: url
				};

				var 
				firstScript = document.getElementsByTagName('script')[0],
				script = document.createElement('script');
				if(typeof args === 'object'){
					for(var k in args){
						script[k] = args[k];
					}
				}
				script.src = url;
				script.onload = script.onreadystatechange = 
				script.onerror = function(){
					if(/undefined|loaded|complete/.test(this.readyState)){
						script = script.onreadystatechange = 
						script.onload = script.onerror = null;
						cache.loaded = true;
						
						for(var i=0,len=cache.callbacks.length; i<len; i++){
							cache.callbacks[i].call(null, url);
						}
						cache.callbacks = [];
					}
				};
				firstScript.parentNode.insertBefore(script, firstScript);
			}

			if(!cache.loaded){
				if(typeof callback === 'function'){
					cache.callbacks.push(callback);
				}
			}
			else{
				(callback || ds.noop).call(null, url);
			}
			return this;
		},
		requestAnimationFrame: (function(){
			var handler = global.requestAnimationFrame || global.webkitRequestAnimationFrame || 
				global.mozRequestAnimationFrame || global.msRequestAnimationFrame || 
				global.oRequestAnimationFrame || function(callback){
					return global.setTimeout(callback, 1000 / 60);
				};
			return function(callback){
				return handler(callback);
			};
		})(),
		animate: (function(){
			var 
			easeOut = function(pos){ return (Math.pow((pos - 1), 3) + 1);};
			getCurrCSS = global.getComputedStyle ? function(elem, name){
				return global.getComputedStyle(elem, null)[name];
			} : function(elem, name){
				return elem.currentStyle[name];
			};
			return function(elem, name, to, duration, callback, easing){
				var 
				from = parseFloat(getCurrCSS(elem, name)) || 0,
				style = elem.style,
				tMark = new Date(),
				size = 0;
				function fx(){
					var elapsed = +new Date() - tMark;
					if(elapsed >= duration){
						style[name] = to + 'px';
						return (callback || ds.noop).call(elem);
					}
					style[name] = (from + size * easing(elapsed/duration)) + 'px';
					ds.requestAnimationFrame(fx);
				};
				to = parseFloat(to) || 0;
				duration = ~~duration || 200;
				easing = easing || easeOut;
				size = to - from;
				fx();
				return this;
			};
		})(),
		//Cookies
		getCookie: function(name){
			var ret = new RegExp('(?:^|[^;])' + name + '=([^;]+)').exec(document.cookie);
			return ret ? decodeURIComponent(ret[1]) : '';
		},
		setCookie: function(name, value, expir){
			var cookie = name + '=' + encodeURIComponent(value);
			if(expir !== void 0){
				var now = new Date();
				now.setDate(now.getDate() + ~~expir);
				cookie += '; expires=' + now.toGMTString();
			}
			document.cookie = cookie;
		},
		//Hacker
		transitionSupport: (function(){
			var 
			name = '',
			prefixs = ['', 'webkit', 'moz', 'ms', 'o'],
			docStyle = (document.documentElement || document.body).style;
			for(var i=0,len=prefixs.length; i<len; i++){
				name = prefixs[i] + (prefixs[i]!=='' ? 'Transition' : 'transition');
				if(name in docStyle){
					return {
						propName: name,
						prefix: prefixs[i]
					};
				}
			}
			return null;
		})(),
		isIE6: !-[1,] && !global.XMLHttpRequest
	};
})(this, document);


/****** 省市区组件 *********/

function addressAdapter(config,af) {
	addressUtils(config);
	var p_id = config.p_id;
	var c_id = config.c_id;
	jQuery('#'+p_id+',#'+c_id).change(function(){
		
		addressUtils(config);
	})
	if (af) {
		var a_id = config.a_id;
		jQuery('#'+a_id).change(function(){
			addressUtils(config,af);
		})
	}
}
function addressUseDefault(s,t) {
	jQuery('#'+t.p).html("<option value='"+jQuery('#'+s.p).val()+"' selected='selected'>--请选择--</option>");
	jQuery('#'+t.c).html("<option value='"+jQuery('#'+s.c).val()+"' selected='selected'>--请选择--</option>");
	jQuery('#'+t.a).html("<option value='"+jQuery('#'+s.a).val()+"' selected='selected'>--请选择--</option>");
	jQuery('#'+t.s).val(jQuery('#'+s.s).val());
	addressUtils({'p_id':jQuery('#'+t.p).attr('id'),'c_id':jQuery('#'+t.c).attr('id'),'a_id':jQuery('#'+t.a).attr('id')});
}
function addressUtils(config,af) {
	//alert(config.p_id);
	var p_id = config.p_id;
	var c_id = config.c_id;
	
	var p = jQuery('#'+p_id).val();
	var c = jQuery('#'+c_id).val();
	
	var empty = config.empty;
	var p_str = empty ? "<option value=''>"+empty+"</option>" : "<option value=''>--请选择--</option>";
	var c_str = p_str;
	
	if (af) {
		var a_id = config.a_id;
		var a = jQuery('#'+a_id).val();
		var a_str = p_str;
	}
	for(var i=0;i<provinces.length;i++) {
		if(provinces[i].value==p) {
			p_str += "<option value='"+provinces[i].value+"' selected='selected'>"+provinces[i].name+"</option>"
			var subs = provinces[i].subs;
			for(var j=0;j<subs.length;j++) {
				if(subs[j].value==c) {
					c_str += "<option value='"+subs[j].value+"' selected='selected'>"+subs[j].name+"</option>"
					if (af) {
						var _subs = subs[j].subs;
						for(var k=0;k<_subs.length;k++) {
							if(_subs[k].value==a) {
								a_str += "<option value='"+_subs[k].value+"' selected='selected'>"+_subs[k].name+"</option>"
							} else {
								a_str += "<option value='"+_subs[k].value+"' >"+_subs[k].name+"</option>"
							}
						}
					}
				} else {
					c_str += "<option value='"+subs[j].value+"'>"+subs[j].name+"</option>"
				}
			}
		} else {
			p_str += "<option value='"+provinces[i].value+"' >"+provinces[i].name+"</option>"
		}
	}
	jQuery('#'+p_id).html(p_str);
	jQuery('#'+c_id).html(c_str);
	if (af) {
		jQuery('#'+a_id).html(a_str);
	}
}
//lazyload
(function(e,t,n,r){var i=e(t);e.fn.lazyload=function(n){function a(){var t=0;s.each(function(){var n=e(this);if(u.skip_invisible&&!n.is(":visible"))return;if(!e.abovethetop(this,u)&&!e.leftofbegin(this,u))if(!e.belowthefold(this,u)&&!e.rightoffold(this,u))n.trigger("appear"),t=0;else if(++t>u.failure_limit)return!1})}var s=this,o,u={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:t,data_attribute:"original",skip_invisible:!0,appear:null,load:null};return n&&(r!==n.failurelimit&&(n.failure_limit=n.failurelimit,delete n.failurelimit),r!==n.effectspeed&&(n.effect_speed=n.effectspeed,delete n.effectspeed),e.extend(u,n)),o=u.container===r||u.container===t?i:e(u.container),0===u.event.indexOf("scroll")&&o.bind(u.event,function(e){return a()}),this.each(function(){var t=this,n=e(t);t.loaded=!1,n.one("appear",function(){if(!this.loaded){if(u.appear){var r=s.length;u.appear.call(t,r,u)}e("<img />").bind("load",function(){n.hide().attr("src",n.data(u.data_attribute))[u.effect](u.effect_speed),t.loaded=!0;var r=e.grep(s,function(e){return!e.loaded});s=e(r);if(u.load){var i=s.length;u.load.call(t,i,u)}}).attr("src",n.data(u.data_attribute))}}),0!==u.event.indexOf("scroll")&&n.bind(u.event,function(e){t.loaded||n.trigger("appear")})}),i.bind("resize",function(e){a()}),/iphone|ipod|ipad.*os 5/gi.test(navigator.appVersion)&&i.bind("pageshow",function(t){t.originalEvent.persisted&&s.each(function(){e(this).trigger("appear")})}),e(t).load(function(){a()}),this},e.belowthefold=function(n,s){var o;return s.container===r||s.container===t?o=i.height()+i.scrollTop():o=e(s.container).offset().top+e(s.container).height(),o<=e(n).offset().top-s.threshold},e.rightoffold=function(n,s){var o;return s.container===r||s.container===t?o=i.width()+i.scrollLeft():o=e(s.container).offset().left+e(s.container).width(),o<=e(n).offset().left-s.threshold},e.abovethetop=function(n,s){var o;return s.container===r||s.container===t?o=i.scrollTop():o=e(s.container).offset().top,o>=e(n).offset().top+s.threshold+e(n).height()},e.leftofbegin=function(n,s){var o;return s.container===r||s.container===t?o=i.scrollLeft():o=e(s.container).offset().left,o>=e(n).offset().left+s.threshold+e(n).width()},e.inviewport=function(t,n){return!e.rightoffold(t,n)&&!e.leftofbegin(t,n)&&!e.belowthefold(t,n)&&!e.abovethetop(t,n)},e.extend(e.expr[":"],{"below-the-fold":function(t){return e.belowthefold(t,{threshold:0})},"above-the-top":function(t){return!e.belowthefold(t,{threshold:0})},"right-of-screen":function(t){return e.rightoffold(t,{threshold:0})},"left-of-screen":function(t){return!e.rightoffold(t,{threshold:0})},"in-viewport":function(t){return e.inviewport(t,{threshold:0})},"above-the-fold":function(t){return!e.belowthefold(t,{threshold:0})},"right-of-fold":function(t){return e.rightoffold(t,{threshold:0})},"left-of-fold":function(t){return!e.rightoffold(t,{threshold:0})}})})(jQuery,window,document)
