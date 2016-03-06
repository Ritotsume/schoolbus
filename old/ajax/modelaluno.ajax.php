<?php

include_once '../app/Config.inc.php';

$varcheck = filter_input(INPUT_GET, 'var', FILTER_DEFAULT);

$del = filter_input(INPUT_GET, 'del', FILTER_VALIDATE_INT);
$dados = filter_input(INPUT_POST, 'json', FILTER_DEFAULT);

if (isset($del) && !empty($del)):
    if (isset($varcheck) && $varcheck == 'delete'):
        $deleteI = new ModelAluno();
        $deleteI->ModelDelete($del);
        if ($deleteI->getResult()):

            ADSError('Deletado com sucesso!', CRAZY_ACCEPT);
        else:
            ADSError('errado denovo!', CRAZY_ERROR);
        endif;
    endif;
endif;

if(isset($dados) && !empty($dados)):
  $data_ok = json_decode($dados, true);
  $cadastra = new ModelAluno();
  unset($data_ok['search_form']);
  $cadastra->ModelCreator($data_ok);
  if($cadastra->getRowCount() > 0):
    echo 'Cadastrado com sucesso!!!';
  else:
    echo 'Erro ao cadastrar aluno';
  endif;
endif;
