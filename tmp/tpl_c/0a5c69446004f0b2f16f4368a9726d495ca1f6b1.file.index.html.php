<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-26 07:51:05
         compiled from "C:\xampp\htdocs\myframework\tpl\pingtai\list\index.html" */ ?>
<?php /*%%SmartyHeaderCode:1968556403ab4d6489-61324910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a5c69446004f0b2f16f4368a9726d495ca1f6b1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myframework\\tpl\\pingtai\\list\\index.html',
      1 => 1432619462,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1968556403ab4d6489-61324910',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_556403ab54b781_16047189',
  'variables' => 
  array (
    'JS_PATH' => 0,
    'host' => 0,
    'company_list' => 0,
    'IMG_PATH' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556403ab54b781_16047189')) {function content_556403ab54b781_16047189($_smarty_tpl) {?><?php echo '<script'; ?>
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
                    <span class="gt">&gt;</span>
                    
                </li>
                <li>平台</li>
            </ul>
        </div>
        <div class="col-main w1100">
		    <!--过滤开始 -->
		    <div class="filter-top mb10 f-fix">
		    	<div class="filter-item f-fix">
			    	<p>平台名称：</p>
			    	<ul>
			    		
			    		<li class="input">
			    			<input type="input-text" name="name" /><button type="submit" class="button"><span>查询</span></button>
			    		</li>
			    		<?php echo $_smarty_tpl->getSubTemplate ("pingtai/list/hot_company.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
		    	<div class="filter-item f-fix">
			    	<p>股东背景</p><!--国资背景 银行背景 上市公司背景 民资背景 金融机构背景 其他 -->
			    	
			    	<ul>	
			    		<li><a href="#" class="active">不限</a></li>
			    		<li><a href="#">国资背景</a></li>
			    		<li><a href="#">银行背景</a></li>
			    		<li><a href="#">上市公司背景</a></li>
			    		<li><a href="#">民资背景</a></li>
			    		<li><a href="#">金融机构背景</a></li>
			    		<li><a href="#">其他</a></li>
			    	</ul>
		    	</div>
		    	<div class="filter-item f-fix">
			    	<p>保障模式</p>
			    	<ul>	
			    		<li><a href="#" class="active">不限</a></li>
			    		<li><a href="#">风险准备金</a></li>
			    		<li><a href="#">小贷公司</a></li>
			    		<li><a href="#">融资性担保公司</a></li>
			    		<li><a href="#">非融资性担保公司</a></li>
			    		<li><a href="#">法律援助基金</a></li>
			    		<li><a href="#">融资租赁公司</a></li>
			    		<li><a href="#">保险公司担保</a></li>
			    		<li><a href="#">其他</a></li>
			    	</ul>
		    	</div>
		    	<div class="filter-item f-fix">
			    	<p>上线时间</p>
			    	<ul>
			    		<li><a href="#" class="active">不限</a></li>
			    		<li><a href="#">2015年</a></li>
			    		<li><a href="#">2014年</a></li>
			    		<li><a href="#">2013年</a></li>
			    		<li><a href="#">2012年</a></li>
			    		<li><a href="#">2011年以前</a></li>
			    	</ul>
		    	</div>
		    	<div class="filter-item f-fix">
			    	<p>平台注册地</p><!--上海广东北京山东浙江四川湖北湖南江苏安徽福建重庆江西河南河北贵州陕西天津广西云南辽宁新疆山西黑龙江宁夏内蒙古吉林海南甘肃-->
			    	<ul>
			    		<li><a href="#" class="active">不限</a></li>
			    		<li><a href="#">上海</a></li>
			    		<li><a href="#">广东</a></li>
			    		<li><a href="#">北京</a></li>
			    		<li><a href="#">山东</a></li>
			    		<li><a href="#">浙江</a></li>
			    		<li><a href="#">四川</a></li>
			    		<li><a href="#">湖北</a></li>
			    		<li><a href="#">湖南</a></li>
			    		<li><a href="#">江苏</a></li>
			    		<li><a href="#">安徽</a></li>
			    		<li><a href="#">福建</a></li>
			    		<li><a href="#">重庆</a></li>
			    		<li><a href="#">江西</a></li>
			    		<li><a href="#">河南</a></li>
			    		<li><a href="#">河北</a></li>
			    		<li><a href="#">贵州</a></li>

			    	</ul>
		    	</div>
		    	
		 
		    	<div class="clearer"></div>
		    	
		    	<table id="products-list" class="products-list company-list"  width="100%">
        			<colgroup>
        				<col width="16%"/>
                		<col width="47%"/>
                		<col width="17%"/>
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
            					<img src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
logo/lufax.png" height="90"/>
            				</td>
            				<td class="top">
            					<dl>
            						<dt>
            							<a href="#"><?php echo $_smarty_tpl->tpl_vars['row']->value['company_name'];?>
&nbsp;|&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value['company_sku_outer'];?>
</a>
            							<span>年华收益<span class="number cred"><?php echo $_smarty_tpl->tpl_vars['row']->value['company_rate'];?>
</span>%</span>
            							<span>投资期限<span class="number cred"><?php echo $_smarty_tpl->tpl_vars['row']->value['company_period'];?>
</span><?php if (!isset($_smarty_tpl->tpl_vars['row']) || !is_array($_smarty_tpl->tpl_vars['row']->value)) $_smarty_tpl->createLocalArrayVariable('row');
if ($_smarty_tpl->tpl_vars['row']->value['company_period_unit'] = 0) {?>天<?php } else { ?>月<?php }?></span>
            						</dt>
            						<dd>
            							<span>借款金额：<?php echo $_smarty_tpl->tpl_vars['row']->value['company_amount'];?>
万元</span>
            							<span>起投金额：<?php echo $_smarty_tpl->tpl_vars['row']->value['company_amount_start'];?>
元</span>
            							<span><?php echo $_smarty_tpl->tpl_vars['row']->value['company_pay_method'];?>
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
licai/view/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['company_id'];?>
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
</div><?php }} ?>
