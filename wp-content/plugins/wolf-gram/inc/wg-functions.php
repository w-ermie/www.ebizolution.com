<?php
/**
 * Wolf Gram Functions
 *
 * Wolf Gram front-end functions
 *
 * @author WolfThemes
 * @category Core
 * @package WolfGram/Functions
 * @since 1.4.8
 */

/**
 * Get user info from Instagram API
 */
function wolf_gram_get_user_info( $username = '', $api_key = '' ) {

	if ( ! wolf_gram_get_auth() || ! $api_key ) {
		return;
	}

	$api_key = ( $api_key ) ? $api_key : wolf_gram_get_auth();

	$data = new stdClass;
	$trans_key = 'wolf_instagram_user_data_' . $username;
	$cache_duration = 3600; // 1 hr
	$api_url = 'https://graph.instagram.com/me?fields=id,username&access_token=' . $api_key;

	if ( false === ( $cached_data = get_transient( $trans_key ) ) || ! get_transient( $trans_key ) ) {

		// send request
		$response = wp_remote_get( $api_url , array(
				'timeout' => 10,
			)
		);

		// get result if no error
		if ( ! is_wp_error( $response ) && is_array( $response ) ) {
			$body = wp_remote_retrieve_body( $response );
			$data =  json_decode( $body );
			set_transient( $trans_key, $data, $cache_duration );
		}
	} else {
		$data = get_transient( $trans_key );
	}

	//var_dump( $data );

	if ( is_object( $data ) && isset( $data->username ) ) {
		return $data;
	}
}

/**
 * Get user info from Instagram API
 */
function wolf_gram_get_user_id( $api_key = '' ) {
	
	$api_key = ( $api_key ) ? $api_key : get_option( 'wolf_instagram_access_token' );

	if ( $api_key ) {
		$data = wolf_gram_get_user_info( '', $api_key );

		if ( is_object( $data ) && isset( $data->username ) ) {
			return $data->username;
		}
	}
}

function wolf_gram_get_username() {

	if ( get_option( 'wolf_instagram_username' ) ) {
		return get_option( 'wolf_instagram_username' );
	}
}

/**
 * Get instagram feed and cache the data in a WP transient key
 */
function wolf_gram_get_feed( $count = 100, $tag = '', $api_key = '', $username = '' ) {

	$trans_key = 'wolf_instagram_data_' . $username;
	$cache_duration = 3600;

	$count = 100; // force caching 100 images

	$images = array();
	$api_key = ( $api_key ) ? $api_key : wolf_gram_get_auth();

	$username = ( $username ) ? $username : wolf_gram_get_username();

	$trans_key = 'wolf_instagram_data_' . $username;

	$expiration_key_name = 'wolf_instagram_expiration_' . $username;
	$expiration_key = get_transient( $expiration_key_name );

	//delete_transient( $expiration_key_name );

	if ( $api_key ) {

		if ( ! $expiration_key ) {
			  /* Renew API key */
			$api_url = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=$api_key";

			$response = wp_remote_get( $api_url,
				array(
					'sslverify' => apply_filters( 'https_local_ssl_verify', false )
				)
			);

			if ( ! is_wp_error( $response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200 ) {
				
				$data =  json_decode( $response['body'] );

				if ( is_object( $data ) && isset( $data->access_token ) ) {

					$api_key = $data->access_token;

					update_option( 'wolf_instagram_access_token', $api_key );

					set_transient( $expiration_key_name, true, 30 * DAY_IN_SECONDS );
				}
			}
		}

		//delete_transient( $trans_key );

		if ( false === ( $cached_data = get_transient( $trans_key ) ) || ! get_transient( $trans_key ) ) {

			$api_url = "https://graph.instagram.com/me/media?fields=id,caption&access_token=$api_key&count=30";

			//$api_url = "https://graph.instagram.com/v1.0/17841426013740693/media?access_token=IGQVJYRnNWNDBkQzN6WFhMSDdtTmo4TVo2TnZAtZAmZA5dHhLM3FaQUtUOGNUaWFBaDJidEpWdUNuYS1BSFNDSHN5TGoydnZAXYXBkWTQzbnlNUjhxMVVsVVNnZAkZAFa25JNHo5ZAlV1c0t3&fields=id%2Ccaption&limit=25&after=QVFIUmNqa3ZAhMk83TklVRFJKUVFTb3NKVkFZAWW5EckZADODZAxcU05c09UX0lHTzZAFb3J4N1I2dXpxcGNWTnNiZADRpYXo5R0xvM0habkktaWRQNVF1ZAWw4aC1n";

			$response = wp_remote_get( $api_url,
				array(
					'sslverify' => apply_filters( 'https_local_ssl_verify', false )
				)
			);

			if ( ! is_wp_error( $response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200 ) {
				
				$data =  json_decode( $response['body'] );

				$next_page_url = ( is_object( $data ) && isset( $data->paging ) && isset( $data->paging->next ) ) ? $data->paging->next : null;

				if ( is_object( $data ) && isset( $data->data ) ) {

					//debug( $next_page_url );
					
					foreach( $data->data as $item ) {

						if ( is_object( $item ) && isset( $item->id ) ) {

							/* Get media data */
							$api_url = 'https://graph.instagram.com/' . esc_attr( $item->id ) . '/?fields=caption,id,media_type,media_url,permalink,thumbnail_url,timestamp,username&access_token=' . esc_attr( $api_key );

							$response = wp_remote_get( $api_url,
								array(
									'sslverify' => apply_filters( 'https_local_ssl_verify', false )
								)
							);

							if ( ! is_wp_error( $response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200 ) {
								
								$media =  json_decode( $response['body'] );

								//debug( $media );
								$tags = array();
								
								if ( isset( $media->caption ) ) {

									if ( preg_match_all( '/\#[a-zA-Z0-9]+/', $media->caption, $matches ) ) {
										foreach( $matches as $match ) {
											$tags[] = str_replace( '#', '', $match );
										}
									}
								}

								$images[] = array(
									'image_small' => $media->media_url,
									'image_middle' => $media->media_url,
									'image_large' => $media->media_url,
									'link' => $media->permalink,
									//'likes' => '',
									//'comments' => '',
									'tags' => $tags,
								);
							}

						}
					}

					/* Get second round */
					if ( $next_page_url ) {
						$next_page_response = wp_remote_get( $next_page_url,
							array(
								'sslverify' => apply_filters( 'https_local_ssl_verify', false )
							)
						);

						if ( ! is_wp_error( $next_page_response) && $next_page_response['response']['code'] < 400 && $next_page_response['response']['code'] >= 200 ) {

							$next_page_data =  json_decode( $next_page_response['body'] );

							if ( is_object( $next_page_data ) && isset( $next_page_data->data ) ) {
								foreach( $next_page_data->data as $item ) {

									if ( is_object( $item ) && isset( $item->id ) ) {

										/* Get media data */
										$api_url = 'https://graph.instagram.com/' . esc_attr( $item->id ) . '/?fields=caption,id,media_type,media_url,permalink,thumbnail_url,timestamp,username&access_token=' . esc_attr( $api_key );

										$response = wp_remote_get( $api_url,
											array(
												'sslverify' => apply_filters( 'https_local_ssl_verify', false )
											)
										);

										if ( ! is_wp_error( $response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200 ) {
											
											$media =  json_decode( $response['body'] );

											//debug( $media );
											$tags = array();
											
											if ( isset( $media->caption ) ) {

												if ( preg_match_all( '/\#[a-zA-Z0-9]+/', $media->caption, $matches ) ) {
													foreach( $matches as $match ) {
														$tags[] = str_replace( '#', '', $match );
													}
												}
											}

											$images[] = array(
												'image_small' => $media->media_url,
												'image_middle' => $media->media_url,
												'image_large' => $media->media_url,
												'link' => $media->permalink,
												//'likes' => '',
												//'comments' => '',
												'tags' => $tags,
											);
										}
									}
								}
							}
						}
					}
				}
			
			}

			set_transient( $trans_key, $images, $cache_duration );
		}

		return get_transient( $trans_key );

	} else {

		return false;
	}
}

/**
 * Display Gallery
 *
 */
function wolf_gram_gallery( $args ) {

	$args = wp_parse_args( $args, array(
		'count' => 0,
		'colums' => 6,
		'username' => '',
		'tag' => '',
		'api_key' => get_option( 'wolf_instagram_access_token' ),
		'button' => false,
		'button_text' => '',
		'tag' => '',
	) );

	extract( $args );

	$username = ( $username ) ? $username : wolf_gram_get_username();

	$button_text = ( ! $button_text ) ? sprintf( esc_html__( 'Instagram @%s', 'wolf-gram' ), $username ) : $button_text;
	
	$button_link = 'https://instagram.com/' . $username;

	$button_text = apply_filters( 'wolf_gram_button_text', $button_text );
	$button_link = apply_filters( 'wolf_gram_button_link', $button_link );

	$output = '';

	if ( wolf_gram_get_auth() || $api_key ) {

		if ( ! $count ) {
			$count = wolf_gram_get_option( 'count', 18 );
		}

		$images = wolf_gram_get_feed( 100, $tag, $api_key, $username ); // get feed

		if ( $count > count( $images) ) {
			$count = count( $images);
		}

		//debug( $images );

		$lightbox = 'swipebox';
		$value = 'link';
		$target = '  target="_blank"';
		$rand = rand( 0, 999 );

		if ( 'lightbox' == wolf_gram_get_option( 'gallery_link' ) ) {

			$lightbox = apply_filters( 'wolf_gram_lightbox', wolf_gram_get_option( 'lightbox' ) );

			if ( 'fancybox' == $lightbox ) {

				$lightbox = 'fancybox';
				$value = 'image_large';
				$target = null;

				wp_enqueue_script( 'fancybox', WG_URI. '/assets/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.4' );


			} elseif ( 'swipebox' == $lightbox ) {

				$lightbox = 'swipebox';
				$value = 'image_large';
				$target = null;

				wp_enqueue_script( 'swipebox', WG_URI. '/assets/swipebox/jquery.swipebox.min.js', array( 'jquery' ), '1.2.1' );
			}

			$output .= "<script type=\"text/javascript\">jQuery(document).ready(function($){
				$( '.$lightbox-wolfgram-$rand' ).$lightbox();});
			</script>";
		}

		$output .= '<div class="wolf-instagram-gallery wolf-instagram-gallery-columns-' . esc_attr( $columns ) . '">';

		if ( $button ) {
			ob_start();
			?>
			<a class="wolf-gram-follow-button" href="<?php echo esc_url( $button_link ); ?>" target="_blank">
				<?php echo sanitize_text_field( $button_text ); ?>
			</a>
			<?php
			$output .= ob_get_clean();
		}

		//for( $i=0; $i < $count; $i++ ) {
		$i = 0;

		foreach( $images as $image ) {

			$link = $image[ $value ];
			$src = str_replace( 's150x150', 's640x640', $image['image_small'] ); // not working anymore
			$src = $image['image_large'];
			$tags = ( isset( $image['tags'] ) && isset( $image['tags'][0] ) ) ? $image['tags'][0] : array();

			//debug( $tags );
			//debug( $tag );
			//debug( in_array( $tag, $tags ) );

			if ( $count && $i == $count ) {
				break;
			}

			if ( $tag && ! in_array( $tag, $tags ) ) {
				//$count++;
				continue;
			}

			$output .= '<figure class="wolf-instagram-item"><div class="wolf-instagram-item-outer"><div class="wolf-instagram-item-container">';
				
				
			if ( preg_match( '/video/', $src ) ) {
				
				$output .= '<div class="wolf-instagram-item-inner">';

				$output .= '<video src="' . esc_url( $src ) . '" muted></video>';
			
			} else {
				$output .= '<div class="wolf-instagram-item-inner" style="background-image:url( ' . esc_url( $src ) . ' );">';
			}

			$output .= '<a' . $target . ' class="' . esc_attr( $lightbox ) . '-wolfgram-' . absint( $rand ) . ' wolf-instagram-link" href="'. esc_url( $link ).'">
					<div class="wolf-instagram-overlay">
						<span  class="wolf-instagram-meta-container">
							<i class="fa socicon-instagram"></i>
						</span>
					</div>
				</a></div></div></div></figure>';

			$i++;
		}

		// <img src="'.$images[$i]['image_middle'].'" alt="wolfgram-thumbnail">

		$output .= '</div><div style="clear:both; float:none"></div>';

	} else {

		$output = '<div style="margin: 180px auto 300px; text-align:center">' . wolf_gram_no_image_message() . '</div>';

	}

	return $output;
}

/**
 * Get Widget Images
 *
 */
function wolf_gram_widget_gallery( $args = array() ) {


	$args = wp_parse_args( $args, array(
		'count' => 18,
		'slideshow' => false,
		'timeout' => 3500,
	) );

	extract( $args );

	wp_enqueue_style( 'wolf-instagram' );

	$output = '';

	if ( wolf_gram_get_auth() ) {

		$images = wolf_gram_get_feed();

		if ( $count > count( $images) ) {
			$count = count( $images);
		}

		if ( $slideshow) {
			wp_enqueue_script( 'cycle' );
			$output .= '<script type="text/javascript">
			jQuery(function( $) {
			    jQuery(".wolf-slidegram-container").cycle({
					fx: "fade",
					timeout : ' . $timeout . '
				});
			});

			</script>';
			$output .= '<div class="wolf-slidegram-container">';
			$fluid_fix = ' wolf-slidegram-fluid-fix';

			for( $i=0; $i<$count; $i++) {

				$output .= '<div class="wolf-slidegram';
				if ( $i == 0 ) $output .= $fluid_fix;
				$output .= '">
				<a target="_blank" href="'. esc_url( $images[ $i ]['link'] ).'">
					<img src="'. esc_url( $images[ $i ]['image_middle'] ).'"></a>
				</div>';
			}
			$output .= '</div>';

		} else {

			$lightbox = '';
			$value = 'link';
			$target = '  target="_blank';
			$rand = rand(0, 999);

			if ( wolf_gram_get_option( 'widget_link' ) == 'lightbox' || ! wolf_gram_get_option( 'widget_link' ) ) {

				$lightbox = apply_filters( 'wolf_gram_lightbox', wolf_gram_get_option( 'lightbox' ) );

				if ( $lightbox == 'fancybox' ) {

					$lightbox = 'fancybox';
					$value = 'image_large';
					$target = null;

					wp_enqueue_script( 'fancybox', WG_URI. '/assets/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.4' );


				} elseif ( $lightbox == 'swipebox' ) {

					$lightbox = 'swipebox';
					$value = 'image_large';
					$target = null;

					wp_enqueue_script( 'swipebox', WG_URI. '/assets/swipebox/jquery.swipebox.min.js', array( 'jquery' ), '1.2.1' );
				}

				if ( $lightbox ) {
					$output .= "<script type=\"text/javascript\">jQuery(document).ready(function($){
						$( '.$lightbox-wolfgram-$rand' ).$lightbox();});
					</script>";
				}
			}



			$output .= '<ul class="wolf-instagram-list">';
			
			for ( $i=0; $i < $count; $i++) {

				$output .= '<li><a' . $target . ' class="' . $lightbox . '-wolfgram-' . absint( $rand ) . '" href="' . esc_url( $images[ $i ][ $value ] ).'"><img src="' . esc_url( $images[ $i ]['image_small'] ) . '" alt="wolfgram-thumbnail"></a></li>';

			}
			$output .= '</ul>';
		}

	} else {

		$output = wolf_gram_no_image_message();
	}

	return $output;
}

/**
 * Display message when no image found
 */
function wolf_gram_no_image_message() {

	$output = '';

	if ( ! wolf_gram_get_auth() ) {

		if ( is_user_logged_in() )
			$output = '<p>' . sprintf( __( 'Please enter your access key and link your Instagram account via the <a href="%s">admin panel</a> to display your images.', 'wolf-gram' ), esc_url( admin_url( 'admin.php?page=wolf-gram-options' ) ) ).'</p>';
		else
			$output = '<p>'.esc_html__( 'No Instagram image yet.', 'wolf-gram' ).'</p>';

	}

	if ( wolf_gram_get_auth() )
		if ( is_user_logged_in() )
			$output = '<p>'.esc_html__( 'No Instagram photo found. Try to reset your access key.', 'wolf-gram' ).'</p>';
		else
			$output = '<p>'.esc_html__( 'No Instagram photo found.', 'wolf-gram' ).'</p>';


	return $output;
}

/**
 * Enqueue jQuery if it's not
 */
function wg_enqueue_scripts() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );

	/* Styles */
	wp_register_style( 'wolf-gram', WG_URI . '/assets/css/instagram' . $suffix . '.css',array(), WG_VERSION, 'all' );
	wp_register_style( 'fancybox', WG_URI . '/assets/fancybox/fancybox.css', array(), '2.1.5' );
	wp_register_style( 'swipebox', WG_URI. '/assets/swipebox/swipebox.min.css', array(), '1.3.0' );

	/* Main CSS */
	wp_enqueue_style( 'wolf-gram' );

	if ( wolf_gram_get_option( 'lightbox' ) == 'fancybox' ) {

		wp_enqueue_style( 'fancybox' );


	} elseif ( wolf_gram_get_option( 'lightbox' ) == 'swipebox' ) {

		wp_enqueue_style( 'swipebox' );
	}

	/* Script */
	wp_register_script( 'cycle', WG_URI . '/assets/js/jquery.cycle.lite.js', array( 'jquery' ), '1.3.2' );

	wp_enqueue_script( 'wolf-gram', WG_URI . '/assets/js/instagram' . $suffix . '.js', array( 'jquery' ), WG_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'wg_enqueue_scripts' );
