<?php  
	
	$pessoa[] = array(
		'id' => 2,
		'nome' => 'Juan Soares',
		'idade' => 15
	);

	$pessoa[] = array(
		'id' => 1,
		'nome' => 'Sophia Soares',
		'idade' => 15
	);

	die(json_encode(array('dados' => $pessoa)));
	exit;

?>