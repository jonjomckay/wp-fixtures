<?php
	/*
	Plugin Name: WP Fixtures
	Plugin URI: https://github.com/jonjomckay/wp-fixtures
	Description: Plugin for storing sports fixtures in Wordpress, originally designed for netball
	Author: Jonjo McKay
	Version: 1.0
	Author URI: http://www.jonjomckay.com
	*/
	
	global $wp_fixtures_db_version;
	$wp_fixtures_db_version = "1.0";
	
	register_activation_hook(__FILE__, 'wp_fixtures_install');

	function wp_fixtures_install () {
	   global $wpdb;
	   global $wp_fixtures_db_version;

	   if($wpdb->get_var("show tables like '" . $wpdb->prefix . 'wpf-fixtures' . "'") != $wpdb->prefix . 'wpf-fixtures') {
		  
			$sql = "CREATE TABLE " . $wpdb->prefix . 'wpf-fixtures' . " (
			  id INT NOT NULL,
			  team INT NULL,
			  date DATETIME NULL,
			  PRIMARY KEY  (id)
			);";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		
		if($wpdb->get_var("show tables like '" . $wpdb->prefix . 'wpf-teams' . "'") != $wpdb->prefix . 'wpf-teams') {
			
			$sql = "CREATE TABLE " . $wpdb->prefix . 'wpf-teams' . " (
				id INT NOT NULL,
				name VARCHAR(70) NULL,
				PRIMARY KEY  (id),
				UNIQUE KEY name_UNIQUE (name ASC)
			);";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		
		if($wpdb->get_var("show tables like '" . $wpdb->prefix . 'wpf-venues' . "'") != $wpdb->prefix . 'wpf-venues') {
			
			$sql = "CREATE TABLE " . $wpdb->prefix . 'wpf-venues' . " (
				id INT NOT NULL,
				name VARCHAR(70) NULL,
				address VARCHAR(120) NULL,
				city VARCHAR(70) NULL,
				postcode VARCHAR(15) NULL,
				PRIMARY KEY  (id),
				UNIQUE KEY postcode_UNIQUE (postcode ASC),
				UNIQUE KEY address_UNIQUE (address ASC)
			);";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}

		$welcome_text = "Installation completed!";

		$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'text' => $welcome_text ) );

		add_option("wp_fixtures_db_version", $wp_fixtures_db_version);
	}
?>