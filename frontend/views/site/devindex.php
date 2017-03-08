<?php

use frontend\assets\AppAsset;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '网上行';
AppAsset::addCss($this,'css/reset200802.css');
AppAsset::addCss($this,'css/kfsindex.css');
$username = Yii::$app->user->identity->username;
AppAsset::addScript($this,'js/pageagent/jquery.page.js');
?>
<body>
	<div class="content">
		<div class="header"></div>
		<div class="clear-fix">
			<div class="sidebar">
				<div class="logo" style='background-image: url(<?= \Yii::getAlias('@web') ?>/img/logo.png);'>
					<a href=""></a>
				</div>
				<ul class="navBar">

				</ul>
			</div>
			<div class="main">
				<div class="tip">欢迎来到网上行行销系统 开发商后台 深圳市万科房地产有限公司 <a href="<?= Url::to(['site/logout'])?>" name="geren">退出</a></div>
				<div class="tongji">
					<div class="huang">
						<p class="renshu-t">总访问人数</p>
						<p class="renshu visit_total"></p>
					</div>
					<div class="lan">
						<p class="renshu-t">总提问人数</p>
						<p class="renshu question_total"></p>
					</div>
					<div class="lv">
						<p class="renshu-t">总注册人数</p>
						<p class="renshu register_total"></p>
					</div>
				</div>
				<div class="biao"></div>
			</div>
		</div>
		<div class="footer">© 网上行行销管理系统 2017Powered by 网上行</div>
	</div>
	<!--弹出表格-->
	<div class="tanchu"></div>
</body>
</html>
<script type="text/javascript">
	$(function(){
		var usernames="<?=$username?>";
		var dataVar = [];
		var row = "";
		var col = "";
		//访问数据1
		var pp="";
		var start="";
		var dataCC="";
		var str = '<table>'+
						'<tr>'+
							'<th>编号</th>'+
							'<th>主页id</th>'+
							'<th>电话</th>'+
							'<th>姓名</th>'+
							'<th>创建时间</th>'+
						'</tr>'+
					'</table>';
				
			var str1 = 	'<table>'+
						'<tr>'+
							'<th>编号</th>'+
							'<th>主页id</th>'+
							'<th>提问问题</th>'+
							'<th>提问者名称</th>'+
							'<th>开发商回答</th>'+
							'<th>回答时间</th>'+
							'<th>创建时间</th>'+
						'</tr>'+
					'</table>';
					
             var str2 = 	'<table>'+
	                        '<tr>'+
		                        '<th>编号</th>'+
		                        '<th>主页id</th>'+
		                        '<th>电话</th>'+
		                        '<th>姓名</th>'+
		                        '<th>预约时间</th>'+
		                        '<th>创建时间</th>'+
	                        '</tr>'+
                          '</table>';	
function styleBtn(data){
	$(".devindex_btn").each(function(){
			if($(this).text() == "undefined"){
				$(this).addClass("disable");
				$(this).css({
					"background":"darkgrey",
					"width":"15px",
					"height":"20px"
				});
				$(this).text("");
			}
			else{
				$(this).css({
					"background":"green",
					"width":"15px",
					"height":"20px"
				});
				$(this).text("");
			}
		});
		 $(".devindex_btn").click(function() {
		 	
			 	if($(this).hasClass("disable")){
			 		return;
			 	}
                        row = $(this).parent().parent().index(); // 行位置
                        col = $(this).parent().index() + 1; // 列位置
                        jinjiren(data);
                        

                 });
}
		mainTitle();
		function changeFun(data,data2){
	
            var total = parseInt(data2/20);
			var btnNum = "";
			  
			for (i in data) { 
				if(i==0){
					$(".visit_total").text(data[i].visit_num);
					$(".question_total").text(data[i].question_num);
					$(".register_total").text(data[i].loupan_num);
				}
				btnNum  = data[i].actid;
                $(".biao table").append("<tr>" +  
	                "<td>" + data[i].create + "</td>" +  
	                "<td>" + data[i].source + "</td>" +  
	                "<td>" + data[i].equip + "</td>" +  
	                "<td><div  class=devindex_btn "+btnNum+" "+data[i].agent_num+">" + data[i].agent_num + "</div></td>" +  
	                "<td><div id='cc' class=devindex_btn "+btnNum+" "+data[i].question_num+">" + data[i].question_num + "</div></td>" +  
	                "<td><div class=devindex_btn "+btnNum+" "+data[i].loupan_num+">" + data[i].loupan_num + "</div></td>" +  
	                "<td>" + data[i].ip + "</td>" +  
                "</tr>");
          
		};
		
		  $(".biao").append('<div class="tcdPageCode"></div>')
		  $(".tcdPageCode").createPage({  
                    pageCount:total,  
                    current:1,  
                    backFn:function(pageIndex){   
                        $(".biao table").empty();  
                        start = 1*pageIndex;  
                        $.ajax({  
                            url:"http://pageangent.yuntumedia.com/site/api/pageagent/get_home_list",  
                            type:"POST",  
                            beforeSend:function(){
						            	$("body").append('<div class="loadingPic"><img src="img/loading.gif"/></div>');
						            },
                            dataType:"json",  
                            async:false,
                            data:{  
                               username:usernames,actid:pp,p:start,size:20
                            },  
                            success:function(data){  
                            	console.log(data);
                             dataCC = data.data.list;
                             console.log(dataCC);
                            	$(".loadingPic").remove();
			                    for (i in dataCC) { 
				                   btnNum  = dataCC[i].actid;
				                    $(".biao table").append('<tr>'+
			                               '<th>日期</th>'+
			                               '<th>来路</th>'+
			                               '<th>设备</th>'+
			                               '<th>经纪人</th>'+
			                               '<th>提问</th>'+
			                               '<th>预约</th>'+
			                               '<th>IP</th>'+
	                                    '</tr>');
                                   $(".biao table").append("<tr>" +  
	                               "<td>" + dataCC[i].create + "</td>" +  
	                               "<td>" + dataCC[i].source + "</td>" +  
	                               "<td>" + dataCC[i].equip + "</td>" +  
	                               "<td><div  class=devindex_btn "+btnNum+" "+dataCC[i].agent_num+">" + dataCC[i].agent_num + "</div></td>" +  
	                               "<td><div id='cc' class=devindex_btn "+btnNum+" "+dataCC[i].question_num+">" + dataCC[i].question_num + "</div></td>" +  
	                               "<td><div class=devindex_btn "+btnNum+" "+dataCC[i].loupan_num+">" + dataCC[i].loupan_num + "</div></td>" +  
	                               "<td>" + dataCC[i].ip + "</td>" +  
                                   "</tr>");
		                       };
		                       styleBtn(dataCC);
                            }  
                        })  
                    }  
               });  
               
		styleBtn(data);	
		};
		function jinjiren(data){
			for (bb in data) {
				 if(bb == row-1&&col ==4){
				 $(".tanchu").css("display","block");
				 $(".tanchu").html(str);
				
				 var cc = data[bb].agent_list;
				for(gg in cc){
					 $(".tanchu table").append("<tr>" +  
	                "<td>" +cc[gg].agentid + "</td>" +  
	                "<td>" +cc[gg].hlid + "</td>" +  
	                "<td>" +cc[gg].phone + "</td>" +  
	                "<td>" +cc[gg].username + "</td>" +  
	                "<td>" +cc[gg].create + "</td>" +  
                "</tr>");
				}    
               }
				 if(bb == row-1&&col ==5){
				 $(".tanchu").css("display","block");
				 $(".tanchu").html(str1);
				 var cc = data[bb].question_list
				 for(gg in cc){
				 	$(".tanchu table").append("<tr>" +  
	                "<td>" +cc[gg].qid + "</td>" +  
	                "<td>" +cc[gg].hlid + "</td>" +  
	                "<td>" +cc[gg].question + "</td>" +  
	                "<td>" +cc[gg].username + "</td>" +  
	                "<td>" +cc[gg].ifanwser + "</td>" + 
	                "<td>" +cc[gg].anwsertime + "</td>" +  
	                "<td>" +cc[gg].create + "</td>" +  
                "</tr>");
				 }
				  $(".tanchu table tr:gt(0)").each(function(i){
	                   $(this).children("td").each(function(i){
	                 if(i==4){
	                 	if($(this).text()==0){
	                 		$(this).text("未回答");
	                 		$(this).next().text("暂未回答");
	                 	}
	                 }
	               });
	           });
               }
				 if(bb == row-1&&col ==6){
				 $(".tanchu").css("display","block");
				 $(".tanchu").html(str2);
				 var cc = data[bb].loupan_list;
				 for(gg in cc){
				 	$(".tanchu table").append("<tr>" +  
	                "<td>" +cc[gg].yid + "</td>" +  
	                "<td>" +cc[gg].hlid + "</td>" +  
	                "<td>" +cc[gg].phone + "</td>" +  
	                "<td>" +cc[gg].username + "</td>" +  
	                "<td>" +cc[gg].yuyuedate + "</td>" + 
	                "<td>" +cc[gg].create + "</td>" +  
                "</tr>");
				 }
              }	 
          	}
			$(".tanchu").append('<div class="closeTanchu"">X</div>');
			$(".closeTanchu").click(function(){
				$(".tanchu").css("display","none");
			});
		}
		
		//请求经济人数目
		//提问数目
		//预约看楼数目
		function mainTitle(){
			$.ajax({
	            type : "post",//定义提交的类型
	            dataType:"json",
	            url : "http://pageangent.yuntumedia.com/site/api/pageagent/get_type_list",
	            beforeSend:function(){
	            	$("body").append('<div class="loadingPic"><img src="img/loading.gif"/></div>');
	            },
	            async : false,//是否异步请求，false为同步
	            error:function(xhr){
	            	alert('动态页出错\n\n'+xhr.responseText);
	            },
	            success : function(data) {//成功返回值执行函数    
	                 console.log(data);
	            	var dataList = data.data.list;
	            	$(".loadingPic").remove();
	            	var ttt=null;
	            	var indexZy="";
	            	for(i in dataList){
	            		ttt = i;
            		    indexZy = dataList[ttt].actid;
	            		 $(".navBar").append(
							"<li id='click"+indexZy+"'>"+ttt+"</li>"
					        );
					        $("#click"+indexZy+"").click(function(){
					           pp =$(this).attr('id').substring(5);
					           
					        	$(".alt").removeClass("alt");
			                    $(this).addClass("alt");
					        	$.ajax({
						            type : "POST",//定义提交的类型
						            dataType:"json",
						            url : "http://pageangent.yuntumedia.com/site/api/pageagent/get_home_list",
						            beforeSend:function(){
						            	$("body").append('<div class="loadingPic"><img src="img/loading.gif"/></div>');
						            },
						            data:{username:usernames,actid:pp,p:1,size:20},
						            async : false,//是否异步请求，false为同步
						            success : function(data) {//成功返回值执行函数 
						            	dataVar = data.data.list;
						            	var data2 = data.data.total;
						            	console.log(data);
						     			$(".loadingPic").remove();
		     			                $(".biao").html('<table>'+
		                                '<tr>'+
			                               '<th>日期</th>'+
			                               '<th>来路</th>'+
			                               '<th>设备</th>'+
			                               '<th>经纪人</th>'+
			                               '<th>提问</th>'+
			                               '<th>预约</th>'+
			                               '<th>IP</th>'+
	                                    '</tr>'+
					                  '</table>');
					                  changeFun(dataVar,data2);
								  	} 
								});
					        })
					        if(indexZy==1){
					        	$("#click"+indexZy+"").addClass("alt");
					        	$("#click"+indexZy+"").trigger("click");
					        	
					        }
	            	}
	               
			  	}
			});
			
		};
				
	});
</script>