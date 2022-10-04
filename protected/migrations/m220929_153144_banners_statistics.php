<?php

class m220929_153144_banners_statistics extends CDbMigration
{
	public function up()
	{
        $this->createTable('tbl_banner_statistics', [
            'id' => 'INT AUTO_INCREMENT NOT NULL KEY',
            'banner_id' => 'INT NOT NULL',
            'view_count' => 'INT DEFAULT 0',
            'click_count' => 'INT DEFAULT 0',
            'status' => 'INT DEFAULT 0',
            'date_created' => 'datetime',
            'date_updated' => 'datetime',
        ]);
	}

	public function down()
	{
        $this->dropTable('tbl_banner_statistics');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}