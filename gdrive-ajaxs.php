<?php 
	$root = dirname(dirname(dirname(dirname(__FILE__))));
	if (file_exists($root.'/wp-load.php')) {
		require_once($root.'/wp-load.php');
	} else {
		require_once($root.'/wp-config.php');
	}

	global $wpdb;
	$wpdb->prefix;
	switch($_POST['ajaxstype']){
	 case 'ontimebackup':
			$bkp    = new gd_take_backup('ontime_backup');
			$backup = $bkp->schedule_time_backup();
	 break;	
	 
	 case 'del_fl_bkp':
			gd_delete_listById($_POST['id']);
			$dir = GBACKUP_PLUGIN_BACKUPFOLDER_PATH."/".$_POST['file_name'];
			@unlink( $dir );
			$dbkp = new settings_option;
			$dbkp->file_manage_list();
	 break;
	 
	 case 'move_to_gdrive':
			$file_path = GBACKUP_PLUGIN_BACKUPFOLDER_PATH."/".$_POST['file_name'];	
			$bkp    = new gd_take_backup('ontime_backup');
			$backup = $bkp->movezip_to_googledrive($file_path, $_POST['file_name']);
	 break;
	 
	 case 'del_db_bkp':
			gd_delete_listById($_POST['id']);
			$dir = GBACKUP_PLUGIN_DBFOLDER_PATH."/".$_POST['file_name'];
			@unlink( $dir );
			$dbkp = new settings_option;
			$dbkp->db_manage_list();
	 break;
	 
	 
	 case 'sql_to_gdrive':
			$file_path = GBACKUP_PLUGIN_DBFOLDER_PATH."/".$_POST['file_name'];	
			$bkp    = new gd_take_backup('ontime_backup');
			$backup = $bkp->movezip_to_googledrive($file_path, $_POST['file_name']);
	 break;
	 	
	}
?>