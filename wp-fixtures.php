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
	$wp_fixtures_db_version = "1.2";
	
	register_activation_hook(__FILE__, 'wp_fixtures_install');
	add_action('admin_menu', 'wp_fixtures_admin_menu');

	function wp_fixtures_install () {
	   global $wpdb;
	   global $wp_fixtures_db_version;
	   
	   $installed_ver = get_option( "wp_fixtures_db_version" );
	   
	   if( $installed_ver != $wp_fixtures_db_version ) {
		  
			$sql = "CREATE TABLE '" . $wpdb->prefix . "wpf-fixtures' (
			  `id` INT NOT NULL AUTO_INCREMENT,
			  `team` INT NULL,
			  `date` DATETIME NULL,
			  PRIMARY KEY  (`id`)
			);";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		
			$sql = "CREATE TABLE '" . $wpdb->prefix . "wpf-teams' (
				`id` INT NOT NULL AUTO_INCREMENT,
				`name` VARCHAR(70) NULL,
				PRIMARY KEY  (`id`),
				UNIQUE KEY name_UNIQUE (`name` ASC)
			);";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		
			$sql = "CREATE TABLE '" . $wpdb->prefix . "wpf-venues' (
				`id` INT NOT NULL AUTO_INCREMENT,
				`name` VARCHAR(70) NULL,
				`address` VARCHAR(120) NULL,
				`city` VARCHAR(70) NULL,
				`postcode` VARCHAR(15) NULL,
				PRIMARY KEY  (`id`),
				UNIQUE KEY postcode_UNIQUE (`postcode` ASC),
				UNIQUE KEY address_UNIQUE (`address` ASC)
			);";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		
			update_option("wp_fixtures_db_version", $wp_fixtures_db_version);
		}
	}
	
	function wp_fixtures_admin_menu() {
		add_menu_page('Fixtures', 'Fixtures', 4, 'wp-fixtures-menu', 'wp_fixtures_options', '', 11);
		add_submenu_page('wp-fixtures-menu', 'Add Fixtures', 'Add Fixtures', 4, 'wp-fixtures-menu-fixtures', 'wp_fixtures_fixtures');
		add_submenu_page('wp-fixtures-menu', 'Add Teams', 'Add Teams', 4, 'wp-fixtures-menu-teams', 'wp_fixtures_teams');
		add_submenu_page('wp-fixtures-menu', 'Add Venues', 'Add Venues', 4, 'wp-fixtures-menu-venues', 'wp_fixtures_venues');
	}
	
	function wp_fixtures_options() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}

		echo '<div class="wrap">';
		echo '<p>Here is where the form would go if I actually had options.</p>';
		echo '</div>';
	}
	
	function wp_fixtures_fixtures() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}

		echo '<div class="wrap">';
		echo '<p>Add fixtures...</p>';
		echo '</div>';
	}
	
	function wp_fixtures_teams() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}

		require('wp-fixtures-teams.php');
	}
	
	function wp_fixtures_venues() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}

		echo '<div class="wrap">';
		echo '<p>Add venues...</p>';
		echo '</div>';
	}
	
?>