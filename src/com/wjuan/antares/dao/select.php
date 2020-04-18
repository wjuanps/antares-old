<?php
//funcao para selecionar valores do banco de dados
function select($tabela, $coluna = "*", $where = NULL, $order = NULL, $limit = NULL) {
    try {
        $pdo = Connection::connect();
        $sql = $pdo->prepare("SELECT {$coluna} FROM {$tabela} {$where} {$order} {$limit}");
        $sql->execute();
        if ($pdo) {
            $query = $sql->fetchAll(PDO::FETCH_OBJ);
            return ($query) ? $query : false;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function selectFunction($funcao) {
    try {
        $pdo = Connection::connect();
        if ($pdo) {
            $sql = $pdo->prepare("SELECT {$funcao} AS value");
            $sql->execute();
            $query = $sql->fetchAll(PDO::FETCH_OBJ);
            return ($query) ? $query : false;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();   
    }
}