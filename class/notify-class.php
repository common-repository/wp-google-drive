<?php 

   class notify_message{
  
  		var $page;
		var $message;
  
			function __construct($page='',$message='') {
				$this->page = $page;
				$this->message = $message;
			}

			function Gdrive_error(){
				header( 'Location: '.admin_url( 'admin.php?page='.$this->page.'&gd_error_msg='.$this->message));
				exit;
			}

			function Gdrive_message(){
				header( 'Location: '.admin_url( 'admin.php?page='.$this->page.'&gd_msg='.$this->message));
				exit;
			}
  }


?>