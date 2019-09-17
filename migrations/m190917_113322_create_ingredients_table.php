<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredients}}`.
 */
class m190917_113322_create_ingredients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ingredients}}', [
	        'id_ingredients' => $this->primaryKey(),
	        'name_ingredients' => $this->string(50)->notNull(),
	        'hided_ingredients' => $this->tinyInteger(1)->defaultValue(0),
	        'deleted_ingredients' => $this->tinyInteger(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ingredients}}');
    }
}
