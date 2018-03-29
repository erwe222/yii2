<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 前台会员管理 <span class="c-gray en">&gt;</span> 会员管理 </nav>


<div class="Hui-article">
    <article class="cl pd-20">
        <div class="text-c"> 
            <form action="javascript:void(0)" id="search-log-from">
                <input type="text" name="menu_name" placeholder="栏目"  class="input-text table-search-input">
                <button class="btn btn-success me-table-reload myEvent" data-type="search"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
                <button class="btn btn-success" type="reset"><i class="Hui-iconfont">&#xe66c;</i> 重置</button>
            </form>
        </div><br/>
        <div class="cl pd-5 bg-1 bk-gray"> 
        <span class="l"> 
            <a class="btn btn-danger radius myEvent" data-type="getCheckData"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
            <a class="btn btn-primary radius myEvent" data-type="getCheckLength" ><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a> 
            <a class="btn btn-primary radius btn-success myEvent"  data-type="refresh"><i class="Hui-iconfont">&#xe68f;</i> 刷新</a> 
        </span>
    </div>

    <div class="mt-10">
        <table id="demo" lay-filter="my-demo"></table>
    </div>
    </article>
</div>


<?php $this->beginBlock('javascript') ?>
<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="detail">查看</a>
  <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
</script>
<?php $this->endBlock() ?>
<?php \backend\assets\AppAsset::addScript($this,Yii::$app->request->baseUrl."/assets/public/js/showmanageloglist.js");?>
