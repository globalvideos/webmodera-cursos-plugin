<?php
/*
Plugin Name: Global Videos (CURSOS)
Plugin URI: https://www.globalvideos.com.br
description: Plugins para os sites de cursos
Version: 1.0.7
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

$myUpdateChecker->setBranch('main');

function create_acesso_table()
{      
	global $wpdb; 
	$db_table_name = $wpdb->prefix . 'acesso_gravado2';
	$charset_collate = $wpdb->get_charset_collate();

	if($wpdb->get_var( "show tables like '$db_table_name'" ) != $db_table_name ) 
	 {
		   $sql = "CREATE TABLE $db_table_name (
					id bigint(20) NOT NULL auto_increment,
					user_id bigint(20) NOT NULL,
					slug varchar(255) NOT NULL,
					acesso datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
					UNIQUE KEY id (id)
			) $charset_collate;";

	   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	   dbDelta( $sql );
	   add_option( 'test_db_version', $test_db_version );
	 }
} 

register_activation_hook( __FILE__, 'create_acesso_table' );

include( plugin_dir_path( __FILE__ ) . 'admin-menu.php');
include( plugin_dir_path( __FILE__ ) . 'acesso-gravado.php');
include( plugin_dir_path( __FILE__ ) . 'general-functions.php');

// INCLUINDO O ARQUIVO ESPECÍFICO DE CADA SITE
if( get_site_url() === 'https://www.diabetesnoalvo.com.br') {
	include( plugin_dir_path( __FILE__ ) . 'sites/diabetesnoalvo.php');
}
if( get_site_url() === 'https://www.cardiorenalmetabolica.com.br') {
	include( plugin_dir_path( __FILE__ ) . 'sites/cardiorenalmetabolica.php');
}