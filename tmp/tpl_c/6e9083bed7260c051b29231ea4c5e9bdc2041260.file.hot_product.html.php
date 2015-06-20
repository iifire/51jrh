<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-28 10:18:03
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\p2p\index\hot_product.html" */ ?>
<?php /*%%SmartyHeaderCode:128635566bfdbe3e187-24511108%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e9083bed7260c051b29231ea4c5e9bdc2041260' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\p2p\\index\\hot_product.html',
      1 => 1432801081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128635566bfdbe3e187-24511108',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5566bfdbef4e89_48218705',
  'variables' => 
  array (
    'product' => 0,
    'i' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5566bfdbef4e89_48218705')) {function content_5566bfdbef4e89_48218705($_smarty_tpl) {?><table width="100%" class="hot-products">
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
</a></td>
			
			<td class="a-right">年华收益</td>
		</tr>
		<tr class="b">
			<td class="per"><div class="progress no-margin"><span class="complete" style="width:50%"></span></div></td>
			<td class="a-left"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_amount_start'];?>
元起投&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['product_period'];?>
</span><?php if (!isset($_smarty_tpl->tpl_vars['row']) || !is_array($_smarty_tpl->tpl_vars['row']->value)) $_smarty_tpl->createLocalArrayVariable('row');
if ($_smarty_tpl->tpl_vars['row']->value['product_period_unit'] = 0) {?>天<?php } else { ?>月<?php }?></td>				
			<td class="rate a-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_rate'];?>
%</td>
		</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>
