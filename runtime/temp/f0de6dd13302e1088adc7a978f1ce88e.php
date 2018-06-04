<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:83:"/home/xww/workspace/shixineitui/public/../application/front/view/intern/detail.html";i:1528099986;s:71:"/home/xww/workspace/shixineitui/application/front/view/public/base.html";i:1527016374;s:77:"/home/xww/workspace/shixineitui/application/front/view/public/navigation.html";i:1527016374;s:73:"/home/xww/workspace/shixineitui/application/front/view/public/footer.html";i:1527016374;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge chrome=1">
    <meta name="renderer" content="webkit">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="/static/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/static/css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="/static/css/studentcss/pageModel.css" />
    <link rel="stylesheet" href="/static/css/studentcss/style.css" />
    <title>北大软微实习内推信息网</title>
    <style>
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
        .table-bordered tbody tr td{
            border:none;
            border-bottom: 1px dashed #cacaca;
        }
        .input-group{
            padding-top: 20px;
            margin-top: 20px;
        }
        .footer a:hover{
            color: #038a1e;
        }
        body {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        a:hover{
            color: red;
            text-decoration:none;
        }

        .form-horizontal .form-group{
            margin-bottom: 0px;
            margin-left: 0px;
        }
    </style>
    
</head>
<body>

<nav class="navbar navbar-inverse  navbar-fixed-top">
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
                <li><a href="/">通知公告</a></li>
                <li><a href="<?php echo url('front/intern/index'); ?>">内推信息</a></li>
                <li><a href="<?php echo url('front/thought/index'); ?>">面试经验</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo url('user/index/index'); ?>" style="color: red;"><i class="fa fa-user" aria-hidden="true"></i>个人中心（<?php echo session('user_name'); ?>）</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<script>

</script>

<form class="form-horizontal bv-form" role="form" id="studentForm" novalidate="novalidate" enctype="multipart/form-data"
      method="post" action="<?php echo url('create'); ?>" onsubmit="return checkForm();">
    <fieldset id="fieldset">
        <div class="form-group">
            <div class="littleTitle lineFeed littleicon2 col-sm-12"><?php echo $details['owner_name']; ?>发布的实习内推</div>
        </div>
        <div class="col-sm-12">
            <div class="articleContainer">
                <div class="articleTitle">
                    <?php echo $details['title']; ?>
                </div>
                <div class="articleDate">
                    <div class="input-group2">发布日期：<?php echo date('Y-m-d',strtotime($details['time_publish'])); ?></div>
                    <div class="input-group2">浏览次数：<?php echo $details['click_times']; ?></div>
                </div>
                <div class="articleContext">
                    <div class="job-head">内推详情:</div>
                    <div>工作地点: <?php echo $details['location']; ?></div>
                    <div>公司名称: <?php echo $details['corp_name']; ?></div>
                    <div>工作职位: <?php echo $details['position']; ?></div>
                    <div>详细内容: <br><?php echo $details['detail']; ?></div>
                    <div hidden="hidden"><a style="color: #1D80DD" href="<?php echo url('front/intern/download', ['id'=>$details['id']]); ?>">附件</a>
                    </div>
                </div>
                <div class="articleContext">
                    <p class="<?php echo !empty($visible)?' ':'hide'; ?>" style="display: inline-block;">
                        <span><?php echo !empty($has_collected)?'已收藏':'收藏本文'; ?></span>&nbsp;&nbsp;&nbsp;
                        <i id="bookmark" onclick="change_collect(this, <?php echo $details['id']; ?>)" class="<?php echo !empty($has_collected)?'fa fa-bookmark':'fa fa-bookmark-o'; ?>" aria-hidden="true" style="<?php echo !empty($has_collected)?'color:red;':''; ?>"></i>
                    </p>
                    <p style="float: right;display: inline-block;border: 0px solid red;">作者: <?php echo $details['owner_name']; ?>&nbsp;&nbsp;&nbsp;
                        <i  id="heart" onclick="change_follow()" class="<?php echo !empty($visible)?' ':'hide'; ?> <?php echo !empty($has_followed)?'fa fa-heart':'fa fa-heart-o'; ?>" aria-hidden="true" style="<?php echo !empty($has_followed)?'color:red;':''; ?>"></i>
                    </p>
                    <!--<p style="text-align: right;border: 0px solid red;" class="<?php echo !empty($visible)?'show':'hide'; ?>"><?php echo !empty($has_followed)?'取关':'关注'; ?>他/她</p>-->
                </div>
            </div>
        </div>
    </fieldset>
</form>

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
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/bootstrap.min.js"></script>

<script>

    function change_follow() {
        $.get("<?php echo url('user/follow/change', ['owner_id'=>$details['owner_id']]); ?>",
            function (e) {
                // console.log(e);
                alert(e['msg']);
                var heart = document.getElementById('heart');
                if (e['msg']==="已取关") {
                    heart.className = 'fa fa-heart-o';
                    heart.style.color = "";
                }else{
                    heart.className = 'fa fa-heart';
                    heart.style.color = "red";
                }
            }
        )
    }
    function change_collect(obj, id) {
        var $thisobj = $(obj)
        var $icon = $thisobj
        var $txt = $thisobj.parent().children('span')

        $.ajax({
            url: "<?php echo url('user/collection/change'); ?>",
            data:{'id': id, 'type': '0'},
            dataType: 'json',
            success: function (data) {
                if(data['status']==0) {
                    if(data['method']=='add') {
                        $icon.attr('class', 'fa fa-bookmark')
                        $icon.css('color', 'red')
                        $txt.text('已收藏')
                        alert(data['msg'])
                    } else {
                        $icon.attr('class', 'fa fa-bookmark-o')
                        $icon.css('color', 'black')
                        $txt.text('收藏本文')
                        alert(data['msg'])
                    }
                }
            },
            error:function () {
                alert(data['msg'])
            }
        })
    }
    function change_collect(obj, id) {
        var $thisobj = $(obj)
        var $icon = $thisobj
        var $txt = $thisobj.parent().children('span')

        $.ajax({
            url: "<?php echo url('user/collection/change'); ?>",
            data:{'id': id, 'type': '0'},
            dataType: 'json',
            success: function (data) {
                if(data['status']==0) {
                    if(data['method']=='add') {
                        $icon.attr('class', 'fa fa-bookmark')
                        $icon.css('color', 'red')
                        $txt.text('已收藏')
                        alert(data['msg'])
                    } else {
                        $icon.attr('class', 'fa fa-bookmark-o')
                        $icon.css('color', 'black')
                        $txt.text('收藏本文')
                        alert(data['msg'])
                    }
                } else {
                    alert(data['msg'])
                }

            },
            error:function () {
                alert('发生错误')
            }
        })
    }
</script>

</body>
</html>
