# Ceh-Deh-En
API for ceh deh en application 


##Requirements
1. PHP 5.3 or greater
2. Mysql Database
3. Mongodb Database

##Installation

###Environment Variable
Below are variables that predefined on environment variable

####fastcgi_custom

```
MYSQL_CDN
MYSQL_CDN_User
MYSQL_CDN_Password

MYSQL_cdn_api
MYSQL_cdn_api_User
MYSQL_cdn_api_Password

MONGODB_cdn_api

MEMCACHE_session_server_1
MEMCACHE_session_port_1
```

####profile ( terminal environment variables)
```
export MYSQL_CDN=localhost
export MYSQL_CDN_User=
export MYSQL_CDN_Password=

export MYSQL_cdn_api=localhost
export MYSQL_cdn_api_User=root
export MYSQL_cdn_api_Password=

export MONGODB_cdn_api=127.0.0.1:27017

##########################
## MEMCACHE
##########################

export MEMCACHE_session_server_1=127.0.0.1
export MEMCACHE_session_port_1=11211
```

###Databases

####MYSQL

1. Create New database
   ```
   create database API_CDN
   ```
2. Create table api-keys for generating and storing api keys for customer communicating to server
   ```
   CREATE TABLE `api-keys` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `key` varchar(40) NOT NULL,
	  `level` int(2) NOT NULL,
	  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
	  `is_private_key` tinyint(1)  NOT NULL DEFAULT '0',
	  `ip_addresses` TEXT NULL DEFAULT NULL,
	  `date_created` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   ```

3. Create table logs for logging any request from client
   ```
	CREATE TABLE `api-keys` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `key` varchar(40) NOT NULL,
	  `level` int(2) NOT NULL,
	  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
	  `is_private_key` tinyint(1)  NOT NULL DEFAULT '0',
	  `ip_addresses` TEXT NULL DEFAULT NULL,
	  `date_created` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) 
   ```


####MongoDB

Mongodb will auto create if database and collection are not exist. Below some examples and usage from database list on mongo

1.Database purge_log
   1.Collection purge_request
   ```javascript

	"_id" : ObjectId("53c7665dccd806e3530041a7"),
	"id" : "0001",
	"endpoint" : "purge",
	"MediaPath" : "http://wpc.0001.edgecastcdn.net/000001/folder1/file.htm",
	"MediaType" : NumberLong(3),
	"time" : NumberLong(1405576797),
	"ipaddress" : "127.0.0.1",
	"executed" : NumberLong(0)

   ```

Cron / CLI script
```
. PROFILE_FILE_ENVIRONMENT; export PATH=$PATH:PATH_FOLDER;PHP_EXECUTABLE_PATH APPLICATION_FOLDER/index.php CONTROLLER_CLASS_NAME METHOD_OF_CLASS

example:
. /var/www/profile; export PATH=$PATH:/usr/sbin/;php /var/www/apps/index.php welcome

```


