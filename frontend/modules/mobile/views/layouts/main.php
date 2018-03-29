<?php
use yii\helpers\Html;
use yii\helpers\Url;
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
            
        </head>
        
        <body class="hold-transition skin-blue sidebar-mini">
            <?php $this->beginBody() ?>
                <!--<h1>当前是手机端模块</h1>-->
                <?= $content ?>
                
            <?php $this->endBody() ?>
        </body>
    </html>
<?php $this->endPage() ?>
