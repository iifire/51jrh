<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-28 13:01:30
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\list\hot_company.html" */ ?>
<?php /*%%SmartyHeaderCode:2257355612228e9e303-05363364%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80ea21642d11fe4745569bde71aa87410a3d37b1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\list\\hot_company.html',
      1 => 1432810888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2257355612228e9e303-05363364',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55612228ec5400_34608489',
  'variables' => 
  array (
    'company_hot' => 0,
    'row' => 0,
    'IMG_PATH' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55612228ec5400_34608489')) {function content_55612228ec5400_34608489($_smarty_tpl) {?><div class="img-list">
	<ul class="links">
		<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['company_hot']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
" target="_blank"><img width="165" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
logo/lufax.png" /></a></li>
		<?php } ?>
	</ul>
	<div class="clearer"></div>
</div><?php }} ?>
