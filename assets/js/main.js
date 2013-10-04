var thimble = {
	// This function is called from the outside
	initialize: function() {
		// Bind all events on the page
		this.bindEvents();
		
		// Get theme from url hash and apply
	 	if (window.location.hash) {
			$('#theme-selector').children('option[value="'+window.location.hash.split('/')[1]+'"]').attr('selected','selected');

			$('#data-selector').children('option[value="'+window.location.hash.split('/')[2]+'"]').attr('selected','selected');
	
			$('#theme-form').submit();
		}else{
			$('#theme-form').submit();
		}
	},

	// Bind DOM elements to functions with events
	bindEvents: function() {
		$('.menu-trigger').bind('click', this.toggleSideMenu);
		$('.import-trigger').bind('click', this.toggleImportPopup);
		$('.popup form').bind('submit', this.importSubmit);
		
		$('#theme-form').bind('submit', this.themeFormSubmit);
		
		$('#theme-preview').bind('load', this.iframeLoad);
	},
	
	// Form submit functions
	importSubmit: function(e) {
		e.preventDefault();
		$('.popup').addClass('loading');

		var blog = $('#blogDomain').val();
		
		$.get( "import.php", { blogDomain: blog })
			.done(function(){
				location.reload();
			}).fail(function(){
				alert('Something went wrong importing the blog. Please check your logs. The URL could also be invalid.');
				$('.popup').removeClass('loading');
			}
		);
	},
	themeFormSubmit: function(e) {
		var location;
		var modal = $('#appearance-selector').siblings('.options');
		var refresh = $('#auto-refresh');
		
		if (window.location.hash) {
			location = window.location.href.split('#')[0];
		} else {
			location = window.location.href;
		}

		window.location = location+"#/" + $('#theme-selector').children(':selected').val() + "/" + $('#data-selector').children(':selected').val();

		$('#theme-preview').attr('src','theme.php?'+$(this).serialize());

		return false;
	},
	
	// Toggle menu functions
	toggleSideMenu: function() {
		$('.holder').toggleClass('menu');
	},
	toggleImportPopup: function() {
		$('iframe').toggleClass('darker');
		$('.popup').fadeToggle(500);
	},
	
	// Other functions
	iframeLoad: function() {
		var frame = $(this.contentWindow? this.contentWindow.document : this.contentDocument.defaultView.document);
		var metaElements = frame.find('meta[name]');
		var appearanceOptions = { 
			'Color': {},
			'Font': {},
			'Boolean': {},
			'Text': {},
			'Image': {}
		};
		metaElements.each( function (i, val) {
			var $this = $(this);
			var option = $this.attr('name').split(':');
			var value = $this.attr('content');
			if (option.length > 1) {
				switch (option[0]) {
					case 'if':
						appearanceOptions['Boolean'][option[1]] = value;
						break;
					case 'color':
						appearanceOptions['Color'][option[1]] = value;
						break;
					case 'font':
						appearanceOptions['Font'][option[1]] = value;
						break;
					case 'image':
						appearanceOptions['Image'][option[1]] = value;
						break;
					case 'text':
						appearanceOptions['Text'][option[1]] = value;
						break;
					default:
						throw "This is not a recognized meta apperance option.";
				}
			}
		});
		thimble.setAppearanceOptions(appearanceOptions);
	},
	setAppearanceOptions: function(options) {
		$('#appearance-selector .options').children(':not(.submit)').remove();
		$.each(options, function (key, value) {
			$.each(value, function (name, content) {
				var p = $('<p><span class="label">'+name+'</span></p>');
				var k = key.toLowerCase();
				switch (k) {
					case 'boolean':
						var is_content_true = false;
						if (content.length) {
							is_content_true = true;
							if (parseInt(content) >= 0) {
								is_content_true = (parseInt(content) > 0);
							}
						}
						p.append('<input type="checkbox" name="if:'+name+'" '+(is_content_true ? 'checked' : '')+' />');
						p.addClass('checkbox');
						break;
					case 'font':
						p.append(thimble.fontSelector(content).attr('name',k+':'+name));
						break;
					default:
						p.append('<input type="text" value="'+content+'" name="'+k+':'+name+'" />');
						break; 
				}
				$('#appearance-selector .options').append(p);
			});
		});
	},
	fontSelector: function(selected) {
		var select = $('<select></select>');
		select.append('<option value="">(default)</option>');
		select.append("<option value=\"Arial\" style=\"font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;\">Arial</option>");
		select.append("<option value=\"Arial Black\" style=\"font-family:'Arial Black', Arial, 'Helvetica Neue', Helvetica, sans-serif;\">Arial Black</option>");
		select.append("<option value=\"Baskerville\" style=\"font-family:Baskerville, 'Times New Roman', Times, serif;\">Baskerville</option>");
		select.append("<option value=\"Century Gothic\" style=\"font-family:'Century Gothic', 'Apple Gothic', sans-serif;\">Century Gothic</option>");
		select.append("<option value=\"Copperlate Light\" style=\"font-family:'Copperplate Light', 'Copperplate Gothic Light', serif;\">Copperlate Light</option>");
		select.append("<option value=\"Courier New\" style=\"font-family:'Courier New', Courier, monospace;\">Courier New</option>");
		select.append("<option value=\"Futura\" style=\"font-family:Futura, 'Century Gothic', AppleGothic, sans-serif;\">Futura</option>");
		select.append("<option value=\"Garamond\" style=\"font-family:Garamond, 'Hoefler Text', Times New Roman, Times, serif;\">Garamond</option>");
		select.append("<option value=\"Geneva\" style=\"font-family:Geneva, 'Lucida Sans', 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif;\">Geneva</option>");
		select.append("<option value=\"Georgia\" style=\"font-family:Georgia, Palatino, 'Palatino Linotype', Times, 'Times New Roman', serif;\">Georgia</option>");
		select.append("<option value=\"Helvetica\" style=\"font-family:Helvetica, Arial, sans-serif;\">Helvetica</option>");
		select.append("<option value=\"Helvetica Neue\" style=\"font-family:'Helvetica Neue', Arial, Helvetica, sans-serif;\">Helvetica Neue</option>");
		select.append("<option value=\"Impact\" style=\"font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;\">Impact</option>");
		select.append("<option value=\"Lucida Sans\" style=\"font-family:'Lucida Sans', 'Lucida Grande', 'Lucida Sans Unicode', sans-serif;\">Lucida Sans</option>");
		select.append("<option value=\"Trebuchet MS\" style=\"font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;\">Trebuchet MS</option>");
		select.append("<option value=\"Verdana\" style=\"font-family:Verdana, Geneva, Tahoma, sans-serif;\">Verdana</option>");
		if (selected && select.children("option[value='"+selected+"']").length) {
			select.children("option[value='"+selected+"']").attr('selected','selected');
		}
		return select;
	}
};