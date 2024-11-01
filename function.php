<?php 
  function gd_get_manage_fl_list(){
		global $wpdb;
		$querystr 	  = "SELECT * FROM ".$wpdb->prefix."gd_manager WHERE type='fl' ORDER BY date DESC";
		$result 	  = $wpdb->get_results($querystr,ARRAY_A);  
		return $result;
  }

  function gd_get_total_fl_row($limit){
		global $wpdb;

		$mgt_arr = array();
		$querystr 	  = "SELECT id,file_name FROM ".$wpdb->prefix."gd_manager WHERE type='fl' ORDER BY date ASC";
		$result 	  = $wpdb->get_results($querystr,ARRAY_A);  
		if(count($result)>=$limit){
				$lmt = (count($result)-$limit);
				for($i=0;$i<=$lmt;$i++){
					$mgt_arr[] = $result[$i]['file_name'];
				}
				$del_limit = $lmt+1;
				gd_del_last_bkp($del_limit);
		}
		return $mgt_arr;
  }

  function gd_del_last_bkp($limit){
		global $wpdb;
		$querystr 	  = "DELETE FROM ".$wpdb->prefix."gd_manager WHERE type='fl' ORDER BY date ASC LIMIT ".$limit;
		$result 	  = $wpdb->query($querystr);  
  }

 function gd_delete_listById($id){
		global $wpdb;
		$querystr 	  = "DELETE FROM ".$wpdb->prefix."gd_manager WHERE id=".$id;
		$wpdb->query($querystr);  
 }

 function gd_get_total_db_row($limit){
		global $wpdb;

		$mgt_arr = array();
		$querystr 	  = "SELECT id,file_name FROM ".$wpdb->prefix."gd_manager WHERE type='db' ORDER BY date ASC";
		$result 	  = $wpdb->get_results($querystr,ARRAY_A);  
		if(count($result)>=$limit){
				$lmt = (count($result)-$limit);
				for($i=0;$i<=$lmt;$i++){
					$mgt_arr[] = $result[$i]['file_name'];
				}
				$del_limit = $lmt+1;
				gd_del_last_db_bkp($del_limit);
		}
		return $mgt_arr;

 }

 function gd_del_last_db_bkp($limit){
		global $wpdb;
		$querystr 	  = "DELETE FROM ".$wpdb->prefix."gd_manager WHERE type='db' ORDER BY date ASC LIMIT ".$limit;
		$result 	  = $wpdb->query($querystr);  
 }
 
 function gd_get_manage_db_list(){
		global $wpdb;
		$querystr 	  = "SELECT * FROM ".$wpdb->prefix."gd_manager WHERE type='db' ORDER BY date DESC";
		$result 	  = $wpdb->get_results($querystr,ARRAY_A);  
		return $result;
 }

function gd_format_bytes($a_bytes)
{
	if ($a_bytes < 1024) {
		return $a_bytes .' B';
	} elseif ($a_bytes < 1048576) {
		return round($a_bytes / 1024, 2) .' KiB';
	} elseif ($a_bytes < 1073741824) {
		return round($a_bytes / 1048576, 2) . ' MiB';
	} elseif ($a_bytes < 1099511627776) {
		return round($a_bytes / 1073741824, 2) . ' GiB';
	} elseif ($a_bytes < 1125899906842624) {
		return round($a_bytes / 1099511627776, 2) .' TiB';
	} elseif ($a_bytes < 1152921504606846976) {
		return round($a_bytes / 1125899906842624, 2) .' PiB';
	} elseif ($a_bytes < 1180591620717411303424) {
		return round($a_bytes / 1152921504606846976, 2) .' EiB';
	} elseif ($a_bytes < 1208925819614629174706176) {
		return round($a_bytes / 1180591620717411303424, 2) .' ZiB';
	} else {
		return round($a_bytes / 1208925819614629174706176, 2) .' YiB';
	}
}



?>