<?php
	/*
	Plugin Name: WP Fixtures
	Plugin URI: https://github.com/jonjomckay/wp-fixtures
	Description: Plugin for storing sports fixtures in Wordpress, originally designed for netball
	Author: Jonjo McKay
	Version: 1.0
	Author URI: http://www.jonjomckay.com
	*/

	function wp_fixtures_install () {
		global $wpdb;
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); 

		$num = 0;
		$it_tables[$num]['table_name'] = $wpdb->prefix . 'wpf-fixtures';
		$it_tables[$num]['table_sql'] = "CREATE TABLE `" . $wpdb->prefix . "wpf-fixtures` (
				`id` INT NOT NULL ,
				`team` INT NULL ,
				`date` DATETIME NULL ,
				PRIMARY KEY (`id`)
			) ENGINE = InnoDB;"; 		

		$num++;
		$it_tables[$num]['table_name'] = $wpdb->prefix . 'wpf-teams';
		$it_tables[$num]['table_sql'] = "CREATE TABLE `" . $wpdb->prefix . "wpf-teams` (
				`id` INT NOT NULL ,
				`name` VARCHAR(70) NULL ,
				PRIMARY KEY (`id`) ,
				UNIQUE INDEX `name_UNIQUE` (`name` ASC)
			) ENGINE = InnoDB;";
			
		$num++;
		$it_tables[$num]['table_name'] = $wpdb->prefix . 'wpf-venues';
		$it_tables[$num]['table_sql'] = "CREATE TABLE `" . $wpdb->prefix . "wpf-venues` (
				`id` INT NOT NULL ,
				`name` VARCHAR(70) NULL ,
				`address` VARCHAR(120) NULL ,
				`city` VARCHAR(70) NULL ,
				`postcode` VARCHAR(15) NULL ,
				PRIMARY KEY (`id`) ,
				UNIQUE INDEX `postcode_UNIQUE` (`postcode` ASC) ,
				UNIQUE INDEX `address_UNIQUE` (`address` ASC)
			) ENGINE = InnoDB;";

		foreach($it_tables as $it_table) {
		if(!$wpdb->get_var("SHOW TABLES LIKE '{$it_table['table_name']}'")) {
		  $wpdb->query($it_table['table_sql']);
			}
		}
	}
	
	register_activation_hook(__FILE__,'wp_fixtures_install');
?>