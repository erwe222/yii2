<?php
    use yii\helpers\Url;
    $menu_select = false;
?>

<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">
    <div class="menu_dropdown bk_2">
        <?php if(isset(Yii::$app->view->params['menus']) && !empty(Yii::$app->view->params['menus'])):?>
            <?php foreach (Yii::$app->view->params['menus'] as $_val):
                $dt_select = "class=''";
                $dd_block = '';
                if(!$menu_select && isset($_val['items']) && count($_val['items'] > 0) && array_key_exists(Yii::$app->view->params['url'],$_val['items'])){
                    $dt_select = "class='selected'";
                    $dd_block = 'style="display:block;"';
                    $menu_select = true;
                }
            ?> 
                <dl>
                    <dt <?php echo $dt_select;?> >
                    <i class="Hui-iconfont <?php echo $_val['icons']?>" style="font-size:18px;"></i> <?php echo $_val['menu_name']?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                    <dd <?php echo $dd_block;?>>
                        <ul>
                            <?php if(isset($_val['items']) && count($_val['items'] > 0)):?>
                                <?php foreach ($_val['items'] as $k=>$_v):?>
                                <li <?php if(Yii::$app->view->params['url'] == $k):?>class="current"<?php endif;?>>
                                    <a href="<?php echo Url::to([$_v['url']])?>" title="<?php echo $_v['menu_name']?>"><?php echo $_v['menu_name']?></a>
                                </li>
                                <?php endforeach;?>
                            <?php else:?>
                                <li><a href="jacascript:void(0)" >暂无列表</a></li>
                            <?php endif;?>
                        </ul>
                    </dd>
                </dl>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</aside>

<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->