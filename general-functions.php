<?php

function nota_prova($id, $prova) {
	
	global $wpdb;
	
	$query = "SELECT percent_correct FROM " . $wpdb->prefix . "watupro_taken_exams WHERE user_id = " . $id . ' AND exam_id = ' . $prova;
	$row = $wpdb->get_row($query, ARRAY_A);

	foreach ($row as $key => $val) {
	   $result = $val;
	}
	
	if($result) {
		return $result . "%";	
	} else {
		return "-";
	}

}

function acesso_pagina($id, $url) {
	
	global $wpdb;
	
	$query = "SELECT * FROM wpb9_acesso_gravado WHERE user_id = " . $id . " AND slug ='" . $url . "' LIMIT 1";
	$row = $wpdb->get_row($query, ARRAY_A);

	foreach ($row as $key => $val) {
	   $result = $val;
	}
	
	if($result) {
		return "Sim";	
	} else {
		return "-";
	}
}

function global_countdown($atts)
{

    $atts = shortcode_atts(
        array(
            'live' => '',
			'data' => ''
        ),
        $atts,
        'global_cadastra_form'
    );

    $current_user = wp_get_current_user();
    $nome = $current_user->user_firstname . " " . $current_user->user_lastname;
    $cidade = get_user_meta($current_user->ID, "cidade", true);
    $uf = get_user_meta($current_user->ID, "uf", true);
    $email = $current_user->user_email;
    $url = 'https://aovivo.' . parse_url( get_site_url(), PHP_URL_HOST );

    echo do_shortcode('[ujicountdown id="kollagenase2018" expire="' . $atts['data'] . '" hide="true" url="'  . $url . '/?live=' . $atts['live'] . '&nome=' . $nome .  '&cidade=' . $cidade .  '&uf=' . $uf .  '&email=' . $email . '" subscr="" recurring="2" rectype="second" repeats=""]');
	
}

add_shortcode('contador', 'global_countdown');