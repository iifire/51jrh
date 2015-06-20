(function($) {
    $.fn.myrule = function(options) {
    	var code = options.code;
		var ruleObj = options.rule;
		
		jQuery('#'+code+'_condition_container').append(jQuery('#t_'+code+'_conditions_combination').html());
		
		vcpm_rule_bind(code);
		if (ruleObj.data.length<1) {
			return;
		}
		var level = ruleObj.level;
		var rule = ruleObj.data;
		for (var i=1;i<=level;i++) {
			for (var j=0;j<rule.length;j++) {
				var item = rule[j];
				if (item.level==1) {
					jQuery('#'+code+'_conditions__1__aggregator').find('option:selected').attr("selected",false);
					jQuery('#'+code+'_conditions__1__value').find('option:selected').attr("selected",false);
					
					jQuery('#'+code+'_conditions__1__aggregator').find("option[value='" + item.combination.aggregator + "']").attr("selected",true);
					jQuery('#'+code+'_conditions__1__value').find("option[value='" + item.combination.value + "']").attr("selected",true);
					
					var txt_aggre = jQuery('#'+code+'_conditions__1__aggregator').find('option:selected').text();
					var txt_value = jQuery('#'+code+'_conditions__1__value').find('option:selected').text();
					jQuery('#'+code+'_conditions__1__aggregator').parent().prev().html(txt_aggre);
					jQuery('#'+code+'_conditions__1__value').parent().prev().html(txt_value);
				} else {
					if (i==item.level) {
						if (item.combination.hasOwnProperty('aggregator')) {
							var before_html = jQuery('#t_'+code+'_conditions_combination').html();
							var target_parent = jQuery('#'+code+'_condition_container #'+code+'_conditions__' + item.parent_path  + '__aggregator');

							var target_before = target_parent.parent().parent().siblings('.rule-param-children').find('>li:last-child');
							target_before.before('<li>' + before_html + '</li>');
							var before_aggre = target_before.prev().find('.aggregator');
							var before_value = target_before.prev().find('.value');
							
							before_aggre.attr('id',code+'_conditions__' + item.path + '__aggregator');
							before_aggre.attr('name',code+'[conditions][' + item.path + '][aggregator]');
							before_value.attr('id',code+'_conditions__' + item.path + '__value');
							before_value.attr('name',code+'[conditions][' + item.path + '][value]');
							
							before_aggre.find('option:selected').attr("selected",false);
							before_aggre.find("option[value='" + item.combination.aggregator + "']").attr("selected",true);
							before_aggre.parent().prev().html(before_aggre.find('option:selected').text());
							
							before_value.find('option:selected').attr("selected",false);
							before_value.find("option[value='" + item.combination.value + "']").attr("selected",true);
							before_value.parent().prev().html(before_value.find('option:selected').text());
							
							before_aggre.parent().parent().siblings('.rule-param-children').find('>li .main').attr('id','conditions__' + item.path + '__new_child')
							before_aggre.parent().parent().siblings('.rule-param-children').find('>li .main').attr('name','rule[conditions][' + item.path + '][new_child]');
						} else {
							var before_html = jQuery('#t_'+code+'_conditions_'+item.combination.type).html();
							var target_parent = jQuery('#'+code+'_condition_container #'+code+'_conditions__' + item.parent_path  + '__aggregator');
							var target_before = target_parent.parent().parent().siblings('.rule-param-children').find('>li:last-child');
							target_before.before('<li>' + before_html + '</li>');
							var before_aggre = target_before.prev().find('.operator');
							var before_value = target_before.prev().find('.value');
							before_aggre.attr('id',code+'_conditions__' + item.path + '__operator');
							before_aggre.attr('name',code+'[conditions][' + item.path + '][operator--' + item.combination.type + ']');
							before_value.attr('id',code+'_conditions__' + item.path + '__value');
							before_value.attr('name',code+'[conditions][' + item.path + '][value--' + item.combination.type + ']');
							before_aggre.find('option:selected').attr("selected",false);
							before_aggre.find("option[value='" + item.combination.operator + "']").attr("selected",true);
							before_aggre.parent().prev().html(before_aggre.find('option:selected').text());
							if (before_value.hasClass('input-text')) {
								before_value.attr("value",item.combination.value);
								before_value.parent().prev().html( item.combination.value?item.combination.value : '...');
							} else {
								before_value.find('option:selected').attr("selected",false);
								before_value.find("option[value='" + item.combination.value + "']").attr("selected",true);
								before_value.parent().prev().html(before_value.find('option:selected').text());
							}	
						}
					}
				}
			}
		}
		vcpm_rule_bind(code);
    };
    
})(jQuery);
function vcpm_rule_bind(code) {
	jQuery('#'+code+'_main .rule-param-add').unbind('click').click(function(){
		jQuery(this).parent().parent().find('>a').hide();
		jQuery(this).parent().parent().find('>span').show();
	})
	jQuery('#'+code+'_main .rule-param-remove').unbind('click').click(function(){
		jQuery(this).parent().parent().empty();
	})
	jQuery('#'+code+'_main .rule-param > span > .element-value-changer.item').unbind('blur').blur(function(){
		var _txt = '';
		if (jQuery(this).hasClass('select')) {
			_txt = jQuery(this).find('option:selected').text();
		} else if (jQuery(this).hasClass('input-text')) {
			_txt = jQuery(this).val();
			_txt = _txt ? _txt : '...';
		}
		jQuery(this).parent().hide().prev().html(_txt).show();
	})
	jQuery('#'+code+'_main .rule-param > a.label').unbind('click').click(function(){
		var _txt = jQuery(this).text();
		if (jQuery(this).hasClass('select-next')) {
			jQuery(this).hide().next().show().find("select").focus().find("option[text='" + _txt + "']").attr("selected",true);;;
		} else if (jQuery(this).hasClass('input-text-next')) {
			_txt = _txt=='...' ? '' : _txt;
			jQuery(this).hide().next().show().find('input').focus().attr('value',_txt);;
		}
	})
	jQuery('#'+code+'_main .element-value-changer.main').unbind('change').change(function(){
		var _t_target_id = jQuery(this).val();
		if (_t_target_id) {
			var _t_target = jQuery(this).parent().parent().parent();
			jQuery(this).parent().hide();
			jQuery(this).parent().prev().show();
			_t_target.before('<li>' + jQuery('#'+code+'_main #'+_t_target_id).html() + '</li>');
			
			
			/*****************************************************************************/
			_t_target_clean = _t_target_id.replace('t_'+code+'_conditions_','');
			if (_t_target_id == 't_'+code+'_conditions_combination') {
				//有子条件
				var _cur_new_id = jQuery(this).attr('id'); 
				var _cur_new_name = jQuery(this).attr('name');
				console.log(_cur_new_id);
				var _cur_new_count = jQuery(this).parent().parent().parent().siblings('li').length;
				_t_target.prev().find('select,input').each(function(){
					if (jQuery(this).hasClass('aggregator')) {
						jQuery(this).attr('id',_cur_new_id.replace('__new_child','--' + (_cur_new_count) + '__aggregator'))
						jQuery(this).attr('name',_cur_new_name.replace('][new_child]','--' + (_cur_new_count) + '][aggregator]'));
					} else if (jQuery(this).hasClass('value')) {
						jQuery(this).attr('id',_cur_new_id.replace('__new_child','--' + (_cur_new_count) + '__value'))
						jQuery(this).attr('name',_cur_new_name.replace('][new_child]','--' + (_cur_new_count) + '][value]'));
					} else if (jQuery(this).hasClass('main')){
						jQuery(this).attr('id',_cur_new_id.replace('__new_child','--' + (_cur_new_count) + '__new_child'))
						jQuery(this).attr('name',_cur_new_name.replace('][new_child]','--' + (_cur_new_count) + '][new_child]'));
					}
				})
			} else {
				//没有子条件
				var _cur_new_id = jQuery(this).attr('id'); 
				var _cur_new_name = jQuery(this).attr('name');
				//console.log(_cur_new_id);
				var _cur_new_count = jQuery(this).parent().parent().parent().siblings('li').length;
				_t_target.prev().find('select,input').each(function(){
					if (jQuery(this).hasClass('operator')) {
						jQuery(this).attr('id',_cur_new_id.replace('__new_child','--' + (_cur_new_count) + '__operator'))
						jQuery(this).attr('name',_cur_new_name.replace('][new_child]','--' + (_cur_new_count) + '][operator--' + _t_target_clean + ']'));
					} else if (jQuery(this).hasClass('value')) {
						jQuery(this).attr('id',_cur_new_id.replace('__new_child','--' + (_cur_new_count) + '__value'))
						jQuery(this).attr('name',_cur_new_name.replace('][new_child]','--' + (_cur_new_count) + '][value--' + _t_target_clean + ']'));
					}
				})
			}
				
			/*****************************************************************************/
			
			jQuery(this).attr('value','');
			vcpm_rule_bind(code);
		}
	})
}