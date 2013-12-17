<?php
require_once dirname(__FILE__) . '/../php-activerecord/ActiveRecord.php';
class Usuario extends ActiveRecord\Model
{
	static $table_name = 'usuario';

}
?>