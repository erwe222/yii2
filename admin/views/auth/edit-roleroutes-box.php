<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/assets/plug/layui/css/layui.css"  media="all">
    <style type="text/css">
        .cus-from{width:600px;height:300px;overflow-y:auto;}
    </style>
</head>
    <body >
        <div style="width:600px;height:600px;margin:0 auto;margin-top: 20px">
            <form class="layui-form cus-from">
                <div id="xtree1" class="xtree_contianer"></div>
            </form>
            <div class="div-btns">
                <input type="button" id="btn1" value="更新权限" class="layui-btn layui-btn-fluid" />
            </div>
        </div>
        
        <script src="/assets/plug/layui/layui.js" charset="utf-8"></script>
        <script src="/assets/custom/js/jquery.min.js" ></script>
        <script src="/assets/plug/layui/lay/modules/layui-xtree.js"></script>
        <script type="text/javascript">
            var json = [
                    {
                        title: "节点1", value: "jd1", data: [
                          { title: "节点1.1", checked: true, disabled: true, value: "jd1.1", data: [] }
                        , { title: "节点1.2", value: "jd1.2", checked: true, data: [] }
                        , { title: "节点1.3", value: "jd1.3", disabled: true, data: [] }
                        , { title: "节点1.4", value: "jd1.4", data: [] }
                        ]
                    }
                    , {
                        title: "节点2", value: "jd2", data: [
                          { title: "节点2.1", value: "jd2.1", data: [] }
                        , { title: "节点2.2", value: "jd2.2", data: [] }
                        , { title: "节点2.3", value: "jd2.3", data: [] }
                        , { title: "节点2.4", value: "jd2.4", data: [] }
                        ]
                    }
                    , { title: "节点3", value: "jd3", data: [] }
                    , { title: "节点4", value: "jd4", data: [] }
                    , {
                        title: "节点2", value: "jd2", data: [
                          { title: "节点2.1", value: "jd2.1", data: [] }
                        , { title: "节点2.2", value: "jd2.2", data: [] }
                        , { title: "节点2.3", value: "jd2.3", data: [] }
                        , { title: "节点2.4", value: "jd2.4", data: [] }
                        ]
                    }, {
                        title: "节点2", value: "jd2", data: [
                          { title: "节点2.1", value: "jd2.1", data: [] }
                        , { title: "节点2.2", value: "jd2.2", data: [] }
                        , { title: "节点2.3", value: "jd2.3", data: [] }
                        , { title: "节点2.4", value: "jd2.4", data: [
                                { title: "节点2.1", value: "jd2.1", data: [] }
                        , { title: "节点2.2", value: "jd2.2", data: [] }
                        , { title: "节点2.3", value: "jd2.3", data: [] }
                        , { title: "节点2.4", value: "jd2.4", data: [] }
                        ] }
                        ]
                    }, {
                        title: "节点2", value: "jd2", data: [
                          { title: "节点2.1", value: "jd2.1", data: [] }
                        , { title: "节点2.2", value: "jd2.2", data: [] }
                        , { title: "节点2.3", value: "jd2.3", data: [] }
                        , { title: "节点2.4", value: "jd2.4", data: [] }
                        ]
                    }, {
                        title: "节点2", value: "jd2", data: [
                          { title: "节点2.1", value: "jd2.1", data: [] }
                        , { title: "节点2.2", value: "jd2.2", data: [] }
                        , { title: "节点2.3", value: "jd2.3", data: [] }
                        , { title: "节点2.4", value: "jd2.4", data: [] }
                        ]
                    }, {
                        title: "节点2", value: "jd2", data: [
                          { title: "节点2.1", value: "jd2.1", data: [] }
                        , { title: "节点2.2", value: "jd2.2", data: [] }
                        , { title: "节点2.3", value: "jd2.3", data: [] }
                        , { title: "节点2.4", value: "jd2.4", data: [] }
                        ]
                    }
            ];
    //layui 的 form 模块是必须的
    layui.use(['form'], function () {
        var form = layui.form;

        var xtree1 = new layuiXtree({
            elem: 'xtree1'   //(必填) 放置xtree的容器，样式参照 .xtree_contianer
            , form: form     //(必填) layui 的 from
            , data: json     //(必填) json数据
        });

        $('#btn1').on('click',function(){
            var oCks = xtree1.GetChecked(); //这是方法
                var arr = [];
                for (var i = 0; i < oCks.length; i++) {
                    arr.push(oCks[i].value);
                }
        });
    });
</script>
    </body>
</html>