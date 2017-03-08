$(document).ready(function() {
	//焦点换图
	$("#inputEmail").focus(function() {
		$("#inputEmail").prev().attr('src', js_root+'img/yhm-xz.png');
	});
	$("#inputPassword").focus(function() {
		$("#inputPassword").prev().attr('src', js_root+'img/pw-xz.png');
	});
	$("#inputyzm").focus(function() {
		$("#inputyzm").prev().attr('src', js_root+'img/yzm-xz.png');
		$("#inputyzm").parent("#inputyzm_p").css('border', '1px solid #5255a0');
	});
	$("#inputEmail").blur(function() {
		$("#inputEmail").prev().attr('src', js_root+'img/yhm-mr.png');
	});
	$("#inputPassword").blur(function() {
		$("#inputPassword").prev().attr('src', js_root+'img/pw-mr.png');
	});
	$("#inputyzm").blur(function() {
		$("#inputyzm").prev().attr('src', js_root+'img/yzm-mr.png');
		$("#inputyzm").parent("#inputyzm_p").css('border', '1px solid grey');
	});

	$('.span3').focus(function() {
		//								alert('nihao');
		$(this).parent('.mycontrols').parent('.control-group').css('border', '1px solid #5255a0');
	});
	$('.span3').blur(function() {
		//								alert('nihao');
		$(this).parent('.mycontrols').parent('.control-group').css('border', '1px solid grey');
	});
	$("#loginForm").validate({
		rules : {
			email : {
				required:true,
			},
			password : {
				required : true,
			},
			verifyCode:{
				required : true,
			},
		},
		messages : {
			email : {
				required :"请输入用户名",
			},
			password : {
				required : "请输入密码",
			},
			verifyCode:{
				required : "请输入验证码",
			},
		},
		errorPlacement : function(error, element) {
//			console.log(error['0']['id']);
			if (error['0']['id'] == "inputyzm-error") {
				element.parent().parent().next().next().html(error);
//				error.appendTo(element.parent().parent().next().next());
			} else {
				error.appendTo(element.parent().parent().next());
			}

			
		},
		// errorLabelContainer:"#messageBox",
		// wrapper:"li",
		onkeyup : false,
	});
});