<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Alert;

#进度条组件
use yii\bootstrap\Progress;
?>
<style>
    p{background:#3C8DBC}
</style>
<h6>&nbsp;&nbsp;这是一个调试页面</h6><hr />


<div style="display:none;">
    <?= Html::tag('p', Html::encode("P标签  Html::tag('p', Html::encode('P标签'), ['class' => 'username'])  等价于 <p class='username'>P标签</p>"), ['class' => 'username']) ?> 
    <?= Url::remember(['product/view', 'id' => 42])?><br/>
    <?= Url::to(['site/index', 'src' => 'ref1', '#' => 'name']);?><br/>
    <?= Url::toRoute('site/index', true);?><br/>
    <?= Url::toRoute(['site/index', 'src' => 'ref1', '#' => 'name'],'https')?><br/><br/>
    <?= Url::to('images/logo.gif',true);?><br/>
    <?= Url::to('images/logo.gif','https');?>
</div>

<div style="width: 500px;height:500px;margin:0 auto;background: #ccc" id="test">
    as dfasd
    
<icon class='icon Hui-iconfont-apple'></icon>
<i class="Hui-iconfont Hui-iconfont-apple"></i>
</div>
    


<?php 
    # Yii flash的使用
//    Yii::$app->getSession()->setFlash('success', 'This is the message');
//    if( Yii::$app->getSession()->hasFlash('success') ) {
//	echo Alert::widget([
//		'options' => [
//			'class' => 'alert-success', //这里是提示框的class
//		],
//		'body' => Yii::$app->getSession()->getFlash('success'), //消息体
//	]);
//    }
?> 

<?php 
    #进度条组件
//    echo Progress::widget(['percent' => 60, 'label' => 'Progress 60%']);
?> 





<?php $this->beginBlock('javascript') ?>  
<script type="text/javascript">

</script>
<?php $this->endBlock() ?>

<?php 
$js = <<< JS
    $(function(){
        yii.confirm('这是提示信息！！！');
    })     
JS;


//$this->registerJs($js);

?>

<!--//调用方式,imageUrl为默认图地址-->
<!--['imageUrl'=>'/assets/public/images/upload.gif']-->
<?php //echo //\hyii2\avatar\AvatarWidget::widget(['imageUrl'=>'/assets/public/images/kpaint.png']); ?>