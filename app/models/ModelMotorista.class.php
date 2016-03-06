<?php

class ModelMotorista {

    const Entity = 'tb_motoristas';

    private $motorista;
    private $data;
    private $result;
    private $rowcount;

    public function ModelCreator(array $data) {
        $this->data = $data;

        $this->data['motorista_nome_url'] = 'url-teste-um-motor';

        $create = new Create();

        $create->Inserter(self::Entity, $this->data);
        if ($create->getResult()):
            $this->result = $create->getResult();
            $this->rowcount = $create->getRowCount();
        endif;
    }

    public function ModelDelete($id) {
        $this->motorista = (int) $id;

        $delete = new Delete();
        $delete->Deleter(self::Entity, 'where motorista_id = :id', "id={$this->motorista}");
        if ($delete->getResult()):
            $this->result = true;
        endif;
    }

    public function ModelUpdate($id, array $dados) {
        $this->motorista = (int) $id;
        $this->data = $dados;

        $update = new Update();
        $update->Updater(self::Entity, $this->data, 'where motorista_id = :id', "id={$this->motorista}");
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
