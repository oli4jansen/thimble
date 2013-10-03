<?php
/*
*	Imports the data from a Tumblr blog and saves it as a JSON file that's usable by Thimble.
*	By Olivier Jansen
*/

class Tumblr_Importer {

	protected $publicKey = '';
	protected $client = '';
	protected $domain = '';

	public function __construct($publicKey)
	{
		$this->publicKey = $publicKey;
		
		$client = new Tumblr\API\Client($this->publicKey);
		$this->client = $client;
	}
	
	public function importBlog($domain, $location)
	{
		$this->domain = $domain;
		
		$data = $this->client->getBlogPosts($domain);
		$blogArray = $this->createArray($data);
		
		foreach($data->posts as $post)
		{
			array_push($blogArray['Posts'], $this->createPost($post));
		}
		
		if($this->saveData($blogArray, $location))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	protected function createArray($data)
	{
		return Array(
			'Title' => $data->blog->title,
			'Description' => $data->blog->description,
			'MetaDescription' => 'Test Blog by Thimble',
			'PortraitURL-16' => $this->client->getBlogAvatar($this->domain, 16),
			'PortraitURL-24' => $this->client->getBlogAvatar($this->domain, 24),
			'PortraitURL-30' => $this->client->getBlogAvatar($this->domain, 30),
			'PortraitURL-40' => $this->client->getBlogAvatar($this->domain, 40),
			'PortraitURL-48' => $this->client->getBlogAvatar($this->domain, 48),
			'PortraitURL-64' => $this->client->getBlogAvatar($this->domain, 64),
			'PortraitURL-96' => $this->client->getBlogAvatar($this->domain, 96),
			'PortraitURL-128' => $this->client->getBlogAvatar($this->domain, 128),
			'PortraitURL-512' => $this->client->getBlogAvatar($this->domain, 512),
			'Pages' => 
				Array(
					0 => 
						Array(
							'Label' => 'About Me',
							'URL' => 'about_me/'
						)
				),
			'Following' => 
				Array(
					0 => 
						Array(
							'Name' => 'staff',
							'Title' => 'Tumblr Staff',
							'URL' => 'http://staff.tumblr.com/',
							'PortraitURL-16' => 'http://30.media.tumblr.com/avatar_013241641371_16.png',
							'PortraitURL-24' => 'http://30.media.tumblr.com/avatar_013241641371_24.png',
							'PortraitURL-30' => 'http://30.media.tumblr.com/avatar_013241641371_30.png',
							'PortraitURL-40' => 'http://30.media.tumblr.com/avatar_013241641371_40.png',
							'PortraitURL-48' => 'http://30.media.tumblr.com/avatar_013241641371_48.png',
							'PortraitURL-64' => 'http://30.media.tumblr.com/avatar_013241641371_64.png',
							'PortraitURL-96' => 'http://30.media.tumblr.com/avatar_013241641371_96.png',
							'PortraitURL-128' => 'http://30.media.tumblr.com/avatar_013241641371_128.png'
						),
					1 => 
						Array(
							'Name' => 'jacob',
							'Title' => 'Jacob Bijani',
							'URL' => 'http://jacobnijani.com/',
							'PortraitURL-16' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_16.png',
							'PortraitURL-24' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_24.png',
							'PortraitURL-30' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_30.png',
							'PortraitURL-40' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_40.png',
							'PortraitURL-48' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_48.png',
							'PortraitURL-64' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_64.png',
							'PortraitURL-96' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_96.png',
							'PortraitURL-128' => 'http://30.media.tumblr.com/avatar_5b13c55f0688_128.png'
						),
					2 => 
						Array(
							'Name' => 'petervidani',
							'Title' => 'Peter Vidani',
							'URL' => 'http://blog.petervidani.com/',
							'PortraitURL-16' => 'http://30.media.tumblr.com/avatar_51777f3c873f_16.png',
							'PortraitURL-24' => 'http://30.media.tumblr.com/avatar_51777f3c873f_24.png',
							'PortraitURL-30' => 'http://30.media.tumblr.com/avatar_51777f3c873f_30.png',
							'PortraitURL-40' => 'http://30.media.tumblr.com/avatar_51777f3c873f_40.png',
							'PortraitURL-48' => 'http://30.media.tumblr.com/avatar_51777f3c873f_48.png',
							'PortraitURL-64' => 'http://30.media.tumblr.com/avatar_51777f3c873f_64.png',
							'PortraitURL-96' => 'http://30.media.tumblr.com/avatar_51777f3c873f_96.png',
							'PortraitURL-128' => 'http://30.media.tumblr.com/avatar_51777f3c873f_128.png'
						),
					3 => 
						Array(
							'Name' => 'oli4jansen',
							'Title' => 'Olivier Jansen',
							'URL' => 'http://oli4jansen.tumblr.com/',
							'PortraitURL-16' => 'http://30.media.tumblr.com/avatar_c713bc7d0b78_16.png',
							'PortraitURL-24' => 'http://30.media.tumblr.com/avatar_c713bc7d0b78_24.png',
							'PortraitURL-30' => 'http://30.media.tumblr.com/avatar_c713bc7d0b78_30.png',
							'PortraitURL-40' => 'http://30.media.tumblr.com/avatar_c713bc7d0b78_40.png',
							'PortraitURL-48' => 'http://30.media.tumblr.com/avatar_c713bc7d0b78_48.png',
							'PortraitURL-64' => 'http://30.media.tumblr.com/avatar_c713bc7d0b78_64.png',
							'PortraitURL-96' => 'http://30.media.tumblr.com/avatar_c713bc7d0b78_96.png',
							'PortraitURL-128' => 'http://30.media.tumblr.com/avatar_c713bc7d0b78_128.png'
						),
				),
			'Posts' => Array()
		);

	}

	protected function createPost($post)
	{
		$postArray = Array();
	
		$postArray['Type'] = ucfirst($post->type);
		$postArray['Permalink'] = $post->post_url;
		$postArray['PostId'] = $post->id;
		$postArray['NoteCount'] = $post->note_count;
		$postArray['Timestamp'] = $post->timestamp;
		$postArray['Tags'] = $post->tags;
		switch ($postArray['Type'])
		{
			case 'Text':
				if(isset($post->title))
				{
					$postArray['Title'] = $post->title;
				}
				$postArray['Body'] = $post->body;
				break;
	
			case 'Photo':
				if(isset($post->caption))
				{
					$postArray['Caption'] = $post->caption;
				}
				//	This needs to be extended when Photosets are being implented
				if(isset($post->photos[0]->alt_sizes[1]))
				{
					$postArray['PhotoURL-500'] = $post->photos[0]->alt_sizes[1]->url;
				}
				if(isset($post->photos[0]->alt_sizes[2]))
				{
					$postArray['PhotoURL-400'] = $post->photos[0]->alt_sizes[2]->url;
				}
				if(isset($post->photos[0]->alt_sizes[3]))
				{
					$postArray['PhotoURL-250'] = $post->photos[0]->alt_sizes[3]->url;
				}
				if(isset($post->photos[0]->alt_sizes[4]))
				{
					$postArray['PhotoURL-100'] = $post->photos[0]->alt_sizes[4]->url;
				}
				if(isset($post->photos[0]->alt_sizes[5]))
				{
					$postArray['PhotoURL-75sq'] = $post->photos[0]->alt_sizes[5]->url;
				}
				break;
				
			case 'Quote':
				$postArray['Source'] = $post->source;
				$postArray['Quote'] = $post->text;
				break;
				
			case 'Link':
				if(isset($post->title))
				{
					$postArray['Name'] = $post->title;
				}
				if(isset($post->description))
				{
					$postArray['Description'] = $post->description;
				}
				$postArray['URL'] = $post->url;
				break;
				
			case 'Chat':
				$lines = Array();
				foreach($post->dialogue as $line)
				{
					$currentLine = Array();
					$currentLine[$line->name] = $line->phrase;
					array_push($lines, $currentLine);
				}
			
				$postArray['Lines'] = $lines;
				break;
				
			case 'Audio':
				$postArray['Caption'] = $post->caption;
				$postArray['PlayCount'] = $post->plays;
				$postArray['AlbumArtURL'] = $post->album_art;
				$postArray['Artist'] = $post->artist;
				$postArray['TrackName'] = $post->track_name;
				$postArray['AudioFile'] = $post->player; // Kinda wrong name since it's a player, not just the file location
				break;
	
			case 'Video':
				$postArray['Caption'] = $post->caption;
				foreach($post->player as $player)
				{
					if($player->width == '250')
					{
						$postArray['Video-250'] = $player->embed_code;
					}
					elseif($player->width == '400')
					{
						$postArray['Video-400'] = $player->embed_code;
					}
					elseif($player->width == '500')
					{
						$postArray['Video-500'] = $player->embed_code;
					}
	
				}
				break;
	
			case 'Answer':
				$postArray['Question'] = $post->question;
				$postArray['Answer'] = $post->answer;
				$postArray['Asker'] = $post->asking_name;
				$postArray['AskerPortraitURL-16'] = $client->getBlogAvatar($post->asking_name.'.tumblr.com', 16);
				$postArray['AskerPortraitURL-24'] = $client->getBlogAvatar($post->asking_name.'.tumblr.com', 24);
				$postArray['AskerPortraitURL-30'] = $client->getBlogAvatar($post->asking_name.'.tumblr.com', 30);
				$postArray['AskerPortraitURL-40'] = $client->getBlogAvatar($post->asking_name.'.tumblr.com', 40);
				$postArray['AskerPortraitURL-48'] = $client->getBlogAvatar($post->asking_name.'.tumblr.com', 48);
				$postArray['AskerPortraitURL-64'] = $client->getBlogAvatar($post->asking_name.'.tumblr.com', 64);
				$postArray['AskerPortraitURL-96'] = $client->getBlogAvatar($post->asking_name.'.tumblr.com', 96);
				$postArray['AskerPortraitURL-128'] = $client->getBlogAvatar($post->asking_name.'.tumblr.com', 128);
				break;
				
			default:
				// Other post types are currently unsupported.
				break;
		}
		return $postArray;
	}

	protected function saveData($data, $location)
	{
		$data = json_encode($data);

		if(file_put_contents($location.$this->domain.'.json', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}
?>