/*
 * Single Drop Down Menu 1.3
 * April 18, 2010
 * Corey Hart @ http://www.codenothing.com
 */
(function( $, undefined ){


// bgiframe is needed to fix z-index problem for IE6 users.
// For applications that don't have bgiframe plugin installed, create a useless 
// function that doesn't break the chain
function emptyfn(){
	return this;
}

// Drop Menu Plugin
$.fn.singleDropMenu = function( options ) {
	return this.each(function(){
		// Default Settings
		var $main = $(this), timer, $menu, $li, el,
			settings = $.extend({
				timer: 500,
				parentMO: undefined,
				childMO: undefined,
				bgiframe: undefined,
				show: 'show',
				hide: 'hide'
			}, options || {}, $.metadata ? $main.metadata() : {} ),
			
			// bgiframe replica
			bgiframe = $.fn.bgiframe || $.fn.bgIframe || emptyfn;

		// Run Menu
		$main.delegate( 'li', 'mouseenter.single-ddm', function(){
			// Clear any open menus
			if ( $.data( el = this, 'single-ddm-toplevel' ) !== true ) {
				$( el ).children('a').addClass( settings.childMO );
				return true;
			}
			else if ( ! $menu || $menu[0] !== el ) {
				closemenu();
				$( el ).children('a').addClass( settings.parentMO ).siblings('ul')[ settings.show ]();
			}
			else {
				$menu = false;
				if ( timer ) {
					timer = clearTimeout( timer );
				}
			}
		})
		.delegate('li', 'mouseleave.single-ddm', function(){
			if ( $.data( el = this, 'single-ddm-toplevel' ) !== true ) {
				$( el ).children('a').removeClass( settings.childMO );
				return true;
			}
			
			if ( timer ) {
				clearTimeout( timer );
			}

			$menu = $( el );
			timer = setTimeout( closemenu, settings.timer );
		});

		// Each nested list needs to be wrapper with bgiframe if possible
		bgiframe.call(
			$main.children('li').data( 'single-ddm-toplevel', true ).children('ul'),
			settings.bgiframe
		);

		// Function to close set menu
		function closemenu(){
			if ( $menu && timer ){
				$menu.children('a').removeClass( settings.parentMO ).siblings('ul')[ settings.hide ]();
				timer = clearTimeout( timer );
				$menu = false;
			}
		}

		// Closes any open menus when mouse click occurs anywhere else on the page
		$(document).click( closemenu );
	});
};


})( jQuery );
