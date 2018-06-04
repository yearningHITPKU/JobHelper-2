<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:82:"/home/xww/workspace/shixineitui/public/../application/front/view/intern/index.html";i:1527577422;s:71:"/home/xww/workspace/shixineitui/application/front/view/public/base.html";i:1527016374;s:77:"/home/xww/workspace/shixineitui/application/front/view/public/navigation.html";i:1527016374;s:73:"/home/xww/workspace/shixineitui/application/front/view/public/footer.html";i:1527016374;}*/ ?>
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

<!--begin case-->
<div class="form-group">
    <div class="littleTitle lineFeed littleicon2 col-sm-12">内推信息</div>
</div>
<form name="search" action="" method="post">

    <div class="input-group">
        <input type="text" name="keyword" class="form-control" placeholder="请输入关键词, 关键词用空格隔开" aria-describedby="basic-addon1">
        <span class="input-group-addon" > <a href="javascript:document.search.submit()"><i class="fa fa-search"></i></a></span>
    </div>
</form>
<!--end case-->
<!--end nav center-->
<div class="intern-list">
    <table class="table table-bordered">
        <tbody>

        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
        <tr>
            <td style="width: 3%; text-align: right">
                <img class="list-style" src="/static/picture/list-sytle.png">
            </td>
            <td style="width: 37%; text-align: left;">
                <?php if($vo['is_pinned']==1): ?>
                <span style="color:rgb(200,0,0)">【置顶】</span>
                <?php endif; ?>
                <a target="_self" href="<?php echo url('front/intern/detail', ['id'=>$vo['id']]); ?>"><?php echo mb_substr($vo['title'],0,15,'utf-8'); if(mb_strlen($vo['title'],'utf-8') >= 15): ?>...<?php endif; ?></a>
            </td>
            <td style="width: 20%; text-align: center">
                <?php echo date('Y-m-d',strtotime($vo['time_publish'])); ?>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <td style="text-align: center; border: none;" colspan="10">
                <ul class="pagination pagination-mini">
                    <?php echo $data->render(); ?>
                </ul>
            </td>
        </tr>
        </tfoot>
    </table>
</div>
<!--<div class="paginator">-->
<!--<nav aria-label="Page navigation">-->
<!--<ul class="pager">-->
<!--<?php echo $data->render(); ?>-->
<!--<li><a href="#">上一页</a></li>-->
<!--<li><a href="#">下一页</a></li>-->
<!--</ul>-->
<!--</nav>-->
<!--</div>-->
<!--<tfoot>-->
<!--<tr>-->
<!--<td style="text-align: center; border: none;" colspan="10">-->
<!--<ul class="pagination pagination-mini">-->
<!--<?php echo $data->render(); ?>-->
<!--</ul>-->
<!--</td>-->
<!--</tr>-->
<!--</tfoot>-->

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

</body>
</html>
