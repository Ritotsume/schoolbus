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
            $this->result = false;
        endif;
    }

    public function ModelDelete($placa) {
        $this->veiculo = $placa;

        $delete = new Delete();
        $delete->Deleter(self::Entity, 'where veiculo_placa = :placa', "placa={$this->veiculo}");
        if ($delete->getResult()):
            $this->result = true;
        endif;
    }

    public function ModelUpdate($placa, array $dados) {
        $this->veiculo = $placa;
        $this->data = $dados;

        $update = new Update();
        $update->Updater(self::Entity, $this->data, 'where veiculo_placa = :placa', "placa={$this->veiculo}");
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
