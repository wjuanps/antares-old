<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../dao/Conexao.class.php';
	require_once '../dao/select.php';
	require_once '../services/sessionService.php';
	require_once '../services/loginService.php';

	date_default_timezone_set("America/Belem");

	$login = trim(strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));
	$senha = trim(strip_tags(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING)));

	if (isset($login, $senha)) {
		if (logarNoSistema($login, $senha)) {
			$usuario = getUsuario($login);
			if ($usuario) {
				adicionarUsuarioNaSessao($usuario);
				die(json_encode(array('usuario' => getUsuarioNaSessao())));
				exit;
			}
		}
	}
}