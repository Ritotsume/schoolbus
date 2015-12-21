<?php

class ModelRotas {

    const Entity = 'tb_rotas';

    private $rota;
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
        endif;
    }

    public function ModelDelete($id) {
        $this->rota = (int) $id;

        $delete = new Delete();
        $delete->Deleter(self::Entity, 'where instituicao_id = :id', "id={$this->rota}");
        if ($delete->getResult()):
            $this->result = true;
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

    public function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->rowcount;
    }

}
