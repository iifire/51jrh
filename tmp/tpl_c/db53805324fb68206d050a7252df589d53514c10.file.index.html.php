<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-17 17:19:54
         compiled from "C:\xampp\htdocs\myframework\tpl\ajaxpostdata\index.html" */ ?>
<?php /*%%SmartyHeaderCode:142065558af9638a404-35239072%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db53805324fb68206d050a7252df589d53514c10' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\ajaxpostdata\\index.html',
      1 => 1431875986,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142065558af9638a404-35239072',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5558af963ff708_18091750',
  'variables' => 
  array (
    'html' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5558af963ff708_18091750')) {function content_5558af963ff708_18091750($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['html']->value;?>


<?php echo '<script'; ?>
>
$('.product-list .product-tr').each(function(){
	var current = $(this);
		$.post("http://localhost/myframework/ajaxpostdata/post/skey/648adh923a2adanpsfk", 
	{ 
		tablename:'my_product_loan',
		product_code: "XXX", 
		product_scheme: "",
		product_name: current.find('h2 a').html(),
		product_company: "",
		product_category: "",
		product_apply_condition: "",
		product_apply_material: "",
		product_grant_day: "",
		product_repay_method: "",
		product_repay_advanced: "",
		product_period_unit: "",
		product_period_min: "",
		product_amount_max: "",
		product_rate: "",
		product_fee_month: "",
		product_fee_once: "",
		product_description: "",
		product_position: "",
		product_created: ""
	},
	function(data){
	 process(data);
	}, "json");
})
<?php echo '</script'; ?>
><?php }} ?>
