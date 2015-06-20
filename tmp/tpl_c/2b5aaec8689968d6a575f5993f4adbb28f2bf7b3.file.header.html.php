<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 09:40:45
         compiled from "C:\xampp\htdocs\myframework\tpl\credit\header.html" */ ?>
<?php /*%%SmartyHeaderCode:8528556816a5708001-87121050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b5aaec8689968d6a575f5993f4adbb28f2bf7b3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\credit\\header.html',
      1 => 1432885242,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8528556816a5708001-87121050',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556816a57fbc09_26075847',
  'variables' => 
  array (
    'host' => 0,
    'submenu_flag' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556816a57fbc09_26075847')) {function content_556816a57fbc09_26075847($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("include/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="h_ctn">
    <div class="w1100">
        <a class="logo" title="" href="http://gary.com/p2p/"><strong></strong><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/images/logo.png"></a>
	</div>
</div>
<div class="m_ctn">
	<div class="w1100">
        <div class="nav">
			<ul>
				<li class="<?php if (!$_smarty_tpl->tpl_vars['submenu_flag']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/" title="">信用卡首页</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value=="p2p") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p/" title="">信用卡申请</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value=="net") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/net/" title="">信用卡定制</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value=="net") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/net/" title="">卡库</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value=="bank") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/bank/" title="">优惠打折</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value=="bank") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/bank/" title="">信用卡积分</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value=="trust") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/trust/" title="">新闻资讯</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_flag']->value=="trust") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/trust/" title="">知识百科</a></li>
				
			</ul>    
		</div>
		<div class="clearer"></div>
    </div>
</div>
<?php }} ?>
