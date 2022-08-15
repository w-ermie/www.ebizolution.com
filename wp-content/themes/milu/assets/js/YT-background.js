/*!
 * Youtube Video Background
 *
 * Milu 1.0.2
 */
/* jshint -W062 */
/* global YT */

var MiluYTVideoBg = function( $ ) {

	'use strict';

	return {

		players : [],
		isMobile : ( navigator.userAgent.match( /(iPad)|(iPhone)|(iPod)|(Android)|(PlayBook)|(BB10)|(BlackBerry)|(Opera Mini)|(IEMobile)|(webOS)|(MeeGo)/i ) ) ? true : false,

		/**
		 * @link http://gambit.ph/how-to-use-the-javascript-youtube-api-across-multiple-plugins/
		 */
		init : function ( $container ) {

			var _this = this;

			$container = $container || $( '#page' );

			if ( ! $container.find( '.youtube-video-bg-container' ).length || this.isMobile ) {
				return;
			}

			if ( 'undefined' === typeof( YT ) || 'undefined' === typeof( YT.Player ) ) {
				$.getScript( '//www.youtube.com/player_api' );
			}

			setTimeout( function() {

				if ( typeof window.onYouTubePlayerAPIReady !== 'undefined' ) {
					if ( typeof window.MiluOtherYTAPIReady === 'undefined' ) {
						window.MiluOtherYTAPIReady = [];
					}
					window.MiluOtherYTAPIReady.push( window.onYouTubePlayerAPIReady );
				}

				window.onYouTubePlayerAPIReady = function() {
					_this.playVideo( $container );

					if ( typeof window.MiluOtherYTAPIReady !== 'undefined' ) {
						if ( window.MiluOtherYTAPIReady.length ) {
							window.MiluOtherYTAPIReady.pop()();
						}
					}
				};
			}, 2 );
		},

		/**
		 * Loop through video container and load player
		 */
		playVideo : function( $container ) {

			var _this = this;

			$container.find( '.youtube-video-bg-container' ).each( function() {
				var $this = $( this ), containerId, videoId, pause = false;

				containerId = $this.find( '.youtube-player' ).attr( 'id' );
				videoId = $this.data( 'youtube-video-id' );

				if ( $this.hasClass( 'yt-pause-hover' ) ) {
					pause = true;
				}

				_this.loadPlayer( containerId, videoId, pause );
			} );
		},

		/**
		 * Load YT player
		 */
		loadPlayer: function( containerId, videoId, pause ) {

			if ( 'undefined' === typeof( YT ) || 'undefined' === typeof( YT.Player ) ) {
				return;
			}

			var _this = this,
				elementDataId = $( '#' + containerId ).parent().data( 'youtube-video-id' ),
				player = new YT.Player( containerId, {
				width: '100%',
				height: '100%',
				videoId: videoId,
				playerVars: {
					playlist: videoId,
					iv_load_policy: 3, // hide annotations
					enablejsapi: 1,
					disablekb: 1,
					autoplay: 1,
					controls: 0,
					showinfo: 0,
					rel: 0,
					loop: 1,
					wmode: 'transparent'
				},
				events: {
					onReady: function ( event ) {
						event.target.mute().setLoop( true );
						var el = document.getElementById( containerId );
						el.className = el.className + ' youtube-player-is-loaded';

						if ( pause ) {}
					},

					/**
					 * End video at the end if loop option not set
					 */
					onStateChange : function( event ) {

						if ( pause && event.data === YT.PlayerState.PLAYING ) {
							setTimeout( function() {

								player.pauseVideo();
							}, 100 );
						}
					}
				}
			} );

			_this.players[elementDataId] = player; // awesome, we can access the player (almost) from anywhere!

			if ( pause ) {
			}

			$( window ).trigger( 'resize' ); // trigger window calculation for video background
		},

		/**
		 * Play/pause on hover
		 */
		playOnHover : function( player, iframeId ) {

			var $container = $( '#' + iframeId ).closest( '.entry-video' ),
				containerId = '#' + $container.attr( 'id' );

			$( containerId ).on( 'mouseenter', function() {
				player.playVideo(); // todo
			} );
		}
	};

}( jQuery );

( function( $ ) {

	'use strict';

	$( window ).load( function() {
		MiluYTVideoBg.init();
	} );

} )( jQuery );