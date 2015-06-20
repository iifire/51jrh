<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-30 03:28:51
         compiled from "C:\xampp\htdocs\myframework\tpl\daikuan\submenu\yongtu.html" */ ?>
<?php /*%%SmartyHeaderCode:282795569121a443689-90969200%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '955bf88af2a8f5501e0b9ee8287892a00c9a640f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\daikuan\\submenu\\yongtu.html',
      1 => 1432949328,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '282795569121a443689-90969200',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5569121a4bd487_62390895',
  'variables' => 
  array (
    'ssmenu_flag' => 0,
    'host' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5569121a4bd487_62390895')) {function content_5569121a4bd487_62390895($_smarty_tpl) {?><div class="ms_ctn">
	<div class="w1100">
        <div class="subnav">
			<ul>
				<li class="<?php if (!$_smarty_tpl->tpl_vars['ssmenu_flag']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/yongtu/" title="">贷款用途首页</a></li>          
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="chuangyedai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/chuangyedai/" title="">创业贷款</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="xiaofeidai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/xiaofeidai/" title="">消费贷款</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="zuxuedai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/zuxuedai/" title="">助学贷款</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="liuxuedai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/liuxuedai/" title="">留学贷款</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="ershoufangdai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/ershoufangdai/" title="">二手房贷</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="zhufangdiyadai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/zhufangdiyadai/" title="">住房抵押</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="ershouchedai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/ershouchedai/" title=""> 二手车贷</a></li>
			</ul>
		</div>
		<div class="clearer"></div>
	</div>
</div><?php }} ?>
