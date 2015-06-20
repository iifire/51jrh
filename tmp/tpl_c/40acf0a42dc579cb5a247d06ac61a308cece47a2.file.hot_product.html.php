<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-24 02:56:37
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\list\hot_product.html" */ ?>
<?php /*%%SmartyHeaderCode:688055611ab818e701-68061388%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40acf0a42dc579cb5a247d06ac61a308cece47a2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\list\\hot_product.html',
      1 => 1432428994,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '688055611ab818e701-68061388',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55611ab8324b03_47903014',
  'variables' => 
  array (
    'product_hot' => 0,
    'IMG_PATH' => 0,
    'row' => 0,
    'host' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55611ab8324b03_47903014')) {function content_55611ab8324b03_47903014($_smarty_tpl) {?><table width="100%" class="products-list licai-list">
	<colgroup>
		<col width="15%">
		<col width="70%">
		<col width="15%">
	</colgroup>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product_hot']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
		<tr>
			<td class="a-center img">
				<img src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
logo/lufax.png" height="60"/>
			</td>
			<td class="top p0">
				<dl>
					<dt>
						<a href="#"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
&nbsp;|&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['product_sku_outer'];?>
</a>
						<span>年华收益<span class="number cred"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_rate'];?>
</span>%</span>
						<span>投资期限<span class="number cred"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_period'];?>
</span><?php if (!isset($_smarty_tpl->tpl_vars['row']) || !is_array($_smarty_tpl->tpl_vars['row']->value)) $_smarty_tpl->createLocalArrayVariable('row');
if ($_smarty_tpl->tpl_vars['row']->value['product_period_unit'] = 0) {?>天<?php } else { ?>月<?php }?></span>
					</dt>
					<dd>
						<span>借款金额：<?php echo $_smarty_tpl->tpl_vars['row']->value['product_amount'];?>
万元</span>
						<span>起投金额：<?php echo $_smarty_tpl->tpl_vars['row']->value['product_amount_start'];?>
元</span>
						<span><?php echo $_smarty_tpl->tpl_vars['row']->value['product_pay_method'];?>
</span>
					</dd>
				</dl>
			</td>
			
			<td class="">
				<div class="btns">
					<a class="button view mr10" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/view/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
"><span>查看</span></a>
				</div>
			</td>
			
		</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>
