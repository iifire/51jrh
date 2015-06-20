<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-25 08:06:27
         compiled from "C:\xampp\htdocs\myframework\tpl\sidebar\wiki_article.html" */ ?>
<?php /*%%SmartyHeaderCode:278855561b9a303cf05-61091789%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '192a8fdf1ca2e5a15950186a36a97214109e2e0f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\sidebar\\wiki_article.html',
      1 => 1432533984,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '278855561b9a303cf05-61091789',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5561b9a3064003_74013733',
  'variables' => 
  array (
    'wiki_artile' => 0,
    'host' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5561b9a3064003_74013733')) {function content_5561b9a3064003_74013733($_smarty_tpl) {?><div class="block wiki-block">
	<div class="block-title pr">
		<h2>P2P百科</h2>
		<a class="more f-right pa" title="更多" href="">更多&gt;&gt;</a>
	</div>
	<div class="clearer"></div>
	<div class="block-content p10">
		<ul class="links">
			<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wiki_artile']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
			<li class=""><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
wiki/view/<?php echo $_smarty_tpl->tpl_vars['row']->value['article_id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['article_title'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value['article_title'];?>
</a></li>
			<?php } ?>
		</ul>
	
	</div>
</div><?php }} ?>
