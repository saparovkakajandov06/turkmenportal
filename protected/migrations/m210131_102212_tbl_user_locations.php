<?php

class m210131_102212_tbl_user_locations extends CDbMigration
{
	public function up()
	{
        $this->createTable('tbl_user_locations', [
            'id' => 'INT AUTO_INCREMENT NOT NULL KEY',
            'ip' => 'VARCHAR(20) NOT NULL UNIQUE',
            'country' => 'VARCHAR(100) NULL',
            'latitude' => 'DOUBLE(11,8)',
            'longitude' => 'DOUBLE(11,8)',
            'date_created' => 'datetime',
            'date_updated' => 'datetime',
        ]);

//        $this->createIndex(
//            'idx-user-locations-ip',
//            'tbl_user_locations',
//            'ip'
//        );
	}

	public function down()
	{
        $this->dropTable('tbl_user_locations');

//        $this->dropIndex(
//            'idx-user-locations-ip',
//            'tbl_user_locations',
//            'ip'
//        );
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