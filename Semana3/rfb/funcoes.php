<?php

	function valida ( $entrada ) {
		if (strlen($entrada) != 11) {
			return false;
		}
		if(is_numeric($entrada) == false){
			return false;
		}
		$soma = 0;
		for ($i = 0 ; $i < 9 ; $i++){
			$n = $entrada[$i]; //Número
			$m = 10-$i;		   //Multiplicador
			$soma = $soma + ($n*$m);
		}
		$resto = $soma % 11;
		$dv = 11 - $resto;
		if ($dv > 9){
			$dv = 0;
		}
		if($entrada[9] != $dv){
			return false;
		}

		$soma = 0;
		for ($i = 0 ; $i < 10 ; $i++){
			$n = $entrada[$i]; //Número
			$m = 11-$i;		   //Multiplicador
			$soma = $soma + ($n*$m);
		}
		$resto = $soma % 11;
		$dv = 11 - $resto;
		if ($dv > 9){
			$dv = 0;
		}
		if($entrada[10] != $dv){
			return false;
		}
		return true;
	}

