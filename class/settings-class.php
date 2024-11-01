<?php 

class settings_option{

	  private function style_url(){
			  echo '<link rel="stylesheet" href="'.GBACKUP_PLUGIN_PATH.'/gd-css.css" type="text/css" media="screen" />';
	  }
	
	  private function js_url(){
			  echo'<script type="text/javascript" src="'.GBACKUP_PLUGIN_PATH.'/js/jquery.min.js"></script>';
			  echo'<script type="text/javascript" src="'.GBACKUP_PLUGIN_PATH.'/js/gdrive-bkp.js"></script>';
	  }

	  public function backup_options_page() {
	 
			$this->style_url();
				
			$options = get_option('google_drive_backup');
			?>
		
		<div class="wrap">
		  <?php if($options['token']==''){ ?>
		  <div  id="icon-index"  class="icon32"><br/>
		  </div>
		  <h2>Configure Google Account</h2>
		  <?php if($_GET['gd_error_msg']){ ?>
		  <div class="error_msg">
			<h3><?php echo $_GET['gd_error_msg']; ?></h3>
		  </div>
		  <?php } ?>
		  <?php if($_GET['gd_msg']){ ?>
		  <div >
			<h3><?php echo $_GET['gd_msg']; ?></h3>
		  </div>
		  <?php } ?>
		  <form action="<?php echo get_option("home"); ?>/wp-admin/admin.php?page=configure_google&action=auth" method="post">
			<table class="form-table">
			  <tbody>
			
			  <div>
				<h3 class="heading">Enter Your Google Account Details</h3>
			  </div>
			  
			  <p class="conf_account">Configure google account, you need to create Client ID & Client secret from the API section '<a href="https://code.google.com/apis/console/" target="_blank">Google API Console</a>' also use authorization redirecting url as <br/><strong> <?php echo admin_url( 'admin.php?page=configure_google&action=auth' ); ?></strong></p>
			
				<tr valign="top">
				  <th scope="row">Client ID</th>
				  <td><input name='client_id' type='text'  value='<?php echo $options['client_id']; ?>' /></td>
				</tr>
				<tr valign="top">
				  <th scope="row">Client secret</th>
				  <td><input name='client_secret' type='text' value='<?php echo $options['client_secret']; ?>' /></td>
				</tr>
			 
			  </tbody>
			  
			</table>
			<p class="submit">
			  <input name="settings_option" type="submit" class="button-secondary" value="Allow Access" />
			</p>
		  </form>
		  <?php }else{
			   
				$options = get_option('google_drive_backup');
				
				?>
		  <div  id="icon-index"  class="icon32"><br/>
		  </div>
		  <h2>Reset Configure Google Account</h2>
		  <?php if($_GET['gd_error_msg']){ ?>
		  <div class="error_msg">
			<h3><?php echo $_GET['gd_error_msg']; ?></h3>
		  </div>
		  <?php } ?>
		  <?php if($_GET['gd_msg']){ ?>
		  <div >
			<h3><?php echo $_GET['gd_msg']; ?></h3>
		  </div>
		  <?php } ?>
		  <table class="form-table">
			<tr>
			  <td><p>By clicking reset, you can reconfigure <strong>Google Account</strong></p>
				<div><a href="options-general.php?page=configure_google&action=reset" class="button-secondary">Reset Configure</a></div></td>
			<tr>
		  </table>
		  <?php } ?>
		</div>
		<?php
	}
 
	public function backup_to_google(){
	
			$this->style_url();
			$this->js_url();
	
		?>
			<div >
			  <div class="wrap">
				<div  id="icon-index" class="icon32"><br/>
				</div>
				<h2>BackUp</h2>
				<div id="bkp_loading" ></div>
				<?php if($_GET['gd_error_msg']){ ?>
				<div class="error_msg">
				  <h3><?php echo $_GET['gd_error_msg']; ?></h3>
				</div>
				<?php } ?>
				<?php if($_GET['gd_msg']){ ?>
				<div >
				  <h3><?php echo $_GET['gd_msg']; ?></h3>
				</div>
				<?php } ?>
				<form action="admin.php?page=backup_to_google&action=update&update=1" method="post">
				  <p class="submit"> On time Backup &nbsp;&nbsp;&nbsp;
					<input name="submit" type="submit" class="button-secondary" value="Backup" onclick="return gd_ontime_backup('<?php echo GBACKUP_PLUGIN_PATH; ?>');" />
				  </p>
				</form>
			  </div>
			</div>
			<?php
	}
	
	public function backup_settings(){

		$this->style_url();
		$sett_options = get_option('google_drive_backup_sett');
		?>
		<div >
		  <div class="wrap">
			<div  id="icon-index" class="icon32"><br/>
			</div>
			<h2>BackUp Settings</h2>
			<?php if($_GET['gd_error_msg']){ ?>
			<div class="error_msg">
			  <h3><?php echo $_GET['gd_error_msg']; ?></h3>
			</div>
			<?php } ?>
			<?php if($_GET['gd_msg']){ ?>
			<div >
			  <h3><?php echo $_GET['gd_msg']; ?></h3>
			</div>
			<?php } ?>
			<div>
			  <h3 class="heading">Backup Folder<span>  </span></h3>
			</div>
			<form action="admin.php?page=backup_settings&action=settings_update" method="post">
			  <table class="backup_setting">
				<tr>
					<td>
					 <div class="bkup_mail">Enter the Backup Folder Name :&nbsp;</div>
					 <div class="bkup_mail_select"><input name="gd_backup_name" id="gd_backup_name" value="<?php echo $sett_options['gd_backup_name']; ?>" />_timestamp</div>
				   </td>
				</tr>

				<tr>
				   <td>
					<p>
						<h3 class="heading">Mail Options <span></span></h3>
					</p>
					<div class="mail_int">
					  <div class="bkup_mail"> Enable Admin Notification Mail:</div>
					  <div class="bkup_mail_select">
					 <input   type="radio" name="gd_intimate_option" id="gd_intimate_option" checked="checked" value="1" />&nbsp;Yes <input  type="radio" name="gd_intimate_option" id="gd_intimate_mail" <?php if($sett_options['gd_intimate_option']==0){ ?> checked="checked" <?php  } ?> value="0" />&nbsp;No
					  </div>
					 </div> 
					  <div class="mail_int">
					  <div class="bkup_mail"> Custom Mail ID:</div>
					  <div class="bkup_mail_select">
						  <input  type="text" name="gd_mail" id="gd_mail"  value="<?php echo $sett_options['gd_mail']; ?>"/>
					  </div>
					</div>
				   <td>	
				</tr>

				<tr>
				  <td><p>
					<h3 class="heading">BackUp Schedule <span>( Schedule an automatic backup on your google drive)</span></h3>
					</p>
					<div class="dbase_backup">
					  <div class="db_bkup"> Set Time Intervel :</div>
					  <div class="db_select">
						<select name="backup_time" id="backup_time" >
						  <option  value="None">None</option>
						  <option <?php if($sett_options['backup_time']=='daily'){ ?> selected="selected"<?php } ?>   value="daily">Daily</option>
						  <option <?php if($sett_options['backup_time']=='weekly'){ ?> selected="selected"<?php } ?>  value="weekly">Weekly</option>
						  <option <?php if($sett_options['backup_time']=='monthly'){ ?> selected="selected"<?php } ?> value="monthly">Monthly</option>
						</select>
					  </div>
					</div></td>
				</tr>
				<tr>
				  <td><p>
					<h3 class="heading">Next Schedule</h3>
					</p>
					<?php 
										$scheduled_time = wp_next_scheduled( 'schedule_google_drive_backup' );
										if($scheduled_time){
											$time = date( __( "M j, Y \a\\t H:i:s", 'backup' ), $scheduled_time );
										}else{
											$time = "None";
										}
									?>
					<p class="next_schedule">Next Backup Scheduled for <?php echo $time; ?></p></td>
				</tr>
			  </table>
			  <p class="submit">
				<input name="submit" type="submit" class="button-secondary" value="Save" />
			  </p>
			</form>
		  </div>
		</div>
<?php
	
	}
	
	
	public function manage_database(){

	$this->style_url();
	$this->js_url();
	
	global $wpdb;
	$db_set = get_option("google_drive_database_sett");
	
	?>
	<div class="error_msg">
	  <h3><?php echo $_GET['gd_error_msg']; ?></h3>
	</div>
		<div >
		  <div class="wrap">
			<div  id="icon-index" class="icon32"><br/>
			</div>
			<h2>Manage Database</h2>
			<?php if($_GET['gd_error_msg']){ ?>
			<div class="error_msg">
			  <h3><?php echo $_GET['gd_error_msg']; ?></h3>
			</div>
			<?php } ?>
			<?php if($_GET['gd_msg']){ ?>
			<div >
			  <h3><?php echo $_GET['gd_msg']; ?></h3>
			</div>
			<?php } ?>
			<form action="admin.php?page=gd_manage_database&action=gd_mgt_db" method="post" class="form_backup">
			  <div>
				<h3 class="heading">Exclude Database Tables <span> ( Check this option if you want to exclude files from backup ) </span></h3>
			  </div>
			  <table class="backup_setting" cellpadding="0" cellspacing="0">
				<tr>
				  <td>
				  
				  	<?php 
						 $selected_table_arr = array();
						 $selected_table_arr =  @explode("|",$db_set['db_exclude']);
						
						$tables = $wpdb->get_results( "SHOW TABLES like '".$wpdb->prefix."%'", ARRAY_A );
						
						echo"<div class='exclude_table'>";
						foreach($tables as $table){
							$table = array_shift( array_values( $table ) );
							if(in_array($table,$selected_table_arr)){
								$checked = 'checked="checked"';
							}else{
								$checked ='';
							}
							echo '<p><input type="checkbox" name="db_exclude[]" '.$checked.' id="db_exclude" value="'.$table.'" />&nbsp;&nbsp; '.$table.'</p>';
						}
						echo"</div>";
						
					?>
				  </td>
				</tr>
				<tr>
				  <td><p>
					<h3 class="heading">Database Backup</h3>
					</p>
					<div class="database_backup">
					  <div class="db_bk"> Include Database into Backup :</div>
					  <div class="db_select">
						<input type="radio" checked="checked" name="gd_db_bkp" value="1"  />&nbsp;Yes &nbsp;
						<input type="radio" <?php if($db_set['gd_db_bkp']==0){ ?> checked="checked" <?php } ?> name="gd_db_bkp" value="0"  />
						&nbsp;No </div>
					</div></td>
				</tr>
				<tr>
				  <td><p>
					<h3 class="heading">Manage Database</h3>
					</p>
					<div class="database_backup">
					  <div class="db_bk"> Set Backup Limit :</div>
					  <div class="db_select">
						<select name="max_db_bkp" id="max_db_bkp" >
						  <option <?php if($db_set['max_db_bkp']=='1'){ ?> selected="selected" <?php } ?>   value="1">One</option>
						  <option <?php if($db_set['max_db_bkp']=='2'){ ?> selected="selected" <?php } ?> value="2">Two</option>
						  <option <?php if($db_set['max_db_bkp']=='3'){ ?> selected="selected" <?php } ?> value="3">Three</option>
						</select>
					  </div>
					</div></td>
				</tr>
				
				<tr>
				  <td>
					  <p class="submit">
							<input name="submit" type="submit" class="button-secondary" value="Save" />
					  </p>
				  </td>
				</tr>
				
			  </table>
			  <div id="manage_db_list">
			     <div id="sql_loading"></div><br/>
				  <?php  $this->db_manage_list();  ?>
			  </div>
			</form>
		  </div>
		</div>
<?php
	}
	
	
 public function manage_files(){
	
	$this->style_url();
	$this->js_url();
	
	$sett_options = get_option('google_drive_fl_sett');
	?>
	<div class="error_msg">
	  <h3><?php echo $_GET['gd_error_msg']; ?></h3>
	</div>
		<div >
		  <div class="wrap">
			<div  id="icon-index" class="icon32"><br/>
			</div>
			<h2>Manage Files</h2>

			<?php if($_GET['gd_error_msg']){ ?>
			<div class="error_msg">
			  <h3><?php echo $_GET['gd_error_msg']; ?></h3>
			</div>
			<?php } ?>
			<?php if($_GET['gd_msg']){ ?>
			<div >
			  <h3><?php echo $_GET['gd_msg']; ?></h3>
			</div>
			<?php } ?>
			<form action="admin.php?page=gd_manage_files&action=gd_mgt_fl" method="post" class="form_backup">
			  <div>
				<h3 class="heading">Exclude Files  <span> ( Check this option if you want to exclude files from backup )  </span></h3>
			  </div>
			  <table class="backup_setting" cellpadding="0" cellspacing="0">
				
				<tr>
				   <td><h4>wp-content Folder</h4></td>
				</tr>
				
				<tr>
				  <td><?php  
						$dummy_arr = array(".","..",'db','backup');
						$filename  = scandir(WP_CONTENT_DIR); 

					   if(count($filename)>0){
						 foreach($filename as $filename){ 
						  if(!in_array($filename,$dummy_arr)){
							  if(is_dir(WP_CONTENT_DIR."/".$filename)){
									$image_name = "/folder_open.png";
							  }else{
									$image_name = "/file.png";
							  }
							  
							  $exclude_backup_arr = @explode("|",$sett_options['exclude_backup']);
									  
								?>
									<div id="exclude">
									  <div id="exclude_bkup"> <img src="<?php echo GBACKUP_PLUGIN_IMAGE_PATH.$image_name; ?>"  /></div>
									  <div class="exclude_files"><?php echo $filename; ?></div>
									  <?php 
									$filepath = WP_CONTENT_DIR."/".$filename;
									$checked = in_array($filepath,$exclude_backup_arr)?'checked="checked"':'';
															?>
									  <div class="exclude_checkbox">
										<input type="checkbox" <?php echo $checked; ?>  name="exclude_backup[]"  value="<?php echo WP_CONTENT_DIR."/".$filename; ?>" />
									  </div>
									</div>
									<?php 
								   }
								 } 
							  }	
							?>
				  </td>
				</tr>
				
				<tr>
				   <td><h4>Wordpress Core Files</h4></td>
				</tr>
				
				<tr>
				  <td><?php  
						$dummy_arr = array(".","..","wp-content");
						$filename  = scandir(trim(WP_CONTENT_DIR,"wp-content")); 

					   if(count($filename)>0){
						 foreach($filename as $filename){ 
						  if(!in_array($filename,$dummy_arr)){
							  if(is_dir(trim(WP_CONTENT_DIR,"wp-content").$filename)){
									$image_name = "/folder_open.png";
							  }else{
									$image_name = "/file.png";
							  }
							  
							  $exclude_backup_arr = @explode("|",$sett_options['exclude_core_backup']);
									  
								?>
									<div id="exclude">
									  <div id="exclude_bkup"> <img src="<?php echo GBACKUP_PLUGIN_IMAGE_PATH.$image_name; ?>"  /></div>
									  <div class="exclude_files"><?php echo $filename; ?></div>
									   <?php 
										$filepath = trim(WP_CONTENT_DIR,"wp-content").$filename;
										$checked = in_array($filepath,$exclude_backup_arr)?'checked="checked"':'';
									   ?>
									  <div class="exclude_checkbox">
										<input type="checkbox" <?php echo $checked; ?>  name="exclude_core_backup[]"  value="<?php echo trim(WP_CONTENT_DIR,"wp-content").$filename; ?>" />
									  </div>
									</div>
									<?php 
								   }
								 } 
							  }	
							?>
				  </td>
				</tr>
				
				
				<tr>
				  <td><p>
					<h3 class="heading">Manage Files</h3>
					</p>
					<div class="database_backup">
					  <div class="db_bk"> Set Backup Limit :</div>
					  <div class="db_select">
						<select name="max_fl_bkp" id="max_fl_bkp" >
						  <option <?php if($sett_options['max_fl_bkp']=='1'){ ?> selected="selected" <?php } ?>   value="1">One</option>
						  <option <?php if($sett_options['max_fl_bkp']=='2'){ ?> selected="selected" <?php } ?> value="2">Two</option>
						  <option <?php if($sett_options['max_fl_bkp']=='3'){ ?> selected="selected" <?php } ?> value="3">Three</option>
						</select>
					  </div>
					</div></td>
				</tr>
				
				<tr>
				  <td>
						<p class="submit">
							<input name="submit" type="submit" class="button-secondary" value="Save" />
						</p>
				  </td>
				</tr>
			  </table>
			  <div id="manage_fl_list">
			      <div id="mzip_loading"></div><br/>
				  <?php $this->file_manage_list(); // manage file list function  ?>
			  </div>
			</form>
		  </div>
		</div>
<?php
}
	
 
 public function db_manage_list(){
     
		echo'<script language="javascript" type="text/javascript">
			pl_path[0] = "'.GBACKUP_PLUGIN_PATH.'";
		</script>';
	 
	    $table = new TableBuilder();
		$table->attributes = array("id" => "gd_manage_list","name" => "gd_manage_list");

		$column = new TableColumn("No", "id");
		$column->cellClass = "gd-id";
		$table->addColumn($column);
		
		$column = new TableColumn("Name", "file_name");
		$column->cellClass = "gd-file_name";
		$table->addColumn($column);
		
		$column = new TableColumn("Date", "date");
		$column->cellClass = "gd-date";
		$table->addColumn($column);
		
		$column = new TableColumn("Size", "file_size");
		$column->cellClass = "gd-file_size";
		$table->addColumn($column);
	
		$column = new TableColumn("Move to Google Drive", "gdrive");
		$column->cellClass = "gd-gdrive";
		$table->addColumn($column);
	
		$column = new TableColumn("Action", "action");
		$column->cellClass = "wpp-small action-links";
		$column->headerClass = "action-links";		
		$table->addColumn($column);		
	
		$row     = array();
		$options = get_option('google_drive_backup');
		$key     = array("id","file_name","date","file_size","gdrive","action");
		$rowdata = gd_get_manage_db_list();;
		
		if(count($rowdata)>0){
				$i= 1;
				foreach($rowdata as $rowdata){
					$row[$key[0]] = $i;
					$row[$key[1]] = $rowdata[$key[1]];
					$row[$key[2]] = $rowdata[$key[2]];
					$row[$key[3]] = $rowdata[$key[3]];
					if(!empty($options['token'])){
					   $movetodrive ="<div class='movetogd' onclick='return sql_to_gdrive(".$rowdata[$key[0]].");' >Move</div>";
					}else{
						$movetodrive ="<div class='no_movetogd' ><a href='admin.php?page=configure_google'>Configure Properly</a></div>";
					}
					$row[$key[4]] = $movetodrive;
					$identify = $rowdata[$key[0]];
					$row[$key[5]] = '<a href="'.GBACKUP_DB_URL.'/'.$rowdata[$key[1]].'" >Download</a>&nbsp;|&nbsp;'.'<a onclick="return gd_delete_dbbkp_list('.$rowdata[$key[0]].');" ><span id="ajax_loader'.$rowdata[$key[0]].'"></span>Delete</a></td>';
				echo'<script language="javascript" type="text/javascript">
					file_list['.$rowdata[$key[0]].'] = "'.$rowdata[$key[1]].'";
				</script>';
				$i++;	
				$table->addRow($row);
				}
		
		}else{
				$row['file_size'] = "No Backup List in Local Server";
				$table->addRow($row);
		}
		echo $table->toString();
	 
 }	
	
 public function file_manage_list(){
     
		echo'<script language="javascript" type="text/javascript">
			pl_path[0] = "'.GBACKUP_PLUGIN_PATH.'";
		</script>';
	 
	    $table = new TableBuilder();
		$table->attributes = array("id" => "gd_manage_list","name" => "gd_manage_list");

		$column = new TableColumn("No", "id");
		$column->cellClass = "gd-id";
		$table->addColumn($column);
		
		$column = new TableColumn("Name", "file_name");
		$column->cellClass = "gd-file_name";
		$table->addColumn($column);
		
		$column = new TableColumn("Date", "date");
		$column->cellClass = "gd-date";
		$table->addColumn($column);
		
		$column = new TableColumn("Size", "file_size");
		$column->cellClass = "gd-file_size";
		$table->addColumn($column);
	
		$column = new TableColumn("Move to Google Drive", "gdrive");
		$column->cellClass = "gd-gdrive";
		$table->addColumn($column);
	
		$column = new TableColumn("Action", "action");
		$column->cellClass = "wpp-small action-links";
		$column->headerClass = "action-links";		
		$table->addColumn($column);		
	
		$row = array();
		$options = get_option('google_drive_backup');
		$key     = array("id","file_name","date","file_size","gdrive","action");
		$rowdata = gd_get_manage_fl_list();;
		
		if(count($rowdata)>0){
				$i= 1;
				foreach($rowdata as $rowdata){
					$row[$key[0]] = $i;
					$row[$key[1]] = $rowdata[$key[1]];
					$row[$key[2]] = $rowdata[$key[2]];
					$row[$key[3]] = $rowdata[$key[3]];
					
					if(!empty($options['token'])){
					   $movetodrive  = "<div class='movetogd' onclick='return zipfileto_gdrive(".$rowdata[$key[0]].");' >Move</div>";
					}else{
						$movetodrive = "<div class='no_movetogd' ><a href='admin.php?page=configure_google'>Configure Properly</a></div>";
					}
					
					$row[$key[4]] = $movetodrive;
					$identify = $rowdata[$key[0]];
					$row[$key[5]] = '<a href="'.GBACKUP_BACKUP_URL.'/'.$rowdata[$key[1]].'" >Download</a>&nbsp;|&nbsp;'.'<a onclick="return gd_delete_filebkp_list('.$rowdata[$key[0]].');" ><span id="ajax_loader'.$rowdata[$key[0]].'"></span>Delete</a></td>';
				echo'<script language="javascript" type="text/javascript">
					file_list['.$rowdata[$key[0]].'] = "'.$rowdata[$key[1]].'";
				</script>';
				$i++;	
				$table->addRow($row);
				}
		
		}else{
				$row['file_size'] = "No Backup List in Local Server";
				$table->addRow($row);
		}
		echo $table->toString();
	 
 }	
	
	
 }

class settings_menu extends settings_option{

	function backup_menu() {
			add_menu_page('Configure Google', 'Configure Google', 'manage_options', 'configure_google',array(&$this,'backup_options_page'),'','8'); 
			add_submenu_page('configure_google', 'Backup Settings', 'Backup Settings', 8, 'backup_settings', array(&$this,'backup_settings'));
			add_submenu_page('configure_google', 'Manage Database', 'Manage Database', 8, 'gd_manage_database', array(&$this,'manage_database'));
			add_submenu_page('configure_google', 'Manage Files', 'Manage Files', 8, 'gd_manage_files', array(&$this,'manage_files'));
			add_submenu_page('configure_google', 'On Time Backup', 'On Time Backup', 8, 'backup_to_google', array(&$this,'backup_to_google'));
	}

}

?>
