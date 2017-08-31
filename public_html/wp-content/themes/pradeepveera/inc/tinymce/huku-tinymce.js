


tinymce.PluginManager.add('huku_tinymce', function( ed, url ) {		
	
	
	ed.on('init', function(e) {				
		
		//ed.formatter.register('content_block', {block : 'div', classes : 'content-block', wrapper: true, merge_siblings: false});
		
		//ed.formatter.register('half_width', {selector : 'div.content-block', classes : 'half-width'});
		//ed.formatter.register('full_width', {selector : 'div.content-block', classes : 'full-width'});
		
		
		
		//ed.formatter.register('content_block_width', {block : 'div', classes : 'content-block', styles : {color : '%value'}, wrapper: true, merge_siblings: false});
		
	});

	
	ed.addButton('huku_menu', {
		text: 'Einfügen',
		icon: false,
		type: 'menubutton',
		menu: [
		
			{
				text: 'Blöcke',
				menu: [
					{
						text: 'Halbe Spalte',
						icon: false,
						onclick: function() {
							ed.formatter.apply('content_block');
							ed.formatter.remove('full_width');
							ed.formatter.apply('half_width');
						}
					},
					
					{
						text: 'Volle Spalte',
						icon: false,
						onclick: function() {
							ed.formatter.apply('content_block');
							ed.formatter.remove('half_width');
							ed.formatter.apply('full_width');
						}
					},

					{
						text: '2-spaltig',
						icon: false,
						onclick: function() {
						
							
							ed.selection.setContent('<div class="content-block-wrapper two-column"><div class="content-block">links</div><div class="content-block">rechts</div></div>');
							
							//var wrapper = ed.dom.create('div', {class: 'wrapper two-column'});
							//ed.dom.add(wrapper, 'div', {class: 'content-block'}, 'test');
							
							//ed.selection.setNode(wrapper);
						
							//ed.formatter.apply('content_block');
							//ed.formatter.remove('full_width');
							//ed.formatter.apply('half_width');
						}
					},
					
				]
			},
		
			{
				text: 'Blöcke',
				menu: [
					{
						text: 'Halbe Spalte',
						icon: false,
						onclick: function() {
							//ed.insertContent('<div class="content-block half-width">Text</p>');
							
							selection = ed.selection.getContent();
							//ed.selection.setContent('<div class="content-block"><p>' + selection + '</p></div>');
							
							var node = ed.selection.setNode(ed.dom.create('div', {class: 'content-block'}, selection));								
							ed.formatter.apply('content_block_width', {value: 'red'}, node);
						}
					},
					{
						text: 'Volle Spalte',
						icon: false,
						onclick: function() {
							//ed.insertContent('<div class="content-block full-width">Text</p>');
							
							var node = ed.selection.setNode(ed.dom.create('div', {class: 'content-block'}));								
							ed.formatter.apply('content_block_width', {width: 'full-width'}, node);
						}
					},
					{
						text: 'insert on top',
						icon: false,
						stateSelector: 'h2',
						onclick: function() {
							// Open window
							ed.windowManager.open({
								title: 'Example plugin',
								body: [
									{type: 'textbox', name: 'title', label: 'Title'}
								],
								onsubmit: function(e) {
									// Insert content when the window form is submitted
									ed.selection.setCursorLocation(ed.getBody().firstChild, 0);									
									ed.insertContent( ed.selection.getContent() );
								}
							});
						}
					},
				]
			},			
			
			{
				text: 'Textbausteine',
				menu: [
				
					{
						text: 'Lorem ipsum',
						icon: false,
						onclick: function() {
							ed.insertContent('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.');
						}
					},
					
					
					
				]
			},
			
			{
				text: 'Test',
				menu: [
					
					{
						text: 'Selection to setContent',
						icon: false,
						onclick: function() {
							selection = tinyMCE.activeEditor.selection.getContent();
							ed.selection.setContent('<div class="content-block"><p>' + selection + '</p></div>');
					
						}
					},
										
					{
						text: 'setNode + apply',
						icon: false,
						onclick: function() {
							var node = ed.selection.setNode(ed.dom.create('div', {class: 'content-block'}));								
							ed.formatter.apply('content_block', node);
						}
					},
					
					{
						text: 'nur apply',
						icon: false,
						onclick: function() {														
							ed.formatter.apply('content_block');
						}
					},
					
				]
			},
			
		]			
	});
	
	
});
