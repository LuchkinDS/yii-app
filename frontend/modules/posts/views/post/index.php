<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $posts app\models\Posts */

?>
<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list',
    'layout' => "{items}\n{pager}",
    'pager' => [
        'firstPageLabel' => '<<',
        'lastPageLabel' => '>>',
        'prevPageLabel' => '<',        
        'nextPageLabel' => '>',
        'maxButtonCount' => 5,
    ],
]); ?>
