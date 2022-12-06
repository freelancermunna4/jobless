 <?php

$config['sql_host']       = 'localhost';
$config['sql_username']   = 'root';		
$config['sql_password']   = '';			
$config['sql_database']   = 'jobless';
$config['sql_extenstion'] = (version_compare(phpversion(), '5.5', '<') ? 'MySQL' : 'MySQLi');			// MySQL or MySQLi

 ?>