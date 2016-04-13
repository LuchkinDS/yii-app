<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($model->deleted_at === 0) { ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php } else { ?>
            <?= Html::a(Yii::t('app', 'Restore'), ['restore', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to restore this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'id_user',
            [
                'attribute' => 'username',
                'value' => $model->user->username,
            ],
            'title',
            'text:html',
            'created_at:date',
            // 'updated_at',
            [
                'attribute' => 'deleted_at',
                'value' => $model->deleted_at === 0 ? 
                    Yii::$app->formatter->asBoolean($model->deleted_at) : 
                    Yii::$app->formatter->asDate($model->deleted_at),
            ],
            // 'deleted_at:date',
            'visible:boolean',
        ],
    ]) ?>

</div>
