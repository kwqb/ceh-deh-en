<?php if ( ! defined('BASEPATH')) exit('No access');
class Media {

	protected $args 		= array();
	protected $MediaPath 	= "";
	protected $MediaType	= "";
	public $output			= "";
	
	function __construct()
	{
		//load some model / database conection in here?
	}

	public function set_resource($key, $value)
	{
		$this->$key = $value;
	}

	public function get_resource($key='')
	{
		return (isset($this->args[$key]))? $this->args[$key] : false;
	}

	public function init()
	{
		foreach ($this->args as $key => $value) {
			$this->$key = $value;
		}
		unset($this->args);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */