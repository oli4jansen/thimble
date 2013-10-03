<?php
require_once('vendor/autoload.php');
require_once('parser/parser.php');
require_once('parser/tumblr_importer.php');

// Some config shizzle. Needs to get another space at some point.
$VERSION = '0.3.0';
$TUMBLR_API_PUBLIC_KEY = '----------------';
$DATA = $_GET['data'];
$LOCALE = 'en-us.yml';
$THEME = 'themes/'.$_GET['theme'];
$options = $_REQUEST;

// Importing a Tumblr blog?
if(isset($options['blog-domain']) && !empty($options['blog-domain']))
{
	$url = parse_url($options['blog-domain']);
	$domain = rtrim($url['host'].$url['path'], "/");
	
	$importer = new Tumblr_Importer($TUMBLR_API_PUBLIC_KEY);
	$importer->importBlog($domain, 'data/');
}

unset($options['theme'], $options['auto-refresh']);

$last_modified_time = filemtime($THEME); 
$etag = md5_file($THEME); 

header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT"); 
header("Etag: $etag");

if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last_modified_time || trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
	header("HTTP/1.1 304 Not Modified");
	exit;
}

$theme = new ThimbleParser(file_get_contents('data/'.$DATA), pathinfo($DATA, PATHINFO_EXTENSION), file_get_contents('lang/'.$LOCALE));
echo $theme->parse(file_get_contents($THEME), $options);

?>
