<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 15:45:27
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\submenu.html" */ ?>
<?php /*%%SmartyHeaderCode:2175655658e4b7d0008-40590986%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d1314f0d31de18e205a09ebccf82079e87f1415' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\submenu.html',
      1 => 1432907038,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2175655658e4b7d0008-40590986',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55658e4b83d603_04712123',
  'variables' => 
  array (
    'submenu_flag' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55658e4b83d603_04712123')) {function content_55658e4b83d603_04712123($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value) {?>
	<?php echo $_smarty_tpl->getSubTemplate ("licai/submenu/".((string)$_smarty_tpl->tpl_vars['submenu_code']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?><?php }} ?>
