<?php

use yii\db\Migration;

class m160412_074434_create_posts extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer()->defaultValue(0)->notNull(),
            'visible' =>  $this->boolean()->defaultValue(false)->notNull(),
        ], $tableOptions);
        $this->createIndex('id_user_pk', '{{%posts}}', 'id_user');
        $this->addForeignKey('id_user_posts_fk', '{{%posts}}', 'id_user', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('id_user_posts_fk', '{{%posts}}');
        $this->dropTable('{{%posts}}');
    }
}
