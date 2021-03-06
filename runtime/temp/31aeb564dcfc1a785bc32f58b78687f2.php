<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"/home/xww/workspace/shixineitui/public/../application/admin/view/intern/deleted_list.html";i:1527016082;s:73:"/home/xww/workspace/shixineitui/application/admin/view/public/header.html";i:1527016082;s:74:"/home/xww/workspace/shixineitui/application/admin/view/public/base_js.html";i:1527016082;}*/ ?>
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
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/static/admin/css/x-admin.css" media="all">
</head>
<body>
<div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>实习信息管理</cite></a>
              <a><cite>已删除列表</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <!--<form class="layui-form x-center" action="" style="width:800px">
        <div class="layui-form-pane" style="margin-top: 15px;">
            <div class="layui-form-item">
                <label class="layui-form-label">日期范围</label>
                <div class="layui-input-inline">
                    <input class="layui-input" placeholder="开始日" id="LAY_demorange_s">
                </div>
                <div class="layui-input-inline">
                    <input class="layui-input" placeholder="截止日" id="LAY_demorange_e">
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="username"  placeholder="标题" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width:80px">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                </div>
            </div>
        </div>
    </form>-->
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delSelected()">
            <i class="layui-icon">&#xe640;</i>
            批量删除
        </button>
        <button class="layui-btn" onclick="recoverAll()">
            <i class="layui-icon">&#xe608;</i>
            批量恢复
        </button>
        <span class="x-right" style="line-height:40px">
                    共有数据：<?php echo $intern_size; ?> 条
                </span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <input type="checkbox" id="selectAll" name="all" value="all" onclick="selectAll()">
            </th>
            <th>
                ID
            </th>
            <th>
                标题
            </th>
            <th>
                提交时间
            </th>
            <th>
                浏览次数
            </th>
            <th>
                操作
            </th>
        </tr>
        </thead>
        <tbody id="internList-body">
        <?php if(is_array($intern_list) || $intern_list instanceof \think\Collection || $intern_list instanceof \think\Paginator): if( count($intern_list)==0 ) : echo "" ;else: foreach($intern_list as $key=>$vo): ?>
        <tr>
            <td>
                <input type="checkbox" value=<?php echo $vo['id']; ?> name="one">
            </td>
            <td>
                <?php echo $vo['id']; ?>
            </td>
            <td>
                <!--<u style="cursor:pointer" onclick="question_show()">-->
                <u style="cursor:pointer">
                    <a target="_blank" href="<?php echo url('front/intern/detail', ['id'=>$vo['id']]); ?>" target="_blank">
                        <?php echo $vo['title']; ?>
                    </a>
                </u>
            </td>
            <td >
                <?php echo $vo['time_publish']; ?>
            </td>
            <td >
                <?php echo $vo['click_times']; ?>
            </td>
            <td class="td-manage">
                <a title="恢复" href="javascript:;" onclick="recover(this,<?php echo $vo['id']; ?>)"
                   style="text-decoration:none">
                    <i class="layui-icon">&#xe654;</i>
                </a>
                <a title="删除" href="javascript:;" onclick="question_del(this,<?php echo $vo['id']; ?>)"
                   style="text-decoration:none">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>

    <!--<div id="page"></div>-->
    <style>
        .pagination{
            display: inline-flex;
        }
        .pagination .active {

        }
        .pagination .active span{
            color: #009688;
        }
    </style>
    <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0" >
        <?php echo $page; ?>
    </div>
</div>
<script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
<script src="/static/admin/js/x-admin.js"></script>
<script src="/static/admin/js/jquery.min.js"></script>
<script>
    layui.use(['laydate','element','laypage','layer'], function(){
        $ = layui.jquery;//jquery
        laydate = layui.laydate;//日期插件
        lement = layui.element();//面包导航
        laypage = layui.laypage;//分页
        layer = layui.layer;//弹出层

        //以上模块根据需要引入
        laypage({
            cont: 'page'
            ,pages: 100
            ,first: 1
            ,last: 100
            ,prev: '<em><</em>'
            ,next: '<em>></em>'
        });

        var start = {
            min: laydate.now()
            ,max: '2099-06-16 23:59:59'
            ,istoday: false
            ,choose: function(datas){
                end.min = datas; //开始日选好后，重置结束日的最小日期
                end.start = datas //将结束日的初始值设定为开始日
            }
        };

        var end = {
            min: laydate.now()
            ,max: '2099-06-16 23:59:59'
            ,istoday: false
            ,choose: function(datas){
                start.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };

        document.getElementById('LAY_demorange_s').onclick = function(){
            start.elem = this;
            laydate(start);
        }
        document.getElementById('LAY_demorange_e').onclick = function(){
            end.elem = this
            laydate(end);
        }
    });

    function question_show (argument) {
        layer.msg('可以跳到前台具体问题页面',{icon:1,time:1000});
    }
    /*添加*/
    function question_add(title,url,w,h){
        x_admin_show(title,url,w,h);
    }
    //编辑
    function question_edit (title,url,id,w,h) {
        x_admin_show(title,url,w,h);
    }

    /*删除*/
    function question_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});

            $.ajax({
                type: 'POST',
                url: "<?php echo url('intern/delete'); ?>",
                data: {'id':id},
                dataType: "json",
            })
        });
    }

    /*恢复*/
    function recover(obj,id){
        layer.confirm('确认要恢复吗？',function(index){
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已恢复!',{icon:1,time:1000});

            $.ajax({
                type: 'POST',
                url: "<?php echo url('intern/recover'); ?>",
                data: {'id':id},
                dataType: "json",
            })
        });
    }

    function selectAll(){
        var checkbox = document.getElementById("selectAll");
        var input = document.getElementsByName("one");

        console.log(input.length);
        if(checkbox.checked){
            for (var i=0;i<input.length ;i++ )
            {
                if(input[i].type=="checkbox")
                    input[i].checked = true;
            }
        }else{
            for (var i=0;i<input.length ;i++ )
            {
                if(input[i].type=="checkbox")
                    input[i].checked = false;
            }
        }
    }

    //批量删除提交
    function delSelected () {
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});

            var data = new Array();
            var j = 0;
            var input = document.getElementsByName("one");
            //遍历internList-body，获取所有子tr
            console.log(input.length);
            for (var i=0;i<input.length;i++)
            {
                console.log("i = " + i);
                console.log(input[i].checked);
                if(input[i].checked){
                    console.log("j = " + j);
                    data[j] = input[i].value;
                    console.log("id = " + data[j]);
                    j++;
                    //input[i].parentNode.parentNode.parentNode.removeChild(input[i].parentNode.parentNode);
                    //$(input[i]).parents("tr").remove();
                    $(input[i]).parents("tr").hide();
                }
            }

            console.log(data);

            $.ajax({
                type: 'POST',
                url: "<?php echo url('intern/deleteSelected'); ?>",
                data: {'json':JSON.stringify(data)},
                dataType: "json",
            })
        });
    }

    //批量删除提交
    function recoverAll () {
        layer.confirm('确认要恢复吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('恢复成功', {icon: 1});

            var data = new Array();
            var j = 0;
            var input = document.getElementsByName("one");
            //遍历internList-body，获取所有子tr
            console.log(input.length);
            for (var i=0;i<input.length;i++)
            {
                console.log("i = " + i);
                console.log(input[i].checked);
                if(input[i].checked){
                    console.log("j = " + j);
                    data[j] = input[i].value;
                    console.log("id = " + data[j]);
                    j++;
                    //input[i].parentNode.parentNode.parentNode.removeChild(input[i].parentNode.parentNode);
                    //$(input[i]).parents("tr").remove();
                    $(input[i]).parents("tr").hide();
                }
            }

            console.log(data);

            $.ajax({
                type: 'POST',
                url: "<?php echo url('intern/recoverSelected'); ?>",
                data: {'json':JSON.stringify(data)},
                dataType: "json",
            })
        });
    }

</script>

</body>
</html>