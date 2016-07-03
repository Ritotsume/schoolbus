<?php

/**
* <b>ModelRotas</b>: Classe responsável por controlar as rotas no sistema.
* @author ADSCrazy (Érica, Gianfrancesco, Mônica)
*/
class ModelRotas {

  //Definição da tabela de rotas.
  const Entity = 'tb_rotas';

  //Atributos da classe.
  private $rota;
  private $data;
  private $result;
  private $rowcount;

  //dados da Rota
  private $logradouro;
  private $bairro;

  /**
  * <b>ModelCreator</b>: Método responsável por efetivar o cadastro da rota no sistema.
  * @param array $data Array com os dados necessários para cadastro da rota.
  * @return bool Retorna TRUE caso a função seja executada com sucesso, ou FALSE em caso de falha.
  */
  public function ModelCreator(array $data) {
    $this->data = $data;
    $dataRota = array(
      'rota_instituicoes' => json_encode($this->data['escolas']),
      'tb_veiculos_veiculo_id' => (int) $this->data['rota_veiculo'],
      'rota_inicio' => date('Y-m-d', strtotime(str_replace(array('/', '_', ' '), '-', $this->data['inicio']))),
      'rota_fim' => date('Y-m-d', strtotime(str_replace(array('/', '_', ' '), '-', $this->data['fim']))),
      'rota_saida' => (int) $this->data['rota_inicio'],
      'rota_chegada' => (int) $this->data['rota_fim'],
      'rota_observacoes' => $this->data['observacoes']
    );
    $create = new Create();

    $create->Inserter(self::Entity, $dataRota);
    if ($create->getResult()):
      $this->result = true;
    else:
      $this->result = false;
    endif;
  }

  public function ModelDelete($id) {
    $this->rota = (int) $id;

    $delete = new Update();
    $delete->Updater(self::Entity, array('rota_status' => 0), 'where rota_id = :id', "id={$this->rota}");
    if ($delete->getResult()):
      $this->result = true;
    else:
      $this->result = false;
    endif;
  }

  public function ModelUpdate($id, array $dados) {
    $this->rota = (int) $id;
    $this->data = $dados;

    $dataRota = array(
      'rota_instituicoes' => json_encode($this->data['escolas']),
      'tb_veiculos_veiculo_id' => (int) $this->data['rota_veiculo'],
      'rota_inicio' => date('Y-m-d', strtotime(str_replace(array('/', '_', ' '), '-', $this->data['inicio']))),
      'rota_fim' => date('Y-m-d', strtotime(str_replace(array('/', '_', ' '), '-', $this->data['fim']))),
      'rota_saida' => (int) $this->data['rota_inicio'],
      'rota_chegada' => (int) $this->data['rota_fim'],
      'rota_observacoes' => $this->data['observacoes']
    );

    $update = new Update();
    $update->Updater(self::Entity, $dataRota, 'where rota_id = :id', "id={$this->rota}");
    if ($update->getResult()):
      $this->result = true;
    else:
      $this->result = false;
    endif;
  }

  public function getRotas($status = null){
    $read = new Read;
    if(!is_null($status)):
      $read->Reader(self::Entity, 'where rota_status = :status', "status={$status}");
      if ($read->getResult()):
        $this->result = $read->getResult();
        $this->rowcount = $read->getRowCount();
      else:
        $this->result = false;
        $this->rowcount = 0;
      endif;
    else:
      $read->Reader(self::Entity);
      if ($read->getResult()):
        $this->result = $read->getResult();
        $this->rowcount = $read->getRowCount();
      else:
        $this->result = false;
        $this->rowcount = 0;
      endif;
    endif;
  }

  public function getRota($rota){
    $read = new Read;
    $read->Reader(self::Entity, 'where rota_id = :id', "id={$rota}");

    if($read->getResult()){
      return $read->getResult();
    }else{
      return false;
    }
  }

  public function getInstituicoes($escolas){
    $escolas = json_decode($escolas, true);
    $read = new Read;
    $data = array();
    $div = '';

    foreach($escolas as $escola){
      $read->Reader('tb_instituicoes', 'where instituicao_id = :id', "id={$escola}");
      if($read->getResult()){
        $data[] = $read->getResult()[0]['instituicao_nome'];
      }
    }

    return implode(', ', $data);
  }

  public function getResult() {
    return $this->result;
  }

  public function getRowCount() {
    return $this->rowcount;
  }

}
