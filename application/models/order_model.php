<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends MY_Model
{

	function __construct(){
		parent::__construct();
		$ci =& get_instance();
	}

}