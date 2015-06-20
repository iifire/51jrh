<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-29 04:28:05
         compiled from "C:\xampp\htdocs\myframework\tpl\licai\trust.html" */ ?>
<?php /*%%SmartyHeaderCode:230305567ceb510f185-97385176%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'efc624789a848a3f632c6ea8fcd760ab79bfbc63' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\licai\\trust.html',
      1 => 1432866424,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '230305567ceb510f185-97385176',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'host' => 0,
    'hot_product' => 0,
    'company_act' => 0,
    'row' => 0,
    'all_product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5567ceb5380189_55682789',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5567ceb5380189_55682789')) {function content_5567ceb5380189_55682789($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("licai/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
                <li class="home">
                    <a title="" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p/">宝宝理财</a>
                    <span class="gt">&gt;&gt;</span>
                </li>
                <li>宝宝理财首页</li>
            </ul>
        </div>
        <div class="w1100">
			<div class="col-main">
				<div class="f-left box w340">
					<div class="sub-title pr">
			    		<h2>宝宝理财收益排行榜</h2>
			    		<p class="more pa"><a href="" title="">更多&gt;&gt;</a></p>
			    		<div class="clearer"></div>
		    		</div>
		    		<div class="">
		    			<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['hot_product']->value, null, 0);?>
		    			<?php echo $_smarty_tpl->getSubTemplate ("licai/trust/index/hot_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		    			
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
				<div class="f-fix box mt15">
					<div class="sub-title pr ">
			    		<h2>年化利率走势</h2>
			    		<p class="more pa"><a href="" title=""></a></p>
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
				
				
				
			</div>
		    <div class="col-right sidebar">
		    
		    </div>
        	
        </div>
        <div class="f-fix box mt15">
			<div class="sub-title pr ">
	    		<h2>产品大全</h2>
	    		<p class="more pa"><a href="" title=""></a></p>
	    		<div class="clearer"></div>
    		</div>
    		<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->tpl_vars['all_product']->value, null, 0);?>
    		<?php echo $_smarty_tpl->getSubTemplate ("licai/trust/index/all_product.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<div class="clearder"></div>
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
