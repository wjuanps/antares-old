<?php
function getSentimento($pontuacao) {
	if ($pontuacao < 0) {
		return 'Negativo';
	}
	if ($pontuacao > 0) {
		return 'Positivo';
	}
	return 'Neutro';
}