<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 05:00:12
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\ziguan\index\hot_product.html" */ ?>
<?php /*%%SmartyHeaderCode:150765567d63c633808-62960682%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fbfc6279ed8d04f47d17e451f342783dbb588beb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\ziguan\\index\\hot_product.html',
      1 => 1432827604,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150765567d63c633808-62960682',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
    'i' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5567d63c65a901_96947121',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5567d63c65a901_96947121')) {function content_5567d63c65a901_96947121($_smarty_tpl) {?><table width="100%" class="hot-products">
	<colgroup>
		<col width="6%" />
		<col width="34%" />
		<col width="40%" />
		<col width="20%" />
	</colgroup>
	<tbody>
		<?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable("0", null, 0);?>
		<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
		<tr class="t">
			<td rowspan="2"><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?><i class="cirle <?php if ($_smarty_tpl->tpl_vars['i']->value<4) {?>top<?php }?>"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</i></td>
			<td class="name" colspan="2"><a href="#"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['product_partner'];?>
</a></td>
			<td class="a-right">预计年收益</td>
		</tr>
		<tr class="b">
			<td class="per"  colspan="2">每万份日收益：<?php echo $_smarty_tpl->tpl_vars['row']->value['product_profit_yesterday'];?>
元   月收益： <?php echo $_smarty_tpl->tpl_vars['row']->value['product_profit_yesterday']*30;?>
元</td>
			
			<td class="rate a-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_rate_week'];?>
%</td>
		</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>
