<?php
 
require_once dirname(__FILE__) . '/../php-activerecord/ActiveRecord.php';

class db 
{
	static function dbini(){
		ActiveRecord\Config::initialize(function($cfg)
		{
			 $cfg->set_model_directory(dirname(__FILE__) . '/../models');
		     $cfg->set_connections(array(
		    'development' => 'mysql://root:1234@localhost/puntorealdelfresno'));
			
			//pass mysql zjzsS5ASQJ6Ujuma
			// ec2-54-211-29-143.compute-1.amazonaws.com
		});
	}
}
?>
