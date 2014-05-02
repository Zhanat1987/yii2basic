<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- BREADCRUMBS -->
<ul class="breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="<?php echo Yii::$app->homeUrl; ?>">
            Главная
        </a>
    </li>
<!--    --><?php //if (isset($this->params['breadcrumbs'])) : ?>
<!--        --><?php //foreach ($this->params['breadcrumbs'] as $breadcrumb) : ?>
<!--            <li>-->
<!--                --><?php //if (isset($breadcrumb['url'])) : ?>
<!--                    <a href="--><?php //echo Url::to($breadcrumb['url']); ?><!--">-->
<!--                        --><?php //echo Html::encode($breadcrumb['label']); ?>
<!--                    </a>-->
<!--                --><?php //else : ?>
<!--                    --><?php //echo Html::encode($breadcrumb['label']); ?>
<!--                --><?php //endif; ?>
<!--            </li>-->
<!--        --><?php //endforeach; ?>
<!--    --><?php //else : ?>
        <li>
            <?php echo Html::encode($this->title); ?>
        </li>
<!--    --><?php //endif; ?>
</ul>
<!-- /BREADCRUMBS -->