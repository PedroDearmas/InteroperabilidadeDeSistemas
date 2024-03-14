<h3>Receita Federal do Brasil<br/>Validação de CPF</h3>
<form method="post">
	<input type="text" name="documento" placeholder="CPF" autocomplete="off" />
	<input type="submit" value="Validar" />
</form>
	
<?php

	if ( isset($_REQUEST['documento']) ) {
		include 'funcoes.php';
		if (valida($_REQUEST['documento'])) {
			print $_REQUEST['documento'] . ' é um CPF válido.';
		} else {
			print $_REQUEST['documento'] . ' não é um CPF válido.';
		}
	}

