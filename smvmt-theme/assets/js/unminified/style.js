/**
 * File navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 *
 * @package smvmt
 */

/**
 * Get all of an element's parent elements up the DOM tree
 *
 * @param  {Node}   elem     The element.
 * @param  {String} selector Selector to match against [optional].
 * @return {Array}           The parent elements.
 */
var getParents = function ( elem, selector ) {

	// Element.matches() polyfill.
	if ( ! Element.prototype.matches) {
		Element.prototype.matches =
			Element.prototype.matchesSelector ||
			Element.prototype.mozMatchesSelector ||
			Element.prototype.msMatchesSelector ||
			Element.prototype.oMatchesSelector ||
			Element.prototype.webkitMatchesSelector ||
			function(s) {
				var matches = (this.document || this.ownerDocument).querySelectorAll( s ),
					i = matches.length;
				while (--i >= 0 && matches.item( i ) !== this) {}
				return i > -1;
			};
	}

	// Setup parents array.
	var parents = [];

	// Get matching parent elements.
	for ( ; elem && elem !== document; elem = elem.parentNode ) {

		// Add matching parents to array.
		if ( selector ) {
			if ( elem.matches( selector ) ) {
				parents.push( elem );
			}
		} else {
			parents.push( elem );
		}
	}
	return parents;
};

/**
 * Toggle Class funtion
 *
 * @param  {Node}   elem     The element.
 * @param  {String} selector Selector to match against [optional].
 * @return {Array}           The parent elements.
 */
var toggleClass = function ( el, className ) {
	if ( el.classList.contains( className ) ) {
		el.classList.remove( className );
	} else {
		el.classList.add( className );
	}
};

// CustomEvent() constructor functionality in Internet Explorer 9 and higher.
(function () {

	if (typeof window.CustomEvent === "function") return false;
	function CustomEvent(event, params) {
		params = params || { bubbles: false, cancelable: false, detail: undefined };
		var evt = document.createEvent('CustomEvent');
		evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
		return evt;
	}
	CustomEvent.prototype = window.Event.prototype;
	window.CustomEvent = CustomEvent;
})();

/**
 * Trigget custom JS Event.
 *
 * @since 1.4.6
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent
 * @param {Node} el Dom Node element on which the event is to be triggered.
 * @param {Node} typeArg A DOMString representing the name of the event.
 * @param {String} A CustomEventInit dictionary, having the following fields:
 *			"detail", optional and defaulting to null, of type any, that is an event-dependent value associated with the event.
 */
var smvmtTriggerEvent = function smvmtTriggerEvent( el, typeArg ) {
	var customEventInit =
	  arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

	var event = new CustomEvent(typeArg, customEventInit);
	el.dispatchEvent(event);
};

( function() {

	var menu_toggle_all 	 = document.querySelectorAll( '.main-header-menu-toggle' );
	var menu_click_listeners = {};

	/* Add break point Class and related trigger */
	var updateHeaderBreakPoint = function () {

		// Content overrflowing out of screen can give incorrect window.innerWidth.
		// Adding overflow hidden and then calculating the window.innerWidth fixes the problem.
		var originalOverflow = document.querySelector('body').style.overflow;
		document.querySelector('body').style.overflow = 'hidden';
		var ww = window.innerWidth;
		document.querySelector('body').style.overflow = originalOverflow;

		var break_point = smvmt.break_point,
			headerWrap = document.querySelectorAll('.main-header-bar-wrap');

		if (headerWrap.length > 0) {
			for (var i = 0; i < headerWrap.length; i++) {

				if (headerWrap[i].tagName == 'DIV' && headerWrap[i].classList.contains('main-header-bar-wrap')) {
					if (ww > break_point) {
						//remove menu toggled class.
						if (null != menu_toggle_all[i]) {
							menu_toggle_all[i].classList.remove('toggled');
						}
						document.body.classList.remove("smvmt-header-break-point");
						document.body.classList.add("smvmt-desktop");
						smvmtTriggerEvent(document.body, "smvmt-header-responsive-enabled");

					} else {

						document.body.classList.add("smvmt-header-break-point");
						document.body.classList.remove("smvmt-desktop");
						smvmtTriggerEvent(document.body, "smvmt-header-responsive-disabled")
					}
				}
			}
		}
	}

	updateHeaderBreakPoint();

	smvmtToggleSubMenu = function() {
		var parent_li = this.parentNode;
		if (parent_li.classList.contains('smvmt-submenu-expanded') && document.querySelector("header.site-header").classList.contains("smvmt-menu-toggle-link")) {
			if (!this.classList.contains('smvmt-menu-toggle')) {
				var link = parent_li.querySelector('a').getAttribute('href');
				if ('' !== link || '#' !== link) {
					window.location = link;
				}
			}
		}

		var parent_li_child = parent_li.querySelectorAll('.menu-item-has-children, .page_item_has_children');
		for (var j = 0; j < parent_li_child.length; j++) {

			parent_li_child[j].classList.remove('smvmt-submenu-expanded');
			var parent_li_child_sub_menu = parent_li_child[j].querySelector('.sub-menu, .children');
			parent_li_child_sub_menu.style.display = 'none';
		};

		var parent_li_sibling = parent_li.parentNode.querySelectorAll('.menu-item-has-children, .page_item_has_children');
		for (var j = 0; j < parent_li_sibling.length; j++) {

			if (parent_li_sibling[j] != parent_li) {

				parent_li_sibling[j].classList.remove('smvmt-submenu-expanded');
				var all_sub_menu = parent_li_sibling[j].querySelectorAll('.sub-menu, .children');
				for (var k = 0; k < all_sub_menu.length; k++) {
					all_sub_menu[k].style.display = 'none';
				};
			}
		};

		if (parent_li.classList.contains('menu-item-has-children') || parent_li.classList.contains('page_item_has_children')) {
			toggleClass(parent_li, 'smvmt-submenu-expanded');
			if (parent_li.classList.contains('smvmt-submenu-expanded')) {
				parent_li.querySelector('.sub-menu, .children').style.display = 'block';
			} else {
				parent_li.querySelector('.sub-menu, .children').style.display = 'none';
			}
		}
	};

	smvmtNavigationMenu = function( parentList ) {
		console.warn( 'smvmtNavigationMenu() function has been deprecated since version 1.6.5 or above of smvmt Theme and will be removed in the future.' );
	};

	smvmtToggleMenu = function( SMVMT_menu_toggle ) {
		console.warn('smvmtToggleMenu() function has been deprecated since version 1.6.5 or above of smvmt Theme and will be removed in the future. Use smvmtToggleSubMenu() instead.');

		// Add Eventlisteners for Submenu.
		if (SMVMT_menu_toggle.length > 0) {
			for (var i = 0; i < SMVMT_menu_toggle.length; i++) {
				SMVMT_menu_toggle[i].addEventListener('click', smvmtToggleSubMenu, false);
			};
		}
	};

	smvmtToggleSetup = function () {
		var __main_header_all = document.querySelectorAll('.main-header-bar-navigation');

		if (menu_toggle_all.length > 0) {

			for (var i = 0; i < menu_toggle_all.length; i++) {

				menu_toggle_all[i].setAttribute('data-index', i);

				if ( ! menu_click_listeners[i] ) {
					menu_click_listeners[i] = menu_toggle_all[i];
					menu_toggle_all[i].addEventListener('click', smvmtNavMenuToggle, false);
				}

				if ('undefined' !== typeof __main_header_all[i]) {

					if (document.querySelector("header.site-header").classList.contains("smvmt-menu-toggle-link")) {
						var SMVMT_menu_toggle = __main_header_all[i].querySelectorAll('.smvmt-header-break-point .main-header-menu .menu-item-has-children > a, .smvmt-header-break-point .main-header-menu .page_item_has_children > a, .smvmt-header-break-point ul.main-header-menu .smvmt-menu-toggle');
					} else {
						var SMVMT_menu_toggle = __main_header_all[i].querySelectorAll('ul.main-header-menu .smvmt-menu-toggle');
					}

					// Add Eventlisteners for Submenu.
					if (SMVMT_menu_toggle.length > 0) {
						for (var j = 0; j < SMVMT_menu_toggle.length; j++) {
							SMVMT_menu_toggle[j].addEventListener('click', smvmtToggleSubMenu, false);
						};
					}

				}
			};
		}
	};

	smvmtNavMenuToggle = function ( event ) {
		event.preventDefault();
		var __main_header_all = document.querySelectorAll('.main-header-bar-navigation');
		var event_index = this.getAttribute('data-index');

		if ('undefined' === typeof __main_header_all[event_index]) {

			return false;
		}

		var menuHasChildren = __main_header_all[event_index].querySelectorAll('.menu-item-has-children, .page_item_has_children');
		for (var i = 0; i < menuHasChildren.length; i++) {
			menuHasChildren[i].classList.remove('smvmt-submenu-expanded');
			var menuHasChildrenSubMenu = menuHasChildren[i].querySelectorAll('.sub-menu, .children');
			for (var j = 0; j < menuHasChildrenSubMenu.length; j++) {
				menuHasChildrenSubMenu[j].style.display = 'none';
			};
		}

		var menu_class = this.getAttribute('class') || '';

		if ( menu_class.indexOf('main-header-menu-toggle') !== -1 ) {
			toggleClass(__main_header_all[event_index], 'toggle-on');
			toggleClass(menu_toggle_all[event_index], 'toggled');
			if (__main_header_all[event_index].classList.contains('toggle-on')) {
				__main_header_all[event_index].style.display = 'block';
				document.body.classList.add("smvmt-main-header-nav-open");
			} else {
				__main_header_all[event_index].style.display = '';
				document.body.classList.remove("smvmt-main-header-nav-open");
			}
		}
	};

	document.body.addEventListener("smvmt-header-responsive-enabled", function () {

		var __main_header_all = document.querySelectorAll('.main-header-bar-navigation');

		if (__main_header_all.length > 0) {

			for (var i = 0; i < __main_header_all.length; i++) {
				if (null != __main_header_all[i]) {
					__main_header_all[i].classList.remove('toggle-on');
					__main_header_all[i].style.display = '';
				}

				var sub_menu = __main_header_all[i].getElementsByClassName('sub-menu');
				for (var j = 0; j < sub_menu.length; j++) {
					sub_menu[j].style.display = '';
				}
				var child_menu = __main_header_all[i].getElementsByClassName('children');
				for (var k = 0; k < child_menu.length; k++) {
					child_menu[k].style.display = '';
				}

				var searchIcons = __main_header_all[i].getElementsByClassName('smvmt-search-menu-icon');
				for (var l = 0; l < searchIcons.length; l++) {
					searchIcons[l].classList.remove('smvmt-dropdown-active');
					searchIcons[l].style.display = '';
				}
			}
		}
	}, false);

	window.addEventListener('resize', function () {
		// Skip resize event when keyboard display event triggers on devices.
		if( 'INPUT' !== document.activeElement.tagName ) {
			updateHeaderBreakPoint();
			smvmtToggleSetup();
		}
	});

	document.addEventListener('DOMContentLoaded', function () {
		smvmtToggleSetup();
		/**
		 * Navigation Keyboard Navigation.
		 */
		var container, button, menu, links, subMenus, i, len, count;

		container = document.querySelectorAll( '.navigation-accessibility' );

		for ( count = 0; count <= container.length - 1; count++ ) {
			if ( container[count] ) {
				navigation_accessibility( container[count] );
			}
		}
	});


	var get_browser = function () {
	    var ua = navigator.userAgent,tem,M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
	    if(/trident/i.test(M[1])) {
	        tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
	        return;
	    }
	    if( 'Chrome'  === M[1] ) {
	        tem = ua.match(/\bOPR|Edge\/(\d+)/)
	        if(tem != null)   {
	        	return;
	        	}
	        }
	    M = M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
	    if((tem = ua.match(/version\/(\d+)/i)) != null) {
	    	M.splice(1,1,tem[1]);
	    }

	    bodyElement = document.body;
	    if( 'Safari' === M[0] && M[1] < 11 ) {
		   bodyElement.classList.add( "smvmt-safari-browser-less-than-11" );
	    }
	}

	get_browser();

	/* Search Script */
	var SearchIcons = document.getElementsByClassName( 'smvmt-search-icon' );
	for (var i = 0; i < SearchIcons.length; i++) {

		SearchIcons[i].onclick = function(event) {
            if ( this.classList.contains( 'slide-search' ) ) {
                event.preventDefault();
                var sibling = this.parentNode.parentNode.parentNode.querySelector( '.smvmt-search-menu-icon' );
                if ( ! sibling.classList.contains( 'smvmt-dropdown-active' ) ) {
                    sibling.classList.add( 'smvmt-dropdown-active' );
                    sibling.querySelector( '.search-field' ).setAttribute('autocomplete','off');
                    setTimeout(function() {
                     sibling.querySelector( '.search-field' ).focus();
                    },200);
                } else {
                	var searchTerm = sibling.querySelector( '.search-field' ).value || '';
	                if( '' !== searchTerm ) {
    		            sibling.querySelector( '.search-form' ).submit();
                    }
                    sibling.classList.remove( 'smvmt-dropdown-active' );
                }
            }
        }
	};

	/* Hide Dropdown on body click*/
	document.body.onclick = function( event ) {
		if ( typeof event.target.classList !==  'undefined' ) {
			if ( ! event.target.classList.contains( 'smvmt-search-menu-icon' ) && getParents( event.target, '.smvmt-search-menu-icon' ).length === 0 && getParents( event.target, '.smvmt-search-icon' ).length === 0  ) {
				var dropdownSearchWrap = document.getElementsByClassName( 'smvmt-search-menu-icon' );

				for (var i = 0; i < dropdownSearchWrap.length; i++) {
					dropdownSearchWrap[i].classList.remove( 'smvmt-dropdown-active' );
				};
			}
		}
	}

	/**
	 * Navigation Keyboard Navigation.
	 */
	function navigation_accessibility( container ) {
		if ( ! container ) {
			return;
		}

		button = container.getElementsByTagName( 'button' )[0];
		if ( 'undefined' === typeof button ) {
			button = container.getElementsByTagName( 'a' )[0];
			if ( 'undefined' === typeof button ) {
				return;
			}
		}

		menu = container.getElementsByTagName( 'ul' )[0];

		// Hide menu toggle button if menu is empty and return early.
		if ( 'undefined' === typeof menu ) {
			button.style.display = 'none';
			return;
		}

		menu.setAttribute( 'aria-expanded', 'false' );
		if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
			menu.className += ' nav-menu';
		}

		button.onclick = function() {
			if ( -1 !== container.className.indexOf( 'toggled' ) ) {
				container.className = container.className.replace( ' toggled', '' );
				button.setAttribute( 'aria-expanded', 'false' );
				menu.setAttribute( 'aria-expanded', 'false' );
			} else {
				container.className += ' toggled';
				button.setAttribute( 'aria-expanded', 'true' );
				menu.setAttribute( 'aria-expanded', 'true' );
			}
		};

		// Get all the link elements within the menu.
		links    = menu.getElementsByTagName( 'a' );
		subMenus = menu.getElementsByTagName( 'ul' );


		// Set menu items with submenus to aria-haspopup="true".
		for ( i = 0, len = subMenus.length; i < len; i++ ) {
			subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
		}

		// Each time a menu link is focused or blurred, toggle focus.
		for ( i = 0, len = links.length; i < len; i++ ) {
			links[i].addEventListener( 'focus', toggleFocus, true );
			links[i].addEventListener( 'blur', toggleBlurFocus, true );
			links[i].addEventListener( 'click', toggleClose, true );
		}
	}

	/**
     * Close the Toggle Menu on Click on hash (#) link.
     *
     * @since 1.3.2
     * @return void
     */
    function toggleClose( )
    {
        var self = this || '',
            hash = '#';

        if( self && ! self.classList.contains('smvmt-search-icon') ) {
            var link = new String( self );
            if( link.indexOf( hash ) !== -1 ) {
            	var link_parent = self.parentNode;
                if ( document.body.classList.contains('smvmt-header-break-point') && ! ( document.querySelector("header.site-header").classList.contains("smvmt-menu-toggle-link") && link_parent.classList.contains("menu-item-has-children") ) ) {

                	/* Close Main Header Menu */
	                var main_header_menu_toggle = document.querySelector( '.main-header-menu-toggle' );
	                main_header_menu_toggle.classList.remove( 'toggled' );

	                var main_header_bar_navigation = document.querySelector( '.main-header-bar-navigation' );
	                main_header_bar_navigation.classList.remove( 'toggle-on' );

					main_header_bar_navigation.style.display = 'none';

					/* Close Below Header Menu */
					var before_header_menu_toggle = document.querySelector( '.menu-below-header-toggle' );
	                var before_header_bar_navigation = document.querySelector( '.smvmt-below-header' );
	                var before_header_bar = document.querySelector( '.smvmt-below-header-actual-nav' );

					if ( before_header_menu_toggle && before_header_bar_navigation && before_header_bar ) {
	                	before_header_menu_toggle.classList.remove( 'toggled' );
	                	before_header_bar_navigation.classList.remove( 'toggle-on' );
						before_header_bar.style.display = 'none';
					}

					/* Close After Header Menu */
	                var after_header_menu_toggle = document.querySelector( '.menu-above-header-toggle' );
	                var after_header_bar_navigation = document.querySelector( '.smvmt-above-header' );
	                var after_header_bar = document.querySelector( '.smvmt-above-header-navigation' );

	                if ( after_header_menu_toggle && after_header_bar_navigation && after_header_bar ) {
	                	after_header_menu_toggle.classList.remove( 'toggled' );
	                	after_header_bar_navigation.classList.remove( 'toggle-on' );
						after_header_bar.style.display = 'none';
					}

					smvmtTriggerEvent( document.querySelector('body'), 'smvmtMenuHashLinkClicked' );
                } else {
	            	while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
						// On li elements toggle the class .focus.
						if ( 'li' === self.tagName.toLowerCase() ) {
							if ( -1 !== self.className.indexOf( 'focus' ) ) {
								self.className = self.className.replace( ' focus', '' );
							}
						}
						self = self.parentElement;
					}
				}
            }
        }
   	}

	/**
	 * Sets or removes .focus class on an element on focus.
	 */
	function toggleFocus() {
		var self = this;
		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Sets or removes .focus class on an element on blur.
	 */
	function toggleBlurFocus() {
		var self = this || '',
            hash = '#';
			link = new String( self );
        if( link.indexOf( hash ) !== -1 && document.body.classList.contains('smvmt-mouse-clicked') ) {
        	return;
        }
		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/* Add class if mouse clicked and remove if tab pressed */
	if ( 'querySelector' in document && 'addEventListener' in window ) {
		var body = document.body;

		body.addEventListener( 'mousedown', function() {
			body.classList.add( 'smvmt-mouse-clicked' );
		} );

		body.addEventListener( 'keydown', function() {
			body.classList.remove( 'smvmt-mouse-clicked' );
		} );
	}

} )();
