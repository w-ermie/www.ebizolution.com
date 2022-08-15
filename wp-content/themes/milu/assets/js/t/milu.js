/*!
 * Additional Theme Methods
 *
 * Milu 1.0.2
 */
/* jshint -W062 */

/* global MiluParams, MiluUi, WVC, Cookies, Event, WVCParams, CountUp */
var Milu = function( $ ) {

	'use strict';

	return {
		initFlag : false,
		isEdge : ( navigator.userAgent.match( /(Edge)/i ) ) ? true : false,
		isWVC : 'undefined' !== typeof WVC,
		isMobile : ( navigator.userAgent.match( /(iPad)|(iPhone)|(iPod)|(Android)|(PlayBook)|(BB10)|(BlackBerry)|(Opera Mini)|(IEMobile)|(webOS)|(MeeGo)/i ) ) ? true : false,
		loaded : false,
		hasScrolled : false,
		menuSkin : 'light',

		/**
		 * Init all functions
		 */
		init : function () {

			if ( this.initFlag ) {
				return;
			}

			//WVC.fireAnimation = false,

			//this.startPercent();

			var _this = this;

			$( '.site-content' ).find( '.wvc-parent-row:first-of-type' ).addClass( 'first-section' );

			//this.cursor();
			this.quickView();
			this.loginPopup();
			this.stickyProductDetails();
			this.transitionCosmetic();
			this.WCQuantity();
			//this.stickyElements();
			this.singlePostNav();
			//this.tooltipsy();
			this.transparentStickyMenuSkin();

			this.isMobile = MiluParams.isMobile;
			this.menuSkin  =MiluParams.menuSkin;

			$( window ).scroll( function() {
				var scrollTop = $( window ).scrollTop();
				_this.backToTopSkin( scrollTop );
				//_this.transparentStickyMenuSkin( scrollTop );
			} );

			// if ( $( 'body' ).hasClass( 'sticky-menu-transparent' ) ) {
			// 	$( window ).scroll( function() {
			// 		_this.transparentStickyMenuSkin( scrollTop );
			// 	} );
			// }

			this.initFlag = true;
		},

		transparentStickyMenuSkin : function( scrollTop ) {
			
			if ( scrollTop < MiluParams.stickyMenuScrollPoint || 'none' === MiluParams.stickyMenuType ) {	
				return;
			}

			var $body = $( 'body' );

			if ( $( '.wvc-row-visible' ).first().hasClass( 'wvc-font-light' ) ) {
				
				$body.addClass( 'menu-skin-dark' );
			
			} else {
				$body.removeClass( 'menu-skin-dark' );
			}
		},

		/**
		 * Check back to top color
		 */
		backToTopSkin : function( scrollTop ) {

			var $button = $( '#back-to-top' ),
				$body = $( 'body' );

			if ( ! $button.length || $( 'body' ).hasClass( 'wvc-scrolling' ) || $( 'body' ).hasClass( 'scrolling' ) ) {
				return;
			}
			
			if ( scrollTop < 550 || this.isMobile ) {
				$button.removeClass( 'back-to-top-light' );
				return;
			}

			if ( $( '.wvc-row-visible' ).last().hasClass( 'wvc-font-light' ) ) {
				$button.addClass( 'back-to-top-light' );
			} else {
				$button.removeClass( 'back-to-top-light' );
			}
		},

		cursor : function() {

			if ( this.isMobile || ! $( 'body' ).hasClass( 'custom-cursor-enabled' ) ) {
				return;
			}
			
			$( 'body.custom-cursor-enabled' ).append( '<div id="milu-cursor-dot-holder"><span id="milu-cursor-dot"></span></div>' );

			var $dotHolder = $( '#milu-cursor-dot-holder' ),
				$dot = $( '#milu-cursor-dot' );

			$dotHolder.css( {
				transform: 'matrix(1, 0, 0, 1, ' + $( window ).width() / 2 + ', ' + $( window ).height() / 2 + ')'
			} );

			$( document ).on( 'mousemove', function( e ) {

				//transform: matrix(1, 0, 0, 1, 9, 213);
				$dotHolder.css( {
					//left:  e.pageX,
					//top:   e.pageY
					transform: 'matrix(1, 0, 0, 1, ' + e.clientX + ', ' + e.clientY + ')'
				} );
		
			} ).on( 'mouseleave', function() {
				
				$dot.hasClass( 'f-block' ) || $dot.addClass( 'f-fade-cursor' );
			
			} ).on( 'mouseenter', function() {
				
				$dot.hasClass( 'f-block' ) || $dot.removeClass( 'f-fade-cursor' );
			} );

			$( 'a' ).on( 'mouseenter', function() {
				$dot.hasClass( 'f-block' ) || $dotHolder.addClass( 'f-hovering' );
			
				if ( '_blank' === $( this ).attr( 'target' ) ) {

					$dotHolder.addClass( 'f-external' );
				}

				//if ( $( this ).data( 'post-type' ) ) {
				//	$dotHolder.addClass( 'f-post-type-' + $( this ).data( 'post-type' ) );
				//}

				if ( $( this ).hasClass( 'milu-button-solid-accent' ) ) {

				}

			} ).on( 'mouseleave', function() {
				$dot.hasClass( 'f-block' ) || $dotHolder.attr( 'class', '' );
			} );
		},

		/**
		 * Tooltip
		 */
		tooltipsy : function () {
			if ( ! this.isMobile ) {

				var $tipspan,
					selectors = '.product-quickview-button, .wolf_add_to_wishlist, .quickview-product-add-to-cart-icon';

				$( selectors ).tooltipsy();

				$( document ).on( 'added_to_cart', function( event, fragments, cart_hash, $button ) {

					if ( $button.hasClass( 'wvc-ati-add-to-cart-button' ) || $button.hasClass( 'wpm-add-to-cart-button' ) || $button.hasClass( 'wolf-release-add-to-cart' ) || $button.hasClass( 'product-add-to-cart' ) ) {

						$tipspan = $button.find( 'span' );

						$tipspan.data( 'tooltipsy' ).hide();
						$tipspan.data( 'tooltipsy' ).destroy();

						$tipspan.attr( 'title', MiluParams.l10n.addedToCart );

						$tipspan.tooltipsy();
						$tipspan.data( 'tooltipsy' ).show();

						setTimeout( function() {
							$tipspan.data( 'tooltipsy' ).hide();
							$tipspan.data( 'tooltipsy' ).destroy();
							$tipspan.attr( 'title', MiluParams.l10n.addToCart );
							$tipspan.tooltipsy();

							$button.removeClass( 'added' );
						}, 4000 );

					}
				} );
			}
		},

		/**
		 * Product quickview
		 */
		quickView : function () {

			$( document ).on( 'added_to_cart', function( event, fragments, cart_hash, $button ) {
				if ( $button.hasClass( 'product-add-to-cart' ) ) {
					//console.log( 'good?' );
					$button.attr( 'href', MiluParams.WooCommerceCartUrl );
					$button.find( 'span' ).attr( 'title', MiluParams.l10n.viewCart );
					$button.removeClass( 'ajax_add_to_cart' );
				}
			} );
		},

		/**
		 * Sticky product layout
		 */
		stickyProductDetails : function() {
			if ( $.isFunction( $.fn.stick_in_parent ) ) {
				if ( $( 'body' ).hasClass( 'sticky-product-details' ) ) {
					$( '.entry-single-product .summary' ).stick_in_parent( {
						offset_top : parseInt( MiluParams.portfolioSidebarOffsetTop, 10 ) + 40
					} );
				}
			}
		},

		/**
		 * Sticky menu skin
		 */
		stickyMenuSkin : function( scrollTop ) {

			//console.log( MiluParams.stickyMenuType );

			var _this = this,
				$body = $( 'body' ),
				sectionTop,
				sectionBottom;
			
			if ( scrollTop < MiluParams.stickyMenuScrollPoint || 'none' === MiluParams.stickyMenuType ) {
				
				return;
			
			} else {

				$body.removeClass( 'menu-skin-light menu-skin-dark' );
				$body.addClass( 'menu-skin-light' );
			}

			$( '.wvc-parent-row' ).each( function() {

				if ( $( this ).hasClass( 'wvc-font-light' ) && ! $( this ).hasClass( 'wvc-row-bg-transparent' ) ) {

					sectionTop = $( this ).offset().top,
					sectionBottom = sectionTop + $( this ).outerHeight();

					if ( sectionTop < scrollTop && sectionBottom > scrollTop ) {
						$body.removeClass( 'menu-skin-light menu-skin-dark' );
						$body.addClass( 'menu-skin-dark' );
					} else {
						//$body.removeClass( 'menu-skin-light menu-skin-dark' );
						//$body.addClass( _this.menuSkin );
					}
				}
			} );
		},

		/**
		 * Login Popup
		 */
		loginPopup : function() {

			var $body = $( 'body' );

			$( document ).on( 'click', '.account-item-icon-user-not-logged-in, .close-loginform-button', function( event ) {
				event.preventDefault();

				if ( $body.hasClass( 'loginform-popup-toggle' ) ) {

					$body.removeClass( 'loginform-popup-toggle' );

				} else {

					$body.removeClass( 'overlay-menu-toggle' );

					$body.addClass( 'loginform-popup-toggle' );
				}
			} );

			if ( ! this.isMobile ) {

				$( document ).mouseup( function( event ) {

					if ( 1 !== event.which ) {
						return;
					}

					var $container = $( '#loginform-overlay-content' );

					if ( ! $container.is( event.target ) && $container.has( event.target ).length === 0 ) {
						$body.removeClass( 'loginform-popup-toggle' );
					}
				} );
			}
		},

		/**
		 * https://stackoverflow.com/questions/48953897/create-a-custom-quantity-field-in-woocommerce
		 */
		WCQuantity : function () {
			
			$( document ).on( 'click', '.wt-quantity-minus', function( event ) {

				event.preventDefault();
				var $input = $( this ).prev( 'input.qty' ),
					val = parseInt( $input.val(), 10 ),
					step = $input.attr( 'step' );
				step = 'undefined' !== typeof( step ) ? parseInt( step ) : 1;
				
				if ( val > 1 ) {
					$input.val( val - step ).change();
				}
			} );
			
			$( document ).on( 'click', '.wt-quantity-plus', function( event ) {
				event.preventDefault();

				var $input = $( this ).next( 'input.qty' ),
					val = parseInt( $input.val(), 10),
					step = $input.attr( 'step' );
				step = 'undefined' !== typeof( step ) ? parseInt( step ) : 1;
				$input.val( val + step ).change();
			} );
		},

		/**
		 * Sticky Portfolio Sidebar
		 */
		stickyElements : function () {
			if ( $.isFunction( $.fn.stick_in_parent ) ) {
				if ( $( 'body' ).hasClass( 'wolf-share' ) || $( 'body' ).hasClass( 'single-post' ) && ! this.isMobile && 1300 > $( window ).width() ) {
					$( '.wolf-share-buttons-container' ).stick_in_parent( {
						offset_top : 66
					} );
				}
			}
		},

		/**
		 * Overlay transition
		 */
		transitionCosmetic : function() {

			$( document ).on( 'click', '.internal-link:not(.disabled)', function( event ) {

				if ( ! event.ctrlKey ) {

					event.preventDefault();

					var $link = $( this );

					$( 'body' ).removeClass( 'mobile-menu-toggle overlay-menu-toggle offcanvas-menu-toggle loginform-popup-toggle lateral-menu-toggle' );
					$( 'body' ).addClass( 'loading transitioning' );

					Cookies.set( MiluParams.themeSlug + '_session_loaded', true, { expires: null } );

					if ( $( '.milu-overlay-loader-block' ).length ) {

						$( '#milu-overlay-loader-block-left' ).one( MiluUi.transitionEventEnd(), function() {
							Cookies.remove( MiluParams.themeSlug + '_session_loaded' );
							window.location = $link.attr( 'href' );
						} );

					} else if ( $( '.milu-loader-overlay' ).length ) {
						$( '.milu-loader-overlay' ).one( MiluUi.transitionEventEnd(), function() {
							Cookies.remove( MiluParams.themeSlug + '_session_loaded' );
							window.location = $link.attr( 'href' );
						} );

					} else if ( $( '.milu-loader-logo' ).length ) {
						$( '.milu-loader-logo' ).one( MiluUi.transitionEventEnd(), function() {
							Cookies.remove( MiluParams.themeSlug + '_session_loaded' );
							window.location = $link.attr( 'href' );
						} );

					} else {
						window.location = $link.attr( 'href' );
					}
				}
			} );
		},

		singlePostNav : function () {
			$( '.post-nav-link-overlay' ).on( 'hover', function() {
				$( this ).parent().toggleClass( 'nav-hover' );
			} );
		},

		reveal : function() {

			var _this = this;

			$( 'body' ).addClass( 'loaded reveal' );
			_this.fireContent();
		},

		/**
		* Page Load
		*/
		loadingAnimation : function () {

			var _this = this,
				delay = 50;

		    	if ( $( '#milu-percent' ).length || $( '#milu-loading-logo' ).length || $( '#milu-overlay-loader-block-left' ).length ) {
		    		return;
		    	}

			setTimeout( function() {

				$( 'body' ).addClass( 'loaded' );

				if ( $( '.milu-loader-overlay' ).length ) {

					$( 'body' ).addClass( 'reveal' );

					$( '.milu-loader-overlay' ).one( MiluUi.transitionEventEnd(), function() {

						_this.fireContent();

						setTimeout( function() {

							$( 'body' ).addClass( 'one-sec-loaded' );

						}, 100 );
					} );
				
				} else {

					$( 'body' ).addClass( 'reveal' );

					_this.fireContent();

					setTimeout( function() {

						$( 'body' ).addClass( 'one-sec-loaded' );

					}, 100 );
				}
			}, delay );
 		},

		fireContent : function () {
			
			var _this = this;

			// Animate
			$( window ).trigger( 'page_loaded' );
			MiluUi.wowAnimate();

			//console.log( 'page_loaded' );

			// if ( this.isWVC ) {
			// 	WVC.wowAnimate();
			// 	WVC.AOS();
			// }

			window.dispatchEvent( new Event( 'resize' ) );
			window.dispatchEvent( new Event( 'scroll' ) ); // Force WOW effect
			$( window ).trigger( 'just_loaded' );
			$( 'body' ).addClass( 'one-sec-loaded' );
		}
	};

}( jQuery );

( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		Milu.init();
	} );

	$( window ).load( function() {
		Milu.loadingAnimation();
	} );

	$( window ).on( 'wolf_ajax_loaded', function() {
		Milu.loadingAnimation();
	} );

} )( jQuery );