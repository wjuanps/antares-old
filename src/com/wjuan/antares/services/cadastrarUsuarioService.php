<?php
function cadastrarUsuario($usuario) {
	$inserir = inserirUsuario($usuario);
	if ($inserir) {
		return true;
	}
	return false;
}

function isUsuario($email) {
	$isUsuario = select("`usuario`", "*", "WHERE `usuario`.`email` = '$email'");
	if ($isUsuario) {
		return true;
	}
	return false;
}