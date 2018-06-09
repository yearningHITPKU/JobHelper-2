<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"/home/xww/workspace/JobHelper/public/../application/admin/view/user/user_list.html";i:1528204438;s:71:"/home/xww/workspace/JobHelper/application/admin/view/public/header.html";i:1528204438;s:72:"/home/xww/workspace/JobHelper/application/admin/view/public/base_js.html";i:1528204438;}*/ ?>
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
              <a><cite>用户管理</cite></a>
              <a><cite>用户列表</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">
            ဂ
        </i>
    </a>
</div>
<div class="x-body">
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delSelected()">
            <i class="layui-icon">&#xe640;</i>
            批量删除
        </button>
        <a href="<?php echo url('user/save',['id'=>'-']); ?>" class="layui-btn layui-btn-normal" id="selpart"><i class="layui-icon">&#xe605;</i>导出选中</a>
        <a href="<?php echo url('user/save',['id'=>-1]); ?>" class="layui-btn layui-btn-warm"><i class="layui-icon">&#xe601;</i>导出全部</a>

        <!--<button class="layui-btn" onclick="question_add('添加问题','question-add.html','600','500')">
            <i class="layui-icon">&#xe608;</i>
            添加
        </button>-->
        <span class="x-right" style="line-height:40px">
                    共有数据：<?php echo $userNum; ?> 条
                </span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <input type="checkbox" id="selectAll" name="all" value="all" onclick="selectAll()">
            </th>
            <th>
                序号
            </th>
            <th>
                学号
            </th>
            <th>
                姓名
            </th>
            <th>
                操作
            </th>
        </tr>
        </thead>
        <tbody id="internList-body">
        <?php if(is_array($user_list) || $user_list instanceof \think\Collection || $user_list instanceof \think\Paginator): if( count($user_list)==0 ) : echo "" ;else: foreach($user_list as $key=>$vo): ?>
        <tr>
            <td>
                <input type="checkbox" value=<?php echo $vo['id']; ?> name="one">
            </td>
            <td>
                <?php echo $vo['id']; ?>
            </td>
            <td>
                <?php echo $vo['uid']; ?>
            </td>
            <td>
                <?php echo $vo['name']; ?>
                <!--<u style="cursor:pointer" onclick="question_show()">-->
                <!--<u style="cursor:pointer">
                    <a target="_blank" href="<?php echo url('front/intern/detail', ['id'=>$vo['id']]); ?>" target="_blank">
                        <?php echo $vo['name']; ?>
                    </a>
                </u>-->
            </td>
            <td class="td-manage">
                <a title="编辑" href="javascript:;" onclick="user_edit('编辑','/admin/user/user_edit',<?php echo $vo['id']; ?>,'400','300')" class="ml-5" style="text-decoration:none">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                <!--<a title="编辑" href="javascript:;" onclick="user_edit(this,<?php echo $vo['id']; ?>,<?php echo $vo['uid']; ?>)" class="ml-5" style="text-decoration:none">
                    <i class="layui-icon">&#xe642;</i>
                </a>-->
                <a title="删除" href="javascript:;" onclick="question_del(this,<?php echo $vo['id']; ?>)"
                   style="text-decoration:none">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>

    <!--<div id="page"></div>        layui自带分页器-->
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
<script src="/static/admin/js/x-layui.js"></script>
<script>
    $('input[type="checkbox"]').change(function(){
        var check = $(this).is(":checked");
        var link = $("#selpart").attr("href");
        var value = $(this).val();
        if(check){
            var pos = link.indexOf(".");
            var newlink = link.substring(0,pos)+"-"+$(this).val()+link.substring(pos)
            $("#selpart").attr("href",newlink);
            // alert($("#selpart").attr("href"));
        }else{
            var newlink = link.substring(0,link.indexOf(value)-1)+link.substring(link.indexOf(value)+1);
            $("#selpart").attr("href",newlink);
            // alert(newlink)
        }
    });
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

    /*删除*/
    function question_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});

            $.ajax({
                type: 'POST',
                url: "<?php echo url('User/deleteOneUser'); ?>",
                data: {'id':id},
                dataType: "json",
                // success: function (data) {
                //     if (data.status == 0){
                //         alert(data.message);
                //         window.location.href = "<?php echo url('index/index'); ?>"
                //     }else{
                //         alert(data.message);
                //         window.location.href = "<?php echo url('login/index'); ?>"
                //     }
                // }
            })
        });
    }

    //编辑
    function user_edit (title,url,id,w,h) {
        if (title == null || title == '') {
            title=false;
        };
        if (url == null || url == '') {
            url="404.html";
        };
        if (w == null || w == '') {
            w=800;
        };
        if (h == null || h == '') {
            h=($(window).height() - 50);
        };
        url = url + '?id=' + id;
        layer.open({
            type: 2,
            area: [w+'px', h +'px'],
            fix: false, //不固定
            maxmin: true,
            shadeClose: true,
            shade:0.4,
            title: title,
            content: url
        });
        //x_admin_show(title,url,w,h);
    }

    /*function user_edit (obj,id,uid){
        $.ajax({
            type: 'POST',
            url: "<?php echo url('User/user_edit'); ?>",
            data: {'id':id, 'uid':uid},
            dataType: "json",
            success: function (data) {
                if (data.status == 0){
                    alert(data.message);
                    window.location.href = "<?php echo url('index/index'); ?>"
                }else{
                    alert(data.message);
                    window.location.href = "<?php echo url('user/user_edit1'); ?>"
                }
            }
        })
    }*/

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
                url: "<?php echo url('user/deleteSelected'); ?>",
                data: {'json':JSON.stringify(data)},
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

    /*置顶*/
    function stick(obj,id){
        layer.confirm('确认要置顶吗？',function(index){
            //发异步删除数据
            //$(obj).parents("tr").remove();
            layer.msg('已置顶!',{icon:1,time:1000});

            $.ajax({
                type: 'POST',
                url: "<?php echo url('intern/stick'); ?>",
                data: {'id':id},
                dataType: "json",
                // success: function (data) {
                //     if (data.status == 0){
                //         alert(data.message);
                //         window.location.href = "<?php echo url('index/index'); ?>"
                //     }else{
                //         alert(data.message);
                //         window.location.href = "<?php echo url('login/index'); ?>"
                //     }
                // }
            })
        });
    }

    function stick_cancel(obj,id){
        layer.confirm('确认要取消置顶吗？',function(index){
            //发异步删除数据
            //$(obj).parents("tr").remove();
            layer.msg('已取消!',{icon:1,time:1000});

            $.ajax({
                type: 'POST',
                url: "<?php echo url('intern/stick_cancel'); ?>",
                data: {'id':id},
                dataType: "json",
                // success: function (data) {
                //     if (data.status == 0){
                //         alert(data.message);
                //         window.location.href = "<?php echo url('index/index'); ?>"
                //     }else{
                //         alert(data.message);
                //         window.location.href = "<?php echo url('login/index'); ?>"
                //     }
                // }
            })
        });
    }

</script>

</body>
</html>