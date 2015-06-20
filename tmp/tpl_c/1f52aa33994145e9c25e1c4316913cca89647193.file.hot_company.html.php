<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-28 01:37:31
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\p2p\pingtai\list\hot_company.html" */ ?>
<?php /*%%SmartyHeaderCode:487055659824dcb402-70976541%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f52aa33994145e9c25e1c4316913cca89647193' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\p2p\\pingtai\\list\\hot_company.html',
      1 => 1432769802,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '487055659824dcb402-70976541',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55659824ddec87_28856362',
  'variables' => 
  array (
    'company_hot' => 0,
    'row' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55659824ddec87_28856362')) {function content_55659824ddec87_28856362($_smarty_tpl) {?><div class="block">
	<div class="block-title">
		<h2><i class="fa fa-hand-o-right"></i>热门平台推荐</h2>
	</div>
	<div class="block-content p5">
		<ul class="links hot-links">
			<li class="title"><label>平台名称</label><span>年收益(%)</span></li>
		</ul>
		<div class="clearer"></div>
		<ul class="links hot-links">
			<?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable("0", null, 0);?>
			<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['company_hot']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
			<li>
				
				<a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
" target="_blank">
					<i class="number <?php if ($_smarty_tpl->tpl_vars['i']->value<3) {?>top<?php }?>"><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);
echo $_smarty_tpl->tpl_vars['i']->value;?>
</i>
					<span class="name"><?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
</span>
					
					<span class="rate"><?php echo $_smarty_tpl->tpl_vars['row']->value['company_rate_average'];?>
%</span>
				</a>
			</li>
			<?php } ?>
		
		</ul>
	
	</div>
</div><?php }} ?>
