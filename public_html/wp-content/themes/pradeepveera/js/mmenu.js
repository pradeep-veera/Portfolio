(function ( $ ) {
 
	$.fn.hukuMmenu = function() {
		
		var $activeSubmenu = false;
		
		var $mmenu = this;
		$mmenu.addClass('mmenu').prependTo('body');		
		
		var $panels = $('<div class="panels"></div>');
		$panels.prependTo($mmenu);
		
		var $mainMenu = $mmenu.children('ul');		
		
		var i = 0;
		$mainMenu.children('li').each(function() {
			i++;
			var $this = $(this);
			if ( $this.children('ul.sub-menu').length ) {
				var $subMenu = $this.children('ul.sub-menu');				
				$subMenu.attr('data-panel', i);
				$this.attr('data-panel', i).append('<div class="open-submenu" data-panel="'+ i +'"><div class="count">' + $subMenu.children('li').length + '</div></div>');
				$subMenu.appendTo( $panels );
				$subMenu.prepend('<li class="back-button"><a href="#close-submenu">zurück</a></li>');
			}
		});
		var $subMenus = $panels.children('ul.sub-menu');
		
		$mainMenu.prependTo( $panels );
		
		var $currentMenuItem = $mmenu.find('li.current-menu-item').first();
		var $currentMenu = $currentMenuItem.closest('ul');
		
		
		
		var $header = $('<div class="menu-header"><div class="headline">Sie befinden sich hier</div><div id="mm-breadcrumb" class="breadcrumb"></div></div>');
		$header.prependTo($mmenu);
		
		var openSubmenu = function( panelID ) {			
			$activeSubmenu = $subMenus.filter('[data-panel="'+ panelID +'"]');
			$mainMenu.css({'transform': 'translate(-100%,0)'});
			$activeSubmenu.css({'transform': 'translate(0,0)'});
			generateBreadcrumb();
		};
		
		var closeSubmenu = function() {
			$mainMenu.css({'transform': 'translate(0,0)'});
			$activeSubmenu.css({'transform': 'translate(100%,0)'});
			$activeSubmenu = false;
			generateBreadcrumb();
		};
		
		// Hauptmenu-Punkte öffnen das Submenu
		$mainMenu.children('li.menu-item-has-children').click(function(e) {
			e.preventDefault();
			openSubmenu( $(this).attr('data-panel') );
		});
		
		// Zurück-Button schließt das Submenu
		$mmenu.find('a[href="#close-submenu"]').click(function() {
			closeSubmenu();			
		});
		
		var generateBreadcrumb = function() {
			//var breadcrumbText = $currentMenuItem.children('a').text().length ? $currentMenuItem.children('a').text() : 'Startseite';
			var breadcrumbText = 'Menü';
			if ( $activeSubmenu ) {
				var panelID = $activeSubmenu.attr('data-panel');
				var parentText = $mainMenu.find('li[data-panel="'+ panelID +'"] a').text();
				breadcrumbText = breadcrumbText + ' / ' + parentText;
			}
			$('#mm-breadcrumb').html( breadcrumbText );
		};
		generateBreadcrumb();
		
				
		if ( $currentMenu.is('.sub-menu') ) {
			openSubmenu( $currentMenu.attr('data-panel') );	
		}
		
		
		return this;
	};
 
}( jQuery ));