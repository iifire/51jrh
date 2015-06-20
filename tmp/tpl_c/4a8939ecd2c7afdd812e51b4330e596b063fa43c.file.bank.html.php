<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 03:20:39
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\submenu\bank.html" */ ?>
<?php /*%%SmartyHeaderCode:168955567bdcef1a686-41885272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a8939ecd2c7afdd812e51b4330e596b063fa43c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\submenu\\bank.html',
      1 => 1432862435,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '168955567bdcef1a686-41885272',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5567bdcf04d580_20533408',
  'variables' => 
  array (
    'ssmenu_flag' => 0,
    'host' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5567bdcf04d580_20533408')) {function content_5567bdcf04d580_20533408($_smarty_tpl) {?><div class="ms_ctn">
	<div class="w1100">
        <div class="subnav">
			<ul>
				<li class="<?php if (!$_smarty_tpl->tpl_vars['ssmenu_flag']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/bank/" title="">银行理财首页</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="pingtai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/bank-jigou/" title="">银行导航</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="shuju") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/bank-shuju/" title="">数据排行</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="xinwen") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/bank-xinwen/" title="">新闻动态</a></li>
			</ul>
		</div>
		<div class="clearer"></div>
	</div>
</div><?php }} ?>
