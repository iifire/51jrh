<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-26 08:19:29
         compiled from "C:\xampp\htdocs\myframework\tpl\pingtai\list\hot_company.html" */ ?>
<?php /*%%SmartyHeaderCode:5673556403ab683f83-01152591%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c0cc48364f64011cd58091bd0082abbd6b5fd20' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\pingtai\\list\\hot_company.html',
      1 => 1432621166,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5673556403ab683f83-01152591',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556403ab6ab080_55320509',
  'variables' => 
  array (
    'company_hot' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556403ab6ab080_55320509')) {function content_556403ab6ab080_55320509($_smarty_tpl) {?><div class="img-list">
	<ul class="links">
		<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['company_hot']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
</a></li>
		<?php } ?>
	</ul>
</div><?php }} ?>
