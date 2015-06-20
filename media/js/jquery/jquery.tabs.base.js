(function(global, document, jQuery){
	var 
	win = jQuery(window),
	_ops = {
		index : 0,
		delay : 0,
		shellTag : 'a',
		event : 'mouseenter',
		focusClass : 'focus',
		onbeforeselect : function(){},
		onselect : function(){}
	};
	jQuery.fn.tabs = function(ops){
		//初始化配置
		ops = ops || {};
		for(var k in _ops){
			if(typeof ops[k] === 'undefined'){
				ops[k] = _ops[k];
			}
		}
		var 
		id,
		i = 0,
		shells = [], 
		shell = this,
		btns = shell.find(ops.shellTag),
		_handler = function(e){
			var 
			tar = jQuery(this),
			inx = btns.index(this),
			prevInx = shell.data('prevIndex');
			e && e.preventDefault();
			if(prevInx !== inx && ops.onbeforeselect.call(shell, inx, prevInx, tar) !== false){
				if(isFinite(prevInx)){
					shells[prevInx].hide();
					btns.eq(prevInx).removeClass(ops.focusClass);
				}
				shells[inx].show();
				tar.addClass(ops.focusClass);
				shell.data('prevIndex', inx);
				ops.onselect.call(shell, inx, prevInx, tar);
			}
		};
		//获取所有 shell, tab
		if(!this.length || !btns.length) return this;
		for(var len = btns.length; i<len; i++){
			id = btns.eq(i).removeClass(ops.focusClass).attr('hideFocus', true).attr('href');
			id = id.slice(id.lastIndexOf('#'));
			shells.push(jQuery(id).hide());
		}
		if(ops.event !== 'mouseenter' || ops.delay <= 0){
			btns.bind(ops.event, _handler);
		}
		else{
			btns.each(function(i){
				var btn = btns.eq(i);
				btn.hover(function(){
					var self = this;
					global.clearTimeout(shell.data('@tab_timer'));
					shell.data('@tab_timer', setTimeout(function(){
						_handler.call(self);
					}, ops.delay));
				}, function(){
					global.clearTimeout(shell.data('@tab_timer'));
				});
			});
		}
		btns.eq(ops.index).trigger(ops.event);
		return this;
	}
})(this, this.document, jQuery);