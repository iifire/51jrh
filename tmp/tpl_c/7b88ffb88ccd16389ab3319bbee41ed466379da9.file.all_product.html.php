<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 05:05:06
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\fund\index\all_product.html" */ ?>
<?php /*%%SmartyHeaderCode:118995567d762b44600-07919765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b88ffb88ccd16389ab3319bbee41ed466379da9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\fund\\index\\all_product.html',
      1 => 1432859203,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118995567d762b44600-07919765',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5567d762b6b703_35522543',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5567d762b6b703_35522543')) {function content_5567d762b6b703_35522543($_smarty_tpl) {?><div class="rating-tab">
            <div class="tab-tabcontent mt10">
                <div class="tab-div" style="display:block;">
                    <table cellspacing="0" cellpadding="0" class="data-table">
                        <thead>
                            <tr>
                                <td>产品名称</td>
                                <td>发行机构</td>
                                <td>目前资金规模</td>
                                <td>昨日万份收益</td>
                                <td>7日年化利率</td>
                                <td>起购金额</td>
                                <td>单日提取上限</td>
                                <td>提现速度	</td>
                                <td width="60px">&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                             <tr>
                                <td class="a-center"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
</td>
                                <td class="a-center"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_company'];?>
</td>
                                <td class="a-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_scale'];?>
亿元</td>
                                <td class="a-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_profit_yesterday'];?>
元</td>
                                <td class="a-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_rate_week'];?>
%</td>
                                <td class="a-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_money_start'];?>
元</td>
                                <td class="a-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_withdraw_limit'];?>
万</td>
                                <td class="a-center"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_withdraw_speed'];?>
</td>
                                <td class="a-center"><a href="" target="_blank" title="查看<?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
详情">查看</a></td>
                            </tr>      
                            <?php } ?>                                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div><?php }} ?>
