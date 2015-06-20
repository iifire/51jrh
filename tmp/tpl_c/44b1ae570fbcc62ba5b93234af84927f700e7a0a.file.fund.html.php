<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 05:05:06
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\submenu\fund.html" */ ?>
<?php /*%%SmartyHeaderCode:57495567d762a5a001-86813658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44b1ae570fbcc62ba5b93234af84927f700e7a0a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\submenu\\fund.html',
      1 => 1432868654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57495567d762a5a001-86813658',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ssmenu_flag' => 0,
    'host' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5567d762a81104_37195801',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5567d762a81104_37195801')) {function content_5567d762a81104_37195801($_smarty_tpl) {?><div class="ms_ctn">
	<div class="w1100">
        <div class="subnav">
			<ul>
				<li class="<?php if (!$_smarty_tpl->tpl_vars['ssmenu_flag']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/ziguan/" title="">基金首页</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="product") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/ziguan-product/" title="">基金产品</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="company") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/ziguan-company/" title="">基金公司</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="news") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/ziguan-news/" title="">基金产品新闻</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="wiki") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/ziguan-wiki/" title="">基金知识百科</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="faq") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/ziguan-faq/" title="">基金常见问题</a></li>
			</ul>
		</div>
		<div class="clearer"></div>
	</div>
</div><?php }} ?>
