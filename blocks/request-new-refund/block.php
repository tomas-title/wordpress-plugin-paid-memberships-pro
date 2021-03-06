<?php
/**
 * Sets up request-new-refund block, does not format frontend
 *
 * @package blocks/request-new-refund
 **/

namespace PMPro\blocks\request_new_refund;

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

// Only load if Gutenberg is available.
if ( ! function_exists( 'register_block_type' ) ) {
	return;
}

/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_dynamic_block() {
	// Hook server side rendering into render callback.
	register_block_type( 'pmpro/request-new-refund', [
		'render_callback' => __NAMESPACE__ . '\render_dynamic_block',
	] );
}
add_action( 'init', __NAMESPACE__ . '\register_dynamic_block' );

/**
 * Server rendering for requestnewrefund block.
 *
 * @param array $attributes contains text, level, and css_class strings.
 * @return string
 **/
function render_dynamic_block( $attributes ) {
	return pmpro_loadTemplate( 'requestnewrefund', 'local', 'pages' );
}

/**
 * Load preheaders/requestnewrefund.php if a page has the checkout block.
 */
function load_requestnewrefund_preheader() {
	if ( has_block( 'pmpro/request-new-refund' ) ) {
		require_once( PMPRO_DIR . "/preheaders/requestnewrefund.php" );
	}
}
add_action( 'wp', __NAMESPACE__ . '\load_requestnewrefund_preheader', 1 );
