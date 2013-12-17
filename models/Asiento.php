<?php
require_once dirname(__FILE__) . '/../php-activerecord/ActiveRecord.php';
class Asiento extends ActiveRecord\Model
{
	static $table_name = 'asiento';

}
?>