<?php

function global_acesso_gravado($atts)
{
	global $wpdb;
	
	$atts = shortcode_atts(
        array(
            'modulo' => '',
        ),
        $atts,
        'global_cadastra_form'
    );
	
	$modulo = $atts['modulo'];
	
	if ( is_user_logged_in() && $modulo ) {
		
		$user = get_current_user_id();
		$table = $wpdb->prefix.'acesso_gravado';
		
		$sql = "SELECT * FROM " . $table . " WHERE user_id = " . $user . ";";	
		$select = $wpdb->query($sql);
		
		
		if($select === 0){
			$sql2 ="INSERT INTO " . $table . " (user_id, " . $modulo . ") VALUES (" . $user . ", 1);";	
			$insert = $wpdb->query($sql2);
		} else {
			$sql3 = "UPDATE " . $table . " SET " . $modulo . " = 1 WHERE user_id = " . $user . ";";	
			$update = $wpdb->query($sql3);
		}

	}

}

add_shortcode('acesso_gravado', 'global_acesso_gravado');