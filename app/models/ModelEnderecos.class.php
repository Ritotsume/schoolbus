uem<?php

/**
* <b>ModelEnderecos</b>: Classe responsável por controlar a base de endereços do sistema.
* @author ADSCrazy (Érica, Gianfrancesco, Mônica)
*/
class ModelEnderecos {

    //Definição da tabela.
    const Logradouro = 'tb_logradouros';
    const Bairro = 'tb_bairros';
    const Cidade = 'tb_cidade';

    //Atributos da classe.
    private $data;
    private $result;
    private $rowcount;

    public function CriaLogradouro(array $data) {
        $this->data = $data;
        $create = new Create();

        $create->Inserter(self::Logradouro, $this->data);
        if ($create->getResult()):
            $this->result = $create->getResult();
        else:
            $this->result = false;
        endif;
    }

    public function CriaBairro(array $data) {
        $this->data = $data;
        $create = new Create();

        $create->Inserter(self::Bairro, $this->data);
        if ($create->getResult()):
            $this->result = $create->getResult();
        else:
            $this->result = false;
        endif;
    }

    public function CriaCidade(array $data) {
        $this->data = $data;
        $create = new Create();

        $create->Inserter(self::Cidade, $this->data);
        if ($create->getResult()):
            $this->result = $create->getResult();
        else:
            $this->result = false;
        endif;
    }

    public function DeleteCidade($id) {

        $delete = new Delete();
        $delete->Deleter(self::Cidade, 'where cidade_id = :id', "id={$id}");
        if ($delete->getResult()):
            $this->result = true;
        else:
            $this->result = false;
        endif;
    }

    public function DeleteBairro($id) {

        $delete = new Delete();
        $delete->Deleter(self::Bairro, 'where bairros_id = :id', "id={$id}");
        if ($delete->getResult()):
            $this->result = true;
        else:
            $this->result = false;
        endif;
    }

    public function DeleteLogradouro($id) {

        $delete = new Delete();
        $delete->Deleter(self::Logradouro, 'where logradouro_id = :id', "id={$id}");
        if ($delete->getResult()):
            $this->result = true;
        else:
            $this->result = false;
        endif;
    }

    public function UpdateCidade($id, array $dados) {
        $this->data = $dados;

        $update = new Update();
        $update->Updater(self::Cidade, $this->data, 'where cidade_id = :id', "id={$id}");
        if ($update->getResult()):
            $this->result = true;
        else:
            $this->result = false;
        endif;
    }

    public function UpdateBairro($id, array $dados) {
        $this->data = $dados;

        $update = new Update();
        $update->Updater(self::Bairro, $this->data, 'where bairros_id = :id', "id={$id}");
        if ($update->getResult()):
            $this->result = true;
        else:
            $this->result = false;
        endif;
    }

    public function UpdateLogradouro($id, array $dados) {
        $this->data = $dados;

        $update = new Update();
        $update->Updater(self::Logradouro, $this->data, 'where logradouro_id = :id', "id={$id}");
        if ($update->getResult()):
            $this->result = true;
        else:
            $this->result = false;
        endif;
    }

    public function getLogradouros(){
        $read = new Read;

        $read->Reader(self::Logradouro, 'inner join tb_bairros on tb_bairros.bairros_id = '.
        self::Logradouro .'.tb_bairros_bairros_id');
        if ($read->getRowCount() > 0):
            $this->result = $read->getResult();
            $this->rowcount = $read->getRowCount();
        else:
            $this->result = false;
            $this->rowcount = 0;
        endif;
    }

    public function getLogradouro($logradouro){
        $read = new Read;

        $read->Reader(self::Logradouro, 'inner join tb_bairros on tb_bairros.bairros_id = '.
        self::Logradouro .'.tb_bairros_bairros_id where logradouro_id = :id', "id={$logradouro}");
        if ($read->getRowCount() > 0):
            return $read->getResult();
        else:
            return false;
        endif;
    }

    public function getBairros(){
        $read = new Read;

        $read->Reader(self::Bairro, 'inner join tb_cidade on tb_cidade.cidade_id = '.
        self::Bairro .'.tb_cidade_cidade_id');
        if ($read->getRowCount() > 0):
            $this->result = $read->getResult();
            $this->rowcount = $read->getRowCount();
        else:
            $this->result = false;
            $this->rowcount = 0;
        endif;
    }

    public function getBairro($bairro){
        $read = new Read;

        $read->Reader(self::Bairro, 'inner join tb_cidade on tb_cidade.cidade_id = '.
        self::Bairro .'.tb_cidade_cidade_id where bairros_id = :id', "id={$bairro}");
        if ($read->getRowCount() > 0):
            return $read->getResult();
        else:
            $this->result = false;
        endif;
    }

    public function getCidades(){
        $read = new Read;

        $read->Reader(self::Cidade);
        if ($read->getRowCount() > 0):
            $this->result = $read->getResult();
            $this->rowcount = $read->getRowCount();
        else:
            $this->result = false;
            $this->rowcount = 0;
        endif;
    }

    public function getCidade($cidade){
        $read = new Read;

        $read->Reader(self::Cidade, "where cidade_id = :id", "id={$cidade}");
        if ($read->getRowCount() > 0):
            return $read->getResult();
        else:
            return false;
        endif;
    }

    public function getBairroNome($id){
        $read = new Read;

        $read->Reader(self::Bairro, ' where bairros_id = :id', "id={$id}");
        if ($read->getRowCount() > 0):
            $nomeBairro = $read->getResult();
            $this->result = $nomeBairro[0]['bairros_nome'];
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
