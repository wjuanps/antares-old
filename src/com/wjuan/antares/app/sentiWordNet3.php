<?php
function getPontuacaoPalavra($palavra) {
	if (empty($palavra)) {
		return 0.0;
	}
	return pontuacaoPalavra($palavra);
}

function getPontuacaoTexto($texto) {
	if (empty($texto)) {
		return array(
			'sentimento' => 'Neutro',
			'pontuacao'  => 0.0
		);
	}

	$palavra = str_replace("-", " ", $texto);
	$somaPosNeg = 0.0;
	$pontuacaoTotal   = 0.0;

	$totalPontuacaoNegativas = 0;
	$totalPontuacaoPositivas = 0;
	$totalPalavrasPositivas = 0;
	$totalPalavrasNegativas = 0;

	$mensagens  = array();
	$comentarios = getComentarios($palavra);
	
	if ($comentarios) {
		$tempComentarios = getTempComentarios($comentarios);
		foreach ($tempComentarios as $comentario) {
			$pontuacaoPositivaPalavra = 0;
			$pontuacaoNegativaPalavra = 0;
			$words = explode("-", urlAmigavel($comentario->comentario));
			foreach ($words as $word) {
				$pontuacaoPalavra = getPontuacaoPalavra($word);
				if ($pontuacaoPalavra < 0) {
					$pontuacaoNegativaPalavra += $pontuacaoPalavra;
					$totalPalavrasNegativas += 1;
				} else if ($pontuacaoPalavra > 0) {
					$pontuacaoPositivaPalavra += $pontuacaoPalavra;
					$totalPalavrasPositivas += 1;
				}
			}
			$totalPontuacaoPositivas += $pontuacaoPositivaPalavra;
			$totalPontuacaoNegativas += $pontuacaoNegativaPalavra;
			$somaPosNeg = $pontuacaoPositivaPalavra + $pontuacaoNegativaPalavra;
			array_push($mensagens, getMensagem($comentario, $words, $somaPosNeg));
		}
		$totalPontuacaoPositivas = ($totalPontuacaoPositivas/$totalPalavrasPositivas);
		$totalPontuacaoNegativas = ($totalPontuacaoNegativas/$totalPalavrasNegativas);
		$pontuacaoTotal = ($totalPontuacaoPositivas - abs($totalPontuacaoNegativas));


		$porcentagemPosNeg = getPorcentagemPosNeg($totalPontuacaoNegativas, $totalPontuacaoPositivas);

		$sentimento = array(
			'sentimento' => getSentimento($pontuacaoTotal),
			'pontuacao' => $pontuacaoTotal,
			'totalPontuacaoPositivas' => $totalPontuacaoPositivas,
			'totalPontuacaoNegativas' => $totalPontuacaoNegativas,
			'somaPosNeg' => $somaPosNeg,
			'porcentagemPositivo' => $porcentagemPosNeg[0],
			'porcentagemNegativo' => $porcentagemPosNeg[1],
			'totalDeTweets' => count($comentarios),
			'mensagens' => $mensagens
		);
		return $sentimento;
	} else {
		return array(
			'sentimento' => 'Vazio',
			'vazio' => 'Desculpe, mas nenhum resultado foi encontrado para sua busca'
		);
	}
}

function getTempComentarios($comentarios) {
	$tempComentarios = array();
	if (count($comentarios) > 5) {
		$indices = array();
		$i = 0;
		while ($i < 5) {
			$indice = rand(count($comentarios)-1, 0);
			if (!in_array($indice, $indices)) {
				array_push($indices, $indice);
				$tempComentarios[] = $comentarios[$indice];
				++$i;
			}
		}
	} else {
		$tempComentarios = $comentarios;
	}
	return $tempComentarios;
}

function getPontuacaoTotal($pontuacaoTexto) {
	$pontuacaoTextoParcial = 0.0;
	foreach ($pontuacaoTexto as $pontuacao) {
		$pontuacaoTextoParcial += $pontuacao;
	}
	return ($pontuacaoTextoParcial/count($pontuacaoTexto));
}

function getMensagem($comentario, $words, $somaPosNeg) {
	return array(
		'mensagem' => utf8_encode($comentario->comentario),
		'sentimento' => getSentimento($somaPosNeg/count($words))
	);
}

function getPorcentagemPosNeg($totalPontuacaoNegativas, $totalPontuacaoPositivas) {
	$somaPosNeg = $totalPontuacaoPositivas + abs($totalPontuacaoNegativas);
	if ($somaPosNeg == 0) return array(0, 0);
	$porcentagemPositivo = (($totalPontuacaoPositivas*100)/$somaPosNeg);
	return array(
		number_format($porcentagemPositivo, 2),
		number_format(abs($porcentagemPositivo - 100), 2)
	);
}