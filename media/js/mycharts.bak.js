function arrayparseint(arr) {
	var _arr = new Array();
	for (var i=0;i<arr.length;i++) {
		_arr.push(parseFloat(arr[i]));
	}
	return _arr;
}
function datetimeToSeconds(datetime) { //这个函数在highchart对象里应该有
	var dateArr = datetime.split(" ");
	var dateArr_0 = dateArr[0].split("-");
	var dateArr_1 = dateArr[1].split(":");
	return Date.UTC(dateArr_0[0],dateArr_0[1]-1,dateArr_0[2],dateArr_1[0],dateArr_1[1],dateArr_1[2]);
}
(function($){
	$.fn.commchart = function(options) {
		var defaults = {
			cht:'lc', //The chart type
			chs:'600x400', //The chart size
			chd:'', //The chart data. t代表是简单的文本格式(目前也只支持t)，|符号分隔不同系列的数据
			chco:'', //The chart color. 16进制表示的颜色，留空或不足则系统自动分配
			chdl:'', //The chart data legend.
			chxl:'', //The chart axis label.“0:”代表这是第一组数据的x轴描述，一般多组数据的x轴都是一样的
			chtt:'示例图表', //The chart title
			chtts:'', //The chart subtitle
			chm:'o', //[N|o|-] The chart marker. 折线中的点的marker，N:标注数字 o:标注圆圈 -:不标注, 默认标注圆圈
			chl: '',
			chpc: false, // 百分比
			chdt: false, // 时间类型
			chdti: 1800, //幅度，默认30分钟
			chdtw: 3,
			chdtm: false, //多日期比较(且x轴是时间型)
			chdtmt: '',
			chxpl:'',
			chcn:'', //chart容器ID 
			tacn:'', //table容器ID,传入就展示table
			tahd:'', //table头
			tacd:'', //table行数据
			tard:'',//'2008|2009|2010|2011|2012|2013|2014'
			taft:'' //table footer
		};
		var opts = $.extend(defaults, options);
		
		//验证传入参数是否合法
		var _chs = opts.chs.split('x');
		var _chd = opts.chd.replace('t:','').split('|');
		var _chco = opts.chco.split(',')
		var _chdl = opts.chdl.split('|');
		var _chxl = opts.chxl.replace('0:|','').split('|'); //目前只支持一维图表
		var _chl = opts.chl.split('|');
		var _chdt = opts.chdt
		var _chpc = opts.chpc
		var _axismax = _chdl.length
		var _xmax = _chxl.length
		var _series = new Array();
		
		//table 
		var _tahd = opts.tahd.split('|');
		var _taft = opts.taft.split('|');
		var _tacd = opts.tacd.split('|');
		var _tard = opts.tard.split('|');
		
		
		var _cht_map = {
			"bvg" : "column", //直方图，多个系列横向平行排列（对比与bvs）
			"bvs" : "column", //直方图
			"l" : "", //折线图
			"lc" : "spline", //曲线图
			"p" : "pie", //饼图
			"s" : "" //散点图
		}
		if (_cht_map[opts.cht]=="pie") {
			_chd = opts.chd.replace('t:','').split(',');
			for (var i=0;i<_chd.length;i++) {
				var tmp = new Array();
				tmp.push(_chl[i]);
				tmp.push(parseFloat(_chd[i]));
				_series.push(tmp);
			}
			
		} else {
			for (var i=0;i<_axismax;i++) {
				_series.push({
					name: _chdl[i],
					data: arrayparseint(_chd[i].split(','))
				});
			}
		}
		var _myoptions = {
			chart: {
	        	type: _cht_map[opts.cht],
	            width: _chs[0],
				height: _chs[1]
	        },
			title: { 
				text: opts.chtt,
				useHTML:true
			},
			subtitle: {
				text: "",
				useHTML:true,
				floating: true,
				align:'right',
				y:15
			},
	        series: _series,
	        tooltip: { 
        		headerFormat: '<span style="font-size:12px">{point.key}</span><table>',
	            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: &nbsp;</td>' + (_chpc?'<td style="padding:0"><b>{point.y} %</b></td></tr>':'<td style="padding:0"><b>{point.y}</b></td></tr>'), 
	            footerFormat: '</table>',
	            shared: true,
	            useHTML: true
	    	},
	        credits: {text: ''},
	        yAxis: {
	        	title:"",
	        	plotLines:[{value:0,width:1,color:'#808080'}]
	        }
	      	
		}
		if (options.legend) {
			_myoptions.legend = options.legend;
		}
		if (typeof opts.custom=="object") {
			if (typeof opts.custom.chart=="object") {
				_myoptions.chart = $.extend(_myoptions.chart, opts.custom.chart);
			}
			if (typeof opts.custom.title=="object") {
				//_myoptions.title = $.extend(_myoptions.title, opts.custom.title);
			}
		}
		if (typeof opts.chtt=="object") {
			_myoptions.title = $.extend(_myoptions.title, opts.chtt);
		}
		if (opts.chtts) {
			_myoptions.subtitle = $.extend(_myoptions.subtitle, opts.chtts);
		}
		if (options.xAxis) {
			_myoptions.xAxis = $.extend(_myoptions.xAxis, options.xAxis);
		}
		
		if (_cht_map[opts.cht]=="pie") {
			var _myoptionspie = {
		        tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
		        colors: options.chco ? _chco : ['#f75252', '#dcdcdc', '#0198ff', '#ff7170', '#fe0000', '#92d14f', '#00b04e', '#4f81bc', '#6AF9C4'],
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                slicedOffset: 0,
		                dataLabels: {
		                    enabled: options.pie.dataLabels.enabled,
		                    color: '#000000',
		                    connectorColor: '#000000',
		                    
		                    format: '<b>{point.name}</b>: {point.percentage:.2f} %'
		                }
		            }
		        },
		        series: [{
		            type: 'pie',
		            name: options.pie.name,
		            innerSize: options.pie.innerSize,
		            data: _series,
		            
		        }] 
		    }
		    if (options.pie.states) {
		    	_myoptionspie.plotOptions.pie.states = options.pie.states
		    }
		    if (options.pie.borderWidth) {
		    	_myoptionspie.plotOptions.pie.borderWidth = options.pie.borderWidth;
		    }
		    _myoptionspie.plotOptions.pie.borderWidth = 0
		    _myoptions = $.extend(_myoptions, _myoptionspie);
		} else if (_cht_map[opts.cht]=="spline" && _chdt) {
			//时间类型
			var _myoptionsdatetime = {
				xAxis: { 
					type:'datetime'
				},
				yAxis: {
					title: "",
					plotLines: [{value:0,width:1,color:'#808080'}]
				},
				plotOptions: {
					spline: {
						lineWidth: opts.chdtw,
						states: {hover: {lineWidth: (parseInt(opts.chdtw)+1)} },
						marker: {enabled: false},
						pointInterval:parseInt(opts.chdti)*1000, //30分钟一次
						pointStart:datetimeToSeconds(_chxl[0])
					}
				},
				tooltip: { 
					formatter:function() {
						return Highcharts.dateFormat('%Y-%m-%d %H:%M:%S',this.x)+"<br/>"+"<b>"+this.series.name+"</b><br/>"+this.y+(_chpc?" %":"")
					}
				}
			}
			if (opts.chdtm) {
				_myoptionsdatetime.tooltip = {
					formatter:function() {
						return this.series.name+Highcharts.dateFormat(' %H:%M:%S',this.x)+"<br/>"+"<b>"+opts.chdtmt+"</b><br/>"+this.y+(_chpc?" %":"")
					}
				}
				_myoptionsdatetime.xAxis = { 
					type:'datetime',
					labels: {formatter: function() {return Highcharts.dateFormat('%H:%M',this.value);}}
				}
			}
			_myoptions = $.extend(_myoptions, _myoptionsdatetime);
		}
		if (opts.chxpl) {
			_myoptions.yAxis.plotLines.push(opts.chxpl);
		}
		//渲染图表
		_myoptions.tooltip = {enabled:false,shadow:false}
		//_myoptions.plotOptions.pie.states = {hover: {lineWidthPlus:0,enabled:false}}
		$("#"+opts.chcn).highcharts(_myoptions);
	}
	
})(jQuery);

//theme
Highcharts.theme = {
   colors: ['#f75252', '#dcdcdc', '#0198ff', '#ff7170', '#fe0000', '#92d14f', '#00b04e', '#4f81bc', '#6AF9C4'],
   chart: {
      backgroundColor: 'transparent',
      borderWidth: 0,
      plotBackgroundColor: 'transparent',
      borderColor: '#ACB3BA',
      plotBorderWidth: 0
   },
   title: {
      style: {
         color: '#274B6D',
         font: 'normal 16px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   subtitle: {
      style: {
         color: '#666666',
         font: 'normal 14px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   xAxis: {
      gridLineWidth: 0,
      lineColor: '#999',
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
         }
      }
   },
 	//////////////////////////////////////////////////////////////
   yAxis: {
      lineColor: '#999',
      lineWidth: 1,
      tickWidth: 0,
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
         }
      }
   },
   legend: {
      itemStyle: {
         font: '9pt Trebuchet MS, Verdana, sans-serif',
         color: 'black'

      },
      itemHoverStyle: {
         color: '#039'
      },
      itemHiddenStyle: {
         color: 'gray'
      }
   },
   labels: {
      style: {
         color: '#99b'
      }
   },

   navigation: {
      buttonOptions: {
         theme: {
            stroke: '#CCCCCC'
         }
      }
   }
};
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);