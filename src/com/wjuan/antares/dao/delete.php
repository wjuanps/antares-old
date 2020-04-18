<?php

//funcao para excluir um valor ou uma tabela do banco de dados
function delete($tabela, $where = NULL) {    
    try {
        $pdo = Connection::connect();
        $delete = $pdo->prepare("DELETE FROM {$tabela} {$where}");
        if ($pdo) {
             if ($delete->execute()) {
                 return true;
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