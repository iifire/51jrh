<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-30 02:38:57
         compiled from "C:\xampp\htdocs\myframework\tpl\daikuan\header.html" */ ?>
<?php /*%%SmartyHeaderCode:66075558463d660083-53138331%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ecf54f4e8c6d80965ea372d9ced76217f2e6f18' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\daikuan\\header.html',
      1 => 1432946324,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66075558463d660083-53138331',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5558463d72f100_63834934',
  'variables' => 
  array (
    'host' => 0,
    'submenu_code' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5558463d72f100_63834934')) {function content_5558463d72f100_63834934($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("include/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
				<li class="<?php if (!$_smarty_tpl->tpl_vars['submenu_code']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/" title="">贷款首页</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="yongtu") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/yongtu/" title="">贷款用途</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="leibie") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/leibie/" title="">贷款类别</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="jigou") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/jigou/" title="">贷款机构</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="gongju") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/gongju/" title="">贷款工具</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="experience") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/experience/" title="">贷款攻略</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="xinwen") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/chedai/" title="">新闻资讯</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="jiameng") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/jiameng/" title="">合作加盟</a></li>
			</ul>    
		</div>
		<div class="clearer"></div>
    </div>
</div>
<?php }} ?>
