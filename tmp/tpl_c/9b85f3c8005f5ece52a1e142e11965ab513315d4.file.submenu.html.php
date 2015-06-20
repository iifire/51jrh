<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-30 16:19:18
         compiled from "C:\xampp\htdocs\myframework\tpl\jigou\submenu.html" */ ?>
<?php /*%%SmartyHeaderCode:153715569c6e68ff207-40064975%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b85f3c8005f5ece52a1e142e11965ab513315d4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\jigou\\submenu.html',
      1 => 1432907077,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153715569c6e68ff207-40064975',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'submenu_flag' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5569c6e6906f04_17205549',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5569c6e6906f04_17205549')) {function content_5569c6e6906f04_17205549($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value) {?>
	<?php echo $_smarty_tpl->getSubTemplate ("daikuan/submenu/".((string)$_smarty_tpl->tpl_vars['submenu_code']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?><?php }} ?>
