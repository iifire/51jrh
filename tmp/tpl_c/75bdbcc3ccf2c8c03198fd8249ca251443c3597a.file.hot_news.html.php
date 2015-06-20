<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-28 12:03:25
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\p2p\index\hot_news.html" */ ?>
<?php /*%%SmartyHeaderCode:55515566d5ff5bcc04-67560372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75bdbcc3ccf2c8c03198fd8249ca251443c3597a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\p2p\\index\\hot_news.html',
      1 => 1432807401,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55515566d5ff5bcc04-67560372',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5566d5ff5bcc02_23563160',
  'variables' => 
  array (
    'hot_news' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5566d5ff5bcc02_23563160')) {function content_5566d5ff5bcc02_23563160($_smarty_tpl) {?><ul class="hot-news">
	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hot_news']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
	<li>
	    <div class="l">
	    	<a title="<?php echo $_smarty_tpl->tpl_vars['row']->value['news_title'];?>
" href="#">
	        <img src="" height="62px" width="88px">
         	</a>
     	</div>
	    <div class="r">
	        <p class="p1">
	            <a target="_blank" href="" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['news_title'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['news_title'];?>
</a><span>new</span>
            </p>
	        <div class="clearfix">
	            <div class="tag">P2P</div>
	            <span class="date">05-28</span>
	        </div>
	    </div>  
	</li>
	<?php } ?>
</ul><?php }} ?>
