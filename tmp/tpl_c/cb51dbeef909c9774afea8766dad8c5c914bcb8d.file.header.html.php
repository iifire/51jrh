<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 15:45:27
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\header.html" */ ?>
<?php /*%%SmartyHeaderCode:2186655594b8d576705-18961656%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb51dbeef909c9774afea8766dad8c5c914bcb8d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\header.html',
      1 => 1432907059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2186655594b8d576705-18961656',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55594b8d5dfe84_23695214',
  'variables' => 
  array (
    'host' => 0,
    'submenu_code' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55594b8d5dfe84_23695214')) {function content_55594b8d5dfe84_23695214($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("include/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="h_ctn">
    <div class="w1100">
        <a class="logo" title="" href="http://gary.com/p2p/"><strong></strong><img alt="万米E贷" src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/images/logo.png"></a>
	</div>
</div>
<div class="m_ctn">
	<div class="w1100">
        <div class="nav">
			<ul>
				<li class="<?php if (!$_smarty_tpl->tpl_vars['submenu_code']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/" title="">理财首页</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="p2p") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p/" title="">P2P理财</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="net") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/net/" title="">宝宝理财</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="bank") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/bank/" title="">银行理财</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="savings") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/savings/" title="">储蓄国债</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="trust") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/trust/" title="">信托</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="ziguan") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/ziguan/" title="">资管</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="fund") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/fund/" title="">基金</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="insurance") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/insurance/" title="">保险</a></li>
			</ul>    
		</div>
		<div class="clearer"></div>
    </div>
</div>
<?php }} ?>
