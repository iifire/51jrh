<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 15:44:40
         compiled from "C:\xampp\htdocs\myframework\tpl\daikuan\submenu.html" */ ?>
<?php /*%%SmartyHeaderCode:315805567dd69df7c81-42535614%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd282b83af81831aab9517ef2ddedeed7c973bed7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\daikuan\\submenu.html',
      1 => 1432907077,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '315805567dd69df7c81-42535614',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5567dd69df7c87_70249550',
  'variables' => 
  array (
    'submenu_flag' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5567dd69df7c87_70249550')) {function content_5567dd69df7c87_70249550($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value) {?>
	<?php echo $_smarty_tpl->getSubTemplate ("daikuan/submenu/".((string)$_smarty_tpl->tpl_vars['submenu_code']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?><?php }} ?>
