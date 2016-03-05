<?php

class ModelAluno {

  const Entity = 'tb_aluno';

  private $aluno;
  private $data;
  private $result;
  private $rowcount;

  public function ModelCreator(array $data) {
    $this->data = $data;

    $this->data['aluno_nome_url'] = 'url-teste-um-aluno';
    $this->data['aluno_nascimento'] = date('Y-m-d', strtotime(str_replace(array('/', '_'), '-', $this->data['aluno_nascimento'])));

    $create = new Create();

    $create->Inserter(self::Entity, $this->data);
    if ($create->getResult()):
      $this->result = $create->getResult();
      $this->rowcount = $create->getRowCount();
    endif;
  }

  public function ModelDelete($id) {
    $this->aluno = (int) $id;

    $delete = new Delete();
    $delete->Deleter(self::Entity, 'where aluno_id = :id', "id={$this->aluno}");
    if ($delete->getResult()):
      $this->result = true;
    endif;
  }

  public function ModelUpdate($id, array $dados) {
    $this->aluno = (int) $id;
    $this->data = $dados;

    $this->data['aluno_nome_url'] = 'url-teste-um-aluno';
    $this->data['aluno_nascimento'] = date('Y-m-d', strtotime(str_replace(array('/', '_'), '-', $this->data['aluno_nascimento'])));

    $update = new Update();
    $update->Updater(self::Entity, $this->data, 'where aluno_id = :id', "id={$this->aluno}");
    if ($update->getResult()):
      $this->result = true;
    else:
      $this->result = false;
    endif;
  }

  public function getResult() {
    return $this->result;
  }

  public function getRowCount() {
    return $this->rowcount;
  }

}
