<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"/home/xww/workspace/shixineitui/public/../application/admin/view/admin/admin_edit.html";i:1527591138;s:73:"/home/xww/workspace/shixineitui/application/admin/view/public/header.html";i:1528096594;s:74:"/home/xww/workspace/shixineitui/application/admin/view/public/base_js.html";i:1527591138;}*/ ?>
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
            <label for="L_pass" class="layui-form-label">
                <span class="x-red">*</span>密码
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_pass" name="password" lay-verify="pass"
                       autocomplete="off" class="layui-input" placeholder="新密码">
            </div>
            <div class="layui-form-mid layui-word-aux">
                6到16个字符
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label"></label>
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

        //自定义验证规则
        form.verify({
            pass: [/(.+){6,12}$/, '密码必须6到12位']
        });

        $(function () {
            $("#submit").on('click', function () {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo url('admin/update'); ?>",
                    data: $(".layui-form").serialize(),
                    dataType: "json",
                    success: function (data) {
                        x_admin_close();
                        alert(data.message);
                    }
                })
            })
        })
    })

</script>
</body>

</html>