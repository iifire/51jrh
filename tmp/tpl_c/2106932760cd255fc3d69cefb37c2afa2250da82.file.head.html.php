<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-02 08:33:01
         compiled from "C:\xampp\htdocs\myframework\tpl\include\head.html" */ ?>
<?php /*%%SmartyHeaderCode:20528555727967a9b81-35156658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2106932760cd255fc3d69cefb37c2afa2250da82' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\include\\head.html',
      1 => 1433226673,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20528555727967a9b81-35156658',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_555727967bd400_92901577',
  'variables' => 
  array (
    'host' => 0,
    'menu_flag' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555727967bd400_92901577')) {function content_555727967bd400_92901577($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['host']->value;?>
</title>
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
" />
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
" />
<meta name="robots" content="INDEX,FOLLOW" />
<link rel="icon" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/css/font-awesome.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/css/styles.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/css/modal.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/css/jquery-ui.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/css/slider.css" media="all" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/js/jquery/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/js/jquery/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/js/jquery/jquery.modal.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/js/com.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/js/jquery/jquery.chosen.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/js/cookies.js"><?php echo '</script'; ?>
>
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
media/css/styles-ie.css" media="all" />
<![endif]-->
<?php echo '<script'; ?>
 type="text/javascript">
//<![CDATA[
Maya.Cookies.path     = '/myframework';
Maya.Cookies.domain   = '.gary.com';
//]]>
<?php echo '</script'; ?>
>
</head>
<body class=" catalog-category-view categorypath-invest-html category-invest">
<div class="h_tb">
	<div class="w1100">
		<ul class="channel f-left no-margin">
			<li class="<?php if (!$_smarty_tpl->tpl_vars['menu_flag']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
" title="MAYA首页"><i class="fa fa-home"></i>MAYA首页</a></li>
			<li class="<?php if ($_smarty_tpl->tpl_vars['menu_flag']->value=="licai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/" title="理财"><i class="fa fa-calculator"></i>理财</a></li>
			<li class="<?php if ($_smarty_tpl->tpl_vars['menu_flag']->value=="daikuan") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/" title="贷款"><i class="fa fa-jpy"></i>贷款</a></li>
			<li class="<?php if ($_smarty_tpl->tpl_vars['menu_flag']->value=="credit") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
credit/" title="信用卡"><i class="fa fa-cc-visa"></i>信用卡</a></li>
			<li class="<?php if ($_smarty_tpl->tpl_vars['menu_flag']->value=="jigou") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
jigou/" title="机构库">机构库</a></li>
			<li><a href="#" title="资讯中心">资讯中心</a></li>
			<li><a href="#" title="最佳问答">最佳问答</a></li>
			<li><a href="#" title="百科大全">百科大全</a></li>
			
			<li><a href="#" title="政策法规">政策法规</a></li>
			<li><a href="#" title="理财APP"><i class="fa fa-mobile"></i>App</a></li>
		</ul>
		<ul class="links">
			<!--<li><a title="关注MAYA" href="#">关注MAYA</a></li>-->
			<li class="last"><a title="网站导航" href="#">网站导航<i class="icon arrow-down"></i></a></li>
		</ul>
	</div>
</div>
<div class="clearer"></div><?php }} ?>
