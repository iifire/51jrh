<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-23 08:41:21
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\view\same_rate.html" */ ?>
<?php /*%%SmartyHeaderCode:1148455602111b5a401-65238077%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '898d3fb42c9d8bb5e700f45d1d44a5deeec2f80e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\view\\same_rate.html',
      1 => 1432363189,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1148455602111b5a401-65238077',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'same_period_product' => 0,
    'IMG_PATH' => 0,
    'row' => 0,
    'host' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55602111bdf109_02676989',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55602111bdf109_02676989')) {function content_55602111bdf109_02676989($_smarty_tpl) {?><table width="100%" class="products-list licai-list">
	<colgroup>
		<col width="16%">
		<col width="47%">
		<col width="17%">
		<col width="20%">
	</colgroup>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['same_period_product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
		<tr>
			<td class="a-center img">
				<img src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
logo/lufax.png" height="90"/>
			</td>
			<td class="top">
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
				<div class="progress"><span class="complete" style="width:50%"></span></div>
				<div class="clearer"></div>
				<p class="no-margin mt5">剩余金额:</p>
			</td>
			<td class="">
				<div class="btns">
					<a class="button view mr10" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/view/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
"><span>查看</span></a>
					<button class="button go"><span>投标</span></button>
				</div>
			</td>
			
		</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>
