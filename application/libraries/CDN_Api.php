<?php if ( ! defined('BASEPATH')) exit('No access');
class CDN_API {

	public $_apiuser;
	private $allowed_endpoint;
	public $endpoint;
	private $node_endpoint;
	protected $args;
	private $method_endpoint;

	function __construct($param=array())
	{
		$this->_apiuser 		= new stdClass();
		$this->node_endpoint 	= array();

		$this->set_allowed_endpoint();
	}

	private function set_allowed_endpoint()
	{
		//next, get the allowed endpoint from database. so we can easlily manage it
		$this->allowed_endpoint = array('purge');
	}

	public function set($key, $value)
	{
		$this->$key = $value;
	}

	/**
	 * Core of api
	 * authenticate the api keys, if the userid match, give them access
	 */
	public function auth()
	{
		if(  ! is_object($this->_apiuser) || $this->_apiuser->id !== $this->{VERB_ID} )
			return FALSE;

		return TRUE;
	}

	/**
	 * Scanning verb that requested from client, 
	 * it will be our next running method
	 */
	public function scan_variable()
	{
		$this->endpoint = $this->{VERB_NODE_ENDPOINT};

		if( in_array($this->endpoint, $this->allowed_endpoint) )
		{
			$this->set_node_endpoint();
			$this->set_method_endpoint();
			return TRUE;
		}

		return FALSE;
	}

	private function set_node_endpoint()
	{
		$this->node_endpoint = $this->endpoint;
	}

	private function set_method_endpoint()
	{
		$this->method_endpoint = (empty($this->{VERB_METHOD_ENDPOINT}))?$this->node_endpoint:$this->{VERB_METHOD_ENDPOINT};
	}

	public function get_node_endpoint()
	{
		return $this->node_endpoint;
	}

	public function get_method_endpoint()
	{
		return $this->method_endpoint;
	}
}

/* End of file welcome.php */
/* Location: ./application/Libraries/CDN_Api.php */