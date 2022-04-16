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
				'Módulo 1/21', 
				'Módulo 2/21', 
				'Módulo 3/21', 
				'Módulo 4/21', 
				'Módulo 5/21', 
				'Módulo 6/21',
				'Módulo 7/21',
				'Módulo 8/21',
                'Módulo 9/21',
                'Módulo 10/21',
                'Assistido (%)',
                'Data de Login',
                'Horário de Login'
			);

			fputcsv($outstream, $fields);

            $dataLogin = '07/12/2021';

			$values = array();
			$blogusers = get_users( array( 'role__in' => array( 'um_profissional-de-saude', 'um_gestor-de-saude' ), 'orderby' => 'ID', 'order' => 'ASC', ) );
			foreach ( $blogusers as $user ) {

				$values[] = array(
					$user->ID,
					$user->display_name,
					get_user_meta($user->ID, 'email',true),
					get_user_meta($user->ID, 'espec_medica_1',true),
					get_user_meta($user->ID, 'crm',true),
					get_user_meta($user->ID, 'uf',true),
					get_user_meta($user->ID, 'cidade',true),
					get_user_meta($user->ID, 'telefone',true),
					acesso_pagina($user->ID, "m1-2021"),
					acesso_pagina($user->ID, "m2-2021"),
					acesso_pagina($user->ID, "m3-2021"),
					acesso_pagina($user->ID, "m4-2021"),
					acesso_pagina($user->ID, "m5-2021"),
					acesso_pagina($user->ID, "m6-2021"),
					acesso_pagina($user->ID, "m7-2021"),
					acesso_pagina($user->ID, "m8-2021"),
					acesso_pagina($user->ID, "m9-2021"),
                    acesso_pagina($user->ID, "m10-2021"),
                    $assistido,
                    $dataLogin,
                    $horaLogin
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