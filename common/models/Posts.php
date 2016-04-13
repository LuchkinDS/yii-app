<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\models\User;

/**
 * This is the model class for table "{{%posts}}".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $title
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property integer $visible
 *
 * 
 * @property User $user
 */
class Posts extends \yii\db\ActiveRecord
{
    const EVENT_POST_PUBLISHED = 'pubishedPost';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%posts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['id_user', 'created_at', 'updated_at', 'deleted_at', 'visible'], 'integer'],
            [['visible'], 'filter', 'filter' => function($value) {
                return (int)$value;
            }],
            [['deleted_at'], 'default', 'value' => 0],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_user' => Yii::t('app', 'Id User'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'visible' => Yii::t('app', 'Visible'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
    
    public function getUsername()
    {
        return $this->user->username;
    }

    public function behaviors() 
    { 
        return [ 
            [ 
                'class' => TimestampBehavior::className(), 
                'attributes' => [ 
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'], 
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at', 
                ], 
                'value' => function() { 
                    return time('U'); 
                }, 
            ], 
        ]; 
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->setAttributes([
                    'id_user' => Yii::$app->user->identity->id,
                ]);
            }
            return true;
        }
        return false;
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if ($this->visible === 1 && $this->deleted_at === 0) {
            $this->trigger(self::EVENT_POST_PUBLISHED);
        }
    }

    public function softDelete()
    {
        if (!$this->hasAttribute('deleted_at') && !$this->hasProperty('deleted_at')) {
            throw new \yii\base\InvalidConfigException(sprintf('`%s` has no attribute named `%s`.', get_class($this), 'deleted'));
        }
        
        $this->setAttributes(['deleted_at' => time('U')]);
        return $result = $this->update(false, ['deleted_at']);
    }
    
    public function restore()
    {
        if (!$this->hasAttribute('deleted_at') && !$this->hasProperty('deleted_at')) {
            throw new \yii\base\InvalidConfigException(sprintf('`%s` has no attribute named `%s`.', get_class($this), 'deleted'));
        }
        $this->setAttributes(['deleted_at' => 0]);
        return $this->update(false, ['deleted_at']);
    }
    
    /**
     * @inheritdoc
     * @return PostsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostsQuery(get_called_class());
    }
}
