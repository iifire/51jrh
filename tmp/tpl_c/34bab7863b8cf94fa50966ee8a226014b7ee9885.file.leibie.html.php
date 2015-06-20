<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-30 03:34:05
         compiled from "C:\xampp\htdocs\myframework\tpl\daikuan\submenu\leibie.html" */ ?>
<?php /*%%SmartyHeaderCode:97305569138d9f6c86-54653825%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '34bab7863b8cf94fa50966ee8a226014b7ee9885' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\daikuan\\submenu\\leibie.html',
      1 => 1432949626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97305569138d9f6c86-54653825',
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
  'unifunc' => 'content_5569138da70a88_67820573',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5569138da70a88_67820573')) {function content_5569138da70a88_67820573($_smarty_tpl) {?><div class="ms_ctn">
	<div class="w1100">
        <div class="subnav">
			<ul>
				          
				<li class="<?php if (!$_smarty_tpl->tpl_vars['ssmenu_flag']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/leibie/" title="">贷款类别首页</a></li>          
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="gerendai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/gerendai/" title="">个人贷款</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="qiyedai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/qiyedai/" title="">企业贷款</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="diyadai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/diyadai/" title="">抵押贷款</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="xinyongdai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/xinyongdai/" title="">信用贷款</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="danbaodai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/danbaodai/" title="">担保贷款</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="piaojudai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/piaojudai/" title="">票据融资</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="xiaoedai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/xiaoedai/" title="">小额贷款</a></li>
			</ul>
		</div>
		<div class="clearer"></div>
	</div>
</div><?php }} ?>
