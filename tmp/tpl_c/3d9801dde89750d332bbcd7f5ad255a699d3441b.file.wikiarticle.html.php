<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-24 13:39:44
         compiled from "C:\xampp\htdocs\myframework\tpl\sidebar\wikiarticle.html" */ ?>
<?php /*%%SmartyHeaderCode:263815561b84d1c3903-33163934%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d9801dde89750d332bbcd7f5ad255a699d3441b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\sidebar\\wikiarticle.html',
      1 => 1432467582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '263815561b84d1c3903-33163934',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5561b84d1c3903_38321927',
  'variables' => 
  array (
    'wikiarticle' => 0,
    'host' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5561b84d1c3903_38321927')) {function content_5561b84d1c3903_38321927($_smarty_tpl) {?><div class="block">
	<div class="block-title pr">
		<h2>P2P百科</h2>
		<a class="more f-right pa" title="更多" href="">更多<i class="icon"></i></a>
	</div>
	<div class="block-content">
		<ul class="links">
			<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wikiarticle']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
wiki/view/<?php echo $_smarty_tpl->tpl_vars['row']->value['article_id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['article_title'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value['article_title'];?>
</a></li>
			<?php } ?>
		</ul>
	
	</div>
</div><?php }} ?>
