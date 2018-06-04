<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"/home/xww/workspace/shixineitui/public/../application/admin/view/user/user_edit.html";i:1528122504;s:73:"/home/xww/workspace/shixineitui/application/admin/view/public/header.html";i:1528096594;s:74:"/home/xww/workspace/shixineitui/application/admin/view/public/base_js.html";i:1527591138;}*/ ?>
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
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="id" class="layui-form-label">
                <span class="x-red">*</span>序号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="id" name="id" lay-verify="pass"
                       autocomplete="off" class="layui-input" value=<?php echo $user['id']; ?> readonly>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="user_id" class="layui-form-label">
                <span class="x-red">*</span>学号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="user_id" name="user_id" lay-verify="pass"
                       autocomplete="off" class="layui-input" value=<?php echo $user['uid']; ?>>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="user_name" class="layui-form-label">
                <span class="x-red">*</span>姓名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="user_name" name="user_name" lay-verify="pass"
                       autocomplete="off" class="layui-input" value=<?php echo $user['name']; ?>>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="submit" class="layui-form-label"></label>
            <button class="layui-btn" lay-filter="save" lay-submit="" id="submit">
                保存
            </button>
        </div>
    </form>
</div>
<script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
<script src="/static/admin/js/x-admin.js"></script>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/js/x-layui.js"></script>
<script>
    layui.use(['form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form()
            , layer = layui.layer;

        $(function () {
            $("#submit").on('click', function () {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo url('user/update'); ?>",
                    data: $(".layui-form").serialize(),
                    dataType: "json"
                })
            })
        })
    })

</script>
</body>

</html>