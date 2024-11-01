<?php 
 
class create_zip{  


	public function addtozip( $source, $destination, $exclude = array() ) { 
	
		if ( !file_exists( $source ) ) {
			return false;
		}
	
		$zip = new ZipArchive();
		if ( $res = $zip->open( $destination, ZIPARCHIVE::CREATE ) != true ) {
			return false;
		}
	
		$source = str_replace( '\\', '/', realpath( $source ) );
	
		if ( is_dir( $source ) === true ) {
			$files = $this->dir_file_list( $source, $exclude, true );
	
			foreach ( $files as $file ) {
				$file = str_replace( '\\', '/', realpath( $file ) );
				if ( is_dir( $file ) === true ) {
					$zip->addEmptyDir( str_replace( $source . '/', '', $file . '/' ) );
				}
				else if ( is_file( $file ) === true ) {
					$zip->addFromString( str_replace( $source . '/', '', $file ), file_get_contents( $file ));
				} 
			}
		}
		else if (is_file($source) === true) {
			$zip->addFromString(basename($source), file_get_contents($source));
		}
	
		return $zip->close();
	}
	
	
  public function dir_file_list($base_path, $exclude = array(), $recursive = true) {
		$base_path = rtrim($base_path, "/") . "/";
	
		if ( !is_dir( $base_path ) ) {
			return false;
		}
	
		$exclude_files = array( ".", "..", ".DS_Store", ".svn",'backup' ); 

		$result_list = array();
	
		if ($folder_handle = opendir($base_path)) {
			while ( false !== ( $filename = readdir( $folder_handle ) ) ) {
				if ( !in_array( $filename, $exclude_files ) && !in_array( $base_path . $filename, $exclude ) ) {
					
					if ( is_dir( $base_path . $filename . "/" ) ) {
						$result_list[] = $base_path . $filename;
						if( $recursive ) {
							$temp_list = $this->dir_file_list( $base_path . $filename . "/", $exclude, $recursive);
							foreach ( $temp_list as $item )
								$result_list[] = $item;
						}
					} else {
						$result_list[] = $base_path . $filename;
					}
				}
			}
			
			closedir($folder_handle);
			
			return $result_list;
		}
	}

}

?>