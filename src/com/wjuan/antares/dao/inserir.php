<?php
function inserir($coluna, $valor, $tabela) {
    try {
        $pdo = Connection::connect();
        if ((is_array($coluna)) && (is_array($valor))) {
            if (count($coluna) == count($valor)) {
                $inserir = $pdo->prepare("INSERT INTO {$tabela} (" . implode(', ', $coluna) . ") VALUES ('" . implode('\', \'', $valor) . "')");
            } else {
                return false;
            }
        } else {
            $inserir = $pdo->prepare("INSERT INTO {$tabela} ({$coluna}) VALUES ('{$valor}'");
        }
        if ($pdo) {
            if ($inserir->execute()) {
                return $pdo;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function inserirUsuario($usuario) {
    try {
        $pdo = Connection::connect();
        if ($pdo) {
            $inserir = $pdo->prepare("INSERT INTO `usuario` (nome, email, senha, data_cadastro) VALUES ('{$usuario->getNome()}', '{$usuario->getEmail()}', MD5('{$usuario->getSenha()}'), CURRENT_TIMESTAMP)");
            $inserir = $inserir->execute();
            if ($inserir) {
                return true;
            }
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}