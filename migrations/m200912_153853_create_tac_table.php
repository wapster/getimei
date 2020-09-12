<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tac}}`.
 */
class m200912_153853_create_tac_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tac}}', [
            'id' => $this->primaryKey(),
            'tac' => $this->string(14)->notNull(),
            'model_xinit' => $this->string(256)->notNull(),
            'model_omsk' => $this->string(256)->notNull()->defaultValue(0),
            'info_omsk' => $this->string(256)->notNull()->defaultValue(0),
            'standart' => $this->string(16)->notNull()->defaultValue(0),
            'sim' => $this->string(32)->notNull()->defaultValue(0),
            'gsm' => $this->string(256)->notNull()->defaultValue(0),
            'imei1' => $this->string(64)->notNull()->defaultValue(0),
            'imei2' => $this->string(64)->notNull()->defaultValue(0),
            'form' => $this->string(8)->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tac}}');
    }
}
