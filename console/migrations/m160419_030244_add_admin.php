<?php

use yii\db\Migration;

class m160419_030244_add_admin extends Migration
{
    public function up()
    {
        $this->insert('{{%user}}', [
            'username' => 'demo',
            'email' => 'demo@example.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('demo'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'created_at' => time('U'),
            'updated_at' => time('U'),
        ]);
    }

    public function down()
    {
        echo "m160419_030244_add_admin cannot be reverted.\n";

        return false;
    }
}
