<?php

namespace app\models;

/**
 * Description of User
 *
 * @author luchkinds
 */

/*
 * 
 * @property Role $role
 * @property AuthAssignment $authAssignment
 * 
 */
class User extends \common\models\User {
    
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    public function rules() 
    {
        $rules = parent::rules();
        return array_merge($rules, [
            [['username', 'email'], 'filter', 'filter' => 'trim'],
            [['username', 'email'], 'required'],
            [['username', 'email'], 'unique'],
            ['email', 'email'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'string', 'max' => 255],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
        ]);
    }
    
    public function getAuthAssignment()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id']);
    }
    
    public function getRole()
    {
        return $this->authAssignment->item_name;
    }
    
    public function setRole($value)
    {
        $this->authAssignment->setAttributes(['item_name' => $value]);
        $result = $this->authAssignment->update(false, ['item_name']);
        return $result;
    }
}
