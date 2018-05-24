<?php

$lang = array(

	'installer'				=> "IPS Community Suite Installer - %s",
    'healthcheck'			=> "System Check",
	'install_step_1'		=> "Setting up database...",
	'install_step_2'		=> "Installing applications and modules...",
	'install_step_3'		=> "Installing settings...",
	'install_step_4'		=> "Creating admin user...",
	'install_step_5'		=> "Installing tasks...",
	'install_step_6'		=> "Installing language pack...",
	'install_step_7'		=> "Installing languages...",
	'install_step_8'		=> "Installing email templates...",
	'install_step_9'		=> "Installing themes...",
	'install_step_10'		=> "Installing javascript...",
	'install_step_11'		=> "Installing search keywords...",
	'install_step_12'		=> "Installing hooks and widgets....",
	'generic_error'			=> "An unknown error occurred",
	'error'					=> "Error",
	'error_title'			=> "Error",
	'page_doesnt_exist'		=> "That page doesn't exist.",
	'err_installer_locked'	=> "The installer is locked.",
	'err_conf_noexist'		=> "In order to install the IPS Community Suite, rename the <em>conf_global.php.dist</em> file to <em>conf_global.php</em>. If you are not sure how to do this, contact your hosting provider.",
	'err_conf_nowrite'		=> "In order to install the IPS Community Suite, you must make the <em>conf_global.php</em> writeable. If you are not sure how to do this, contact your hosting provider.",
	'form_required'			=> "This field is required.",
	'form_email_bad'		=> "That is not a valid email address.",
	'form_password_confirm'	=> "The passwords do not match.",
	'step'					=> "Step %d",
	'continue'				=> "Continue",
	'install_guide'			=> "Need help? Consult the Installation Guide &rarr;",
	'err_password_length'	=> "Passwords must be at least 3 characters",

	'requirements_php_version_success'	=> "PHP version %s.",
	'requirements_php_version_success_advice'	=> "PHP version %s. <strong>Please see advice below</strong>",
	'requirements_php_version_fail'		=> "You are running PHP version %s. You need PHP 5.4.0 or above. You should contact your hosting provider or system administrator to ask for an upgrade.",
	'requirements_php_version_advice'	=> "You are running PHP version %s. While this version is compatible, we recommend version 5.5.0 or above.",
	'requirements_curl_success'			=> "cURL extension loaded.",
	'requirements_curl_fopen'			=> "fsockopen function available",
	'requirements_curl_advice'			=> "You do not have the cURL PHP extension loaded or it is running a version less than 7.36. While this is not required, it is recommended.",
	'requirements_curl_fail'			=> "You do not have the cURL PHP extension loaded (or it is running a version less than 7.36) and the fsockopen function is disabled. You should contact your hosting provider or system administrator to ask either for cURL version 7.36 or greater to be installed, or the fsockopen function to be enabled. cURL is recommended.",
	'requirements_mb_success'			=> "Multibyte String extension loaded",
	'requirements_mb_regex'				=> "The Multibyte String extension has been configured with the --disable-mbregex option. You should contact your hosting provider or system administrator to ask for it to be reconfigured without that option.",
	'requirements_mb_fail'				=> "You do not have the Multibyte String PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled. It must be configured <em>without</em> the --disable-mbregex option.",
	'requirements_extension_success'	=> "%s extension loaded",
	'requirements_extension_fail'		=> "You do not have the %s PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled.",
	'requirements_extension_advice'		=> "You do not have the %s PHP extension loaded. While this is not required, it is recommended.",
	'requirements_extension_dom'		=> "DOM",
	'requirements_extension_gd'			=> "GD",
	'requirements_extension_mysqli'		=> "MySQLi",
	'requirements_extension_openssl'	=> "OpenSSL",
	'requirements_extension_session'	=> "Session",
	'requirements_extension_simplexml'	=> "SimpleXML",
	'requirements_extension_xml'		=> "XML",
	'requirements_extension_xmlreader'	=> "XMLReader",
	'requirements_extension_xmlwriter'	=> "XMLWriter",
	'requirements_extension_zip'		=> "Zip",
	'requirements_extension_phar'		=> "Phar",
	'requirements_memory_limit_success'	=> "%s memory limit.",
	'requirements_memory_limit_fail'	=> "Your PHP memory limit is set to %s but should be set to 128M or more. You should contact your hosting provider or system administrator to ask for this to be changed.",
	'requirements_suhosin_limit'		=> "PHP setting %s is set to %s. This can cause problems in some areas. We recommended a value of %s or above.",
	'requirements_file_system'			=> "File System",
	'requirements_file_writable'		=> "%s is writable",
    'dir_does_not_exist'				=> "%s does not exist.",
	'dir_is_not_writable'				=> "%s cannot be written to. Please adjust the permissions on it or contact your hosting provider for assistance.",
	'file_storage_test_error_amazon'	=> "There appears to be a problem with your Amazon (%s) file storage settings which can cause problems with uploads.<br> After attempting to upload a file to the directory, the URL to the file is returning a HTTP %s error. Update your settings and then check and see if the problem has been resolved",
	'ftp_err_no_ext'					=> "Your server does not support using FTP storage. Please contact your hosting provider to ask for PHP FTP extension to be enabled.",
	'ftp_err_no_ssl'					=> "Your server does not support using SSL-FTP storage. Please contact your hosting provider to ask for PHP OpenSSL extension to be enabled or use a different protocol.",
	'ftp_err_no_sftp'					=> "Your server does not support using SFTP storage. Please contact your hosting provider to ask for PHP SSH2 extension to be enabled or use a different protocol.",
	'ftp_err-COULD_NOT_CONNECT'			=> "A connection to the host could not be established. Check the host and port provided are correct.",
	'ftp_err-COULD_NOT_LOGIN'			=> "Authentication failed. Check the username and password provided are correct.",
	'ftp_err-COULD_NOT_CHDIR'			=> "Could not move into the directory specified. Check the directory is correct and the user provided has permission to access it.",
	'ftp_err-COULD_NOT_UPLOAD'			=> "Could not upload to the FTP server. Check the user has permission to write files.",
	'ftp_err-COULD_NOT_DELETE'			=> "Could not delete from the FTP server. Check the user has permission to delete files.",
	'file_storage_test_error_ftp'		=> "There appears to be a problem with your FTP (%s) storage settings which can cause problems with uploads.<br> After attempting to upload a file to the directory, the URL to the file is returning a HTTP %s error. Update your settings and then check and see if the problem has been resolved",
	'file_storage_test_ftp_unexpected_response' => "There appears to be a problem with your FTP (%s) storage settings. Please contact technical support.",
	'hook_file_not_writable' => "You must make the file %s writeable (usually by setting the CHMOD for the file or the plugins folder to 0777) before you can continue.",
	'license'				=> "License",
	'lkey'					=> "License Key",
	'lkey_help'				=> "If you don't see a license key you use a web host which is blocked by Cloudflare or Invision Virus is temporarily down. <br>If you have Cloudflare issues add this key 0000000000-000000-000000-0000000000",
	'generic_server_error'	=> "There was an error communicating with the IPS License Server. Please try again later or contact IPS technical support for assistance.",
	'license_server_error'	=> "There was an error communicating with the IPS License Server: %s. Please try again later or contact IPS technical support for assistance.",
	'license_key_not_found'	=> "The license key supplied is not valid. Please check the provided key and try again or contact IPS technical support for more assistance.",
	'license_key_legacy'	=> "The license key supplied is not compatible with this version of the IPS Community Suite. Please contact IPS technical support for assistance.",
	'license_key_active'	=> "An installation has already been activated for this license key. Your license key entitles you to one installation only. If you need to change the URL associated with your license, contact IPS technical support.",
	'license_key_test_active' => "A test installation has already been activated for this license key. Your license key entitles you to one test installation only.",
	'eula'					=> "License Agreement",
	'eula_suffix'			=> "I have read and agree to the license agreement",
	'eula_err'				=> "You must agree to the license agreement.",
	
	'applications'			=> "Applications",
	'apps'					=> "Applications to install",
	'default_app'			=> "Default application",
	'default_app_desc'		=> "The application selected here will be used as the default landing page when visitors first come to your site.",
	'default_app_invalid'	=> "Invalid Default",
	'err_min_php'			=> "Your server needs to be running PHP %s or higher to install this application (your server is running %s). Contact your hosting provider to have your server upgraded.",
	'err_min_php_setting'	=> "Your server needs to have the PHP <em>%s</em> setting set to %s or higher to install this application (your server is set to %s). Contact your hosting provider to have this changed.",
	'err_php_extension'		=> "Your server needs to have the PHP <em>%s</em> extension enabled to install this application. Contact your hosting provider to have this enabled.",
	'err_not_writable'		=> "The directory %s needs to be writable. Please change the directory's CHMOD to 0777",
	'err_tmp_dir_create'	=> "Your server does not allow temporary files to be created in the configured temporary directory. To work around this issue please create a file named constants.php at %s with the following code in it:<br><br><span>&lt;?php<br><br>define( 'TEMP_DIRECTORY', dirname( __FILE__ ) . '/uploads' );</span>",
	'err_tmp_dir_adjust'	=> "Your server does not allow temporary files to be created in the configured temporary directory. To work around this issue please edit the file named constants.php at %s and add following code to it:<br><br><span>define( 'TEMP_DIRECTORY', dirname( __FILE__ ) . '/uploads' );</span>",
	'serverdetails'			=> "Server Details",
	'mysql_server'			=> "MySQL Server Details",
	'sql_host'				=> "Host",
	'sql_host_desc'			=> "If you are not sure, leave at the default value.",
	'sql_user'				=> "Username",
	'sql_user_desc'			=> "If you are not sure what your MySQL Server username and password is, contact your hosting provider for assistance.",
	'sql_pass'				=> "Password",
	'sql_database'			=> "Database Name",
	'sql_database_desc'		=> "If the database does not exist we will try to create it. If your MySQL user does not have permission and you're not sure how to create a database, contact your hosting provider for assistance.",
	'sql_tbl_prefix'		=> "Table Prefix",
	'sql_tbl_prefix_desc'	=> "If provided, all database tables created will be prefixed with the value provided. It is recommended this is left blank.",
	'sql_port'				=> "Port",
	'sql_port_desc'			=> "If you are not sure, leave at the default value.",
	'sql_socket'			=> "Socket",
	'sql_socket_desc'		=> "If not provided, the server's default setting will be used. If you're not sure, leave at the default value.",
	'sql_utf8mb4'			=> "Use 4-Byte UTF-8 Unicode Encoding?",
	'sql_utf8mb4_desc'		=> "Some non-common symbols (such as historical scripts, music symbols and Emoji) require more space in the database to be stored. If you leave this setting disabled, users will not be able to use these symbols on your site. If enabled, these characters will be able to be used, but the database will use more disk space.",
	'err_no_utf8mb4'		=> "4-Byte UTF-8 Unicode Encoding is only available in MySQL 5.5.3 and above. You can uncheck that option to continue (it can be changed later), or contact your hosting provider or server administrator to upgrade your version of MySQL.",
	'http_server'			=> "Web Server Details",
	'base_url'				=> "Site URL",
	'err_db_exists'			=> "There is already an IPS Community Suite installation in that database. Choose a different database or use a table prefix.",
	'err_db_cant_create'	=> "The Database does not exist and cannot be created automatically. Please create the database manually or contact your hosting provider if you are unsure how to do this.",
		
	'conf_global_error'		 => "",
	
	'admin'					=> "Administrator Account",
	'admin_user'			=> "Display Name",
	'admin_pass1'			=> "Password",
	'admin_pass2'			=> "Confirm Password",
	'admin_email'			=> "Email Address",
	
	'install'				=> "Install",
	'start'					=> "Start",
	'redirecting'			=> "Redirecting...",
	'redirecting_wait'		=> "Please wait while we transfer you...",
	'installing'			=> "Installing...",
	
	'done'					=> "Installation Complete!",
	
	/* filesizes */
	'filesize_Y'						=> '%s YB',
	'filesize_Z'						=> '%s ZB',
	'filesize_E'						=> '%s EB',
	'filesize_P'						=> '%s PB',
	'filesize_T'						=> '%s TB',
	'filesize_G'						=> '%s GB',
	'filesize_M'						=> '%s MB',
	'filesize_k'						=> '%s kB',
	'filesize_b'						=> '%s B',
	'unlimited'							=> "Unlimited",

);