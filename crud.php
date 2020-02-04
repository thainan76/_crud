<?php

    require('conexao.php');

    $mysqli = new conexao();

    if($_GET['metodo'] == 'adicionar'){

        $obj = json_decode($_GET['val']);

        return $mysqli->addClientes($obj);

    }else if($_GET['metodo'] == 'editar'){

        $obj = json_decode($_GET['val']);

        return $mysqli->updateClientes($obj);

    }else if($_GET['metodo'] == 'remover'){

        $obj = json_decode($_GET['val']);

        return $mysqli->deleteClientes($obj->id);
        
    }

?>