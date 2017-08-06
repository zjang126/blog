<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link rel="Bookmark" href="favicon.ico" >
	<link rel="Shortcut Icon" href="favicon.ico" />
	<!--[if lt IE 9]>
	<script type="text/javascript" src="/Public/Admin/lib/html5.js"></script>
	<script type="text/javascript" src="/Public/Admin/lib/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui/css/H-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/css/H-ui.admin.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/css/style.css" />
	<script>
        function(a, b) {
            function c(a) {
                return a[0] || (a = []),
                    new KNode(a)
            }
            if (a !== undefined && null !== a) {
                if ("string" == typeof a) {
                    b && (b = _get(b));
                    var d = a.length;
                    if ("@" === a.charAt(0) && (a = a.substr(1)), a.length !== d || /<.+>/.test(a)) {
                        var e = b ? b.ownerDocument || b: document,
                            f = e.createElement("div"),
                            g = [];
                        f.innerHTML = '<img id="__kindeditor_temp_tag__" width="0" height="0" style="display:none;" />' + a;
                        for (var h = 0,
                                 i = f.childNodes.length; i > h; h++) {
                            var j = f.childNodes[h];
                            "__kindeditor_temp_tag__" != j.id && g.push(j)
                        }
                        return c(g)
                    }
                    return c(_queryAll(a, b))
                }
                return a && a.constructor === KNode ? a: (a.toArray && (a = a.toArray()), c(_isArray(a) ? a: _toArray(arguments)))
            }
        }
	</script>

	<!--/meta 作为公共模版分离出去-->

	<title>添加分类 - 分类管理 - H-ui.admin v3.0</title>
	<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
	<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="cl pd-20">
	<form action="/Admin/Article/add" method="post" class="form form-horizontal" enctype="multipart/form-data">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" name="title">
			</div>
		</div>

		<div  class="row cl">
			<label class="form-label col-xs-4 col-sm-3">分类：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span style="width:150px;">
					<select name="cat_id" class="input-text">
						<option value="0">顶级分类</option>
						<?php foreach($cats as $v): ?>
						<option value="<?php echo $v['cat_id']; ?>"><?php echo str_repeat("&nbsp;&nbsp;",$v['level']*2).$v['cat_name']; ?></option>
						<?php endforeach; ?>
					</select>
			</span>
			</div>
		</div>
		<div  class="row cl">
			<label class="form-label col-xs-4 col-sm-3">图片：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span style="width:150px;">
             <input type="file" id="f"  name="img" onchange="change()"    >
				 <p>
            <img id="preview"  alt="" width="300px"  name="pic" />
           </p>
			</span>
			</div>
		</div>
		<div  class="row cl">
			<label class="form-label col-xs-4 col-sm-3">文章内容：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span style="width:150px;">
			</span>
				<textarea id='container' name='content' type='text/plain'></textarea>
			</div>
		</div>
		<div  class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/static/h-ui.admin/js/H-ui.admin.page.js"></script>

<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/Admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-admin-add").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 4,
                    maxlength: 16

                },
                content: {
                    required: true

                },
                onkeyup: false,
                focusCleanup: true,
                success: "valid"
            }
        });
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->

<script type="text/javascript" src="/Public/Admin/utf8-php/ueditor.config.js"></script>
<!-- 编辑源码文件 -->
<script type="text/javascript" src="/Public/Admin/utf8-php/ueditor.all.js"></script>
<script type="text/javascript" src="/Public/Admin/utf8-php/ueditor.parse.min.js"></script>
<script type="text/javascript">
    var  ue=UE.getEditor('container',{
        autoHeight:false
    });
    var ue=UE.getContent();
    //对编辑器的操作最好在编辑器ready之后在做
    ue.ready(function(){
        //设置编辑器的内容
        ue.setContent('hello');
        //获得html内容,返回<p>hello</p>
        var html =ue.getContent();
        //获取纯文本内容,返回:hello
        var txt = ue.getContentText();
    })
</script>
</body>
</html>