<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../dao/Conexao.class.php';
	require_once '../dao/select.php';
	require_once '../dao/inserir.php';
	require_once '../domain/Usuario.class.php';	
	require_once '../services/cadastrarUsuarioService.php';
	require_once '../services/sessionService.php';
	require_once '../services/loginService.php';

	$email = trim(strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));
	$isUsuario = isUsuario($email);
	if (!$isUsuario) {
		$nome  = utf8_decode(trim(strip_tags(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING))));
		$senha = utf8_decode(trim(strip_tags(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING))));

		$usuario = new Usuario();
		$usuario->setNome($nome);
		$usuario->setEmail($email);
		$usuario->setSenha($senha);

		$inserir = inserirUsuario($usuario);
		if ($inserir) {
			$usuario = getUsuario($email);
			adicionarUsuarioNaSessao($usuario);
			die(json_encode(array("mensagem" => "sucesso")));
		} else {
			die(json_encode(array("mensagem" => "Falha ao realizar o cadastro")));
		}
	} else {
		die(json_encode(array("mensagem" => "Já existe um cadastro com esse email")));
		exit;
	}
}