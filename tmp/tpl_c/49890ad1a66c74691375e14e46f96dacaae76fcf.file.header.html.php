<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-02 09:38:31
         compiled from "C:\xampp\htdocs\myframework\tpl\jigou\header.html" */ ?>
<?php /*%%SmartyHeaderCode:286345569c6e68a9302-15021362%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49890ad1a66c74691375e14e46f96dacaae76fcf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\jigou\\header.html',
      1 => 1433230707,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '286345569c6e68a9302-15021362',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5569c6e68ef805_51218791',
  'variables' => 
  array (
    'host' => 0,
    'submenu_code' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5569c6e68ef805_51218791')) {function content_5569c6e68ef805_51218791($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("include/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
jigou/" title="">机构库首页</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="experience") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
jigou/experience/" title="">银行金融机构</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="xintuo") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
jigou/xintuo/" title="">信托类</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="yongtu") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
jigou/yongtu/" title="">证券类</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="leibie") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
jigou/leibie/" title="">基金类</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="gongju") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
jigou/gongju/" title="">保险类</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['submenu_code']->value=="jiameng") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
jigou/jiameng/" title="">合作加盟</a></li>
			</ul>    
		</div>
		<div class="clearer"></div>
    </div>
</div>
<?php }} ?>
