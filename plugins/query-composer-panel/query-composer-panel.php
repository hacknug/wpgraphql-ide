<?php
/**
 * Plugin Name: Query Composer
 * Description: Registers a new Activity Bar Panel with the IDE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'QUERY_COMPOSER_PANEL_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

add_action( 'wpgraphqlide_enqueue_script', function() {
    $asset_file = include QUERY_COMPOSER_PANEL_PLUGIN_DIR_PATH . 'build/index.asset.php';

	if ( empty( $asset_file['dependencies'] ) ) {
		return;
	}

    wp_enqueue_script(
        'query-composer-panel',
        plugins_url( 'build/index.js', __FILE__ ),
        array_merge( $asset_file['dependencies'], ['wpgraphql-ide'] ),
        $asset_file['version']
    );

	wp_enqueue_style(
		'query-composer-panel',
		plugins_url( 'build/style-index.css', __FILE__ ),
		[],
		$asset_file['version'],
	);

});

