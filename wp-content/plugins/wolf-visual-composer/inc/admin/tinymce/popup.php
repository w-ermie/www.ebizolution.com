<?php
/**
 * WPBakery Page Builder Extension TinyMCE popup HTML wrapper
 *
 * @class WVC_Admin
 * @author WolfThemes
 * @category Admin
 * @package WolfWPBakeryPageBuilderExtension/Admin
 * @version 3.2.8
 */
include_once( 'load.php' );
$popup = null;
if ( isset( $_GET[ 'popup' ] ) )
	$popup = 'popup/' . $_GET['popup'] . '.php';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head></head>
<body>
	<?php include( $popup ); ?>
</body>
</html>