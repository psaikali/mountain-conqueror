'use strict';

/**
 * File: mobile-menu.js
 *
 * In charge of the main menu navigation on mobile/tablets.
 */
window.inpMcDebug = {};
(function (window, $, app) {

	// Constructor.
	app.init = function () {
		if (parseInt(inp_mc_data.is_debug) === 1) {
			app.createDebugDiv();
			app.updateDebugData();
			app.bindEvents();
		}
	};

	// Combine all events.
	app.bindEvents = function () {
		$('body').on('resize', app.updateDebugData);
	};

	// Create the debug div.
	app.createDebugDiv = function () {
		var debug_html = '<div class="debug-info"></div>';
		$(debug_html).appendTo('body');
	};

	// Update debug info in the debug div.
	app.updateDebugData = function () {
		var $debug = $('.debug-info');
		var data = '';

		// Viewport size.
		data += $(window).width() + 'x' + $(window).height();
		$debug.text(data);
	};

	// Engage!
	$(app.init);
})(window, jQuery, window.inpMcDebug);
'use strict';

/*
CSS Browser Selector v0.4.0 (Nov 02, 2010)
Rafael Lima (http://rafael.adm.br)
http://rafael.adm.br/css_browser_selector
License: http://creativecommons.org/licenses/by/2.5/
Contributors: http://rafael.adm.br/css_browser_selector#contributors
*/
window.inpMcIeDetector = {};
(function (window, $, app) {

	// Constructor.
	app.init = function () {
		app.addBrowserCssSelector(navigator.userAgent);
	};

	app.addBrowserCssSelector = function (u) {
		var ua = u.toLowerCase(),
		    is = function is(t) {
			return ua.indexOf(t) > -1;
		},
		    g = 'gecko',
		    w = 'webkit',
		    s = 'safari',
		    o = 'opera',
		    m = 'mobile',
		    h = document.documentElement,
		    b = [!/opera|webtv/i.test(ua) && /msie\s(\d)/.test(ua) ? 'ie ie' + RegExp.$1 : is('firefox/2') ? g + ' ff2' : is('firefox/3.5') ? g + ' ff3 ff3_5' : is('firefox/3.6') ? g + ' ff3 ff3_6' : is('firefox/3') ? g + ' ff3' : is('gecko/') ? g : is('opera') ? o + (/version\/(\d+)/.test(ua) ? ' ' + o + RegExp.$1 : /opera(\s|\/)(\d+)/.test(ua) ? ' ' + o + RegExp.$2 : '') : is('konqueror') ? 'konqueror' : is('blackberry') ? m + ' blackberry' : is('android') ? m + ' android' : is('chrome') ? w + ' chrome' : is('iron') ? w + ' iron' : is('applewebkit/') ? w + ' ' + s + (/version\/(\d+)/.test(ua) ? ' ' + s + RegExp.$1 : '') : is('mozilla/') ? g : '', is('j2me') ? m + ' j2me' : is('iphone') ? m + ' iphone' : is('ipod') ? m + ' ipod' : is('ipad') ? m + ' ipad' : is('mac') ? 'mac' : is('darwin') ? 'mac' : is('webtv') ? 'webtv' : is('win') ? 'win' + (is('windows nt 6.0') ? ' vista' : '') : is('freebsd') ? 'freebsd' : is('x11') || is('linux') ? 'linux' : '', 'js'];var ccc = b.join(' ');h.className += ' ' + ccc;
		return ccc;
	};

	// Engage!
	$(app.init);
})(window, jQuery, window.inpMcIeDetector);
'use strict';

/**
 * File js-enabled.js
 *
 * If Javascript is enabled, replace the <body> class "no-js".
 */
document.documentElement.className = document.documentElement.className.replace('no-js', 'js');
'use strict';

/**
 * File: mobile-menu.js
 *
 * In charge of the main menu navigation on mobile/tablets.
 */
window.inpMcMobileMenu = {};
(function (window, $, app) {

	// Constructor.
	app.init = function () {
		app.cache();
		app.bindEvents();
		app.prepareMobileMenuMarkup();
	};

	// Cache all the things.
	app.cache = function () {
		app.$c = {
			html: $('html'),
			mobileMenu: $('header#masthead nav.main-navigation'),
			mobileMenuTrigger: $('.trigger-mobile-menu'),
			mobileMenuParents: $('header#masthead nav.main-navigation li.menu-item-has-children'),
			subMenus: $('header#masthead ul.sub-menu')
		};
	};

	// Combine all events.
	app.bindEvents = function () {
		app.$c.mobileMenuTrigger.on('click', app.openMobileMenu);
		app.$c.mobileMenu.on('click', '.close-mobile-menu', app.closeMobileMenu);
		app.$c.mobileMenu.on('click', '.parent-indicator', app.toggleSubMenu);
	};

	// Prepare menu markup (by adding the close button).
	app.prepareMobileMenuMarkup = function () {
		// Add close "X" button to menu.
		var close_button = '<span class="close-mobile-menu">X</span>';
		$(close_button).appendTo(app.$c.mobileMenu);
		app.$c.mobileMenu.attr('aria-expanded', false);

		// Add expand "+" button to items with children.
		app.$c.mobileMenuParents.prepend('<button type="button" aria-expanded="false" class="parent-indicator" aria-label="Open submenu"><span class="down-arrow">+</span></button>');
	};

	// Open mobile menu.
	app.openMobileMenu = function (e) {
		// Global class to let elements change styles when menu opens.
		app.$c.html.addClass('mobile-menu-active');

		app.$c.mobileMenu.addClass('active').attr('aria-expanded', true);
	};

	// Close mobile menu.
	app.closeMobileMenu = function (e) {
		app.$c.html.removeClass('mobile-menu-active');
		app.$c.mobileMenu.removeClass('active').attr('aria-expanded', false);
	};

	// Toggle (open/close) sub-menus.
	app.toggleSubMenu = function (e) {
		//app.$c.subMenus.slideUp();
		$(this).parent().find('> ul.sub-menu').stop().slideToggle();
	};

	// Engage!
	$(app.init);
})(window, jQuery, window.inpMcMobileMenu);
'use strict';

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
	var isWebkit = -1 < navigator.userAgent.toLowerCase().indexOf('webkit'),
	    isOpera = -1 < navigator.userAgent.toLowerCase().indexOf('opera'),
	    isIe = -1 < navigator.userAgent.toLowerCase().indexOf('msie');

	if ((isWebkit || isOpera || isIe) && document.getElementById && window.addEventListener) {
		window.addEventListener('hashchange', function () {
			var id = location.hash.substring(1),
			    element;

			if (!/^[A-z0-9_-]+$/.test(id)) {
				return;
			}

			element = document.getElementById(id);

			if (element) {
				if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false);
	}
})();
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImRlYnVnLmpzIiwiaWUuanMiLCJqcy1lbmFibGVkLmpzIiwibW9iaWxlLW1lbnUuanMiLCJza2lwLWxpbmstZm9jdXMtZml4LmpzIl0sIm5hbWVzIjpbIndpbmRvdyIsImlucE1jRGVidWciLCIkIiwiYXBwIiwiaW5pdCIsInBhcnNlSW50IiwiaW5wX21jX2RhdGEiLCJpc19kZWJ1ZyIsImNyZWF0ZURlYnVnRGl2IiwidXBkYXRlRGVidWdEYXRhIiwiYmluZEV2ZW50cyIsIm9uIiwiZGVidWdfaHRtbCIsImFwcGVuZFRvIiwiJGRlYnVnIiwiZGF0YSIsIndpZHRoIiwiaGVpZ2h0IiwidGV4dCIsImpRdWVyeSIsImlucE1jSWVEZXRlY3RvciIsImFkZEJyb3dzZXJDc3NTZWxlY3RvciIsIm5hdmlnYXRvciIsInVzZXJBZ2VudCIsInUiLCJ1YSIsInRvTG93ZXJDYXNlIiwiaXMiLCJ0IiwiaW5kZXhPZiIsImciLCJ3IiwicyIsIm8iLCJtIiwiaCIsImRvY3VtZW50IiwiZG9jdW1lbnRFbGVtZW50IiwiYiIsInRlc3QiLCJSZWdFeHAiLCIkMSIsIiQyIiwiY2NjIiwiam9pbiIsImNsYXNzTmFtZSIsInJlcGxhY2UiLCJpbnBNY01vYmlsZU1lbnUiLCJjYWNoZSIsInByZXBhcmVNb2JpbGVNZW51TWFya3VwIiwiJGMiLCJodG1sIiwibW9iaWxlTWVudSIsIm1vYmlsZU1lbnVUcmlnZ2VyIiwibW9iaWxlTWVudVBhcmVudHMiLCJzdWJNZW51cyIsIm9wZW5Nb2JpbGVNZW51IiwiY2xvc2VNb2JpbGVNZW51IiwidG9nZ2xlU3ViTWVudSIsImNsb3NlX2J1dHRvbiIsImF0dHIiLCJwcmVwZW5kIiwiZSIsImFkZENsYXNzIiwicmVtb3ZlQ2xhc3MiLCJwYXJlbnQiLCJmaW5kIiwic3RvcCIsInNsaWRlVG9nZ2xlIiwiaXNXZWJraXQiLCJpc09wZXJhIiwiaXNJZSIsImdldEVsZW1lbnRCeUlkIiwiYWRkRXZlbnRMaXN0ZW5lciIsImlkIiwibG9jYXRpb24iLCJoYXNo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LFdBQVcsQ0FBQyxDQUFELEdBQUsvQyxVQUFVQyxTQUFWLENBQW9CRyxXQUFwQixHQUFrQ0csT0FBbEMsQ0FBMkMsUUFBM0MsQ0FBcEI7QUFBQSxLQUNDeUMsVUFBVSxDQUFDLENBQUQsR0FBS2hELFVBQVVDLFNBQVYsQ0FBb0JHLFdBQXBCLEdBQWtDRyxPQUFsQyxDQUEyQyxPQUEzQyxDQURoQjtBQUFBLEtBRUMwQyxPQUFPLENBQUMsQ0FBRCxHQUFLakQsVUFBVUMsU0FBVixDQUFvQkcsV0FBcEIsR0FBa0NHLE9BQWxDLENBQTJDLE1BQTNDLENBRmI7O0FBSUEsS0FBSyxDQUFFd0MsWUFBWUMsT0FBWixJQUF1QkMsSUFBekIsS0FBbUNuQyxTQUFTb0MsY0FBNUMsSUFBOER4RSxPQUFPeUUsZ0JBQTFFLEVBQTZGO0FBQzVGekUsU0FBT3lFLGdCQUFQLENBQXlCLFlBQXpCLEVBQXVDLFlBQVc7QUFDakQsT0FBSUMsS0FBS0MsU0FBU0MsSUFBVCxDQUFjQyxTQUFkLENBQXlCLENBQXpCLENBQVQ7QUFBQSxPQUNDQyxPQUREOztBQUdBLE9BQUssQ0FBSSxlQUFGLENBQW9CdkMsSUFBcEIsQ0FBMEJtQyxFQUExQixDQUFQLEVBQXdDO0FBQ3ZDO0FBQ0E7O0FBRURJLGFBQVUxQyxTQUFTb0MsY0FBVCxDQUF5QkUsRUFBekIsQ0FBVjs7QUFFQSxPQUFLSSxPQUFMLEVBQWU7QUFDZCxRQUFLLENBQUksdUNBQUYsQ0FBNEN2QyxJQUE1QyxDQUFrRHVDLFFBQVFDLE9BQTFELENBQVAsRUFBNkU7QUFDNUVELGFBQVFFLFFBQVIsR0FBbUIsQ0FBQyxDQUFwQjtBQUNBOztBQUVERixZQUFRRyxLQUFSO0FBQ0E7QUFDRCxHQWpCRCxFQWlCRyxLQWpCSDtBQWtCQTtBQUNELENBekJDLEdBQUYiLCJmaWxlIjoicHJvamVjdC5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogRmlsZTogbW9iaWxlLW1lbnUuanNcbiAqXG4gKiBJbiBjaGFyZ2Ugb2YgdGhlIG1haW4gbWVudSBuYXZpZ2F0aW9uIG9uIG1vYmlsZS90YWJsZXRzLlxuICovXG53aW5kb3cuaW5wTWNEZWJ1ZyA9IHt9O1xuKCBmdW5jdGlvbiggd2luZG93LCAkLCBhcHAgKSB7XG5cblx0Ly8gQ29uc3RydWN0b3IuXG5cdGFwcC5pbml0ID0gZnVuY3Rpb24oKSB7XG5cdFx0aWYgKCBwYXJzZUludCggaW5wX21jX2RhdGEuaXNfZGVidWcgKSA9PT0gMSApIHtcblx0XHRcdGFwcC5jcmVhdGVEZWJ1Z0RpdigpO1xuXHRcdFx0YXBwLnVwZGF0ZURlYnVnRGF0YSgpO1xuXHRcdFx0YXBwLmJpbmRFdmVudHMoKTtcblx0XHR9XG5cdH07XG5cblx0Ly8gQ29tYmluZSBhbGwgZXZlbnRzLlxuXHRhcHAuYmluZEV2ZW50cyA9IGZ1bmN0aW9uKCkge1xuXHRcdCQoICdib2R5JyApLm9uKCAncmVzaXplJywgYXBwLnVwZGF0ZURlYnVnRGF0YSApO1xuXHR9O1xuXG5cdC8vIENyZWF0ZSB0aGUgZGVidWcgZGl2LlxuXHRhcHAuY3JlYXRlRGVidWdEaXYgPSBmdW5jdGlvbigpIHtcblx0XHRsZXQgZGVidWdfaHRtbCA9ICc8ZGl2IGNsYXNzPVwiZGVidWctaW5mb1wiPjwvZGl2Pic7XG5cdFx0JCggZGVidWdfaHRtbCApLmFwcGVuZFRvKCAnYm9keScgKTtcblx0fTtcblxuXHQvLyBVcGRhdGUgZGVidWcgaW5mbyBpbiB0aGUgZGVidWcgZGl2LlxuXHRhcHAudXBkYXRlRGVidWdEYXRhID0gZnVuY3Rpb24oICkge1xuXHRcdGxldCAkZGVidWcgPSAkKCAnLmRlYnVnLWluZm8nICk7XG5cdFx0bGV0IGRhdGEgPSAnJztcblxuXHRcdC8vIFZpZXdwb3J0IHNpemUuXG5cdFx0ZGF0YSArPSAkKCB3aW5kb3cgKS53aWR0aCgpICsgJ3gnICsgJCggd2luZG93ICkuaGVpZ2h0KCk7XG5cdFx0JGRlYnVnLnRleHQoIGRhdGEgKTtcblx0fTtcblxuXHQvLyBFbmdhZ2UhXG5cdCQoIGFwcC5pbml0ICk7XG5cbn0oIHdpbmRvdywgalF1ZXJ5LCB3aW5kb3cuaW5wTWNEZWJ1ZyApICk7XG4iLCIvKlxuQ1NTIEJyb3dzZXIgU2VsZWN0b3IgdjAuNC4wIChOb3YgMDIsIDIwMTApXG5SYWZhZWwgTGltYSAoaHR0cDovL3JhZmFlbC5hZG0uYnIpXG5odHRwOi8vcmFmYWVsLmFkbS5ici9jc3NfYnJvd3Nlcl9zZWxlY3RvclxuTGljZW5zZTogaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbGljZW5zZXMvYnkvMi41L1xuQ29udHJpYnV0b3JzOiBodHRwOi8vcmFmYWVsLmFkbS5ici9jc3NfYnJvd3Nlcl9zZWxlY3RvciNjb250cmlidXRvcnNcbiovXG53aW5kb3cuaW5wTWNJZURldGVjdG9yID0ge307XG4oIGZ1bmN0aW9uKCB3aW5kb3csICQsIGFwcCApIHtcblx0XG5cdC8vIENvbnN0cnVjdG9yLlxuXHRhcHAuaW5pdCA9IGZ1bmN0aW9uKCkge1xuXHRcdGFwcC5hZGRCcm93c2VyQ3NzU2VsZWN0b3IobmF2aWdhdG9yLnVzZXJBZ2VudCk7XG5cdH07XG5cdFxuXHRhcHAuYWRkQnJvd3NlckNzc1NlbGVjdG9yID0gZnVuY3Rpb24oIHUgKSB7XG5cdFx0dmFyIHVhPXUudG9Mb3dlckNhc2UoKSxpcz1mdW5jdGlvbih0KXtyZXR1cm4gdWEuaW5kZXhPZih0KT4tMX0sZz0nZ2Vja28nLHc9J3dlYmtpdCcscz0nc2FmYXJpJyxvPSdvcGVyYScsbT0nbW9iaWxlJyxoPWRvY3VtZW50LmRvY3VtZW50RWxlbWVudCxiPVsoISgvb3BlcmF8d2VidHYvaS50ZXN0KHVhKSkmJi9tc2llXFxzKFxcZCkvLnRlc3QodWEpKT8oJ2llIGllJytSZWdFeHAuJDEpOmlzKCdmaXJlZm94LzInKT9nKycgZmYyJzppcygnZmlyZWZveC8zLjUnKT9nKycgZmYzIGZmM181JzppcygnZmlyZWZveC8zLjYnKT9nKycgZmYzIGZmM182JzppcygnZmlyZWZveC8zJyk/ZysnIGZmMyc6aXMoJ2dlY2tvLycpP2c6aXMoJ29wZXJhJyk/bysoL3ZlcnNpb25cXC8oXFxkKykvLnRlc3QodWEpPycgJytvK1JlZ0V4cC4kMTooL29wZXJhKFxcc3xcXC8pKFxcZCspLy50ZXN0KHVhKT8nICcrbytSZWdFeHAuJDI6JycpKTppcygna29ucXVlcm9yJyk/J2tvbnF1ZXJvcic6aXMoJ2JsYWNrYmVycnknKT9tKycgYmxhY2tiZXJyeSc6aXMoJ2FuZHJvaWQnKT9tKycgYW5kcm9pZCc6aXMoJ2Nocm9tZScpP3crJyBjaHJvbWUnOmlzKCdpcm9uJyk/dysnIGlyb24nOmlzKCdhcHBsZXdlYmtpdC8nKT93KycgJytzKygvdmVyc2lvblxcLyhcXGQrKS8udGVzdCh1YSk/JyAnK3MrUmVnRXhwLiQxOicnKTppcygnbW96aWxsYS8nKT9nOicnLGlzKCdqMm1lJyk/bSsnIGoybWUnOmlzKCdpcGhvbmUnKT9tKycgaXBob25lJzppcygnaXBvZCcpP20rJyBpcG9kJzppcygnaXBhZCcpP20rJyBpcGFkJzppcygnbWFjJyk/J21hYyc6aXMoJ2RhcndpbicpPydtYWMnOmlzKCd3ZWJ0dicpPyd3ZWJ0dic6aXMoJ3dpbicpPyd3aW4nKyhpcygnd2luZG93cyBudCA2LjAnKT8nIHZpc3RhJzonJyk6aXMoJ2ZyZWVic2QnKT8nZnJlZWJzZCc6KGlzKCd4MTEnKXx8aXMoJ2xpbnV4JykpPydsaW51eCc6JycsJ2pzJ107IGxldCBjY2MgPSBiLmpvaW4oJyAnKTsgIGguY2xhc3NOYW1lICs9ICcgJyArIGNjYztcblx0XHRyZXR1cm4gY2NjO1xuXHR9O1xuXG5cdC8vIEVuZ2FnZSFcblx0JCggYXBwLmluaXQgKTtcblxufSggd2luZG93LCBqUXVlcnksIHdpbmRvdy5pbnBNY0llRGV0ZWN0b3IgKSApOyIsIi8qKlxuICogRmlsZSBqcy1lbmFibGVkLmpzXG4gKlxuICogSWYgSmF2YXNjcmlwdCBpcyBlbmFibGVkLCByZXBsYWNlIHRoZSA8Ym9keT4gY2xhc3MgXCJuby1qc1wiLlxuICovXG5kb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuY2xhc3NOYW1lID0gZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LmNsYXNzTmFtZS5yZXBsYWNlKCAnbm8tanMnLCAnanMnICk7IiwiLyoqXG4gKiBGaWxlOiBtb2JpbGUtbWVudS5qc1xuICpcbiAqIEluIGNoYXJnZSBvZiB0aGUgbWFpbiBtZW51IG5hdmlnYXRpb24gb24gbW9iaWxlL3RhYmxldHMuXG4gKi9cbndpbmRvdy5pbnBNY01vYmlsZU1lbnUgPSB7fTtcbiggZnVuY3Rpb24oIHdpbmRvdywgJCwgYXBwICkge1xuXG5cdC8vIENvbnN0cnVjdG9yLlxuXHRhcHAuaW5pdCA9IGZ1bmN0aW9uKCkge1xuXHRcdGFwcC5jYWNoZSgpO1xuXHRcdGFwcC5iaW5kRXZlbnRzKCk7XG5cdFx0YXBwLnByZXBhcmVNb2JpbGVNZW51TWFya3VwKCk7XG5cdH07XG5cblx0Ly8gQ2FjaGUgYWxsIHRoZSB0aGluZ3MuXG5cdGFwcC5jYWNoZSA9IGZ1bmN0aW9uKCkge1xuXHRcdGFwcC4kYyA9IHtcblx0XHRcdGh0bWw6ICQoICdodG1sJyApLFxuXHRcdFx0bW9iaWxlTWVudTogJCggJ2hlYWRlciNtYXN0aGVhZCBuYXYubWFpbi1uYXZpZ2F0aW9uJyApLFxuXHRcdFx0bW9iaWxlTWVudVRyaWdnZXI6ICQoICcudHJpZ2dlci1tb2JpbGUtbWVudScgKSxcblx0XHRcdG1vYmlsZU1lbnVQYXJlbnRzOiAkKCAnaGVhZGVyI21hc3RoZWFkIG5hdi5tYWluLW5hdmlnYXRpb24gbGkubWVudS1pdGVtLWhhcy1jaGlsZHJlbicgKSxcblx0XHRcdHN1Yk1lbnVzOiAkKCAnaGVhZGVyI21hc3RoZWFkIHVsLnN1Yi1tZW51JyApLFxuXHRcdH07XG5cdH07XG5cblx0Ly8gQ29tYmluZSBhbGwgZXZlbnRzLlxuXHRhcHAuYmluZEV2ZW50cyA9IGZ1bmN0aW9uKCkge1xuXHRcdGFwcC4kYy5tb2JpbGVNZW51VHJpZ2dlci5vbiggJ2NsaWNrJywgYXBwLm9wZW5Nb2JpbGVNZW51ICk7XG5cdFx0YXBwLiRjLm1vYmlsZU1lbnUub24oICdjbGljaycsICcuY2xvc2UtbW9iaWxlLW1lbnUnLCBhcHAuY2xvc2VNb2JpbGVNZW51ICk7XG5cdFx0YXBwLiRjLm1vYmlsZU1lbnUub24oICdjbGljaycsICcucGFyZW50LWluZGljYXRvcicsIGFwcC50b2dnbGVTdWJNZW51ICk7XG5cdH07XG5cblx0Ly8gUHJlcGFyZSBtZW51IG1hcmt1cCAoYnkgYWRkaW5nIHRoZSBjbG9zZSBidXR0b24pLlxuXHRhcHAucHJlcGFyZU1vYmlsZU1lbnVNYXJrdXAgPSBmdW5jdGlvbigpIHtcblx0XHQvLyBBZGQgY2xvc2UgXCJYXCIgYnV0dG9uIHRvIG1lbnUuXG5cdFx0bGV0IGNsb3NlX2J1dHRvbiA9ICc8c3BhbiBjbGFzcz1cImNsb3NlLW1vYmlsZS1tZW51XCI+WDwvc3Bhbj4nO1xuXHRcdCQoIGNsb3NlX2J1dHRvbiApLmFwcGVuZFRvKCBhcHAuJGMubW9iaWxlTWVudSApO1xuXHRcdGFwcC4kYy5tb2JpbGVNZW51LmF0dHIoICdhcmlhLWV4cGFuZGVkJywgZmFsc2UgKTtcblxuXHRcdC8vIEFkZCBleHBhbmQgXCIrXCIgYnV0dG9uIHRvIGl0ZW1zIHdpdGggY2hpbGRyZW4uXG5cdFx0YXBwLiRjLm1vYmlsZU1lbnVQYXJlbnRzLnByZXBlbmQoICc8YnV0dG9uIHR5cGU9XCJidXR0b25cIiBhcmlhLWV4cGFuZGVkPVwiZmFsc2VcIiBjbGFzcz1cInBhcmVudC1pbmRpY2F0b3JcIiBhcmlhLWxhYmVsPVwiT3BlbiBzdWJtZW51XCI+PHNwYW4gY2xhc3M9XCJkb3duLWFycm93XCI+Kzwvc3Bhbj48L2J1dHRvbj4nICk7XG5cdH07XG5cblx0Ly8gT3BlbiBtb2JpbGUgbWVudS5cblx0YXBwLm9wZW5Nb2JpbGVNZW51ID0gZnVuY3Rpb24oIGUgKSB7XG5cdFx0Ly8gR2xvYmFsIGNsYXNzIHRvIGxldCBlbGVtZW50cyBjaGFuZ2Ugc3R5bGVzIHdoZW4gbWVudSBvcGVucy5cblx0XHRhcHAuJGMuaHRtbC5hZGRDbGFzcyggJ21vYmlsZS1tZW51LWFjdGl2ZScgKTtcblx0XHRcblx0XHRhcHAuJGMubW9iaWxlTWVudS5hZGRDbGFzcyggJ2FjdGl2ZScgKS5hdHRyKCAnYXJpYS1leHBhbmRlZCcsIHRydWUgKTtcblx0fTtcblxuXHQvLyBDbG9zZSBtb2JpbGUgbWVudS5cblx0YXBwLmNsb3NlTW9iaWxlTWVudSA9IGZ1bmN0aW9uKCBlICkge1xuXHRcdGFwcC4kYy5odG1sLnJlbW92ZUNsYXNzKCAnbW9iaWxlLW1lbnUtYWN0aXZlJyApO1xuXHRcdGFwcC4kYy5tb2JpbGVNZW51LnJlbW92ZUNsYXNzKCAnYWN0aXZlJyApLmF0dHIoICdhcmlhLWV4cGFuZGVkJywgZmFsc2UgKTtcblx0fTtcblxuXHQvLyBUb2dnbGUgKG9wZW4vY2xvc2UpIHN1Yi1tZW51cy5cblx0YXBwLnRvZ2dsZVN1Yk1lbnUgPSBmdW5jdGlvbiggZSApIHtcblx0XHQvL2FwcC4kYy5zdWJNZW51cy5zbGlkZVVwKCk7XG5cdFx0JCggdGhpcyApLnBhcmVudCgpLmZpbmQoICc+IHVsLnN1Yi1tZW51JyApLnN0b3AoKS5zbGlkZVRvZ2dsZSgpO1xuXHR9O1xuXG5cdC8vIEVuZ2FnZSFcblx0JCggYXBwLmluaXQgKTtcblxufSggd2luZG93LCBqUXVlcnksIHdpbmRvdy5pbnBNY01vYmlsZU1lbnUgKSApO1xuIiwiLyoqXG4gKiBGaWxlIHNraXAtbGluay1mb2N1cy1maXguanMuXG4gKlxuICogSGVscHMgd2l0aCBhY2Nlc3NpYmlsaXR5IGZvciBrZXlib2FyZCBvbmx5IHVzZXJzLlxuICpcbiAqIExlYXJuIG1vcmU6IGh0dHBzOi8vZ2l0LmlvL3ZXZHIyXG4gKi9cbiggZnVuY3Rpb24oKSB7XG5cdHZhciBpc1dlYmtpdCA9IC0xIDwgbmF2aWdhdG9yLnVzZXJBZ2VudC50b0xvd2VyQ2FzZSgpLmluZGV4T2YoICd3ZWJraXQnICksXG5cdFx0aXNPcGVyYSA9IC0xIDwgbmF2aWdhdG9yLnVzZXJBZ2VudC50b0xvd2VyQ2FzZSgpLmluZGV4T2YoICdvcGVyYScgKSxcblx0XHRpc0llID0gLTEgPCBuYXZpZ2F0b3IudXNlckFnZW50LnRvTG93ZXJDYXNlKCkuaW5kZXhPZiggJ21zaWUnICk7XG5cblx0aWYgKCAoIGlzV2Via2l0IHx8IGlzT3BlcmEgfHwgaXNJZSApICYmIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkICYmIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyICkge1xuXHRcdHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCAnaGFzaGNoYW5nZScsIGZ1bmN0aW9uKCkge1xuXHRcdFx0dmFyIGlkID0gbG9jYXRpb24uaGFzaC5zdWJzdHJpbmcoIDEgKSxcblx0XHRcdFx0ZWxlbWVudDtcblxuXHRcdFx0aWYgKCAhICggL15bQS16MC05Xy1dKyQvICkudGVzdCggaWQgKSApIHtcblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXG5cdFx0XHRlbGVtZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIGlkICk7XG5cblx0XHRcdGlmICggZWxlbWVudCApIHtcblx0XHRcdFx0aWYgKCAhICggL14oPzphfHNlbGVjdHxpbnB1dHxidXR0b258dGV4dGFyZWEpJC9pICkudGVzdCggZWxlbWVudC50YWdOYW1lICkgKSB7XG5cdFx0XHRcdFx0ZWxlbWVudC50YWJJbmRleCA9IC0xO1xuXHRcdFx0XHR9XG5cblx0XHRcdFx0ZWxlbWVudC5mb2N1cygpO1xuXHRcdFx0fVxuXHRcdH0sIGZhbHNlICk7XG5cdH1cbn0oKSApO1xuIl19
