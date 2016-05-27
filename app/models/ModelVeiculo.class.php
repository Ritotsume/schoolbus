<?php

class ModelVeiculo {

    const Entity = 'tb_veiculos';

    private $veiculo;
    private $data;
    private $result;
    private $rowcount;

    public function ModelCreator(array $data) {
        $this->data = $data;

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
        $this->veiculo = $idveiculo;

        $delete = new Delete();
        $delete->Deleter(self::Entity, 'where veiculo_id = :id', "id={$this->veiculo}");
        if ($delete->getResult()):
            $this->result = true;
        else:
            $this->result = false;
        endif;
    }

    public function ModelUpdate($idveiculo, array $dados) {
        $this->veiculo = $idveiculo;
        $this->data = $dados;

        $update = new Update();
        $update->Updater(self::Entity, $this->data, 'where veiculo_id = :id', "id={$this->veiculo}");
        if ($update->getResult()):
            $this->result = true;
        else:
            $this->result = false;
        endif;
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
