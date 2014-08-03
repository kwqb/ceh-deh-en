<?php if ( ! defined('BASEPATH')) exit('No access');
class core_api extends MX_Controller {

	protected $get;
	protected $_apiuser;
	protected $allowed_method;
	protected $method;
	protected $core_mothod;
	protected $args;

	function __construct($param=array())
	{
		$this->get 				= array();
		$this->post 			= array();
		$this->delete 			= array();
		$this->put 				= array();
		$this->_apiuser 		= new stdClass();
		$this->allowed_method 	= array('purge');
		$this->core_mothod 		= array();
		$this->args 			= array();
	}

	public function _remap()
	{
		exit('No direct script access allowed');
	}

	public function set($key, $value)
	{
		$this->$key = $value;
	}

	public function get($key='')
	{
		return (isset($this->args[$key]))? $this->args[$key] : false;
	}

	/**
	 * Core of api
	 * authenticate the api keys, if the userid match, give them access
	 */
	public function auth()
	{
		if(  $this->_apiuser->id !== $this->get( VERB_ID ) )
			return FALSE;

		return TRUE;
	}

	/**
	 * Scanning verb that requested from client, 
	 * it will be our next running method
	 */
	public function scan_variable()
	{
		$this->method = $this->get(VERB_ENDPOINT);

		if( in_array($this->method, $this->allowed_method) )
		{
			$this->set_core_method();
			return TRUE;
		}

		return FALSE;
	}

	private function set_core_method()
	{
		$this->core_method = CORE_VERSION.'/core_'.$this->method;
	}

	public function run()
	{
		modules::run($this->core_method.'/validate');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */