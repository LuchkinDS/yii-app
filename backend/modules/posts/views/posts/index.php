<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Posts'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'id_user',
            'username',    
            'title',
            // 'text:ntext',
            'created_at:date',
            // 'updated_at',
            // 'deleted_at',
            [
                'attribute' => 'visible',
                'format' => 'boolean',
                'filter' => [
                    "0" => "Нет",
                    "1" => "Да",
                ],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {restore}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        if($model->deleted_at === 0) { // если пост не удален, позволяем удалить
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },
                    'restore' => function ($url, $model) {
                        if($model->deleted_at !== 0) { // если пост удален, позволяем востановить
                            return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', $url, [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to restore this item?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },
                ],
            ],
        ],
    ]); ?>
</div>
