<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-23 03:55:57
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\view\hot_company.html" */ ?>
<?php /*%%SmartyHeaderCode:18618555fd8ca2f4402-36815578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e360270aadcfd22687b4cb0c15bd83978e65eba' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\view\\hot_company.html',
      1 => 1432346154,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18618555fd8ca2f4402-36815578',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_555fd8ca2f4404_93550850',
  'variables' => 
  array (
    'company_hot' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555fd8ca2f4404_93550850')) {function content_555fd8ca2f4404_93550850($_smarty_tpl) {?><div class="block">
	<div class="block-title">
		<h2>热门平台推荐</h2>
	</div>
	<div class="block-content">
		<ul clas="links">
			<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['company_hot']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
：<?php echo $_smarty_tpl->tpl_vars['row']->value['company_hot_slogan'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
：<?php echo $_smarty_tpl->tpl_vars['row']->value['company_hot_slogan'];?>
</a></li>
			<?php } ?>
		
		</ul>
	
	</div>
</div><?php }} ?>
