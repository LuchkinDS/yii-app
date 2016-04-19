<?php

namespace app\components;

use yii\base\BootstrapInterface;
use yii\base\Event;
use common\models\Posts;
use yii\helpers\ArrayHelper;
use Yii;
use ElephantIO\Exception\ServerConnectionFailureException;

/**
 * Description of PostPublisher
 *
 * @author luchkinds
 */
class PostPublisher implements BootstrapInterface {
    public function bootstrap($app) {
        Event::on(Posts::class, Posts::EVENT_POST_PUBLISHED, [$this, 'postPublished']);
    }
    
    public function postPublished(Event $event)
    {
        $data = ArrayHelper::toArray($event->sender);
        try {
            Yii::$app->elephantio->emit('post', $data);
        } catch (ServerConnectionFailureException $exc) {
            Yii::$app->session->setFlash('publisher_error', Yii::t('app', 'post publisher server not launched'));
        }
    }
}
