<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($dados) && !empty($dados)):
    if (isset($dados['CadRota'])):
        unset($dados['search_form'], $dados['CadRota']);
        $insert = new ModelRotas();
        $insert->ModelCreator($dados);
        if ($insert->getRowCount()):
            echo '<script type="text/javascript">'
            . 'alert("Rota cadastrada com sucesso!");'
            . '</script>';
        else:
            echo '<script type="text/javascript">'
            . 'alert("Erro ao cadastrar rota...");'
            . '</script>';
        endif;
    endif;
endif;
?>

<!-- INICIO MODAL -->

<!-- FIM MODAL -->
