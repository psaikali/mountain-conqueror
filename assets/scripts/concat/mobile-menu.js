/**
 * File: mobile-menu.js
 *
 * In charge of the main menu navigation on mobile/tablets.
 */
window.inpMcMobileMenu = {};
( function( window, $, app ) {

	// Constructor.
	app.init = function() {
		app.cache();
		app.bindEvents();
		app.prepareMobileMenuMarkup();
	};

	// Cache all the things.
	app.cache = function() {
		app.$c = {
			html: $( 'html' ),
			mobileMenu: $( 'header#masthead nav.main-navigation' ),
			mobileMenuTrigger: $( '.trigger-mobile-menu' ),
			mobileMenuParents: $( 'header#masthead nav.main-navigation li.menu-item-has-children' ),
			subMenus: $( 'header#masthead ul.sub-menu' ),
		};
	};

	// Combine all events.
	app.bindEvents = function() {
		app.$c.mobileMenuTrigger.on( 'click', app.openMobileMenu );
		app.$c.mobileMenu.on( 'click', '.close-mobile-menu', app.closeMobileMenu );
		app.$c.mobileMenu.on( 'click', '.parent-indicator', app.toggleSubMenu );
	};

	// Prepare menu markup (by adding the close button).
	app.prepareMobileMenuMarkup = function() {
		// Add close "X" button to menu.
		let close_button = '<span class="close-mobile-menu">X</span>';
		$( close_button ).appendTo( app.$c.mobileMenu );
		app.$c.mobileMenu.attr( 'aria-expanded', false );

		// Add expand "+" button to items with children.
		app.$c.mobileMenuParents.prepend( '<button type="button" aria-expanded="false" class="parent-indicator" aria-label="Open submenu"><span class="down-arrow">+</span></button>' );
	};

	// Open mobile menu.
	app.openMobileMenu = function( e ) {
		// Global class to let elements change styles when menu opens.
		app.$c.html.addClass( 'mobile-menu-active' );
		
		app.$c.mobileMenu.addClass( 'active' ).attr( 'aria-expanded', true );
	};

	// Close mobile menu.
	app.closeMobileMenu = function( e ) {
		app.$c.html.removeClass( 'mobile-menu-active' );
		app.$c.mobileMenu.removeClass( 'active' ).attr( 'aria-expanded', false );
	};

	// Toggle (open/close) sub-menus.
	app.toggleSubMenu = function( e ) {
		//app.$c.subMenus.slideUp();
		$( this ).parent().find( '> ul.sub-menu' ).stop().slideToggle();
	};

	// Engage!
	$( app.init );

}( window, jQuery, window.inpMcMobileMenu ) );
