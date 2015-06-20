<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-30 16:19:18
         compiled from "C:\xampp\htdocs\myframework\tpl\jigou\index.html" */ ?>
<?php /*%%SmartyHeaderCode:259895569c6e66c0e85-96863822%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '567e3b7fc7e058bba4aa787e645a39da03324983' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\jigou\\index.html',
      1 => 1432994641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '259895569c6e66c0e85-96863822',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'host' => 0,
    'hot_default' => 0,
    'hot_highrate' => 0,
    'hot_shortperiod' => 0,
    'company_act' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5569c6e689d781_19250034',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5569c6e689d781_19250034')) {function content_5569c6e689d781_19250034($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("jigou/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("jigou/submenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="c_ctn col1">
    <div class="main w1100">
    	<div class="breadcrumbs">
    		<ul>
    			<li class="home">
                    <a title="MAYA首页" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
">MAYA首页</a>
                    <span class="gt">&gt;&gt;</span>
                    
                </li>
                <li class="home">
                    <a title="" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p/">机构库</a>
                    <span class="gt">&gt;&gt;</span>
                </li>
                <li>机构库首页</li>
            </ul>
        </div>
        <div class="w1100">
			<div class="col-main">
				<div class="f-left box w340">
					<ul class="tabs tabs-title f-fix">
			    		<li class="active"><h2><a href="#hot_default">综合排行</a></h2></li>
			    		<li><h2><a href="#hot_highrate" class="">收益高</a></h2></li>
			    		<li><h2><a href="#hot_shortperiod" class="">期限短</a></h2></li>
		    		</ul>
		    		<div class="clearer"></div>
		    		<div class="padder">
		    			<div id="hot_default" class="tab-content">
		    				<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_default']->value, null, 0);?>
		    				<?php echo $_smarty_tpl->getSubTemplate ("licai/net/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			</div>
		    			<div id="hot_highrate" class="tab-content" style="display:none;">
		    				<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_highrate']->value, null, 0);?>
		    				<?php echo $_smarty_tpl->getSubTemplate ("licai/net/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			</div>
		    			<div id="hot_shortperiod" class="tab-content" style="display:none;">
		    				<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_shortperiod']->value, null, 0);?>
		    				<?php echo $_smarty_tpl->getSubTemplate ("licai/net/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			</div>
		    		</div>
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
				<div class="f-fix box mt15">
					<div class="sub-title pr ">
			    		<h2>P2P平台热门活动</h2>
			    		<p class="more pa"><a href="" title="">更多&gt;&gt;</a></p>
			    		<div class="clearer"></div>
			    		
		    		</div>
		    		<div class="mt10">
			    		<ul class="links slider-small">
			    		<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['company_act']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
			    			<li>
			    				<p class="img"><a  href="<?php echo $_smarty_tpl->tpl_vars['row']->value['act_url'];?>
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
		    		</div>
					<div class="clearder"></div>
				</div>
				<div class="f-fix box mt15">
					<div class="sub-title pr ">
			    		<h2>P2P理财品牌专区</h2>
			    		<p class="more pa"><a href="" title="">更多&gt;&gt;</a></p>
			    		<div class="clearer"></div>
		    		</div>
		    		<?php echo $_smarty_tpl->getSubTemplate ("licai/list/hot_company.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

					<div class="clearder"></div>
				</div>
				<div class="f-fix box mt15">
					<div class="sub-title pr ">
			    		<h2>P2P平台评级</h2>
			    		<p class="more pa"><a href="" title="">我要上榜/我要踢馆</a></p>
			    		<div class="clearer"></div>
		    		</div>
		    		<?php echo $_smarty_tpl->getSubTemplate ("licai/p2p/index/rating_company.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

					<div class="clearder"></div>
				</div>
				<div class="f-fix box mt15">
					<div class="sub-title pr ">
			    		<h2>平台导航</h2>
			    		<div class="clearer"></div>
		    		</div>
		    		
					<div class="clearder"></div>
				</div>
			</div>
		    <div class="col-right sidebar">
		    
		    </div>
        	
        </div>
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
