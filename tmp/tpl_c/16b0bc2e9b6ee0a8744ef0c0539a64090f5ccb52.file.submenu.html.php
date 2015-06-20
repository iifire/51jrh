<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 09:35:01
         compiled from "C:\xampp\htdocs\myframework\tpl\credit\submenu.html" */ ?>
<?php /*%%SmartyHeaderCode:16201556816a5838b06-63992567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16b0bc2e9b6ee0a8744ef0c0539a64090f5ccb52' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\credit\\submenu.html',
      1 => 1432718863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16201556816a5838b06-63992567',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'submenu_flag' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556816a5838b05_99102616',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556816a5838b05_99102616')) {function content_556816a5838b05_99102616($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value) {?>
	<?php echo $_smarty_tpl->getSubTemplate ("licai/submenu/".((string)$_smarty_tpl->tpl_vars['submenu_flag']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?><?php }} ?>
