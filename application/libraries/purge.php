<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purge extends Media {

	protected $CI ;

	function __construct()
	{
		parent::__construct();
	}

	public function purge()
	{
		$this->save_purge_request();

		//save to db that this will be processed
	}

	private function save_purge_request()
	{
		$this->CI =& get_instance();

		$log = array (		"id"		=> $this->CI->cdn_api->_apiuser->id, 
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
		}
		catch(exception $e)
		{
			echo "gagal";
			return FALSE;
		}

		return TRUE;
	}

	private function set_error()
	{

	}

	public function get_error()
	{

	}
	
}

/* End of file welcome.php */
/* Location: ./application/Libraries/purge.php */