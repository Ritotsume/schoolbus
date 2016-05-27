<?php

class ModelAluno {

  const Entity = 'tb_aluno';

  private $aluno;
  private $data;
  private $result;
  private $rowcount;

  public function ModelCreator(array $data) {
    //verificar aluno se o mesmo existe antes de cadastrar....
    //
    $this->data = $data;

    $this->data['aluno_nome_url'] = Asserts::CheckName($this->data['aluno_nome']);
    $this->data['aluno_nascimento'] = date('Y-m-d', strtotime(str_replace(array('/', '_'), '-', $this->data['aluno_nascimento'])));

    $create = new Create();

    $create->Inserter(self::Entity, $this->data);
    if ($create->getResult()):
      $this->result = $create->getResult();
      $this->rowcount = $create->getRowCount();
    else:
      $this->result = $create->getResult();
      $this->rowcount = 0;
    endif;
  }

  public function ModelDelete($id) {
    $this->aluno = (int) $id;

    $delete = new Delete();
    $delete->Deleter(self::Entity, 'where aluno_id = :id', "id={$this->aluno}");
    if ($delete->getResult()):
      $this->result = true;
    else:
      $this->result = false;
    endif;
  }

  public function ModelUpdate($id, array $dados) {
    $this->aluno = (int) $id;
    $this->data = $dados;

    $this->data['aluno_nome_url'] = Asserts::CheckName($this->data['aluno_nome']);
    $this->data['aluno_nascimento'] = date('Y-m-d', strtotime(str_replace(array('/', '_'), '-', $this->data['aluno_nascimento'])));

    $update = new Update();
    $update->Updater(self::Entity, $this->data, 'where aluno_id = :id', "id={$this->aluno}");
    if ($update->getResult()):
      $this->result = true;
    else:
      $this->result = false;
    endif;
  }

  public function getAlunos($status = null)
  {
    $read = new Read;

    if(is_null($status)):
      $read->Reader(self::Entity, 'inner join tb_logradouros on ' .
      self::Entity . '.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
      . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id');
      if($read->getResult()):
        $this->result = $read->getResult();
        $this->rowcount = $read->getRowCount();
      else:
        $this->result = false;
        $this->rowcount = 0;
      endif;
    else:
      $read->Reader(self::Entity, 'inner join tb_logradouros on ' .
      self::Entity . '.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
      . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id '
      . ' where aluno_status = :status', "status={$status}");
      if($read->getResult()):
        $this->result = $read->getResult();
        $this->rowcount = $read->getRowCount();
      else:
        $this->result = false;
        $this->rowcount = 0;
      endif;
    endif;
  }

  public function getAluno($id)
  {
    $read = new Read;

    $read->Reader(self::Entity, 'inner join tb_logradouros on ' .
    self::Entity . '.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
    . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id '
    . ' where aluno_id = :id', "id={$id}");
    if($read->getResult()):
      $this->result = $read->getResult();
      $this->rowcount = $read->getRowCount();
    else:
      $this->result = false;
      $this->rowcount = 0;
    endif;
  }

  public function getResult() {
    return $this->result;
  }

  public function getRowCount() {
    return $this->rowcount;
  }

}
