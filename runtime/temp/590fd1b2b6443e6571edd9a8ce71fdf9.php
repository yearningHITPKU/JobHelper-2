<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"/home/xww/workspace/JobHelper/public/../application/admin/view/login/login.html";i:1528099678;s:71:"/home/xww/workspace/JobHelper/application/admin/view/public/header.html";i:1528096594;s:72:"/home/xww/workspace/JobHelper/application/admin/view/public/base_js.html";i:1527591138;}*/ ?>
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
    <body style="background-color: #393D49">
        <div class="x-box">
            <div class="x-top">
                <i class="layui-icon x-login-close">
                    &#x1007;
                </i>
                <ul class="x-login-right">
                    <li style="background-color: #F1C85F;" color="#F1C85F">
                    </li>
                    <li style="background-color: #EA569A;" color="#EA569A">
                    </li>
                    <li style="background-color: #393D49;" color="#393D49">
                    </li>
                </ul>
            </div>
            <div class="x-mid">
                <div class="x-avtar">
                    <img src="/static/admin/images/logo.png" alt="">
                </div>
                <div class="input">
                    <form class="layui-form">
                        <div class="layui-form-item x-login-box">
                            <label for="username" class="layui-form-label">
                                <i class="layui-icon">&#xe612;</i>
                            </label>
                            <div class="layui-input-inline">
                                <input type="text" id="username" name="username" required="" lay-verify="username"
                                autocomplete="off" placeholder="用户名" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item x-login-box">
                            <label for="password" class="layui-form-label">
                                <i class="layui-icon">&#xe628;</i>
                            </label>
                            <div class="layui-input-inline">
                                <input type="password" id="password" name="password" required="" lay-verify="pass"
                                autocomplete="off" placeholder="密码" class="layui-input" >
                            </div>
                        </div>
                        <div class="layui-form-item x-login-box" style="">
                            <label for="captcha" class="layui-form-label">
                                <i class="layui-icon">&#xe623;</i>
                            </label>
                            <div class="layui-input-inline">
                                <input type="captcha" id="captcha" name="captcha" required="" lay-verify="captcha"
                                       autocomplete="off" placeholder="验证码" class="layui-input" >
                            </div>
                            <img src="<?php echo captcha_src(); ?>" alt="captcha" id="captcha_img" style="margin-left: -10px"/>
                        </div>
                        <div class="layui-form-item x-login-box" style="text-align: center;">
                            <input type="checkbox" id="isRememberMe" name="isRememberMe" required="" >
                            <label>记住我</label>
                        </div>
                        <div class="layui-form-item">
                            <button  class="layui-btn" lay-filter="save"  type="button" id="loginbtn">
                                登 录
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--<p style="color:#fff;text-align: center;">Copyright © 2017.Company name All rights X-admin </p>-->

        <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
<script src="/static/admin/js/x-admin.js"></script>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/js/x-layui.js"></script>
        <script>
            layui.use(['form'],
            function() {
                $ = layui.jquery;
                var form = layui.form(),
                layer = layui.layer;

                $('.x-login-right li').click(function(event) {
                    color = $(this).attr('color');
                    $('body').css('background-color', color);
                });
                nodes=document.evaluate("/html/body/div[1]/div[2]/div[2]/form/div[3]/div/span", document).iterateNext();
                nodes.innerText = '记住我';

            });

        </script>

        <script>
            $(function () {
                $("#loginbtn").on('click',function () {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo url('login/check'); ?>",
                        data: $(".layui-form").serialize(),
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 1){
                                alert(data.message);
                                window.location.href = "<?php echo url('index/index'); ?>"
                            }else{
                                alert(data.message);
                                window.location.href = "<?php echo url('login/index'); ?>"
                            }
                        }
                    })
                })
            })
        </script>
        <script>
            $("#captcha_img").click(function(){
                var ts = Date.parse(new Date())/1000;
                $('#captcha_img').attr("src", "/captcha?id="+ts);
            });
        </script>
    </body>

</html>
