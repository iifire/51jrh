<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-27 12:30:28
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\submenu\p2p.html" */ ?>
<?php /*%%SmartyHeaderCode:12890556590d853fc04-63955801%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd375904a35b449b3291b3746575d16fd62baafc3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\submenu\\p2p.html',
      1 => 1432722625,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12890556590d853fc04-63955801',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556590d855f001_30070024',
  'variables' => 
  array (
    'ssmenu_flag' => 0,
    'host' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556590d855f001_30070024')) {function content_556590d855f001_30070024($_smarty_tpl) {?><div class="ms_ctn">
	<div class="w1100">
        <div class="subnav">
			<ul>
				<li class="<?php if (!$_smarty_tpl->tpl_vars['ssmenu_flag']->value) {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p/" title="">P2P理财首页</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="pingtai") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p-pingtai/" title="">网贷平台</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="shuju") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p-shuju/" title="">网贷数据</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="xinwen") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p-xinwen/" title="">行业新闻</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="dianping") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p-dianping/" title="">大众点评</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="wenda") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p-wenda/" title="">网贷问答</a></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['ssmenu_flag']->value=="jiaoyu") {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p-jiaoyu/" title="">投资者教育</a></li>
			</ul>
		</div>
		<div class="clearer"></div>
	</div>
</div><?php }} ?>
