<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-24 06:34:48
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\view.html" */ ?>
<?php /*%%SmartyHeaderCode:23658555c7e27927c09-49216657%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '502235f860b389472c9904ac6c3157eddfa115b4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\view.html',
      1 => 1432442085,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23658555c7e27927c09-49216657',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_555c7e27964b05_26126798',
  'variables' => 
  array (
    'CSS_PATH' => 0,
    'JS_PATH' => 0,
    'host' => 0,
    'category' => 0,
    'product' => 0,
    'IMG_PATH' => 0,
    'company' => 0,
    'same_period_product' => 0,
    'same_company_product' => 0,
    'same_rate_product' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555c7e27964b05_26126798')) {function content_555c7e27964b05_26126798($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("include/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<link media="all" href="<?php echo $_smarty_tpl->tpl_vars['CSS_PATH']->value;?>
product.css" type="text/css" rel="stylesheet">

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
charts.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
charts/theme.grey.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
mycharts.js" type="text/javascript"><?php echo '</script'; ?>
>
<div class="c_ctn col2-right">
    <div class="main w1100">
    	<div class="breadcrumbs">
    		<ul>
    			<li class="home">
                    <a title="MAYA首页" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
">MAYA首页</a>
                    <span class="gt">&gt;</span>
                    
                </li>
                <li>
                	<a title="<?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/list/id/<?php echo $_smarty_tpl->tpl_vars['product']->value['product_category'];?>
">
                	<?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>

                	</a>
                	<span class="gt">&gt;</span>
            	</li>
            	<li>
            		<?php echo $_smarty_tpl->tpl_vars['product']->value['product_name'];?>

            	</li>
            </ul>
        </div>
        <div class="col-main">
        	<div class="product-view">
        		<div class="product-header">
        			<div class="f-left ml10">
        				<img src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
logo/<?php echo $_smarty_tpl->tpl_vars['company']->value['company_code'];?>
.png" height="70"/>
        			
        			</div>
			    	<div class="product-name">
			            <h1>商贸企业补充流动资金_借款标&nbsp;1006</h1>
			            <div class="clearer"></div>
			            <p class=""><a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
company/view/id/<?php echo $_smarty_tpl->tpl_vars['company']->value['company_id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
</a></p>
			        </div>
			        <div class="product-share">
			        	<a class="button p10 fs16" href="<?php echo $_smarty_tpl->tpl_vars['company']->value['company_url'];?>
" target="_blank">前往平台投资</a>
			        </div>
			    </div>
        		<div class="product-essential">
        			<div class="product-shop">
        				<div class="p20">
        					<table width="100%" class="info">
								<colgroup><col width="25%">
								<col width="25%">
								<col width="25%">
								<col width="25%">
								</colgroup><tbody>
									<tr>
										<td>年化收益</td>
										<td>投资期限 </td>
										<td>项目规模</td>
										<td rowspan="3">
											<div class="progress-ctn">
												<div id="chart_product" class="chart-ctn" data-highcharts-chart="0"><div class="highcharts-container" id="highcharts-0" style="position: relative; overflow: hidden; width: 108px; height: 108px; text-align: left; line-height: normal; z-index: 0; left: 0.5px; top: 0.350006px;"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="108" height="108"><desc>Created with Highcharts 4.0.4</desc><defs><clipPath id="highcharts-1"><rect x="0" y="0" width="108" height="108"/></clipPath></defs><rect x="0" y="0" width="108" height="108" strokeWidth="0" fill="transparent" class=" highcharts-background"/><rect x="0" y="0" width="108" height="108" fill="transparent"/><g class="highcharts-series-group" zIndex="3"><g class="highcharts-series highcharts-tracker" visibility="visible" zIndex="0.1" transform="translate(0,0) scale(1 1)" style="cursor:pointer;"><path fill="#f75252" d="M 53.989001647000464 0.0000011200349092632678 A 54 54 0 0 1 56.040515731959346 0.03856659105851179 L 55.53038679896951 13.528924943293887 A 40.5 40.5 0 0 0 53.99175123525035 13.500000840026182 Z" stroke-linejoin="round" transform="translate(0,0)"/><path fill="#dcdcdc" d="M 56.09447613611693 0.04063408716483963 A 54 54 0 1 1 53.924995083344136 0.00005209018736707094 L 53.9437463125081 13.500039067640529 A 40.5 40.5 0 1 0 55.57085710208769 13.530475565373635 Z" stroke-linejoin="round" transform="translate(0,0)"/></g><g class="highcharts-markers" visibility="visible" zIndex="0.1" transform="translate(0,0) scale(1 1)"/></g><g class="highcharts-legend" zIndex="7"><g zIndex="1"><g/></g></g><text x="98" text-anchor="end" zIndex="8" style="cursor:pointer;color:#909090;font-size:9px;fill:#909090;" y="103"/></svg></div></div>
												<div class="progress-title"><p class="ratio no-margin">1%</p><p class=" no-margin">投标进度</p></div>
											</div>
										</td>
											
									</tr>
									<tr class="number">
										<td>12.00<small>%</small></td>
										<td>90<small>天</small></td>
										<td>50<small>万</small></td>											
									</tr>
									<tr class="more">
										<td>发布日期：2015-03-09</td>
										<td colspan="2">还款方式：每月等额本金</td>
									</tr>
									<tr class="more">
										<td>还款日期：</td>
										<td colspan="3">起息日：满标日 T+1</td>
									</tr>
								</tbody>
							
							</table>
        				
        				</div>
        			</div>
        			
        		</div>
        		<div class="detail-main f-left mt15">
	        		<div class="product-tabs">
	        			<div class="detail-tabs" id="detail_tabs">
							<ul class="tabs clearfix">
								<li id="ptdesc"><a class="active" href="#ptcdesc">项目详情</a></li>
								<li id="ptcompany"><a href="#cpccompany">平台介绍</a></li>
								<li id="ptcompare"><a href="#cpccompare">收益比较</a></li>
								<li id="ptcross"><a href="#cpccross">同类产品</a></li>
								<li id="ptreview"><a href="#cpcreview">投资点评</a></li>
							</ul>
							<div class="clearer"></div>
						</div>
	        			<div class="padder">
	        				<div id="ptcdesc">
								<h2>项目描述</h2>
								<?php echo $_smarty_tpl->tpl_vars['product']->value['product_description'];?>

							</div>
							<div id="cpccompany">
								<h2>平台介绍</h2>
								<table width="100%" class="data-table">
		                            <tbody>
			                            <tr>
			                                <th width="134px;">平台名称</th>
			                                <td width="194px"><?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
</td>
			                                <th width="118px;">年化收益</th>
			                                <td width="210px;"><?php echo $_smarty_tpl->tpl_vars['company']->value['company_rate_average'];?>
&nbsp;%</td>
			                            </tr>
			                            <tr>
			                                <th>注册资本</th>
			                                <td><b1c class="b1c6bGec"><?php echo $_smarty_tpl->tpl_vars['company']->value['company_fund'];?>
&nbsp;万</td>
			                                <th>注册地点</th>
			                                <td><?php echo $_smarty_tpl->tpl_vars['company']->value['company_province'];?>
</td>
			                            </tr>
			                            <tr>
			                                <th>上线时间</th>
			                                <td><?php echo $_smarty_tpl->tpl_vars['company']->value['company_founded'];?>
</td>
			                                <th>法人代表</th>
			                                <td><?php echo $_smarty_tpl->tpl_vars['company']->value['company_represent'];?>
</td>
			                            </tr>
			                            <tr>
			                                <th>管理费</th>
			                                <td>-&nbsp;-元</td>
			                                <th>充值费</th>
			                                <td>-&nbsp;-&nbsp;元</td>
			                            </tr>
			                            <tr>
			                                <th>资金保障</th>
			                                <td><?php echo $_smarty_tpl->tpl_vars['company']->value['company_guarantee_scheme'];?>
</td>
			                                <th>资金托管</th>
			                                <td><?php echo $_smarty_tpl->tpl_vars['company']->value['company_deposit_name'];?>
</td>
			                            </tr>
										
			                        </tbody>
		                        
		                        </table>
							</div>
							<div id="ptccompare">
								<h2>收益比较</h2>
								<div id="compare_chart" style="width:700px;height:300px;"></div>
						    	<?php echo '<script'; ?>
>
								$('#compare_chart').commchart({
									cht:'bvg', //The chart type
									chs:'700x300', //The chart size
									chd:'t:13.50,10.63,14.75,4.20,5.97,2.25', //The chart data. t代表是简单的文本格式(目前也只支持t)，|符号分隔不同系列的数据
									chco:'#fd8238,#000000,#0098e1', //The chart color. 16进制表示的颜色，留空或不足则系统自动分配
									chdl:'', //The chart data legend.
									chxl:'当前标|陆金所|P2P行情|余额宝|银行理财|银行定存',
									chtt:'年华收益率(%)', //The chart title
									chpc: false,
									chcn:'compare_chart',
									legend: {
										align: 'right',
							            verticalAlign: 'top',
							            x: 0,
							            y: -10,
							            floating: true
									}
								})
								<?php echo '</script'; ?>
>
							</div>
							<div id="ptcross">
								<h2 class="mb0">同类产品</h2>
								<div class="crosssell pr">
									<div class="filters pa">
										<ul class="tabs clearfix">
											<li id="cs_period"><a class="active" href="#cs_period_c">同期限</a></li>
											<li id="cs_company"><a class="" href="#cs_company_c">同平台</a></li>
											<li id="cs_rate"><a class="" href="#cs_rate_c">同收益率</a></li>
										</ul>
										
									</div>
									<div class="padder p0 wp100">
	        							<div id="cs_period_c">
	        								<?php $_smarty_tpl->tpl_vars['same_product'] = new Smarty_variable($_smarty_tpl->tpl_vars['same_period_product']->value, null, 0);?>
	        								<?php echo $_smarty_tpl->getSubTemplate ("licai/view/same.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	        							</div>
	        							<div id="cs_company_c" style="display:none">
	        								<?php $_smarty_tpl->tpl_vars['same_product'] = new Smarty_variable($_smarty_tpl->tpl_vars['same_company_product']->value, null, 0);?>
	        								<?php echo $_smarty_tpl->getSubTemplate ("licai/view/same.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	        							</div>
	        							<div id="cs_rate_c" style="display:none">
	        								<?php $_smarty_tpl->tpl_vars['same_product'] = new Smarty_variable($_smarty_tpl->tpl_vars['same_rate_product']->value, null, 0);?>
	        								<?php echo $_smarty_tpl->getSubTemplate ("licai/view/same.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	        							</div>
        							</div>
								</div>
							</div>
							<div id="ptreview">
								<h2>投资点评</h2>
								
							</div>
	        			</div>
	        		</div>
	        	</div>
        	</div>	
	        	
        </div>
        <div class="col-right sidebar">
        	<div class="block">
        		<h2>P2P理财计算器</h2>
        	
        	</div>
        	<?php echo $_smarty_tpl->getSubTemplate ("licai/view/hot_company.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        	<?php echo $_smarty_tpl->getSubTemplate ("licai/view/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        	
        	<div class="block">
        		<div class="block-title">
        			<h2>P2P投资攻略</h2>
    			</div>
        	</div>
        </div>
    </div>
</div>
        
<?php echo $_smarty_tpl->getSubTemplate ("include/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
