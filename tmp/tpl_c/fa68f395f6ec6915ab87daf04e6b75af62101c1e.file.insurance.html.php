<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 05:11:24
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\submenu\insurance.html" */ ?>
<?php /*%%SmartyHeaderCode:94575567d8dc26ea82-91775269%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa68f395f6ec6915ab87daf04e6b75af62101c1e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\submenu\\insurance.html',
      1 => 1432869080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94575567d8dc26ea82-91775269',
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
  'unifunc' => 'content_5567d8dc2bcc88_66880463',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5567d8dc2bcc88_66880463')) {function content_5567d8dc2bcc88_66880463($_smarty_tpl) {?><div class="ms_ctn">
	<div class="w1100">
        <div class="subnav">
			<ul>
				<li class="<?php if (!$_smarty_tpl->tpl_vars['ssmenu_flag']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/insurance/" title="">保险首页</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="product") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/insurance-product/" title="">保险产品</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="company") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/insurance-company/" title="">保险公司</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="news") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/insurance-news/" title="">保险产品新闻</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="wiki") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/insurance-wiki/" title="">保险知识百科</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="faq") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/insurance-faq/" title="">保险常见问题</a></li>
			</ul>
		</div>
		<div class="clearer"></div>
	</div>
</div><?php }} ?>
