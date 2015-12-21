<?php

class ModelInstituicao {

    const Entity = 'tb_instituicoes';

    private $instituicao;
    private $data;
    private $result;
    private $rowcount;
    private $lastid;

    public function ModelCreator(array $data) {
        $this->data = $data;

        $this->data['instituicao_nome_url'] = 'url-teste-um';

        $create = new Create();

        $create->Inserter(self::Entity, $this->data);
        if ($create->getResult()):
            $this->result = $create->getResult();
            $this->rowcount = $create->getRowCount();
            $this->lastid = $create->getLastId();
        endif;
    }

    public function ModelDelete($id) {
        $this->instituicao = (int) $id;

        $delete = new Delete();
        $delete->Deleter(self::Entity, 'where instituicao_id = :id', "id={$this->instituicao}");
        if ($delete->getResult()):
            $this->result = true;
        endif;
    }

    public function ModelUpdate($id, array $dados) {
        $this->instituicao = (int) $id;
        $this->data = $dados;

        $update = new Update();
        $update->Updater(self::Entity, $this->data, 'where instituicao_id = :id', "id={$this->instituicao}");
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

    public function getLastId(){
        return $this->lastid;
    }

}
