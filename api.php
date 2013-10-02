<?php

require_once('parser/spyc.php');

$data = file_get_contents('data/demo.yml');
echo '<pre>';
print_r(Spyc::YAMLLoad($data));
echo '</pre>';


$xml = simplexml_load_file('http://oli4jansen.tumblr.com/rss');

$xml = $xml->xpath("/rss/channel/");

$blogArray = Array(
		'Title' => $xml->title,
		'Description' => $xml->description,
		'MetaDescription' => $xml->description,
		'Pages' => Array(
							[0] => Array(
								[Label] => About Me
								[URL] => about_me/
							)
						),
         'Following' => Array(
				            [0] => Array(
				                    'Name' => 'staff'
				                    'Title' => 'Tumblr Staff'
				                    'URL' => 'http://staff.tumblr.com/'
				                    'PortraitURL-16' => 'http://30.media.tumblr.com/avatar_013241641371_16.png'
				                    'PortraitURL-24' => 'http://30.media.tumblr.com/avatar_013241641371_24.png'
				                    'PortraitURL-30' => 'http://30.media.tumblr.com/avatar_013241641371_30.png'
				                    'PortraitURL-40' => 'http://30.media.tumblr.com/avatar_013241641371_40.png'
				                    'PortraitURL-48' => 'http://30.media.tumblr.com/avatar_013241641371_48.png'
				                    'PortraitURL-64' => 'http://30.media.tumblr.com/avatar_013241641371_64.png'
				                    'PortraitURL-96' => 'http://30.media.tumblr.com/avatar_013241641371_96.png'
				                    'PortraitURL-128' => 'http://30.media.tumblr.com/avatar_013241641371_128.png'
				                ),
				            [1] => Array(
				                    'Name' => 'jacob'
				                    'Title' => 'Jacob Bijani'
				                    'URL' => 'http://jacobnijani.com/'
				                    'PortraitURL-16' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_16.png'
				                    'PortraitURL-24' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_24.png'
				                    'PortraitURL-30' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_30.png'
				                    'PortraitURL-40' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_40.png'
				                    'PortraitURL-48' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_48.png'
				                    'PortraitURL-64' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_64.png'
				                    'PortraitURL-96' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_96.png'
				                    'PortraitURL-128' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_128.png'
				                ),
				            [2] => Array(
				                    'Name' => 'petervidani'
				                    'Title' => 'Peter Vidani'
				                    'URL' => 'http://blog.petervidani.com/'
				                    'PortraitURL-16' => 'http://30.media.tumblr.com/avatar_51777f3c873f_16.png'
				                    'PortraitURL-24' => 'http://30.media.tumblr.com/avatar_51777f3c873f_24.png'
				                    'PortraitURL-30' => 'http://30.media.tumblr.com/avatar_51777f3c873f_30.png'
				                    'PortraitURL-40' => 'http://30.media.tumblr.com/avatar_51777f3c873f_40.png'
				                    'PortraitURL-48' => 'http://30.media.tumblr.com/avatar_51777f3c873f_48.png'
				                    'PortraitURL-64' => 'http://30.media.tumblr.com/avatar_51777f3c873f_64.png'
				                    'PortraitURL-96' => 'http://30.media.tumblr.com/avatar_51777f3c873f_96.png'
				                    'PortraitURL-128' => 'http://30.media.tumblr.com/avatar_51777f3c873f_128.png'
				                ),
				           ),
	);

$xml = $xml->xpath("/rss/channel/item");

foreach($xml as $post) {
	echo '<pre>';
	echo '------------
	';
	echo $post->title;
	echo $post->link;
	echo '++++++++++++
	';
	echo '</pre>';
}
?>