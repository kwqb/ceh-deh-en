<?php
class Model_purge extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('mongo');
		$this->_mongo_cdn = $this->mongo->get_connection( 'cdn' );

	}

	public function insert_new_log($data)
	{
		try{

			$this->_mongo_cdn->{PURGE_LOG_COLL}->save($data);

			return (string) $data['_id'];
		}
		catch(exception $e)
		{
			return FALSE;
		}
	}

	public function get_single_log($id)
	{
		try{
			return $this->_mongo_cdn->{PURGE_LOG_COLL}->findOne( array("_id" =>New MongoId($id))) ;
		}
		catch(exception $e)
		{
			return FALSE;
		}
	}
}