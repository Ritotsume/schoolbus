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
      'tb_veiculos_veiculo_id' => (int) $this->data['tb_veiculos_veiculo_placa'],
      'tb_veiculos_inicio' => date('Y-m-d', strtotime(str_replace(array('/', '_', ' '), '-', $this->data['inicio']))),
      'tb_veiculos_fim' => date('Y-m-d', strtotime(str_replace(array('/', '_', ' '), '-', $this->data['fim'])))
    );
    $create = new Create();

    $create->Inserter(self::Entity, $dataRota);
    if ($create->getResult()):
      $createCaminho = clone $create;
      $idRota = $create->getLastId();
      for($x = 0; $x < count($this->data['caminhos']); $x++):
        $dataCaminho = array(
          'tb_rotas_rota_id' => (int) $idRota,
          'tb_logradouros_logradouro_id' => (int) $this->data['caminhos'][$x],
          'tb_caminho_ref' => $this->data['observacoes'][$x]
        );
        $createCaminho->Inserter('tb_caminhos_rota', $dataCaminho);
      endfor;
      if($createCaminho->getResult()):
        $this->result = true;
      else:
        $this->result = false;
      endif;
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

    $update = new Update();
    $update->Updater(self::Entity, $this->data, 'where rota_id = :id', "id={$this->rota}");
    if ($update->getResult()):
      $this->result = true;
    else:
      $this->result = false;
    endif;
  }

  public function getRotas($status = null){
    $read = new Read;
    if($status):
      $read->Reader('tb_rotas', 'inner join tb_instituicoes on '
      . 'tb_rotas.tb_instituicoes_instituicao_id = tb_instituicoes.instituicao_id '
      . 'inner join tb_veiculos on tb_rotas.tb_veiculos_veiculo_id = tb_veiculos.veiculo_id '
      . 'inner join tb_logradouros on tb_rotas.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
      . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id '
      . 'where rota_status = :status', "status={$status}");
      if ($read->getRowCount() > 0):
        $this->result = $read->getResult();
        $this->rowcount = $read->getRowCount();
      else:
        $this->result = $read->getResult();
        $this->rowcount = 0;
      endif;
    else:
      $read->Reader('tb_rotas', 'inner join tb_instituicoes on '
      . 'tb_rotas.tb_instituicoes_instituicao_id = tb_instituicoes.instituicao_id '
      . 'inner join tb_veiculos on tb_rotas.tb_veiculos_veiculo_id = tb_veiculos.veiculo_id '
      . 'inner join tb_logradouros on tb_rotas.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
      . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id');
      if ($read->getRowCount() > 0):
        $this->result = $read->getResult();
        $this->rowcount = $read->getRowCount();
      else:
        $this->result = $read->getResult();
        $this->rowcount = 0;
      endif;
    endif;
  }

  public function getResult() {
    return $this->result;
  }

  public function getRowCount() {
    return $this->rowcount;
  }

}
