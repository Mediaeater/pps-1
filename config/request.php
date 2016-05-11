<?php
// I'm pretty sure this entire class implementation is useless
class Request
{
	public $type;
	
	function __construct()
	{	
		// get variables
		$get = array('type');

		foreach($get as $v)	
			$this->$v = $_GET[$v];
	}
}
?>