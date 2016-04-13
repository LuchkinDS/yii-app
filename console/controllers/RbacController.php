<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        
        // добавляем роль "user"
        $user = $auth->createRole('user');
        $auth->add($user);

        // добавляем роль "admin"
        // а также все разрешения роли "user"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);
        
        $auth->assign($admin, 1);
    }
}