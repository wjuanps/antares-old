<?php
    require_once 'app.php';
    require_once 'src/com/wjuan/antares/services/sessionService.php';

    if (isset($url[1])) {
        header("Location: " . __URL_BASE__ . $url[0]);
    }

    echo '<pre>';
    print_r($url);

    if ($url[0] == 'index') {
        require_once 'web/view/antares.html';
    } else if(file_exists("web/view/".$url[0].".html")) {
        if ($url[0] == "acessar-sistema" && getUsuarioNaSessao() != null) {
            header("Location: /antares");
        }     
        require_once 'web/view/'.$url[0].".html";
    } else {
        require_once 'web/view/analise-de-sentimento.html';
    } 
?>