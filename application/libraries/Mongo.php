<?php
/*------------------------------------
lIBRARY CLASS FOR MONGO DB CONNECTION
Date: Fri, 12 Nov 2010 13:30:17 +0700 
Rev : Fri, 25 Mar 2011 19:41:04 +0700 
Programmer: Nuris
Description: MONGO DB Library
-------------------------------------*/
class CI_Mongo
{

	var $connections = array();
	var $CI;
	const MONGODB_CONN_PREFIX 	= 'mongodb://';
	const MONGODB_REPLICA		= 'replicaSet';

	function CI_Mongo()
	{   
		// Fetch CodeIgniter instance
		$this->CI =& get_instance();
	}
	
	function get_connection($conn_name, $try_attempt = 0)
	{
		//use mongoclient, because mongo will be deprecated
		$class = 'MongoClient'; 
		if(!class_exists($class))
		{ 
			$class = 'Mongo'; 			
		} 

		// connection exists? return it
		if (isset($this->connections[$conn_name])) 
		{
			return $this->connections[$conn_name];
		}
		else
		{
			// create connection. return it.
			$config = $this->CI->config->item('mongodb');

			$server			= $config[$conn_name]['mongo_server'];
			$dbname			= $config[$conn_name]['mongo_dbname'];
			$username		= $config[$conn_name]['mongo_username'];
			$password		= $config[$conn_name]['mongo_password'];
			$replica_group	= empty($config[$conn_name]['mongo_replica_group'])?'':$config[$conn_name]['mongo_replica_group'];

			if(!empty($replica_group))
			{
				foreach ($config as $conn_name_key => $server_setting) 
				{
					if($server_setting['mongo_replica_group'] == $replica_group)
					{
						$server_replica[$conn_name_key] = (is_array($server_setting['mongo_server']) ? implode(',', $server_setting['mongo_server']) : $server_setting['mongo_server']);
					}
				}
				
				// combine all server and remove duplicate server name
				$server_replica = implode(',', array_unique($server_replica));
			}

			try{
					if($server)
					{
						if(!empty($replica_group))
						{
							$replica_set = array(self::MONGODB_REPLICA => $replica_group);
							$this->connections[$conn_name] = new $class(self::MONGODB_CONN_PREFIX.$server_replica, $replica_set);
						}
						else
						{
							$this->connections[$conn_name] = new $class($server);
						}
					}
					else
					{
						$this->connections[$conn_name] = new $class();
					}
				
				}
				catch(MongoConnectionException $e)
				{
					$code = $e->getCode();
					
					if( $code == 71 && $try_attempt < 3)
					{
						$try_attempt++;
						$this->get_connection($conn_name, $try_attempt);
						return;
					}

					show_error('Unable Connect to Mongodb Server : '.$conn_name." After 3 times trying to connect. Code:".$e->getCode()." Message: ".$e->getMessage());
				}
			
			$this->connections[$conn_name] = $this->connections[$conn_name]->$dbname;

			if($username != '' && $password != '')
			{
			
				$this->connections[$conn_name]->authenticate($username,$password);
			
			}
			
			return $this->connections[$conn_name];
		}
	}	
}