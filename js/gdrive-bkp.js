// JavaScript Document

  var pl_path   =[];
  var file_list =[];

 function gd_ontime_backup(path){
	var success = function(t){complete_backup_process(response);}
	var failure = function(t){ShowOnFailure(response);}
	var url     = path+"/gdrive-ajaxs.php";
	var pars 	= 'ajaxstype=ontimebackup';
	document.getElementById("bkp_loading").innerHTML ="<img src='"+path+"/images/ajax-loader.gif'  />Please wait.. Process Loading... ";
	var response = $.ajax({type: "post",url:url,data: pars,success: success});
	return false;
  }
  
  function complete_backup_process(t){
		var str = t.responseText;
		document.getElementById("bkp_loading").innerHTML =str;
		return false;
  }
  
  function gd_delete_filebkp_list(id){
		var success = function(t){complete_flbkp_del(response);}
		var failure = function(t){ShowOnFailure(response);}
		var url     = pl_path[0]+"/gdrive-ajaxs.php";
		var pars 	= 'ajaxstype=del_fl_bkp'+"&id="+id+"&file_name="+file_list[id];
		document.getElementById("ajax_loader"+id).innerHTML ="<img src='"+pl_path[0]+"/images/ajax-loader.gif'  />";
		var response = $.ajax({type: "post",url:url,data: pars,success: success});
		return false;

  }
  
  function complete_flbkp_del(t){
		var str = t.responseText;
		document.getElementById("manage_fl_list").innerHTML =str;
		return false;
  }
  
  
  function zipfileto_gdrive(id){
		var success = function(t){complete_movezip_to_gdrive(response);}
		var failure = function(t){ShowOnFailure(response);}
		var url     = pl_path[0]+"/gdrive-ajaxs.php";
		var pars 	= 'ajaxstype=move_to_gdrive'+'&file_name='+file_list[id];
		document.getElementById("mzip_loading").innerHTML ="<img src='"+pl_path[0]+"/images/ajax-loader.gif'  />Please wait.. Process Loading... ";
		var response = $.ajax({type: "post",url:url,data: pars,success: success});
		return false;
  }
  
  function complete_movezip_to_gdrive(t){
		var str = t.responseText;
		document.getElementById("mzip_loading").innerHTML = str;
		return false;
  }
  
  
  function gd_delete_dbbkp_list(id){
	  
		var success = function(t){complete_dbasebkp_del(response);}
		var failure = function(t){ShowOnFailure(response);}
		var url     = pl_path[0]+"/gdrive-ajaxs.php";
		var pars 	= 'ajaxstype=del_db_bkp'+"&id="+id+"&file_name="+file_list[id];
		document.getElementById("ajax_loader"+id).innerHTML ="<img src='"+pl_path[0]+"/images/ajax-loader.gif'  />";
		var response = $.ajax({type: "post",url:url,data: pars,success: success});
		return false;
  }
  
 function complete_dbasebkp_del(t){
		var str = t.responseText;
		document.getElementById("manage_db_list").innerHTML = str;
		return false;
 }
 
 function sql_to_gdrive(id){
		var success = function(t){complete_sql_to_gdrive(response);}
		var failure = function(t){ShowOnFailure(response);}
		var url     = pl_path[0]+"/gdrive-ajaxs.php";
		var pars 	= 'ajaxstype=sql_to_gdrive'+'&file_name='+file_list[id];
		document.getElementById("sql_loading").innerHTML ="<img src='"+pl_path[0]+"/images/ajax-loader.gif'  />Please wait.. Process Loading... ";
		var response = $.ajax({type: "post",url:url,data: pars,success: success});
		return false;
 }

 function complete_sql_to_gdrive(t){
		var str = t.responseText;
		document.getElementById("sql_loading").innerHTML = str;
		return false;
 }