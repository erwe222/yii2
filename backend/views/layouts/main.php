<?php
use yii\helpers\Html;

//判断是否是登录页面
if (Yii::$app->controller->action->id === 'login') {
    echo $this->render('main-login',['content' => $content]);
} else {
    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
        
        <head>
            <meta charset="<?= Yii::$app->charset ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?= Html::csrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
            <link href='/assets/public/static/h-ui.admin/skin/default/skin.css' rel='stylesheet' id='skin'>
        </head>
        
        <body class="hold-transition skin-blue sidebar-mini">
            <?php $this->beginBody() ?>

                <!--头部布局文件-->
                <?= $this->render('header.php') ?>

                <!--导航栏布局文件-->
                <?= $this->render('left.php') ?>

                <!--主体内容布局文件-->
                <?= $this->render('content.php',['content' => $content]) ?>
                
                <script type="text/javascript">
                    window.jQuery || document.write("<script src='/assets/lib/jquery/1.9.1/jquery.min.js'>"+"<"+"/script>");
                </script>
                
            <?php $this->endBody() ?>
            
            
            <?=$this->blocks['javascript']?>
        </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
