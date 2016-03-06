<?php

include_once '../app/Config.inc.php';

$varcheck = filter_input(INPUT_GET, 'var', FILTER_DEFAULT);

$del = filter_input(INPUT_GET, 'del', FILTER_VALIDATE_INT);
$dados = filter_input(INPUT_POST, 'json', FILTER_DEFAULT);

if (isset($del) && !empty($del)):
    if (isset($varcheck) && $varcheck == 'delete'):
        $deleteI = new ModelMotorista();
        $deleteI->ModelDelete($del);
        if ($deleteI->getResult()):

            ADSError('Deletado com sucesso!', CRAZY_ACCEPT);
        else:
            ADSError('errado denovo!', CRAZY_ERROR);
        endif;
    endif;
endif;

if(isset($dados) && !empty($dados)):
  $dados_js = json_decode($dados, true);
  $cadastra = new ModelMotorista();
  unset($dados_js['search_form'], $dados_js['telefone']);
  $cadastra->ModelCreator($dados_js);
  if($cadastra->getRowCount() > 0):
    echo 'Motorista cadastrado(a) com sucesso!!!';
  else:
    echo 'Erro ao cadastrar motorista...';
  endif;
endif;
