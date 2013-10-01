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
			<div class="title"><input type="submit" value="Apply" /></div>
	
			<div class="menu-item">
				<h3>Select theme</h3>
				
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
			
		<!--	<details id="options-selector">
				<summary>Options</summary>
				<div class="options">
					<a href="http://www.tumblr.com/docs/en/custom_themes">Theme Documentation</a>
	
					<input type="checkbox" name="auto-refresh" id="auto-refresh">
					<label for="auto-refresh" class="small">Auto Refresh?</label>
				</div>
			</details>
			-->
			
		</div>
		
		<div id="theme-container">
			<iframe id="theme-preview" border="0" frameborder="0"></iframe>
		</div>
	</div>
</body>	
</html>
