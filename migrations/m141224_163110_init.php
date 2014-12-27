<?php

use yii\db\Schema;
use wolfguard\block\migrations\Migration;

class m141224_163110_init extends Migration
{
    public function up()
    {
        $this->createTable('{{%block}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' DEFAULT NULL',
            'code' =>  Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_TEXT . ' DEFAULT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createIndex('ix_block_name', '{{%block}}', 'name');
        $this->createIndex('ix_block_code', '{{%block}}', 'code', true);
    }

    public function down()
    {
        $this->dropTable('{{%block}}');
    }

}
