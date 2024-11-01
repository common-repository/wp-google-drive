<?php 

  class take_db_backup{
  
  		private $db_manage_array;
		
		private $bkp_name;
		
		function __construct($bkp_name='') {
			$this->bkp_name = $bkp_name;
		}
		
		
		public function get_database_backup(){
				global $wpdb;
				$file_name = time().".sql";
				
				if(!empty($this->bkp_name)){
					$file_name = $this->bkp_name."_".$file_name;
				}
				
				$this->db_manage_array = get_option('google_drive_database_sett'); // list database manager result
				$this->databases_backup($file_name);
				$this->manage_db_list($file_name);
				return $file_name;
		}
		
		private function databases_backup($file_name) {
				global $wpdb;
				$prifix = $wpdb->prefix;
				
				$exclude_tables_arr = array();
				$exclude_tables_arr =  $this->exclude_tables_list();
				
				$dump_file = GBACKUP_PLUGIN_DBFOLDER_PATH."/".$file_name;
				$db = fopen( $dump_file, 'wb' );
				if ($db){
				
				    $this->file_to_write($db, "/**\n");
					$this->file_to_write( $db, " http://www.securenext.com *\n" );
					$this->file_to_write( $db, " */\n\n" );
					$this->file_to_write( $db, "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n" );
					$this->file_to_write( $db, "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n" );
					$this->file_to_write( $db, "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n" );
					$this->file_to_write( $db, "/*!40101 SET NAMES " . DB_CHARSET . " */;\n" );
					$this->file_to_write( $db, "/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;\n" );
					$this->file_to_write( $db, "/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;\n" );
					$this->file_to_write( $db, "/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;\n\n" );
					$tables = $wpdb->get_results( "SHOW TABLES like '".$prifix."%'", ARRAY_A );
				
					if (!empty( $tables ) ){
						foreach ( $tables as $table_array ) {
							$table = array_shift( array_values( $table_array ) );
						
							  if(!in_array($table,$exclude_tables_arr)){
							  
									$create = $wpdb->get_var( "SHOW CREATE TABLE " . $table, 1 );
									
									$this->file_to_write( $db, "/* Dump of table `" . $table . "`\n" );
									$this->file_to_write( $db, " * ------------------------------------------------------------*/\n\n" );
									
									$this->file_to_write( $db, "DROP TABLE IF EXISTS `" . $table . "`;\n\n" . $create . ";\n\n" );
						
									$data = $wpdb->get_results("SELECT * FROM `" . $table . "`", ARRAY_A );
						
									if ( ! empty( $data ) ) {
										$this->file_to_write( $db, "LOCK TABLES `" . $table . "` WRITE;\n" );
										if ( strpos( $create, 'MyISAM' ) !== false )
											$this->file_to_write( $db, "/*!40000 ALTER TABLE `".$table."` DISABLE KEYS */;\n\n" );
										foreach ( $data as $entry ) {
											foreach ( $entry as $key => $value ) {
												if ( $value === NULL )
													$entry[$key] = "NULL";
												elseif ( $value === "" || $value === false )
													$entry[$key] = "''";
												elseif ( !is_numeric( $value ) )
													$entry[$key] = "'" . mysql_real_escape_string($value) . "'";
											}
											$this->file_to_write( $db, "INSERT INTO `" . $table . "` ( " . implode( ", ", array_keys( $entry ) ) . " ) VALUES ( " . implode( ", ", $entry ) . " );\n" );
										}
										if ( strpos( $create, 'MyISAM' ) !== false )
											$this->file_to_write( $db, "\n/*!40000 ALTER TABLE `".$table."` ENABLE KEYS */;" );
										$this->file_to_write( $db, "\nUNLOCK TABLES;\n\n" );
									}
							}
					   }	
					}    
				
					$this->file_to_write( $db, "/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;\n" );
					$this->file_to_write( $db, "/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;\n" );
					$this->file_to_write( $db, "/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;\n" );
					$this->file_to_write( $db, "/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\n" );
					$this->file_to_write( $db, "/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\n" );
					$this->file_to_write( $db, "/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;\n" );
				
					fclose( $db );
					return true;
				
				}
				return false;
		}	
		
		private function file_to_write($db,$command=''){
			 return fwrite( $db, $command );
		}

    
	    private function exclude_tables_list(){
		    $tables = array();
	 		$tables = @explode("|",$this->db_manage_array['db_exclude']);
			return $tables;
		} 
		
		private function manage_db_list($filename){
		
				global $wpdb;
		
				$limit     =  $this->db_manage_array['max_db_bkp'];  // user assign limit
				$rm_lists  =  gd_get_total_db_row($limit);  // manage table rows
				foreach($rm_lists as $rm_list){
					$this->removedir(GBACKUP_PLUGIN_DBFOLDER_PATH.'/'.$rm_list); /// remove dir files 
				}
		
				$size = filesize( GBACKUP_PLUGIN_DBFOLDER_PATH."/".$filename );
				$data = array();
				$data['file_name'] = $filename;
				$data['file_size'] = gd_format_bytes($size);
				$data['type']      = 'db';
				$data['date']      = date("Y-m-d H:i:s");
				
				$tablename  = $wpdb->prefix."gd_manager";
				$query      = arrayToSQLInsert($tablename,$data); // insert backup history
				$insert     = $wpdb->query($query);
		
		}
		
		private function removedir( $dir ) {
				@unlink( $dir );
		}
		
  	
  }


?>