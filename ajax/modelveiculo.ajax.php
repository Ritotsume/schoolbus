<?php

include_once '../app/Config.inc.php';

$varcheck = filter_input(INPUT_GET, 'var', FILTER_DEFAULT);

$del = filter_input(INPUT_GET, 'del', FILTER_VALIDATE_INT);

if (isset($del) && !empty($del)):
    if (isset($varcheck) && $varcheck == 'delete'):
        $deleteI = new ModelVeiculo();
        $deleteI->ModelDelete($del);
        if ($deleteI->getResult()):
            ADSError('Deletado com sucesso!', CRAZY_ACCEPT);
        else:
            ADSError('errado denovo!', CRAZY_ERROR);
        endif;
    endif;
endif;
