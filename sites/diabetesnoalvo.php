<?php

function global_admin_page()
{
?>

    <div class="wrap">
        <h1>
            <img width="150" src="https://www.globalvideos.com.br/wp-content/uploads/2015/08/global_logo_web_transparente-e1439243390827.png" alt="" />
        </h1>
		
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
				'CGM Mód 1-21', 
				'Prova 1',
				'CGM Mód 2-21', 
				'Prova 2',
				'CGM Mód 3-21', 
				'Prova 3',
				'CGM Mód 4-21', 
				'Prova 4',
				'CGM Mód 5-21', 
				'Prova 5',
				'CGM Mód 6-21',
				'Prova 6',
				'Diabetes no Alvo - 21',
				'CGM Mód 1-22',
				'PMAPD Mód 1-22'
			);

			fputcsv($outstream, $fields);

			$values = array();
		
			$blogusers = get_users( array( 'role__in' => array( 'um_profissional-de-saude', 'um_gestor-de-saude' ), 'orderby' => 'ID', 'order' => 'ASC', ) );
			foreach ( $blogusers as $user ) {

				$time = get_user_meta($user->ID, 'wp-last-login',true);

				if($time == 0){
					$date = "-";
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
					acesso_pagina($user->ID, "cgm-masters-m1"),
					nota_prova($user->ID, 1),
					acesso_pagina($user->ID, "cgm-masters-m2"),
					nota_prova($user->ID, 3),
					acesso_pagina($user->ID, "cgm-masters-m3"),
					nota_prova($user->ID, 4),
					acesso_pagina($user->ID, "cgm-masters-m4"),
					nota_prova($user->ID, 5),
					acesso_pagina($user->ID, "cgm-masters-m5"),
					nota_prova($user->ID, 7),
					acesso_pagina($user->ID, "cgm-masters-m6"),
					nota_prova($user->ID, 8),
					acesso_pagina($user->ID, "diabetes-no-alvo-edicao-2021"),
					acesso_pagina($user->ID, "cgm-masters-m1-2022"),
					acesso_pagina($user->ID, "paapcd-m1-2022"),
				);
			};

			foreach ($values as $linha) {
				fputcsv($outstream, $linha);
			}

			fclose($outstream); 
			echo '<a class="button-primary" href="'.$path['url'].'/relatorio.csv">Baixar Relatório</a>';
		
		?>
		
		
    </div>

<?php
}