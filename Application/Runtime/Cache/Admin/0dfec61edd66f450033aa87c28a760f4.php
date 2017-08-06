<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<!--[if lt IE 9]>
	<script type="text/javascript" src="/Public/Admin/lib/html5.js"></script>
	<script type="text/javascript" src="/Public/Admin/lib/respond.min.js"></script>
	<![endif]-->
	<link href="/Public/Admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
	<link href="/Public/Admin/static/h-ui/css/H-ui.login.css" rel="stylesheet" type="text/css" />
	<link href="/Public/Admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
	<link href="/Public/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
	<!--[if IE 6]>
	<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
	<script>DD_belatedPNG.fix('*');</script><![endif]-->
	<title>后台登录</title>
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
	<div id="loginform" class="loginBox">
		<form class="form form-horizontal" action="/Admin/Login/login" method="post">
			<div class="row cl">
				<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
				<div class="formControls col-xs-8">
					<input type="text" name="username" style="display: none">
					<input  name="username" autocomplete="off" type="text" placeholder="账户" class="input-text size-L">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
				<div class="formControls col-xs-8">
					<input type="password" name="password" style="display: none">
					<input  name="password" autocomplete="off" type="password" placeholder="密码" class="input-text size-L">
				</div>
			</div>
			<div class="row cl">
				<div class="formControls col-xs-8 col-xs-offset-3">
					<input class="input-text size-L" type="text" name="captcha" style="width:150px;">
					<img src="/Admin/Login/genCode" id="change">
				</div>
			</div>

			<div class="row cl">
				<div class="formControls col-xs-8 col-xs-offset-3">
					<input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
					<input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/static/h-ui/js/H-ui.js"></script>
<script>
    $('#change').click(function(){
        $(this).attr('src','/Admin/Login/genCode/'+Math.random());
    })
    $('#change').click();
</script>
<script type="text/javascript"> 
   setInterval('change()',1000); /*先设定函数运行的更新时间*/
var bodyObj = document.body;/*获取标签中的对象*/
 function change(){/*因为要使背景颜色随机改变，所以将颜色rgbde的三个数值设为变量。*/
       var min =0;
	   var max =255;/*颜色数值由0~255，因此又要使用到函数*/
	   var red =getRandom(max,min);
	   var green =getRandom(max,min);
	   var blue =getRandom(max,min);
	   bodyObj.style.backgroundColor ='rgb('+red+','+green+','+blue+')';  /*将标签中的对象设置CSS*/
 }
    function getRandom(a,b){/*设置随机变量最大、最小值*/
	return Math.floor(Math.random()*(a-b+1)+b);/*这个代码可以Math.floor(Math.random()*(最大值-最小值+1)+最小值)  包含最小值包含最大值   包含指定区域的随机数，包含最大值与最小值*/
    /*注意书写格式 ：Math.floor(Math.random()*(Max-min+1)+min);*/
	}
</script>
</body>
</html>