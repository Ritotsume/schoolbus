<?php

class Read extends Conn {

    /** @var PDO */
    private $connection;

    /** @var PDOStatement */
    private $read;
    //atributos da classe
    private $query;
    private $binds;
    private $result;

    public function Reader($table, $where = null, $bind = null) {
        if (!empty($bind)):
            parse_str($bind, $this->binds);
        endif;

        $this->query = "select * from {$table} {$where}";
        $this->Execute();
    }

    public function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->read->rowCount();
    }

    /**
     * PRIVATE METHODS = Métodos privados para uso interno da classe
     *
     */
    private function getCon() {
        $this->connection = parent::getConnection();
        $this->read = $this->connection->prepare($this->query);
        $this->read->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function setParameters() {
        if (isset($this->binds) && !empty($this->binds)):
            foreach ($this->binds as $index => $value):
                $this->read->bindValue(":{$index}", $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
            endforeach;
        endif;
    }

    private function Execute() {
        $this->getCon();
        try {
            $this->setParameters();
            $this->read->execute();
            $this->result = $this->read->fetchAll();
        } catch (PDOException $ex) {
            $this->result = false;
            $erro = 'algo errado...' . $ex->getMessage();
        }
    }

}
