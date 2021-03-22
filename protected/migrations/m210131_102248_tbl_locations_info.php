<?php

class m210131_102248_tbl_locations_info extends CDbMigration
{
	public function up()
	{
        $this->createTable('tbl_locations_info', [
            'id' => 'INT AUTO_INCREMENT NOT NULL KEY',
            'location_id' => 'INt NOT NULL UNIQUE',
            'continent' => 'VARCHAR(255) NULL',
            'country_code' => 'VARCHAR(10) NULL',
            'country_flag' => 'VARCHAR(20) NULL',
            'country_capital' => 'VARCHAR(150) NULL',
            'country_phone' => 'VARCHAR(10) NULL',
            'country_neighbours' => 'VARCHAR(150) NULL',
            'region' => 'VARCHAR(100) NULL',
            'city' => 'VARCHAR(100) NULL',
            'asn' => 'VARCHAR(20) NULL',
            'org' => 'VARCHAR(255) NULL',
            'isp' => 'VARCHAR(255) NULL',
            'timezone' => 'VARCHAR(100) NULL',
            'timezone_name' => 'VARCHAR(150) NULL',
            'timezone_gmt' => 'VARCHAR(10) NULL',
            'currency' => 'VARCHAR(75) NULL',
            'currency_code' => 'VARCHAR(10) NULL',
            'currency_symbol' => 'VARCHAR(5) NULL',
            'currency_rates' => 'DOUBLE(11,8) NULL',
        ]);


        $this->addForeignKey(
            'fk-location-info-location-id',
            'tbl_locations_info',
            'location_id',
            'tbl_user_locations',
            'id',
            'CASCADE'
        );

	}

	public function down()
	{


        $this->dropForeignKey(
            'fk-location-info-location-id',
            'tbl_locations_info'
        );

        $this->dropTable('tbl_locations_info');
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