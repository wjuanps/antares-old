<?php
function pontuacaoPalavra($palavra) {
	$pontuacao = selectFunction("pontuacao_palavra('".$palavra."')");
	if ($pontuacao) {
		return $pontuacao[0]->value;
	}
	return false;
}

function getComentarios($palavra) {
	$comentarios = select("`comentarios`", "*", "WHERE LOWER(`comentario`) REGEXP '[[:<:]]".$palavra."[[:>:]]'");
	if ($comentarios) {
		inserirPesquisa($palavra);
	}
	return $comentarios;
}

function getMaisVisitados() {
	$maisVisitados = select("`pesquisa`", "*", "ORDER BY `total_pesquisa` DESC", "LIMIT 5");
	return $maisVisitados;
}

function inserirPesquisa($palavra) {
	if (!empty($palavra)) {
		$pesquisa = select("`pesquisa`", "*", "WHERE LOWER(`pesquisa`) = '$palavra'");
		if ($pesquisa) {
			$total_pesquisa = $pesquisa[0]->total_pesquisa + 1;
			$id_pesquisa = $pesquisa[0]->id_pesquisa;
			update("total_pesquisa", $total_pesquisa, "pesquisa", "WHERE `id_pesquisa` = $id_pesquisa");
		} else {
			$coluna = array("pesquisa", "total_pesquisa");
			$valor  = array($palavra, 1);
			inserir($coluna, $valor, "pesquisa");
		}
	}
}