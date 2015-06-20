<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-23 04:11:32
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\view\hot_product.html" */ ?>
<?php /*%%SmartyHeaderCode:1989555fe04ba5eb00-35270869%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2807d2fa0fc102eb548a90e8d17262cfd78857bb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\view\\hot_product.html',
      1 => 1432347090,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1989555fe04ba5eb00-35270869',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_555fe04badf985_94264057',
  'variables' => 
  array (
    'product_hot' => 0,
    'host' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555fe04badf985_94264057')) {function content_555fe04badf985_94264057($_smarty_tpl) {?><div class="block">
	<div class="block-title">
		<h2>热门产品推荐</h2>
	</div>
	<div class="block-content">
		<ul clas="links">
			<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product_hot']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/view/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
：<?php echo $_smarty_tpl->tpl_vars['row']->value['product_hot_slogan'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
|<?php echo $_smarty_tpl->tpl_vars['row']->value['product_sku_outer'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['product_rate'];?>
%&nbsp;/&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['product_period'];?>
</span><?php if (!isset($_smarty_tpl->tpl_vars['row']) || !is_array($_smarty_tpl->tpl_vars['row']->value)) $_smarty_tpl->createLocalArrayVariable('row');
if ($_smarty_tpl->tpl_vars['row']->value['product_period_unit'] = 0) {?>天<?php } else { ?>月<?php }?></a></li>
			<?php } ?>
		
		</ul>
	
	</div>
</div><?php }} ?>
