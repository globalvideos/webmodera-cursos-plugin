<?php
/*
Plugin Name: Global Videos (CURSOS)
Plugin URI: https://www.globalvideos.com.br
description: Plugins para os sites de cursos
Version: 1.1.0
Author: Global Videos
Author URI: https://www.globalvideos.com.br
License: GPL2
 */

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/globalvideos/webmodera-cursos-plugin',
	__FILE__,
	'global-videos'
);

$myUpdateChecker->setBranch('main');

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