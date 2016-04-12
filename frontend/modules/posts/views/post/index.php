<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $posts app\models\Posts */

?>
<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list',
    'layout' => "{items}\n{pager}",
    'options' => [
        'class' => 'posts-list',
        'id' => 'posts-list',
    ],
    'pager' => [
        'firstPageLabel' => '<<',
        'lastPageLabel' => '>>',
        'prevPageLabel' => '<',        
        'nextPageLabel' => '>',
        'maxButtonCount' => 5,
    ],
]); ?>

<script id="entry-template" type="text/x-handlebars-template">
<div class="posts-item">
    <div class="panel panel-default">
        <div class="panel-heading">{{title}}</div>
        <div class="panel-body">
            {{{text}}}
        </div>
    </div>
</div>
</script>