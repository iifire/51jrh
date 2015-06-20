<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 03:39:06
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\bank.html" */ ?>
<?php /*%%SmartyHeaderCode:176945567bdcee08f80-82134133%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15c6acd03eac3c5f1750d652fa160747fa637a4c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\bank.html',
      1 => 1432863542,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '176945567bdcee08f80-82134133',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5567bdceef3583_00442976',
  'variables' => 
  array (
    'host' => 0,
    'hot_product' => 0,
    'hot_default' => 0,
    'hot_highrate' => 0,
    'hot_shortperiod' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5567bdceef3583_00442976')) {function content_5567bdceef3583_00442976($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("licai/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("licai/submenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="c_ctn col1">
    <div class="main w1100">
    	<div class="breadcrumbs">
    		<ul>
    			<li class="home">
                    <a title="MAYA首页" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
">MAYA首页</a>
                    <span class="gt">&gt;&gt;</span>
                    
                </li>
                <li>
                    <a title="" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/">理财频道</a>
                    <span class="gt">&gt;&gt;</span>
                </li>
                <li>
                    <a title="" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/bank/">银行理财</a>
                    <span class="gt">&gt;&gt;</span>
                </li>
                <li>银行理财首页</li>
            </ul>
        </div>
        <div class="w1100">
			<div class="col-main">
				<div class="f-left box w340">
					<div class="sub-title pr">
			    		<h2>银行理财产品人气排行榜</h2>
			    		<p class="more pa"><a href="" title="">更多&gt;&gt;</a></p>
			    		<div class="clearer"></div>
		    		</div>
		    		<div class="">
		    			<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_product']->value, null, 0);?>
		    			<?php echo $_smarty_tpl->getSubTemplate ("licai/bank/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			
		    		</div>
					<div class="clearer"></div>
				</div>
				<div class="f-right w370 box">
					<div class="sub-title pr">
			    		<h2>热点关注</h2>
			    		<p class="more pa"><a href="" title="">更多&gt;&gt;</a></p>
			    		<div class="clearer"></div>
		    		</div>
		    		<div class="">
		    			<?php echo $_smarty_tpl->getSubTemplate ("licai/p2p/index/hot_news.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			
		    		</div>
					<div class="clearer"></div>
				</div>
				<div class="clearder"></div>
				<div class="f-left box w340 mt15">
					<ul class="tabs tabs-title f-fix">
			    		<li class="active"><h2><a href="#hot_default">按起购金额</a></h2></li>
			    		<li><h2><a href="#hot_highrate" class="">按投资期限</a></h2></li>
			    		<li><h2><a href="#hot_shortperiod" class="">按收益类型</a></h2></li>
		    		</ul>
		    		<div class="clearer"></div>
		    		<div class="padder">
		    			<div id="hot_default" class="tab-content">
		    				<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_default']->value, null, 0);?>
		    				<?php echo $_smarty_tpl->getSubTemplate ("licai/bank/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			</div>
		    			<div id="hot_highrate" class="tab-content" style="display:none;">
		    				<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_highrate']->value, null, 0);?>
		    				<?php echo $_smarty_tpl->getSubTemplate ("licai/bank/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			</div>
		    			<div id="hot_shortperiod" class="tab-content" style="display:none;">
		    				<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_shortperiod']->value, null, 0);?>
		    				<?php echo $_smarty_tpl->getSubTemplate ("licai/bank/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			</div>
		    		</div>
				</div>
				<div class="clearer"></div>
				<div class="box mt15">
					<div class="sub-title pr">
			    		<h2>热门产品推荐</h2>
			    		<p class="more pa"><a href="" title="">更多&gt;&gt;</a></p>
			    		<div class="clearer"></div>
		    		</div>
		    		<div class="">
		    			<?php echo $_smarty_tpl->getSubTemplate ("licai/bank/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			
		    		</div>
					<div class="clearer"></div>
				</div>
				<div class="clearder"></div>
				<div class="f-left box w340">
					<div class="sub-title pr">
			    		<h2>市场动态</h2>
			    		<p class="more pa"><a href="" title="">更多&gt;&gt;</a></p>
			    		<div class="clearer"></div>
		    		</div>
		    		<div class="">
		    			<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_product']->value, null, 0);?>
		    			<?php echo $_smarty_tpl->getSubTemplate ("licai/bank/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			
		    		</div>
					<div class="clearer"></div>
				</div>
				<div class="f-right w370 box">
					<div class="sub-title pr">
			    		<h2>政策解读</h2>
			    		<p class="more pa"><a href="" title="">更多&gt;&gt;</a></p>
			    		<div class="clearer"></div>
		    		</div>
		    		<div class="">
		    			<?php echo $_smarty_tpl->getSubTemplate ("licai/p2p/index/hot_news.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			
		    		</div>
					<div class="clearer"></div>
				</div>
				<div class="clearder"></div>
				<div class="f-fix box mt15">
					<ul class="tabs tabs-title f-fix">
			    		<li class="active"><h2><a href="#hot_default">年化收益走势</a></h2></li>
			    		<li><h2><a href="#hot_highrate" class="">新产品数量走势</a></h2></li>
			    		<li><h2><a href="#hot_shortperiod" class="">起购金额分布</a></h2></li>
			    		<li><h2><a href="#hot_shortperiod" class="">投资期限分布</a></h2></li>
		    		</ul>
		    		<div class="clearer"></div>
		    		<div class="padder">
		    			<div id="hot_default" class="tab-content">
		    				<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_default']->value, null, 0);?>
		    				<?php echo $_smarty_tpl->getSubTemplate ("licai/bank/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			</div>
		    			<div id="hot_highrate" class="tab-content" style="display:none;">
		    				<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_highrate']->value, null, 0);?>
		    				<?php echo $_smarty_tpl->getSubTemplate ("licai/bank/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			</div>
		    			<div id="hot_shortperiod" class="tab-content" style="display:none;">
		    				<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_shortperiod']->value, null, 0);?>
		    				<?php echo $_smarty_tpl->getSubTemplate ("licai/bank/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			</div>
		    		</div>
					<div class="clearder"></div>
				</div>
				
				
				
			</div>
		    <div class="col-right sidebar">
		    
		    </div>
        	
        </div>
        <!--口碑-->
        <div class="f-fix box mt15">
			<div class="sub-title pr ">
	    		<h2>友情链接</h2>
	    		<div class="clearer"></div>
    		</div>
    		
			<div class="clearder"></div>
		</div>
    </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("include/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
