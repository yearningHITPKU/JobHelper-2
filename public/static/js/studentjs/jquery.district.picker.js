/**
* version 1.00
* Copyright (c) 2010- The End of Time, zzldn@163. com
* jquery1.7+
*
* parameter describe
* jQuery.extend({
          url:'',              //请求省市区的 url
          level:1,            //1省；2市；3区县；4详细地址
          partition:'$',  //省市区分割
          interval:'#',      //详细地址分割
          translate:false //是否翻译，默认是填写不是翻译
          callback:null		//回调函数，最后执行
     });
*
* USAGE:
* 1.write:
* <input type="hidden" value="110000$110100">
* <input id='district' name="address" type="text">
* $("#district").districtpicker ({
*          url:'districtPicker.hl',
*          level:4
*     });
*
* 2.translate:
* <label class="address">140000$140300$140321#总行路12号 </label>
* $(".address").districtpicker ({
*          url:'districtPicker.hl',
*          translate:true
*     });
*
*/
jQuery.fn.districtpicker = function(d) {
    var k = [];
    d = jQuery.extend({
        url: "",
        level: 1,
        global: false,//是否有国家
        partition: "$",
        interval: "#",
        translate: !1,
        callback: function() {
            return ! 1
        },
        onchange: function(obj) {
            return ! 1
        }
    },
    d || {});
    4 < d.level && (d.level = 4);
    var l = function(a) {
        return 2 >= a.toString().length || "00" == a.toString().substring(a.toString().length - 2) ? !1 : !0
    };
    d.url && $.ajax({
        url: d.url,
        async: !1,
        dataType: "json",
        success: function(a) {
            $.each(a,
            function(a, d) {
                0 == d.parentId ? d.level = 1 : l(d.id) ? d.level = 3 : d.level = 2;
                k.push(d)
            })
        }
    });
    $(this).addClass("district");
    return this.each(function() {
        var a = [],
        b = $(this),
        skip = false,
        h = function(f) {
            var c = f.text();
            c || (c = f.val());
            c && (c = c.split(d.interval), $.each(c[0].split(d.partition),
            function(f, c) {
                $.each(k,
                function(f, d) {
                    d.id == c && a.push(d.name)
                })
            }), f.text(a.join("") + (void 0 != c[1] ? c[1] : "")))
        };
        if (d.translate) h(b);
        else {
            var e = b.prev();
            if(e.length<=0){
              e = b;
            }
            var c = $("<div class='panel'><div class='panel-top'><span></span><div class='dp-btn'><span class='home'></span><span class='back'></span><span class='confirm'></span></div></div><div class='panel-contents'><ul></ul></div>");
            b.after(c).attr("readonly", "readonly");
            4 == d.level && (h = b.clone(!1), h.attr("id", "district-detail").attr("name", "district-detail").attr("class", "district-detail").removeAttr("readonly"), h.bind("keyup",
            function() {
                var a = $(this);
                if (1 > b.val().length) b.addClass("district-tip"),
                a.val("");
                else if (b.removeClass("district-tip"), null != e && void 0 != e && "" != e.val()) {
                    var c = e.val().split(d.interval);
                    e.val(c[0] + d.interval + a.val())
                }
            }), b.after(h));
            //触发隐藏的hidden标签mouseover事件修改选中地区
            e.bind("mouseover", function() {
                if(a.length > 0){
                    return;
                }
                var f = e.val().split(d.interval);
                $.each(f[0].split(d.partition),
                function(b, c) {
                    $.each(k,
                    function(b, d) {
                        if(d.id == c){
                            if(isNaN(d.id)){//d.id不是数字
                                var gj = $.extend({},d);
                                var line = gj.name.indexOf('-');
                                gj.name = gj.name.substring(line + 1);
                                a.push(gj);
                            } else {
                                a.push(d);
                            } 
                            return false;                               
                        }                            
                    })
                });
                0 == a.length ? c.addLabel(0) : (g(), c.addLabel(a[a.length - 1].parentId), b.val(c.find("div.panel-top span:first").text()), void 0 != f[1] && b.next().val(f[1]));
                skip = true;
            });            
            b.bind("click",
            function() {                
                var a = $(this).offset();
                var formH = c.parents('form').outerHeight();
                if(formH && a.top > formH){
                    c.css({bottom: '40px'}).slideDown("fast");
                } else {
                    c.slideDown("fast").offset({
                        left: a.left,
                        top: a.top + b.outerHeight()
                    });
                }

                $("body").bind("mousedown", function(a) {
                    a.target == b[0] || a.target == c[0] || 0 < $(a.target).parents("div.panel").length || (c.find("span.confirm").click(), $("body").unbind("mousedown"))
                })
            });
            c.find("div.dp-btn span").hover(function() {
                $(this).css({
                    "border-radius": "4px",
                    "-webkit-border-radius":"4px",
                    "-moz-border-radius":"4px",
                    "-o-border-radius":"4px",
                    "background-color": "#eee"
                })
            },
            function() {
                $(this).css({
                    border: "none",
                    "background-color": "#fff"
                })
            });
            c.find("span.home").click(function() {
                c.addLabel(0);
                a.length = 0;
                g()
            });
            c.find("span.back").click(function() {
                1 <= a.length && a.pop();
                0 == a.length ? c.addLabel(0) : c.addLabel(a[a.length - 1].id);
                g()
            });
            c.find("span.confirm").click(function() {
                null != e && void 0 != e && e.val(m());
                b.prev().val(m());
                //20170517取消选择层级限制
                skip = true;
                if(a.length < (3 < d.level ? 3 : d.level)) {
                  if(a.length === 0 || skip || a.length >= d.level){
                    //skip = false;
                    b.removeClass("district-tip")
                    .val(c.find("div.panel-top span:first").text())
                    .trigger('blur');
                    c.fadeOut("fast");
                  } else {
                    b.addClass("district-tip").val("").trigger('blur');
                  }
                } else {
                  b.removeClass("district-tip")
                  .val(c.find("div.panel-top span:first").text())
                  .trigger('blur');
                  c.fadeOut("fast");
                }
                //上面代码出自此段代码(嵌套三元 (b.addClass("district-tip"), b.val(""), b.trigger('blur'))这种写法还能执行方法 )
                // a.length < (3 < d.level ? 3 : d.level) ?
                // a.length === 0 || a.length >= d.level ?
                // (b.removeClass("district-tip"), c.fadeOut("fast"), b.val(c.find("div.panel-top span:first").text()), b.trigger('blur')) :
                // (b.addClass("district-tip"), b.val(""), b.trigger('blur') ) :
                // (b.removeClass("district-tip"), c.fadeOut("fast"), b.val(c.find("div.panel-top span:first").text()), b.trigger('blur'))
                d.onchange(b);
            });
            c.addLabel = function(a) {
                skip = false;
                if(l(a)){
                    skip = true;
                    c.find("span.confirm").click();
                } else {
                    var liArray = [];
                    c.find("div.panel-contents ul").children().remove();
                    $.each(k, function(d, b) {
                        if (b.parentId == a) {
                            var $li = $("<li><label></label></li>");
                            var $label = $li.find("label");
                            if ('CN' == b.id) {
                                $label.css({'font-weight': 'bold', 'color': '#a2000d'});                                
                            }
                            $label.attr({"id": b.id, "parentId": b.parentId}).text(b.name).click(function() {
                                n(b);
                            });
                            liArray.push($li[0]);
                        }
                    });
                    if (liArray) {
                        c.find("div.panel-contents ul").append(liArray);
                    } else {
                        skip = true;
                        c.find("span.confirm").click();
                    }
                    
                }
            };
            var n = function(b) {
                skip = false;
                a = $.grep(a,
                function(a, c) {
                    return a.id != b.id && a.id != "710000"
                });
                if ("710000" == b.id)
                d.global ? (2 <= a.length && a.pop(), a.push(b)) : (1 <= a.length && a.pop(), a.push(b)),
                g(),
                skip = true,
                c.find("span.confirm").click();
                else if ("110000" == b.parentId || "120000" == b.parentId || "310000" == b.parentId || "500000" == b.parentId || "810000" == b.parentId || "820000" == b.parentId)
                d.global ? (3 <= a.length && a.pop(), a.push(b)) : (2 <= a.length && a.pop(), a.push(b)),
                g(),
                skip = true,
                c.find("span.confirm").click();
                else if (d.global) {//有国家
                    if(isNaN(b.id)){//并且b.id不是数字
                        //复制当前选中国家对象
                        var gj = $.extend({},b);
                        var line = gj.name.indexOf('-');
                        gj.name = gj.name.substring(line + 1);
                        a.pop(),                        
                        a.push(gj),
                        g();
                        if('CN' == b.id){//选择中国则继续选择
                            c.addLabel(b.id);
                        } else {
                            skip = true,
                            c.find("span.confirm").click();
                        }
                    } else {
                        var lastChildLi = $.grep(k, function(o, i) {
                            return o.parentId == a[a.length-1].id;
                        });
                        var e = 3 < d.level ? 3 : d.level;
                        if(a.length == e && lastChildLi.length <= 0){
                            a.pop();
                            a.push(b);
                            g();
                        } else if(a.length-1 < e){
                            a.push(b);
                            g();
                        }
                        a.length-1 == e ? (a.pop(), a.push(b), g(), c.find("span.confirm").click()) : c.addLabel(b.id);
                    }
                } else {
                    var lastChildLi = $.grep(k, function(o, i) {
                        if(a.length > 0){
                            return o.parentId == a[a.length-1].id;
                        }
                        return [];
                    });
                    var e = 3 < d.level ? 3 : d.level;
                    if(a.length + 1 == e && lastChildLi.length <= 0){
                        a.pop();
                        a.push(b);
                        g();                        
                    } else if(a.length < e){
                        a.push(b);
                        g();
                    }
                    a.length == e ? (a.pop(), a.push(b), g(), c.find("span.confirm").click()) : c.addLabel(b.id);
                }
            },
            g = function() {
                var b = [];
                $.each(a,
                function(a, c) {
                    b.push(c.name)
                });
                c.find("div.panel-top span:first").text(b.join(""))
            },
            m = function() {
                var b = [];
                $.each(a,
                function(a, c) {
                    b.push(c.id)
                });
                return b.join(d.partition)
            }; (function() {
                if (null == e || void 0 == e || "" == e.val()) c.addLabel(0);
                else {
                    var f = e.val().split(d.interval);
                    $.each(f[0].split(d.partition),
                    function(b, c) {
                        $.each(k,
                        function(b, d) {
                            if(d.id == c){
                                if(isNaN(d.id)){//d.id不是数字
                                    var gj = $.extend({},d);
                                    var line = gj.name.indexOf('-');
                                    gj.name = gj.name.substring(line + 1);
                                    a.push(gj);
                                } else {
                                    a.push(d);
                                } 
                                return false;                               
                            }                            
                        })
                    });
                    0 == a.length ? c.addLabel(0) : (g(), c.addLabel(a[a.length - 1].parentId), b.val(c.find("div.panel-top span:first").text()), void 0 != f[1] && b.next().val(f[1]));
                    skip = true;
                }
            })();
            d.callback()
        }
    })
};
