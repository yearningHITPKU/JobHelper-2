<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"/home/xww/workspace/JobHelper/public/../application/admin/view/admin/admin_list.html";i:1527591138;s:71:"/home/xww/workspace/JobHelper/application/admin/view/public/header.html";i:1528096594;s:72:"/home/xww/workspace/JobHelper/application/admin/view/public/base_js.html";i:1527591138;}*/ ?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        软微学院实习内推信息管理系统
    </title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/static/admin/css/x-admin.css" media="all">
</head>
    <body>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>管理员列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            登录名
                        </th>
                        <!--<th>-->
                            <!--登陆密码-->
                        <!--</th>-->
                        <th>
                            上次登陆时间
                        </th>
                        <th>
                            修改密码
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $admin['id']; ?>
                        </td>
                        <td>
                            <?php echo $admin['username']; ?>
                        </td>
                        <!--<td >-->
                            <!--<?php echo $admin['password']; ?>-->
                        <!--</td>-->
                        <td>
                            <?php echo $admin['last_time']; ?>
                        </td>
                        <td class="td-manage">

                            <a title="编辑" href="javascript:;" onclick="admin_edit('编辑','/admin/admin/edit','','400','300')"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>

                        </td>
                    </tr>
                </tbody>
            </table>

            <div id="page"></div>
        </div>
        <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
<script src="/static/admin/js/x-admin.js"></script>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/js/x-layui.js"></script>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
                laydate = layui.laydate;//日期插件
                lement = layui.element();//面包导航
                layer = layui.layer;//弹出层
                //以上模块根据需要引入
            });
            //编辑
            function admin_edit (title,url,id,w,h) {
                x_admin_show(title,url,w,h);
            }
        </script>
        
    </body>
</html>
