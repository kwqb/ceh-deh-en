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

		$this->CI->load->library('mongo');
		$mongodb = $this->CI->mongo->get_connection( 'cdn' );
		
		try{

			$mongodb->{PURGE_LOG_COLL}->save($log);

			//set the purge id to the object
			$this->set_resource('purgeid', (string) $log['_id']);
		}
		catch(exception $e)
		{
			$this->set_error(ERR_UNKNOWN);
			return FALSE;
		}
		
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
	
}

/* End of file welcome.php */
/* Location: ./application/Libraries/purge.php */