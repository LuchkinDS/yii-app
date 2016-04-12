<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Posts]].
 *
 * @see Posts
 */
class PostsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Posts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Posts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function notDelete()
    {
        return $this->andWhere(['deleted_at' => 0]);
    }
    
    public function isVisible()
    {
        return $this->andWhere(['visible' => true]);
    }
}
