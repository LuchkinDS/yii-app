<?php

namespace app\modules\posts\controllers;

use yii\web\Controller;
use common\models\Posts;

/**
 * Default controller for the `posts` module
 */
class PostController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Posts::find()->notDelete()->isVisible()->orderBy('updated_at DESC'),
            'pagination' => [
                // 'pageSize' => 3,
            ],
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
