<?php
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		require_once '../dao/Conexao.class.php';
		require_once '../dao/select.php';
		require_once '../services/antaresService.php';
		require_once '../util/urlAmigavel.php';
		
		$getMaisVisitados = getMaisVisitados();
		$maisVisitados = array();
		if ($getMaisVisitados) {
			foreach ($getMaisVisitados as $visitado) {
				$maisVisitados[] = array(
					'url' => utf8_encode(urlAmigavel($visitado->pesquisa)),
					'nome' => utf8_encode($visitado->pesquisa),
					'total' => $visitado->total_pesquisa
				);
			}
			die(json_encode(array('dados' => $maisVisitados)));
		}

		die(json_encode(array("erro" => 'erro')));
	}