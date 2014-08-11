<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purge extends Media {

	protected $CI ;

	function __construct()
	{
		parent::__construct();
	}

	public function purge()
	{
		return $this->save_purge_request();

		//save to db that this will be processed
	}

	private function save_purge_request()
	{
		$this->CI =& get_instance();

		$log = array (		"customerid"=> $this->CI->cdn_api->_apiuser->id, 
							"endpoint"	=> "purge",
							"MediaPath" => $this->MediaPath,
							"MediaType" => $this->MediaType,
							"time"		=> time(),
							"ipaddress" => $this->CI->input->server('REMOTE_ADDR'),
							"executed"	=> NOT_YET_EXECUTED
						);

		$this->CI->load->model("model_purge");
		
		$ret =  $this->CI->model_purge->insert_new_log($log);
		
		if( empty($ret) )
		{
			$this->set_error(ERR_UNKNOWN);
			return FALSE;
		}
		//set the purge id to the object
		$this->set_resource('purgeid', $ret);
		$this->set_output($this->purgeid);

		return TRUE;
	}

	private function set_error($err_method = "")
	{
		$this->error_message = array(ERR_PREFIX => $err_method);
	}

	public function display_errors()
	{
		if (empty( $this->error_message ))
			return FALSE;

		return $this->error_message;
	}

	public function set_output($opt)
	{
		$this->output = $opt;
	}

	public function output()
	{
		return $this->output;
	}

	private function start_purge_process()
	{

	}

	public function check()
	{

	}

	
}

/* End of file welcome.php */
/* Location: ./application/Libraries/purge.php */