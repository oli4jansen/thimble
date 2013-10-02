<!DOCTYPE html>
<html lang="en-US" id="thimblr">
<head>
	<meta charset="utf-8" />
	<title>Thimble</title>

	<meta name="Copyright" content="Copyright (c) 2010 Mark Wunsch" />
	<meta name="description" content="Thimble is a tool for easily developing Tumblr themes, built by Mark Wunsch and Olivier Jansen.">
    <meta name="viewport" content="width=device-width">

	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>	
	<link type="text/css" rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div class="sidemenu">
		<form method="get" action="theme.php" id="theme-form">
			<div class="title">
				<input type="submit" value="Apply" />
				<input type="button" class="gray" value="Open Docs" onclick="window.open('http://www.tumblr.com/docs/en/custom_themes', '_blank')" />
			</div>
	
			<div class="menu-item">
				<h3>Select datasource</h3><br>
				
				<select name="data" id="data-selector">
					<?php
					foreach (glob('data/*.yml') as $data) {
				    	$data = basename($data);
				    	if (($data !== '.') && ($data !== '..')) {
							echo '<option value="'.$data.'">'.$data.'</option>';
						}
					}
					?>
				</select>
			</div>


			<hr>
			
			<div class="menu-item">
				<h3>Select theme</h3><br>
				
				<select name="theme" id="theme-selector">
					<?php
					foreach (glob('themes/*.html') as $theme) {
				    	$theme = basename($theme);
				    	if (($theme !== '.') && ($theme !== '..')) {
							echo '<option value="'.$theme.'">'.$theme.'</option>';
						}
					}
					?>
				</select>
			</div>
			
			<hr>
			
			<div class="menu-item">
				<h3>Auto refresh</h3><br>
				
				<div class="options">
					<p class="text">Auto refresh will automatically check for changes and refresh the page if needed.</p>
					
					<p class="checkbox">
						<label for="auto-refresh" class="label">Check to activate</label>
						<input type="checkbox" name="auto-refresh" id="auto-refresh">
					</p>
				</div>
			</div>
		
			<hr>
			
			<div class="menu-item" id="appearance-selector">
				<h3>Appearance</h3>
				<div class="options"></div>
			</div>
		</form>
	</div>
	<div class="holder">
		<div id="header">
			<span class="logo">thimble</span>
		
			<span class="menu-trigger">Settings</span>			
		</div>
		
		<div id="theme-container">
			<iframe id="theme-preview" border="0" frameborder="0"></iframe>
		</div>
	</div>
</body>	
</html>
