<?php
/*
Plugin Name: wp-google-drive
Version: 2.2
Description: Backup your WordPress website to Google Drive.
Author: Securenext Softwares WP Team, Malarvizhi Krishnan
Plugin URI: http://www.securenext.com/
http://www.securenext.com/hire-dedicated-programmers.php
*/

class backup_activate{

	function backup_activate() {
			// Check for compatibility
			add_action( 'plugins_loaded', array( $this, 'init' ), 8 );
		
			global $wpdb;
			
			$table_name = $wpdb->prefix."gd_manager";
			if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
						$sql = "CREATE TABLE `$table_name` (
						 	  `id` int(10) unsigned NOT NULL auto_increment,
							  `file_name` varchar(255),
							  `file_size` varchar(200),
							  `type` varchar(100),
							  `date` datetime,
							  PRIMARY KEY (`id`)
					    ) ";
					 $wpdb->query($sql);
			}
	}
	
	// Add custom schedule intervals
	
	function cron_intervals( $schedules ) {
			$schedules['weekly'] = array(
				'interval' => 604800,
				'display' => __('Once Weekly')
			);
			$schedules['monthly'] = array(
				'interval' => 2635200,
				'display' => __('Once a Month')
			);
			return $schedules;
	}
	
	function init(){
		$this->start();
		$this->includes();
		
		$bkp_update  = new backup_schedule;
		$take_backup = new gd_take_backup;
		$oauth  	 = new google_oauth;
		$menu  	     = new settings_menu;
		$settings  	 = new google_drive_settings;

		add_filter( 'cron_schedules', array(&$this,'cron_intervals') );
		add_action('init', array(&$bkp_update,'schedule_backup_time')); 
		add_action('schedule_google_drive_backup', array(&$take_backup,'schedule_time_backup') );
		add_action('init', array(&$oauth,'backup_auth'));
		add_action('init', array(&$settings,'settings_option'));
		add_action('admin_menu',array(&$menu,'backup_menu'));
	}
	
	function start(){
		global $wpdb;
		define('GBACKUP_PLUGIN_PATH',WP_PLUGIN_URL.'/wp-google-drive'); 
		define('GBACKUP_PLUGIN_CLASS_PATH',WP_PLUGIN_URL.'/wp-google-drive/class');
		define('GBACKUP_PLUGIN_IMAGE_PATH',WP_PLUGIN_URL.'/wp-google-drive/images');
		define('GBACKUP_PLUGIN_BACKUPFOLDER_PATH',WP_CONTENT_DIR.'/backup');
		define('GBACKUP_PLUGIN_DBFOLDER_PATH',WP_CONTENT_DIR.'/db');
		define('GBACKUP_BACKUP_URL',get_option("home").'/wp-content/backup');
		define('GBACKUP_DB_URL',get_option("home").'/wp-content/db');
		define('GBACKUP_CONTENT_URL',get_option("home").'/wp-content/');
		define('GBACKUP_PREFIX',$wpdb->prefix);
		define('GBACKUP_FILE_PATH', dirname( __FILE__ ) );
	}

	function includes(){
		require_once(GBACKUP_FILE_PATH.'/function.php' );
		require_once(GBACKUP_FILE_PATH.'/class/notify-class.php' );
		require_once(GBACKUP_FILE_PATH.'/lib/gd-sql.php' );
		require_once(GBACKUP_FILE_PATH.'/lib/gd-tablebuilder.php' );
		require_once(GBACKUP_FILE_PATH.'/class/db-backup-class.php' );
		require_once(GBACKUP_FILE_PATH.'/class/backup-class.php' );
		require_once(GBACKUP_FILE_PATH.'/class/settings-class.php' );
		require_once(GBACKUP_FILE_PATH.'/class/google-oauth-class.php' );
		require_once(GBACKUP_FILE_PATH.'/class/zip-class.php' );
	}

}

$bkp = new backup_activate;
register_activation_hook(__FILE__,array( $bkp,'backup_activate'));