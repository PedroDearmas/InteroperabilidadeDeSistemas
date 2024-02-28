<?php

	function valida ( $entrada ) {
		if (strlen($entrada) != 11) {
			return false;
		}
		return true;
	}

