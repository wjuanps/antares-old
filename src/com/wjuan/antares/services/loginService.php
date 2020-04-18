<?php
function logarNoSistema($email, $senha) {
	try {
		$usuario = selectFunction("logar('$email', '$senha')");
		if ($usuario) {
			return ($usuario[0]->value != 0);
		}
	} catch (PDOException $e) {
		$e->getMessage();
	}
}

function getUsuario($email) {
	$usuario = select("`usuario`", "*", "WHERE BINARY `usuario`.`email` = '$email'");
	if ($usuario && count($usuario) == 1) {
		return $usuario[0];
	}
	return false;
}