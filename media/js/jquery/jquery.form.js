/*
* jQuery表单验证
* Gary Yang (532483703@qq.com)
* Version 1.0 (2015-04-20)
*/
;(function($){  
	/**
	* 表单验证
	*/
    $.fn.extend({  
        validateForm:function(options){  
        	var isEmpty = function(v) {
        		return  (v == '' || (v == null) || (v.length == 0) || /^\s+$/.test(v));
        	}
        	var lib = [
				    ['validate-no-html-tags', '不能包含HTML标签', function(v) {
						return !/<(\/)?\w+/.test(v);
					}],
					['validate-select', '请选择', function(v) {
				        return ((v != "none") && (v != null) && (v.length != 0));
		            }],
				    ['required-entry', '不能为空', function(v) {
				        return  isEmpty(v);
		            }],
		            ['validate-username', '格式不正确', function(v) {
				        return isEmpty(v) || (!(/^(?:[\w-]+\.?)*[\w-]+@(?:[\w-]+\.)+[\w]{2,3}$/.test(v)) && !(/^1[34578]\d{9}$/.test(v)));
		            }],
				    ['validate-number', '输入不合法', function(v) {
				        return isEmpty(v) || (!isNaN(parseNumber(v)) && /^\s*-?\d*(\.\d*)?\s*$/.test(v));
		            }],
		            ['validate-password', '6~16位字符，至少包含数字、字母（区分大小写）、符号中的2种', function(v) {
		                var pass=$.trim(v);
		                return !(pass.length>5 && pass.length < 17);
		            }],
	            ];
        	options = $.extend({
        		elementError:true,
	        	lib:[]
	        },options);
	        $.extend(lib,options.lib);
	        var msg = [];
	        $(this).find('.validation-failed').remove();
	        $(this).find('input:visible,select,textarea').each(function(){
	        	var elem = $(this);
	        	var flag = true;
	        	$.each(lib, function(i, n){
	        		if (elem.hasClass(n[0])) {
	        			var f = n[2];
	        			flag = f(elem.val());
	        			if (flag) {
	        				if (options.elementError) {
	        					elem.after('<span class="validation-failed">'+n[1]+'</span>');
	        				} else {
	        					msg.push(elem.attr('title')+n[1]);
	        				}
	        				
	        			}
	        		}
	        	})
	        	
	        });
	        
	        //返回
	        return {'ret':(msg.length>0 ? 0 : -1),'msg':msg};
        }
	        
    });
})(jQuery);