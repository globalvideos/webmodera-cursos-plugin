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
		return "";
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
		return "";
	}

	
}

function global_admin_page()
{
?>

    <div class="wrap">
        <h1>
            <img width="150" src="https://www.globalvideos.com.br/wp-content/uploads/2015/08/global_logo_web_transparente-e1439243390827.png" alt="" />
        </h1>

		<!--<table class="wp-list-table widefat fixed striped table-view-list users">
			<thead>
				<tr>
					<th>#</th>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Especialidade</th>
					<th>CRM</th>
					<th>UF</th>
					<th>Cidade</th>
					<th>Telefone</th>
					<th>Último Login</th>
					<th>Prova 1</th>
					<th>Prova 2</th>
					<th>Prova 3</th>
					<th>Prova 4</th>
					<th>Prova 5</th>
					<th>Prova 6</th>
					<th>paapcd-m1-2022</th>
					<th>cgm-masters-m1</th>
					<th>cgm-masters-m2</th>
					<th>cgm-masters-m3</th>
					<th>cgm-masters-m4</th>
					<th>cgm-masters-m5</th>
					<th>cgm-masters-m6</th>
				</tr>
			</thead>
			<tbody id="the-list" data-wp-lists="list:user">
				<?php /*
					$blogusers = get_users( array( 'role__in' => array( 'um_profissional-de-saude', 'um_gestor-de-saude' ) ) );
					// Array of WP_User objects.
					foreach ( $blogusers as $user ) {
						
						$time = get_user_meta($user->ID, 'wp-last-login',true);
						
						if($time == 0){
							$date = "Nunca";
						} else {
							$date = gmdate("d/m/Y H:i:s", get_user_meta($user->ID, 'wp-last-login',true));
						}
						
						echo '<tr>';
						echo '<td>' . $user->ID . '</td>';
						echo '<td>' . $user->display_name . '</td>';
						echo '<td>' . get_user_meta($user->ID, 'email',true) . '</td>';
						echo '<td>' . get_user_meta($user->ID, 'espec_medica_1',true) . '</td>';
						echo '<td>' . get_user_meta($user->ID, 'crm',true) . '</td>';
						echo '<td>' . get_user_meta($user->ID, 'uf',true) . '</td>';
						echo '<td>' . get_user_meta($user->ID, 'cidade',true) . '</td>';
						echo '<td>' . get_user_meta($user->ID, 'telefone',true) . '</td>';
						echo '<td>' . $date . '</td>';
						nota_prova($user->ID, 1);
						nota_prova($user->ID, 2);
						nota_prova($user->ID, 3);
						nota_prova($user->ID, 4);
						nota_prova($user->ID, 5);
						nota_prova($user->ID, 6);
						acesso_pagina($user->ID, "paapcd-m1-2022");
						acesso_pagina($user->ID, "cgm-masters-m1");
						acesso_pagina($user->ID, "cgm-masters-m2");
						acesso_pagina($user->ID, "cgm-masters-m3");
						acesso_pagina($user->ID, "cgm-masters-m4");
						acesso_pagina($user->ID, "cgm-masters-m5");
						acesso_pagina($user->ID, "cgm-masters-m6");
						echo '</tr>';
						
					}*/
				?>
			</tbody>
		</table>-->
		
		<?php 
		
			$path = wp_upload_dir();
			$outstream = fopen($path['path']."/relatorio.csv", "w");  // the file name you choose

			$fields = array(
				'id',
				'nome', 
				'email', 
				'especialidade', 
				'crm', 
				'uf',
				'cidade', 
				'telefone', 
				'ultimo login',
				'Prova 1',
				'Prova 2',
				'Prova 3',
				'Prova 4',
				'Prova 5',
				'Prova 6',
				'CGM Mód 1', 
				'CGM Mód 2', 
				'CGM Mód 3', 
				'CGM Mód 4', 
				'CGM Mód 5', 
				'CGM Mód 6',
				'Diabetes no Alvo - 2021',
				'CGM Masters 2022',
				'PMAPD Mód 1 - 2022'
			);

			fputcsv($outstream, $fields);

			$values = array();
		
			$blogusers = get_users( array( 'role__in' => array( 'um_profissional-de-saude', 'um_gestor-de-saude' ), 'orderby' => 'ID', 'order' => 'ASC', ) );
			foreach ( $blogusers as $user ) {

				$time = get_user_meta($user->ID, 'wp-last-login',true);

				if($time == 0){
					$date = "Nunca";
				} else {
					$date = gmdate("d/m/Y H:i:s", get_user_meta($user->ID, 'wp-last-login',true));
				}

				$values[] = array(
					$user->ID,
					$user->display_name,
					get_user_meta($user->ID, 'email',true),
					get_user_meta($user->ID, 'espec_medica_1',true),
					get_user_meta($user->ID, 'crm',true),
					get_user_meta($user->ID, 'uf',true),
					get_user_meta($user->ID, 'cidade',true),
					get_user_meta($user->ID, 'telefone',true),
					$date,
					nota_prova($user->ID, 1),
					nota_prova($user->ID, 2),
					nota_prova($user->ID, 3),
					nota_prova($user->ID, 4),
					nota_prova($user->ID, 5),
					nota_prova($user->ID, 6),
					acesso_pagina($user->ID, "cgm-masters-m1"),
					acesso_pagina($user->ID, "cgm-masters-m2"),
					acesso_pagina($user->ID, "cgm-masters-m3"),
					acesso_pagina($user->ID, "cgm-masters-m4"),
					acesso_pagina($user->ID, "cgm-masters-m5"),
					acesso_pagina($user->ID, "cgm-masters-m6"),
					acesso_pagina($user->ID, "diabetes-no-alvo-edicao-2021"),
					acesso_pagina($user->ID, "cgm-masters-m1-2022"),
					acesso_pagina($user->ID, "paapcd-m1-2022"),
				);
			};
	
			//print_r($values);
			
			//fputcsv($outstream, $values);  //output the user info line to the csv file
			foreach ($values as $linha) {
				fputcsv($outstream, $linha);
			}

			fclose($outstream); 
			echo '<a class="button-primary" href="'.$path['url'].'/relatorio.csv">Baixar Relatório</a>';
		
		?>
		
		
    </div>

<?php
}