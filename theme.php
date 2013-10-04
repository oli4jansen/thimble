<?php
require_once('config.php');
require_once('vendor/autoload.php');
require_once('parser/parser.php');
//require_once('parser/tumblr_importer.php');

$THEME = $THEME_LOCATION.$_GET['theme'];
$DATA = $_GET['data'];
$options = $_REQUEST;

unset($options['theme'], $options['auto-refresh']);

$last_modified_time = filemtime($THEME); 
$etag = md5_file($THEME); 

header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT"); 
header("Etag: $etag");

if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last_modified_time || trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
	header("HTTP/1.1 304 Not Modified");
	exit;
}

$theme = new ThimbleParser(file_get_contents($DATA_LOCATION.$DATA), pathinfo($DATA, PATHINFO_EXTENSION), file_get_contents('lang/'.$LOCALE));
echo $theme->parse(file_get_contents($THEME), $options);

?>
