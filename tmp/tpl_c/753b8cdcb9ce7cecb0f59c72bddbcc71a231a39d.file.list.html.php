<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-27 11:39:36
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\list.html" */ ?>
<?php /*%%SmartyHeaderCode:2313155594b8d5f3709-29470184%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '753b8cdcb9ce7cecb0f59c72bddbcc71a231a39d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\list.html',
      1 => 1432719573,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2313155594b8d5f3709-29470184',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55594b8d622500_83934932',
  'variables' => 
  array (
    'host' => 0,
    'category' => 0,
    'product' => 0,
    'IMG_PATH' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55594b8d622500_83934932')) {function content_55594b8d622500_83934932($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("licai/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("licai/submenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="c_ctn col1">
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

		    <div class="filter-top mb10 f-fix">
		    	<div class="filter-item f-fix">
			    	<p>平台来源</p>
			    	<ul>
			    		<li><a href="#" class="active">不限</a></li>
			    	</ul>
		    	</div>
		    	<div class="filter-item f-fix">
			    	<p>投资期限</p>
			    	<ul>
			    		<li><a href="#" class="active">不限</a></li>
			    		<li><a href="#">1个月内</a></li>
			    		<li><a href="#">1-3个月</a></li>
			    		<li><a href="#">3-6个月</a></li>
			    		<li><a href="#">6-12个月</a></li>
			    		<li><a href="#">12个月以上</a></li>
			    	</ul>
		    	</div>
		    	<div class="filter-item f-fix">
			    	<p>年化收益</p>
			    	<ul>	
			    		<li><a href="#" class="active">不限</a></li>
			    		<li><a href="#">6%以下</a></li>
			    		<li><a href="#">6%-8%</a></li>
			    		<li><a href="#">8%-12%</a></li>
			    		<li><a href="#">12%-16%</a></li>
			    		<li><a href="#">16%以上</a></li>
			    	</ul>
		    	</div>
		    	<div class="filter-item f-fix last">
			    	<p>起投金额</p>
			    	<ul>
			    		<li><a href="#" class="active">不限</a></li>
			    		<li><a href="#">0-1元</a></li>
			    		<li><a href="#">1-50元</a></li>
			    		<li><a href="#">50-100元</a></li>
			    		<li><a href="#">100-1000元</a></li>
			    		<li><a href="#">1000-1万元</a></li>
			    		<li><a href="#">1万-5万元</a></li>
			    		<li><a href="#">5万以上</a></li>
			    	</ul>
		    	</div>
		    	<!--
		    	<div class="filter-item f-fix last">
			    	<p>收益方式</p>
			    	<ul>
			    		<li><a href="#" class="active">不限</a></li>
			    		<li><a href="#">每月等额本息</a></li>
			    		<li><a href="#">一次性还本付息</a></li>
			    		<li><a href="#">每月还息，到期还本</a></li>
			    	</ul>
		    	</div>
		    	-->
		    	<div class="clearer"></div>
		    </div>
		    <div class="clearer"></div>
        	<div class="category-products mt40">
        		<div class="toolbar">
			        <div class="order">
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
        		<table id="products-list" class="products-list licai-list"  width="100%">
        			<colgroup>
        				<col width="16%"/>
                		<col width="47%"/>
                		<col width="17%"/>
                		<col width="20%"/>
            		</colgroup>
            		<tbody>
        			<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
            			<tr>
            				<td class="a-center img">
            					<img src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
logo/lufax.png" height="90"/>
            				</td>
            				<td class="top">
            					<dl>
            						<dt>
            							<a href="#"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_name'];?>
&nbsp;|&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['product_sku_outer'];?>
</a>
            							<span>年华收益<span class="number cred"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_rate'];?>
</span>%</span>
            							<span>投资期限<span class="number cred"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_period'];?>
</span><?php if (!isset($_smarty_tpl->tpl_vars['row']) || !is_array($_smarty_tpl->tpl_vars['row']->value)) $_smarty_tpl->createLocalArrayVariable('row');
if ($_smarty_tpl->tpl_vars['row']->value['product_period_unit'] = 0) {?>天<?php } else { ?>月<?php }?></span>
            						</dt>
            						<dd>
            							<span>借款金额：<?php echo $_smarty_tpl->tpl_vars['row']->value['product_amount'];?>
万元</span>
            							<span>起投金额：<?php echo $_smarty_tpl->tpl_vars['row']->value['product_amount_start'];?>
元</span>
            							<span><?php echo $_smarty_tpl->tpl_vars['row']->value['product_pay_method'];?>
</span>
            						</dd>
            					</dl>
            				</td>
            				<td class="">
            					<div class="progress"><span class="complete" style="width:50%"></span></div>
            					<div class="clearer"></div>
            					<p class="no-margin mt5">剩余金额:</p>
            				</td>
            				<td class="">
            					<div class="btns">
            						<a class="button view mr10" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/view/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
"><span>查看</span></a>
            						<button class="button go"><span>投标</span></button>
            					</div>
            				</td>
            				
            			</tr>
			        <?php } ?>
			        </tbody>
            	</table>
        	</div>
        </div>
    </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("include/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
