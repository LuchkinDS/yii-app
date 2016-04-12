<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
 
<div class="news-item">
    <div class="panel panel-default">
        <div class="panel-heading"><?= Html::encode($model->title) ?></div>
        <div class="panel-body">
            <?= HtmlPurifier::process($model->text) ?>
        </div>
    </div>
</div>
