<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
example of replica set group connection
$config['mongodb']['example']['mongo_server']				= array($_SERVER['MONGODB_REPL_mypost_mongo_server_1'], 
																	$_SERVER['MONGODB_REPL_mypost_mongo_server_2'], 
																	$_SERVER['MONGODB_REPL_mypost_mongo_server_3']);
$config['mongodb']['example']['mongo_username']				= '';
$config['mongodb']['example']['mongo_password']				= '';
$config['mongodb']['example']['mongo_dbname']				= $_SERVER['MONGODB_REPL_mypost_mongo_db_name'];
$config['mongodb']['example']['mongo_replica_group']			= $_SERVER['MONGODB_REPL_mypost_mongo_server_name'];
*/

$config['mongodb']['cdn']['mongo_server']				= getenv('MONGODB_cdn_api');
$config['mongodb']['cdn']['mongo_username']				= '';
$config['mongodb']['cdn']['mongo_password']				= '';
$config['mongodb']['cdn']['mongo_dbname']				= PURGE_LOG_DBNAME;