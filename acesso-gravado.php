<?php

function global_acesso_gravado()
{

	global $post;

	if ( is_user_logged_in() ) {
		
		$current_user = wp_get_current_user();
		$email = $current_user->user_email;    
		$post_slug = $post->post_name;
		$user = get_current_user_id();

		echo 'teste';
	}

}

add_shortcode('acesso_gravado', 'global_acesso_gravado');