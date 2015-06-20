<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-25 04:53:01
         compiled from "C:\xampp\htdocs\myframework\tpl\sidebar\jisuanqi.html" */ ?>
<?php /*%%SmartyHeaderCode:3234155617278297485-84466812%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9ce27026e2fb24f8d7b1177f1b4de47c6e9da17' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\sidebar\\jisuanqi.html',
      1 => 1432522377,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3234155617278297485-84466812',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55617278297485_58299919',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55617278297485_58299919')) {function content_55617278297485_58299919($_smarty_tpl) {?><div class="cal-block">
	<form name="calculator" id="calculator">
	<table width="100%" class="data-table cal-table nobd">
		<col width="35%" />
		<col width="65%" />
		<thead>
			<tr>
				<th colspan="2">P2P理财计算器</h2>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="a-right">年化收益：</td>
				<td class="no-padding"><input class="input-text w75" name="rate"/><label>%</label></td>
			</tr>
			<tr>
				<td class="a-right">投标奖励：</td>
				<td class="no-padding"><input class="input-text w75" name=""/><label>%</label></td>
			</tr>
			<tr>
				<td class="a-right">管理费：</td>
				<td class="no-padding"><input class="input-text w75" name="fee_manage"/><label>%</label></td>
			</tr>
			<tr>
				<td class="a-right">投资期限：</td>
				<td class="no-padding"><input class="input-text w75" name="month"/><label>月</label></td>
			</tr>
			<tr>
				<td class="a-right">投标金额：</td>
				<td class="no-padding"><input class="input-text w75" name="qty"/><label>元</label></td>
			</tr>
			<tr>
				<td class="a-right">还款方式：</td>
				<td class="no-padding">
					<select name="method" class="select">
						
					
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<button class="button"><span>开始计算</span></button>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td class="a-right">投资本金：</td>
				<td><span class="number"></span>&nbsp;&nbsp;<label>元</label></td>
			</tr>
			<tr>
				<td class="a-right">投资收益：</td>
				<td><span class="number"></span>&nbsp;&nbsp;<label>元</label></td>
			</tr>
			<tr>
				<td class="a-right">奖励：</td>
				<td><span class="number"></span>&nbsp;&nbsp;<label>元</label></td>
			</tr>
			<tr>
				<td class="a-right">最终收益：</td>
				<td><span class="number"></span>&nbsp;&nbsp;<label>元</label></td>
			</tr>
		</tfoot>
	</table>
	</form>
</div><?php }} ?>
