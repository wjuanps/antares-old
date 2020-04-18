<?php
session_start();
function adicionarUsuarioNaSessao($usuario) {
	if (!isset($_SESSION['usuario'])) {
		$_SESSION['usuario'] = $usuario;
	}
}

function getUsuarioNaSessao() {
	return (isset($_SESSION['usuario'])) ? $_SESSION['usuario'] : null;
}

function destruirSessao() {
	if (isset($_SESSION['usuario'])) {
		unset($_SESSION['usuario']);
	}
}