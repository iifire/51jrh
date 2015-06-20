<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-27 11:35:37
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\list\index.html" */ ?>
<?php /*%%SmartyHeaderCode:1155455609237a35488-33932972%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c986ec32fe2402eb51dd5db06e37edf5050e51b3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\list\\index.html',
      1 => 1432719334,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1155455609237a35488-33932972',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55609237a39305_05440780',
  'variables' => 
  array (
    'JS_PATH' => 0,
    'host' => 0,
    'product_hot' => 0,
    'company_act' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55609237a39305_05440780')) {function content_55609237a39305_05440780($_smarty_tpl) {?><?php echo '<script'; ?>
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
<div class="c_ctn col1">
    <div class="main w1100">
    	<div class="breadcrumbs">
    		<ul>
    			<li class="home">
                    <a title="MAYA首页" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
">MAYA首页</a>
                    <span class="gt">&gt;&gt;</span>
                    
                </li>
                <li>P2P理财</li>
            </ul>
        </div>
        <div class="col-main">
        	<div class="box">
        		<div class="sub-title">
		    		<h2>最新理财产品</h2>
		    		<div class="clearer"></div>
	    		</div>
	    		<div class="clearer"></div>
		    	<div class="products-box">
		    		<?php $_smarty_tpl->tpl_vars['product_hot'] = new Smarty_variable($_smarty_tpl->tpl_vars['product_hot']->value, null, 0);?>
		    		<?php echo $_smarty_tpl->getSubTemplate ("licai/list/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    	</div>
		    </div>
		    <div class="box mt15 pingtai-box">
		    	<div class="sub-title">
		    		<h2>P2P理财品牌专区</h2>
		    		<div class="clearer"></div>
	    		</div>
		    	<div class="clearer"></div>
		    	<div class="products-box">
		    		<?php echo $_smarty_tpl->getSubTemplate ("licai/list/hot_company.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    	</div>
		    </div>
        	<div class="box mt15">
        		<div class="sub-title">
		    		<h2>P2P平台热门活动</h2>
		    		<div class="clearer"></div>
	    		</div>
		    	<div class="clearer"></div>
		    	<div class="">
		    		<ul class="links slider-small">
		    		<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['company_act']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
		    			<li>
		    				<p><a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['act_url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['act_title'];?>
"><img alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['act_title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['host']->value;
echo $_smarty_tpl->tpl_vars['row']->value['act_img'];?>
" width="180" height="120" /></a></p>
		    				<p class="no-margin"><a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['act_url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['act_title'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['act_title'];?>
</a></p>
		    			</li>
		    		<?php } ?>
		    		</ul>
		    		<div class="clearer"></div>
		    	</div>
		    </div>
		    <div class="box mt15">
		    	<ul class="tabs tabs-big sub-title f-fix">
		    		<li><h2><a class="active" href="">P2P理财产品收益走势</a></h2></li>
		    		<li><h2><a class="" href="">P2P理财市场总体走势</a></h2></li>
		    		<li><h2><a class="" href="">P2P理财投资流程</a></h2></li>
	    		</ul>
	    		<div class="clearer"></div>
		    	<div class="padder">
		    		<div id="chart_1">
		    		
		    		</div>
		    		<?php echo '<script'; ?>
>
					$('#chart_1').commchart({
						cht:'lc', //The chart type
						chs:'700x300', //The chart size
						chd:'t:13.50,13.70,14.75,12.50,13.30,15.50,13.30,15.50,13.30,15.50', //The chart data. t代表是简单的文本格式(目前也只支持t)，|符号分隔不同系列的数据
						chco:'#fd8238,#000000,#0098e1', //The chart color. 16进制表示的颜色，留空或不足则系统自动分配
						chdl:'', //The chart data legend.
						chxl:'2014-05|2014-06|2014-07|2014-08|2014-09|2014-10|2014-11|2014-12|2015-01|2015-02|2015-03|2015-04',
						chtt:'年华收益率(%)', //The chart title
						chpc: false,
						chcn:'chart_1',
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
		    		<div id="chart_2">
		    		
		    		</div>
		    		<div id="chart_3">
		    		
		    		</div>
		    	</div>
		    </div>
        </div>
        <div class="col-right sidebar">
        	<div class="block">
        		<!--APP-->
        	
        	</div>
    		<div class="block">
        		<!--P2P理财计算器-->
        		<?php echo $_smarty_tpl->getSubTemplate ("sidebar/jisuanqi.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        	</div>
        	<div class="block">
        		<!--P2P百科-->
        		<?php echo $_smarty_tpl->getSubTemplate ("sidebar/wiki_article.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        	</div>
        	<div class="block">
        		<!--平台排行-->
        	
        	</div>
        </div>
    </div>
    <div class="w1100">
    	<div class="box">
	    	<h2>网贷平台</p>
	    	<div class="">
	    	
	    	</div>
	    </div>
    </div>
</div><?php }} ?>
