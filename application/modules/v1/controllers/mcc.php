<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
class mcc extends REST_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library( 'purge' );
		
		$this->cdn_api = $this->load->library('cdn_api');
		$this->cdn_api->set('_apiuser',$this->_apiuser);
		$this->cdn_api->set(VERB_ID ,$this->get(VERB_ID));
		$this->cdn_api->set(VERB_NODE_ENDPOINT ,$this->get(VERB_NODE_ENDPOINT));


		//run the authentication process
		if( ! $this->cdn_api->auth() )
			$this->response(array( ERR_PREFIX => ERR_FORBIDDEN ), 403);
	}

	public function user_put()
	{
		if ( ! $this->cdn_api->scan_variable() )
				$this->response(array( ERR_PREFIX => ERR_METHOD_NOT_ALLOWED ), 403);

		//load the library for processing the endpoint
		$node_endpoint 	= $this->cdn_api->get_node_endpoint();
		$method_endpoint 	= $this->cdn_api->get_method_endpoint();
		//initiate CORE CLASS MEDIA WITH all data resource from all method , put , get, delete ,post
		$this->load->library( CORE_CLASS_MEDIA );
		$this->load->library( $node_endpoint );
		$this->$node_endpoint->set_resource(RESOURCE_VARNAME,$this->_args);
		$this->$node_endpoint->init();

		//save the requested purged media, if something is wrong with the current process, throw unknown error
		if ( ! $this->$node_endpoint->$method_endpoint() )
			$this->response( $this->$node_endpoint->display_errors() , 404);

		//give requested purge id, for user monitoring requested media that want to be purged
		$this->response(array('PurgeRequestId' => $this->$node_endpoint->purgeid ));
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */