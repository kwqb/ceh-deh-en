<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| For CDN API Configuration
|--------------------------------------------------------------------------
|
| 
|
*/

define('CORE_CLASS_MEDIA',						'media');
define('MEDIA_PATH',							'MediaPath');
define('MEDIA_TYPE',							'MediaType');

define('VERB_ID',								'uid');
define('VERB_NODE_ENDPOINT',					'ep');
define('VERB_METHOD_ENDPOINT',					'method');

define('RESOURCE_VARNAME',						'args');

define('PURGE_LOG_DBNAME',						'purge_log');
define('PURGE_LOG_COLL',						'purge_request');

define('NOT_YET_EXECUTED',						0);
define('EXECUTED',								1);

define('ERR_PREFIX',							'error');
define('ERR_FORBIDDEN',							'Forbidden.');
define('ERR_METHOD_NOT_ALLOWED',				'Method not allowed.');


/* End of file constants_CDNAPI.php */
/* Location: ./application/config/constants_CDNAPI.php */