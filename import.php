<?php
require_once('config.php');
require_once('vendor/autoload.php');
//require_once('parser/tumblr_importer.class.php');

$options = $_REQUEST;

error_log('Aangeroepen.');

if(isset($options['blogDomain']) && !empty($options['blogDomain']))
{
	$url = parse_url($options['blogDomain']);
	$domain = rtrim($url['host'].$url['path'], "/");
	
	error_log($domain);
	
	$importer = new TumblrImporter\Importer($TUMBLR_API_PUBLIC_KEY);
	if($importer->importBlog($domain, $DATA_LOCATION))
	{
		error_log('SUccess');
		return true;
	}
	
	exit;
}
?>