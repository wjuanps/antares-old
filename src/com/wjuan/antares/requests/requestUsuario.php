<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../dao/Conexao.class.php';
	require_once '../dao/select.php';
	require_once '../services/sessionService.php';

	die(json_encode(array("usuario" => getUsuarioNaSessao())));
}