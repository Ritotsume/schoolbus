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

        $this->data['instituicao_nome_url'] = Asserts::CheckName($this->data['instituicao_nome']);

        $create = new Create();

        $create->Inserter(self::Entity, $this->data);
        if ($create->getResult()):
            $this->result = $create->getResult();
            $this->rowcount = $create->getRowCount();
            $this->lastid = $create->getLastId();
        else:
            $this->result = $create->getResult();
            $this->rowcount = 0;
            $this->lastid = false;
        endif;
    }

    public function ModelDelete($id) {
        $this->instituicao = (int) $id;

        $delete = new Delete();
        $delete->Deleter(self::Entity, 'where instituicao_id = :id', "id={$this->instituicao}");
        if ($delete->getResult()):
            $this->result = true;
        else:
            $this->result = false;
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

    public function getInstituicoes($id = null)
    {
        $read = new Read;

        if(is_null($id)):
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
            . 'where instituicao_id = :id', "id={$id}");
            if($read->getResult()):
                $this->result = $read->getResult();
                $this->rowcount = $read->getRowCount();
            else:
                $this->result = false;
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

    public function getLastId(){
        return $this->lastid;
    }

}
