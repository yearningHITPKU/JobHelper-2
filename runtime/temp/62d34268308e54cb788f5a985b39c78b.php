<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:94:"/home/xww/workspace/shixineitui/public/../application/user/view/thoughts/publish-thoughts.html";i:1527845322;s:70:"/home/xww/workspace/shixineitui/application/user/view/public/base.html";i:1527016374;s:76:"/home/xww/workspace/shixineitui/application/user/view/public/navigation.html";i:1528099986;s:72:"/home/xww/workspace/shixineitui/application/user/view/public/footer.html";i:1527016374;}*/ ?>
<!--
	作者：xichutian@163.com
	时间：2018-05-06
	描述：学生心得
-->
<!DOCTYPE html>
<!-- saved from url=(0050)https://scc.pku.edu.cn/student/base-student.action -->
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="/static/css/studentcss/bootstrap.min.css" rel="stylesheet">
    <!-- 时间控件 -->
    <link href="/static/css/studentcss/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link rel="stylesheet" href="/static/css/font-awesome.min.css">
    <link rel="stylesheet" href="/static/css/studentcss/bootstrapValidator.min.css">
    <script src="/static/js/studentjs/jquery.min.js"></script>
    <link rel="stylesheet" href="/static/css/studentcss/pageModel.css" />
    <link rel="stylesheet" href="/static/css/studentcss/style.css" />
    <title>北京大学软件与微电子学院-实习内推发布</title>
    <style media="screen">
        .wrap { position: relative; } .side { width: 120px; position: absolute; left: 0; height: 100%; background-color: #f1f1f1; } .right { margin-left: 140px; margin-top: -20px; padding-top: 10px; background-color: white; min-height: 800px; } .p-15 { padding: 15px; } .upload-logo-input { cursor: pointer; width: 100px; height: 100px; font-size: 20px; position: absolute; z-index: 99; opacity: 0; -ms-filter: 'alpha(opacity=0)'; } .profile-logo { position: relative; padding: 10px; text-align: center; } .profile-logo img { border-radius: 50%; width: 100px; height: 100px; } .tip-mask { visibility: hidden; position: absolute; border-radius: 50%; width: 100px; height: 100px; overflow: hidden; } .tip-mask .fa { position: absolute; color: #FFF; font-size: 55px; z-index: 10; left: 30px; top: 7px; } .tip-mask .hint { position: absolute; color: #fff; z-index: 10; font-size: 16px; bottom: 15px; left: 20px; } .tip-mask .mask { width: inherit; height: inherit; background: #000; opacity: 0.6; -ms-filter: 'alpha(opacity=0.6)'; } .head-div { border-radius: 50%; overflow: hidden; } .head-div:hover .tip-mask{ visibility: visible; } .profile-logo h4 { margin: 8px 0; } ul.profile-spec { margin-top: 20px; } ul.profile-spec li>a { display: inline-block; padding: 15px 0 15px 25px; width: 100%; height: 100%; text-decoration: none; font-size: 14px; } ul.profile-spec li.active>a { background-color: #fff; font-size: 15px; } ul.profile-spec li>a:hover { background-color: #fff; } .tab-pane { padding-bottom: 40px; } .add-more { text-align: center; margin: 10px; } .add-more a { padding: 6px 20px; display: inline-block; border: 1px solid #03A9F4; border-radius: 5px; font-size: 14px; text-decoration: none; } .add-more .color-green{ border: 1px solid #527d28; color:#527d28; } .add-more a:hover { background-color: #f1f1f1; text-decoration: none; } .add-more a>i { padding-right: 6px; } .bootstrap-select { width: 260px !important; } .student-tip { line-height: 45px; font-size: 16px; color: red; padding: 0 15px; } .col-sm-2{ width: 15%; padding-right: 0; }
    </style>
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 50px;
        }
        a{
            text-decoration: none;
            color:#000000;
            text-underline: none;
        }
        a:hover{
            color: red;
            text-decoration:none;
        }
        .footer{
            margin: 0 auto;
            padding: 10px 0px;
        }
        span.star{
            color: red;
        }
        .footer a:hover{
            color: #038a1e;
        }
        .hide{
            display: none;
        }
        .show{
            display: inline;
        }
    </style>
    
<style media="screen">.wrap {
    position: relative;
}

.side {
    width: 120px;
    position: absolute;
    left: 0;
    height: 100%;
    background-color: #f1f1f1;
}

.right {
    margin-left: 140px;
    margin-top: -20px;
    padding-top: 10px;
    background-color: white;
    min-height: 800px;
}

.p-15 {
    padding: 15px;
}

.upload-logo-input {
    cursor: pointer;
    width: 100px;
    height: 100px;
    font-size: 20px;
    position: absolute;
    z-index: 99;
    opacity: 0;
    -ms-filter: 'alpha(opacity=0)';
}

.profile-logo {
    position: relative;
    padding: 10px;
    text-align: center;
}

.profile-logo img {
    border-radius: 50%;
    width: 100px;
    height: 100px;
}

.tip-mask {
    visibility: hidden;
    position: absolute;
    border-radius: 50%;
    width: 100px;
    height: 100px;
    overflow: hidden;
}

.tip-mask .fa {
    position: absolute;
    color: #FFF;
    font-size: 55px;
    z-index: 10;
    left: 30px;
    top: 7px;
}

.tip-mask .hint {
    position: absolute;
    color: #fff;
    z-index: 10;
    font-size: 16px;
    bottom: 15px;
    left: 20px;
}

.tip-mask .mask {
    width: inherit;
    height: inherit;
    background: #000;
    opacity: 0.6;
    -ms-filter: 'alpha(opacity=0.6)';
}

.head-div {
    border-radius: 50%;
    overflow: hidden;
}

.head-div:hover .tip-mask {
    visibility: visible;
}

.profile-logo h4 {
    margin: 8px 0;
}

ul.profile-spec {
    margin-top: 20px;
}

ul.profile-spec li > a {
    display: inline-block;
    padding: 15px 0 15px 25px;
    width: 100%;
    height: 100%;
    text-decoration: none;
    font-size: 14px;
}

ul.profile-spec li.active > a {
    background-color: #fff;
    font-size: 15px;
}

ul.profile-spec li > a:hover {
    background-color: #fff;
}

.tab-pane {
    padding-bottom: 40px;
}

.add-more {
    text-align: center;
    margin: 10px;
}

.add-more a {
    padding: 6px 20px;
    display: inline-block;
    border: 1px solid #03A9F4;
    border-radius: 5px;
    font-size: 14px;
    text-decoration: none;
}

.add-more .color-green {
    border: 1px solid #527d28;
    color: #527d28;
}

.add-more a:hover {
    background-color: #f1f1f1;
    text-decoration: none;
}

.add-more a > i {
    padding-right: 6px;
}

.bootstrap-select {
    width: 260px !important;
}

.student-tip {
    line-height: 45px;
    font-size: 16px;
    color: red;
    padding: 0 15px;
}

.col-sm-2 {
    width: 15%;
    padding-right: 0;
}</style>

</head>
<body tabindex="0">

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:history.back()"><i class="fa fa-arrow-left"></i> </a>
            <a class="navbar-brand" href="/">实习内推信息网</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo url('user/index/index'); ?>">个人信息</a></li>
                <li><a href="<?php echo url('user/interns/index_myinterns'); ?>">我的发布</a></li>
                <li><a href="<?php echo url('user/follow/index'); ?>">我的关注</a></li>
                <li><a href="<?php echo url('user/collection/index'); ?>">我的收藏</a></li>
                <li><a href="<?php echo url('user/message/index'); ?>">我的消息</a></li>
            </ul>
            <!--<ul class="nav navbar-nav navbar-right">
                <li><a href="" style="color: red;"><i class="fa fa-user" aria-hidden="true"></i>欢迎回来，<?php echo session('user_name'); ?></a></li>
            </ul>-->
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div style="padding-left: 5%; padding-right: 5%">
    <form class="form-horizontal" role="form" id="studentForm" novalidate enctype="multipart/form-data">
        <div class="form-group">
            <!--<div class="littleTitle  lineFeed littleicon2 col-sm-1">面试经验</div>-->
            <div class="littleTitle lineFeed littleicon2 col-sm-12"><i class="fa fa-hand-o-right"></i>面试经验</div>

        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">
                <span class="star">*</span>标题：</label>
            <div class="col-sm-9">
                          <span class="twitter-typeahead" style="position: relative; display: block;">
                            <input class="form-control tt-hint" value="" autocomplete="off" spellcheck="false"
                                   tabindex="-1" dir="ltr"
                                   style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: none 0% 0% / auto repeat scroll padding-box border-box rgb(255, 255, 255);">
                            <input id="title" class="form-control col-sm-9" placeholder="请输入完整的标题" name="title"
                                   autocomplete="off" spellcheck="false" dir="auto"
                                   style="position: relative; vertical-align: top; background-color: transparent;">
                            <pre aria-hidden="true"
                                 style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, SimSun, Arial, &quot;Helvetica Neue&quot;, Helvetica; font-size: 12px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre>
                            <div class="tt-menu"
                                 style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;">
                              <div class="tt-dataset tt-dataset-school-dataset"></div>
                            </div>
                          </span>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-3 control-label">
                <span class="star">*</span>企业名称：</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" placeholder="请填写企业名称" name="corp_name">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-3 control-label">
                <span class="star">*</span>工作职位：</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" placeholder="请填写工作职位" name="position">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"><span class="star">*</span>面试经验：</label>
            <div class="col-sm-8">
                <textarea name="advise" rows="10" class="form-control" placeholder="详细内容"></textarea>
                <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>"/>
            </div>
        </div>
        <div class="add-more" id="saveAndSubmit">
            <label class="control-label col-sm-1">
            </label>
            <button type="submit" id="btn_submitInfo" style="margin: 0 10px;" class="btn btn-success">
                <i class="fa fa-check-square-o"></i>提交
            </button>
        </div>
    </form>
</div>


<!-- footer -->
<div class="footer row navbar-fixed-bottom">
    <a href="<?php echo url('user/interns/index'); ?>">
        <div class="item col-xs-6 col-sm-6" style="text-align: center;">
            <i class="fa fa-file-text" aria-hidden="true"></i>
            <br>
            发布内推信息
        </div>
    </a>
    <a href="<?php echo url('user/thoughts/publish'); ?>">
        <div class="item col-xs-6 col-sm-6" style="text-align: center;">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <br>
            发布面试经验
        </div>
    </a>

</div>
<!-- /footer -->

<!-- jQuery Version 1.11.0 -->
<script src="/static/js/studentjs/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="/static/js/studentjs/bootstrap.min.js"></script>
<!-- bootstrapValidator -->
<script src="/static/js/studentjs/bootstrapValidator.js"></script>
<!-- 时间格式化 -->
<script type="text/javascript" src="/static/js/studentjs/date.format.js"></script>
<!-- 下拉控件 -->
<script type="text/javascript" src="/static/js/studentjs/bootstrap-select.min.js"></script>
<!-- ajaxfileupload -->
<script src="/static/js/studentjs/ajaxfileupload.js"></script>
<script>
    function goBack() {
        window.history.goBack();
    }
</script>

<script type="text/javascript">
    fillMyInfo();

    function fillMyInfo() {
        //初始化验证
        $('#studentForm').bootstrapValidator({
            excluded: [':disabled'],
            live: 'enabled',
            fields: {
                "title": {
                    validators: {
                        notEmpty: {
                            message: '内推标题不能为空'
                        }
                    }
                },
                "corp_name": {
                    validators: {
                        notEmpty: {
                            message: '企业名称不能为空'
                        }
                    }
                },
                "position": {
                    validators: {
                        notEmpty: {
                            message: '工作职位不能为空'
                        }
                    }
                },
                "advise": {
                    validators: {
                        notEmpty: {
                            message: '面试经验不能为空'
                        }
                    }
                },
            }
        });
    }

    $("#btn_submitInfo").click(function (event) {
        var formData = $("#studentForm").serialize();
        var bv = $("#studentForm").data('bootstrapValidator');
        bv.validate();
        if (bv.isValid()) {
            document.getElementById('btn_submitInfo').innerHTML = "正在提交";
            $.post("<?php echo url('user/thoughts/add_thoughts'); ?>", formData,
                function (data) {
                    document.getElementById('btn_submitInfo').innerHTML = "提交";
                    alert(data.message);
                    window.location.href = "<?php echo url('user/thoughts/mythoughts'); ?>";
                },
                "json").fail(function (data) {
                document.getElementById('btn_updateInfo').innerHTML = "提交";
                alertify.alert(data.message + "");



            });
        }
    });
</script>

</body>
</html>