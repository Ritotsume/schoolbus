<?php

class ModelMotorista {

    const Entity = 'tb_motoristas';

    private $motorista;
    private $data;
    private $result;
    private $rowcount;

    public function ModelCreator(array $data) {
        $this->data = $data;

        $this->data['motorista_nome_url'] = Asserts::CheckName($this->data['motorista_nome'] . ' ' . $this->data['motorista_sobrenome']);

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
        $this->motorista = (int) $id;

        $read = new Read;
        $read->Reader(self::Entity, 'where motorista_id = :id', "id={$this->motorista}");

        if($read->getResult()){
            $status = $read->getResult()[0]['motorista_status'];
            $update = new Update;
            $update->Updater(self::Entity, array('motorista_status' => ((1 == $status) ? 0 : 1)), 'where motorista_id = :id', "id={$this->motorista}");
            if ($update->getResult()):
                $this->result = true;
            else:
                $this->result = false;
            endif;
        }else{
            $this->result = false;
        }
    }

    public function ModelUpdate($id, array $dados) {
        $this->motorista = (int) $id;
        $this->data = $dados;

        $this->data['motorista_nome_url'] = Asserts::CheckName($this->data['motorista_nome']);

        $update = new Update();
        $update->Updater(self::Entity, $this->data, 'where motorista_id = :id', "id={$this->motorista}");
        if ($update->getResult()):
            $this->result = true;
        else:
            $this->result = false;
        endif;
    }

    public function getMotoristas($status = null)
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
            . ' where motorista_status = :status', "status={$status}");
            if($read->getResult()):
                $this->result = $read->getResult();
                $this->rowcount = $read->getRowCount();
            else:
                $this->result = false;
                $this->rowcount = 0;
            endif;
        endif;
    }

    public function getMotorista($idmotorista)
    {
        $read = new Read;

        $read->Reader(self::Entity, 'inner join tb_logradouros on ' .
        self::Entity . '.tb_logradouros_logradouro_id = tb_logradouros.logradouro_id '
        . 'inner join tb_bairros on tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id '
        . ' where motorista_id = :id', "id={$idmotorista}");
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
