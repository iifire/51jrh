<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-17 16:02:45
         compiled from "C:\xampp\htdocs\myframework\tpl\daikuan\list.html" */ ?>
<?php /*%%SmartyHeaderCode:2694355588d34ac5d00-68840037%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3302fabb64ca149d3ca01dfd3127b3bb441a1b2a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\daikuan\\list.html',
      1 => 1431871362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2694355588d34ac5d00-68840037',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55588d34ad1881_54032834',
  'variables' => 
  array (
    'host' => 0,
    'category' => 0,
    'product' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55588d34ad1881_54032834')) {function content_55588d34ad1881_54032834($_smarty_tpl) {?><div class="c_ctn col1">
    <div class="main w1100">
    	<div class="breadcrumbs">
    		<ul>
    			<li class="home">
                    <a title="MAYA首页" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
">MAYA首页</a>
                    <span class="gt">&gt;</span>
                    
                </li>
                <li>
                	<?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>

            	</li>
            </ul>
        </div>
        <div class="w1100">
        	<div class="title category-title">	
				<h1><?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
</h1>
		    	<div class="clearer"></div>
		    </div>
        	<div class="category-products">
        		<div class="toolbar">
			        <div class="order">
						<strong>排序：</strong>
				        <ul class="btns">
				            <li class="cur asc ">
				                <a class="" onclick="setLocation('http://gary.com/p2p/invest.html?dir=desc&amp;order=position')" href="javascript:void(0)"><span>默认排序</span></a><b></b>
				            </li>
				            <li class=" ">
				                <a class="" onclick="setLocation('http://gary.com/p2p/invest.html?dir=asc&amp;order=moneyrate')" href="javascript:void(0)"><span>收益率</span></a><b></b>
				            </li>
				            <li class=" ">
				                <a class="" onclick="setLocation('http://gary.com/p2p/invest.html?dir=asc&amp;order=moneyperiod')" href="javascript:void(0)"><span>投资期限计算单位</span></a><b></b>
				            </li>
				            <li class=" ">
				                <a class="" onclick="setLocation('http://gary.com/p2p/invest.html?dir=asc&amp;order=moneyperiod_amount')" href="javascript:void(0)"><span>投资期限日期大小</span></a><b></b>
				            </li>
				        </ul>
				        <div class="right pages"></div>
				    </div>
				    
			        <div class="filter"></div>
				    <div class="clearer"></div>
				</div>
        		<table id="products-list" class="products-list"  width="100%">
        			<colgroup>
        				<col width="8%"/>
                		<col width="17%"/>
                		<col width="18%"/>
                		<col width="18%"/>
                		<col width="13%"/>
                		<col width="13%"/>
                		<col width="13%"/>
            		</colgroup>
            		<thead>
            			<tr>
            				<th>&nbsp;</th>
            				<th>产品名称/特点</th>
            				<th>申请条件</th>
            				<th>费用说明</th>
            				<th>月供</th>
            				<th>总费用</th>
            				<th>&nbsp;</th>
            			</tr>
            		</thead>
            		<tbody>
        			<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        				<tr class="title">
        					<td>&nbsp;</td>
        					<td colspan="6"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
-<?php echo $_smarty_tpl->tpl_vars['row']->value['product_scheme'];?>
</td>
        				</tr>
            			<tr>
            				<td class="a-center">
            					<img src="" />
            				</td>
            				<td class="top">
            					<ul>
            						<li>当天放款</li>
            						<li>可提前还款</li>
            					</ul>
            				</td>
            				<td class="top">
            					<ul>
            						<li>有职业身份要求</li>
            						<li>打卡工资大于4000元</li>
            						<li>要求有本地社保</li>
            					</ul>
            				</td>
            				<td class="top">
            					<ul>
            						<li>年利率&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['product_rate'];?>
%</li>
            						<li>月管理费率&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['product_fee_month'];?>
%</li>
            						<li>一次性费率&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['product_fee_once'];?>
%</li>
            					</ul>
            				</td>
            				<td>
            					<p class="cred">月供<span class="number">8885</span>元 </p>
            				</td>
            				<td>
            					<p class="cred"><span class="number">0.66</span>万元 </p>
            				</td>
            				<td>
            					<p><button class="button"><span>立即查看</span></button></p>
            				</td>
            			</tr>
			        <?php } ?>
			        </tbody>
            	</table>
        	</div>
        </div>
    </div>
</div><?php }} ?>
