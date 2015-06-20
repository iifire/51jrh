<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-30 03:43:40
         compiled from "C:\xampp\htdocs\myframework\tpl\daikuan\submenu\jigou.html" */ ?>
<?php /*%%SmartyHeaderCode:16289556915cc2d4380-30120991%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f37970d09f733623f0dcc3dd3a67cba7287ce25' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\daikuan\\submenu\\jigou.html',
      1 => 1432950215,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16289556915cc2d4380-30120991',
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
  'unifunc' => 'content_556915cc311286_19201362',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556915cc311286_19201362')) {function content_556915cc311286_19201362($_smarty_tpl) {?><div class="ms_ctn">
	<div class="w1100">
        <div class="subnav">
			<ul>
				                   
				<li class="<?php if (!$_smarty_tpl->tpl_vars['ssmenu_flag']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/jigou/" title="">贷款机构首页</a></li>          
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="yihang") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/yihang/" title="">银行</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="xinyongshe") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/xinyongshe/" title="">信用社</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="xiaodaigongsi") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/xiaodaigongsi/" title="">小额贷款公司</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="danbaogongsi") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/danbaogongsi/" title="">担保公司</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="diandanghang") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/diandanghang/" title="">典当行</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="touzigongsi") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/touzigongsi/" title="">投资公司</a></li>
				<li class="last <?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="p2p") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/p2p/" title="">P2P</a></li>
			</ul>
		</div>
		<div class="clearer"></div>
	</div>
</div><?php }} ?>
