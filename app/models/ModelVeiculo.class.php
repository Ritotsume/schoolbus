<?php

class ModelVeiculo {

    const Entity = 'tb_veiculos';

    private $veiculo;
    private $data;
    private $result;
    private $rowcount;

    public function ModelCreator(array $data) {
        $this->data = $data;
        $this->data['veiculo_vagas'] = 0;

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

    public function ModelDelete($idveiculo) {
        $this->veiculo = (int) $idveiculo;

        $read = new Read;
        $read->Reader(self::Entity, 'where veiculo_id = :id', "id={$this->veiculo}");

        if($read->getResult()){
            $status = $read->getResult()[0]['veiculo_status'];
            $update = new Update;
            $update->Updater(self::Entity, array('veiculo_status' => ((1 == $status) ? 0 : 1)), 'where veiculo_id = :id', "id={$this->veiculo}");
            if ($update->getResult()):
                $this->result = true;
            else:
                $this->result = false;
            endif;
        }else{
            $this->result = false;
        }
    }

    public function ModelUpdate($idveiculo, array $dados) {
        $this->veiculo = $idveiculo;
        $this->data = $dados;

        $read = new Read;
        $read->Reader(self::Entity, 'where veiculo_id = :id', "id={$this->veiculo}");

        if($read->getResult()){
            $poltronas = (int) $read->getResult()[0]['veiculo_poltronas'];
            $vagas = (int) $read->getResult()[0]['veiculo_vagas'];
            $diffPoltronas = $this->data['veiculo_poltronas'] - $poltronas;
            if(($this->data['veiculo_poltronas'] > $vagas) && ($diffPoltronas < $vagas))
            {
                $this->data['veiculo_vagas'] = $vagas + $diffPoltronas;
            }else{
                $this->data['veiculo_poltronas'] = $poltronas;
            }
            $update = new Update();
            $update->Updater(self::Entity, $this->data, 'where veiculo_id = :id', "id={$this->veiculo}");
            if ($update->getResult()):
                $this->result = true;
            else:
                $this->result = false;
            endif;
        }
    }

    public function setVaga($veiculo)
    {
        $read = new Read;
        $read->Reader(self::Entity, 'where veiculo_id = :id', "id={$veiculo}");
        if($read->getResult())
        {
            $vagas = (int) $read->getResult()[0]['veiculo_vagas'];
            if(0 < $vagas)
            {
                $update = new Update;
                $update->Updater('tb_veiculos', array('veiculo_vagas' => ($vagas - 1)), 'where veiculo_id = :id', "id={$veiculo}");
                return true;
            }else{
                return false;
            }
        }
    }

    public function getVeiculos($status = null)
    {
        $read = new Read;

        if(is_null($status)):
            $read->Reader(self::Entity);
            if($read->getResult()):
                $this->result = $read->getResult();
                $this->rowcount = $read->getRowCount();
            else:
                $this->result = false;
                $this->rowcount = 0;
            endif;
        else:
            $read->Reader(self::Entity, 'where veiculo_status = :status', "status={$status}");
            if($read->getResult()):
                $this->result = $read->getResult();
                $this->rowcount = $read->getRowCount();
            else:
                $this->result = false;
                $this->rowcount = 0;
            endif;
        endif;
    }

    public function getVeiculo($idveiculo)
    {
        $read = new Read;

        $read->Reader(self::Entity, 'where veiculo_id = :id', "id={$idveiculo}");
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
