<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m190917_113333_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
	        'id_users' => $this->primaryKey(),
	        'login' => $this->string(50)->notNull(),
	        'password_hash' => $this->string(500)->notNull(),
	        'group_type' => $this->string(50),
        ]);
	    $this->insert('{{%users}}', [
		    'login' => 'test',
		    'password_hash' => '$2y$13$yddTOVJDyi5nZ3CMZC2CFOkaKk8StdEtFZ.CQIbLmX336j9EOLn1S',
		    'group_type' => 'admin'
	    ]);
	    $this->insert('{{%users}}', [
		    'login' => 'user1',
		    'password_hash' => '$2y$13$.tyrla9I1Uuk.q5.1d7PBu2HzZ1eTQ5EB6SKMw7N50h1t6J7ryDeK',
		    'group_type' => 'user'
	    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
