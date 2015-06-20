<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-26 07:24:59
         compiled from "C:\xampp\htdocs\myframework\tpl\pingtai\index.html" */ ?>
<?php /*%%SmartyHeaderCode:126655560996ddc3705-30540174%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c3e0f35f216be858f44d3ac8c4d86daba225ed9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\pingtai\\index.html',
      1 => 1432617896,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126655560996ddc3705-30540174',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5560996de57e09_22224918',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5560996de57e09_22224918')) {function content_5560996de57e09_22224918($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("include/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("pingtai/list/index.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("include/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
