<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-30 03:45:30
         compiled from "C:\xampp\htdocs\myframework\tpl\daikuan\jigou\index.html" */ ?>
<?php /*%%SmartyHeaderCode:21958556915cc311283-14327337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5d22a8c67715cdd4f042fd5b493ca1d132e609a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\daikuan\\jigou\\index.html',
      1 => 1432950327,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21958556915cc311283-14327337',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556915cc3c7f88_38030561',
  'variables' => 
  array (
    'JS_PATH' => 0,
    'host' => 0,
    'page' => 0,
    'company_list' => 0,
    'row' => 0,
    'IMG_PATH' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556915cc3c7f88_38030561')) {function content_556915cc3c7f88_38030561($_smarty_tpl) {?><?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery/jquery.pagination.js" type="text/javascript"><?php echo '</script'; ?>
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
                <li class="home">
                    <a title="" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
daikuan/">贷款</a>
                    <span class="gt">&gt;&gt;</span>
                </li>
                <li>贷款机构首页</li>
            </ul>
        </div>
        <div class="w1100">
		    <!--过滤开始 -->
		    <div class="mb10 f-fix">
		    	<table width="100%" class="filter-table">
		    		<col width="10%" />
		    		<col width="90%" />
		    		<tbody>
		    			<tr>
		    				<th>职业身份：</th>
		    				<td>
					    		<ul>
						    		<li><a href="#" class="active">不限</a></li>
						    		
						    		<li><a href="#">0-1元</a></li>
						    		
						    	</ul>
		    				</td>
		    			</tr>
		    			<tr>
		    				<th>房产要求：</th>
		    				<td>
		    					<ul>
						    		<li><a href="#" class="active">不限</a></li>
						    		
						    		<li><a href="#">0-1元</a></li>
						    		
						    	</ul>
		    				</td>
		    			</tr>
		    			<tr>
		    				<th>车产要求：</th>
		    				<td>
		    					<ul>
						    		<li><a href="#" class="active">不限</a></li>
						    		
						    		<li><a href="#">0-1元</a></li>
						    		
						    	</ul>
		    				</td>
		    			</tr>
		    			<tr>
		    				<th>信用记录：</th>
		    				<td>
		    					<ul>
						    		<li><a href="#" class="active">不限</a></li>
						    		
						    		<li><a href="#">0-1元</a></li>
						    		
						    	</ul>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
		    	<div class="clearer"></div>
		    	<div class="f-fix mt10"></div>
		    	<div class="w1100 ">
		    		<div class="f-left big-main">
				    	<div class="filter-result">
				    		<p><strong>全部结果</strong><span>为您筛选出<?php echo $_smarty_tpl->tpl_vars['page']->value['totalnum'];?>
个平台</span></p>
				    		<div class="clearer"></div>
				    	</div>
				    	<table id="products-list" class="products-list company-list"  width="100%">
		        			<colgroup>
		        				<col width="16%"/>
		                		<col width="64%"/>
		                		<col width="20%"/>
		            		</colgroup>
		            		<tbody>
		        			<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['company_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
		            			<tr>
		            				<td class="a-center img">
		            					<a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p-pingtai/view/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['company_id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
logo/<?php echo $_smarty_tpl->tpl_vars['row']->value['company_code'];?>
.png" height="68"/></a>
		            				</td>
		            				<td class="top">
		            					<dl>
		            						<dt>
		            							<a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
licai/p2p-pingtai/view/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['company_id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
</a>
		            							<?php if ($_smarty_tpl->tpl_vars['row']->value['company_transfer']) {?><strong>债权可转让</strong><?php }?>
		            							<?php if ($_smarty_tpl->tpl_vars['row']->value['company_transfer']) {?><strong>债权可转让</strong><?php }?>
		            						</dt>
		            						<dd>
		            							<span class="title">投标保障 ：</span>
		            							<span class="value"><?php echo $_smarty_tpl->tpl_vars['row']->value['company_guarantee'];?>
 </span>
		            						</dd>
		            						<dd>
		            							<span class="title">上线时间 ：</span>
		            							<span class="time"><?php if ($_smarty_tpl->tpl_vars['row']->value['company_founded']) {
echo $_smarty_tpl->tpl_vars['row']->value['company_founded'];
} else { ?>--<?php }?></span>
												<span class="value locale"><?php echo $_smarty_tpl->tpl_vars['row']->value['company_province'];?>
</span>
												<span class="title">网友评价：</span>
												<span class="value review">服务&nbsp;<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['row']->value['company_review_service']);?>
&nbsp;&nbsp;体验&nbsp;<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['row']->value['company_review_experience']);?>
&nbsp;&nbsp;取现&nbsp;<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['row']->value['company_review_withdraw']);?>
</span>
		            						</dd>
		            					</dl>
		            				</td>
		            				<td class="number">年化收益 : &nbsp;<strong><?php echo sprintf("%d",$_smarty_tpl->tpl_vars['row']->value['company_rate_min']);?>
<small>%</small>-<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['row']->value['company_rate_max']);?>
<small>%</small></strong></td>
		            				
		            			</tr>
					        <?php } ?>
					        </tbody>
		            	</table>
		            	<div id="pagerNav" class="pager mt15">
            			</div>
            			<?php echo '<script'; ?>
>
						$(function () {
			                function pageselectCallback(page_id, jq) {
			                    //
			                }
			                $("#pagerNav").pagination(<?php echo $_smarty_tpl->tpl_vars['page']->value['total'];?>
, {
			                    callback: pageselectCallback,//PageCallback() 为翻页调用次函数。
			                    prev_text: " 上一页",
			                    next_text: "下一页 ",
			                    items_per_page: 1,
			                    num_display_entries: 5,
			                    current_page: <?php echo $_smarty_tpl->tpl_vars['page']->value['cur']-1;?>
,
			                    num_edge_entries: 1,
			                    link_to:"?page=__id__"
			                });
			               
			            });
			          
			    <?php echo '</script'; ?>
>
	            	</div>
	            	<div class="f-right mini-sidebar">
	            		<?php echo $_smarty_tpl->getSubTemplate ("licai/p2p/pingtai/list/hot_company.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	            	</div>
            	
		    </div>
        </div>
    </div>
</div><?php }} ?>
