<?php

class Create extends Conn {

    /** @var PDO */
    private $connection;

    /** @var PDOStatement */
    private $create;
    //atributos da classe
    private $data;
    private $result;

    public function Inserter($table, array $dados) {
        $this->data = $dados;
        $columns = implode(', ', array_keys($dados));
        $values = ':' . implode(', :', array_keys($dados));
        $this->create = "insert into {$table} ({$columns}) values({$values})";

        $this->Execute();
    }

    public function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->create->rowCount();
    }

    public function getLastId(){
        return $this->connection->lastInsertId();
    }

    /**
     * PRIVATE METHODS - Métodos privados para uso interno da classe
     * 
     */
    private function getCon() {
        $this->connection = parent::getConnection();
        $this->create = $this->connection->prepare($this->create);
    }

    private function Execute() {
        $this->getCon();
        try {
            $this->create->execute($this->data);
            if ($this->connection->lastInsertId()):
                $this->result = $this->connection->lastInsertId();
            else:
                $this->result = true;
            endif;
        } catch (PDOException $ex) {
            $this->result = [$ex->getMessage(), $ex->getCode()];
        }
    }

}
