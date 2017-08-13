<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link rel="Bookmark" href="favicon.ico" >
	<link rel="Shortcut Icon" href="favicon.ico" />

	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui/css/H-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/css/H-ui.admin.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/css/style.css" />

	<!--/meta 作为公共模版分离出去-->

	<title>分类列表 - 分类列表 - H-ui.admin v3.0</title>
</head>
<body>
<!--_header 作为公共模版分离出去-->
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">H-ui.admin</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a> <span class="logo navbar-slogan f-l mr-10 hidden-xs">v3.0</span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav class="nav navbar-nav">
                <ul class="cl">
                    <li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" onclick="article_add('添加资讯','/Admin/Article/add')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
                            <li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
                            <li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
                            <li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li><?php if( session('adminRole') == 2){echo '管理员';}else{echo '超级管理员';};?></li>


                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo session('username');?><i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
                            <li><a href="#">切换账户</a></li>
                            <li><a href="<?php echo U('Login/logout');?>" >退出系统</a></li>
                        </ul>
                    </li>
                    <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                            <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!--/_header 作为公共模版分离出去-->

<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">
    <div class="menu_dropdown bk_2">
        <dl id="menu-admin">
            <dt class="selected"><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd style="display:block">
                <ul>
                    <li><a href="/Admin/Role/index" title="角色管理">角色管理</a></li>
                    <li><a href="/Admin/Auth/index" title="权限管理">权限管理</a></li>
                    <li class="current"> <a href="/Admin/User/index" title="管理员列表">管理员列表</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-blog">
            <dt><i class="Hui-iconfont">&#xe613;</i> 博文管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="/Admin/Article/index" title="博文管理">博文列表</a></li>
                </ul>
            </dd>
        </dl>
         <dl id="menu-picture">
            <dt><i class="Hui-iconfont">&#xe613;</i> 分类管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="<?php echo U('Category/index')?>" title="分类管理">分类列表</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-comments">
            <dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="#" title="评论列表">评论列表</a></li>
                    <li><a href="#" title="意见反馈">意见反馈</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-member">
            <dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="member-list.html" title="会员列表">会员列表</a></li>
                    <li><a href="member-del.html" title="删除的会员">删除的会员</a></li>
                    <li><a href="member-level.html" title="等级管理">等级管理</a></li>
                    <li><a href="member-scoreoperation.html" title="积分管理">积分管理</a></li>
                    <li><a href="member-record-browse.html" title="浏览记录">浏览记录</a></li>
                    <li><a href="member-record-download.html" title="下载记录">下载记录</a></li>
                    <li><a href="member-record-share.html" title="分享记录">分享记录</a></li>
                </ul>
            </dd>
        </dl>
        <dl  id="Hui-iconfont" >
            <dt><i class="Hui-iconfont">&#xe613;</i> 回收站管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="<?php echo U('Recovery/index')?>" title="回收站管理">博文回收站</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-system">
            <dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="system-base.html" title="系统设置">系统设置</a></li>
                    <li><a href="system-category.html" title="栏目管理">栏目管理</a></li>
                    <li><a href="system-data.html" title="数据字典">数据字典</a></li>
                    <li><a href="system-shielding.html" title="屏蔽词">屏蔽词</a></li>
                    <li><a href="/Admin/index/index" title="系统日志">系统日志</a></li>
                </ul>
            </dd>
        </dl>
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a> </div>
<!--/_menu 作为公共模版分离出去-->

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		分类管理
		<span class="c-gray en">&gt;</span>
		分类列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<form action="/Admin/Category/index" method="get">
			<input type="text" class="input-text" style="width:250px" placeholder="输入顶级分类名称"  name="cat_name">
			<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜分类</button>
			</form>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<a href="javascript:;" onclick="admin_add('添加分类','/Admin/Category/add','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a> </span>
				<span class="r">共有数据：<strong><?php echo $con ;?></strong> 条</span>
			</div>
			<table class="table table-border table-bordered table-bg">
				<thead>
				<tr>
					<th scope="col" colspan="9">分类列表</th>
				</tr>
				<tr class="text-c">
					<th width="40">序号</th>
					<th width="150">分类名</th>
					<th width="90">分类级别</th>
					<th width="130">加入时间</th>
					<th width="120">修改时间</th>
					<th width="100">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php $i=0; foreach($lists as $k=>$v){ ?>
				<tr class="text-c">
					<td><?php echo ++$i;?></td>
					<td><?php echo str_repeat("--",$v['level']).$v['cat_name']; ?></td>
					<td><?php echo $lists[ $v['pid'] ]['cat_name']?:'顶级分类'; ?></td>
					<td><?php echo date('Y-m-d H:i:s',$v[add_time]) ?></td>
					<td><?php echo date('Y-m-d H:i:s',$v[update_time]) ?></td>
					<td class="td-manage">
						<a title="编辑" href="javascript:;" onclick="admin_edit('分类编辑','/Admin/Category/upd/cat_id/<?php echo $v[cat_id]?>','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="删除"  cat_id="<?php echo $v[cat_id];?>"  class="del" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				</tbody>
				<?php }?>
			</table>
		</article>
	</div>
</section>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Admin/static/h-ui.admin/js/H-ui.admin.page.js"></script>
<!--<script type="text/javascript">-->
    <!--$(".Hui-aside").Huifold({-->
        <!--titCell:'.menu_dropdown dl dt',-->
        <!--mainCell:'.menu_dropdown dl dd',-->
    <!--});-->
<!--</script>-->
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/Admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
	/*
	 参数解释：
	 title	标题
	 url		请求的url
	 id		需要操作的数据id
	 w		弹出层宽度（缺省调默认值）
	 h		弹出层高度（缺省调默认值）
	 */
	/*分类-增加*/
    function admin_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
	/*分类-编辑*/
    function admin_edit(title,url,w,h){
        layer_show(title,url,w,h);
    }
</script>
<script>
    //无刷新删除
    $(".del").click(function(){
        var self = $(this);
        if(!confirm('确认删除？')){
            return false;
        }
        //发送ajax请求
        var cat_id = $(this).attr('cat_id');
        $.ajax({
            type:"get",
            url:"/Admin/Category/del",
            data:{"cat_id":cat_id},
            dataType:'json',
            success:function(json){

                if(json.errCode == 0){
                    //要删除当前行
                    self.parents("tr").remove();
                    //序号需要重新排列
                    $("tbody tr").each(function(k,v){
                        $(this).find("td:first").html(k+1);
                    });
                    alert(json.info);

                }else{
                    alert(json.info);
                }

            }
        });
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>