<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once '../dao/Conexao.class.php';
	require_once '../dao/select.php';
	require_once '../dao/inserir.php';
	require_once '../dao/atualizar.php';
	require_once '../services/antaresService.php';
	require_once '../domain/sentimento.php';
	require_once '../util/urlAmigavel.php';
	require_once '../app/sentiWordNet3.php';

	$c1 = trim(strip_tags(filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_STRING)));
	$c2 = trim(strip_tags(filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_STRING)));
	
	if (isset($c1, $c2)) {
		$c1 = urlAmigavel($c1);
		$c2 = urlAmigavel($c2);

		$sentimento1 = getPontuacaoTexto($c1);
		$sentimento2 = getPontuacaoTexto($c2);

		die(json_encode(
			array("sentimentos" => array(
				array("dados" => $sentimento1, "pesquisa" => str_replace("-", " ", $c1)), 
				array("dados" => $sentimento2, "pesquisa" => str_replace("-", " ", $c2))))
			)
		);

	} else {
		die(json_encode(array("error")));
	}
}