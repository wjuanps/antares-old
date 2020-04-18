<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once '../dao/Conexao.class.php';
	require_once '../dao/select.php';
	require_once '../dao/inserir.php';
	require_once '../dao/atualizar.php';
	require_once '../services/antaresService.php';
	require_once '../domain/sentimento.php';
	require_once '../util/urlAmigavel.php';
	require_once '../app/sentiWordNet3.php';

	$texto = trim(strip_tags(filter_input(INPUT_GET, 'texto', FILTER_SANITIZE_STRING)));
	$texto = urlAmigavel($texto);
	die(json_encode(getPontuacaoTexto($texto)));
	exit();
}