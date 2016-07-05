<?php

include_once '../app/Config.inc.php';

$varcheck = filter_input(INPUT_GET, 'var', FILTER_DEFAULT);

$del = filter_input(INPUT_GET, 'del', FILTER_VALIDATE_INT);
$dados = filter_input(INPUT_POST, 'json', FILTER_DEFAULT);

if (isset($del) && !empty($del)):
    if (isset($varcheck) && $varcheck == 'delete'):
        $deleteI = new ModelRotas();
        $deleteI->ModelDelete($del);
        if ($deleteI->getResult()):
            ADSError('Alterada com sucesso!', CRAZY_ACCEPT);
        else:
            ADSError('Erro ao inativar a rota.', CRAZY_ERROR);
        endif;
    endif;
endif;
