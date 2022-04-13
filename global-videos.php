<?php
/*
Plugin Name: Global Videos (CURSOS)
Plugin URI: https://www.globalvideos.com.br
description: Plugins para os sites de cursos
Version: 1.0.3
Author: Global Videos
Author URI: https://www.globalvideos.com.br
License: GPL2
 */

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/globalvideos/webmodera-cursos',
	__FILE__,
	'global-videos'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
//$myUpdateChecker->setAuthentication('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');

define(PLUGIN_FILE_URL, __FILE__);

function global_activation(){
	// create the custom table
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'acesso_gravado';
	$charset_collate = $wpdb->get_charset_collate();
	
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
			user_id BIGINT(20),
			page_slug VARCHAR(255),
			horario TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
register_activation_hook( __FILE__, 'global_activation' );

include( plugin_dir_path( __FILE__ ) . 'admin-menu.php');
include( plugin_dir_path( __FILE__ ) . 'admin-menu-content.php');
include( plugin_dir_path( __FILE__ ) . 'acesso-gravado.php');

