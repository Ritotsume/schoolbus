<?php

class Delete extends Conn {

    /** @var PDO */
    private $connection;

    /** @var PDOStatement */
    private $delete;
    //atributos classe
    private $query;
    private $binds;
    private $result;

    public function Deleter($table, $where, $bind) {
        parse_str($bind, $this->binds);

        $this->query = "delete from {$table} {$where}";
        $this->Execute();
    }

    public function getResult() {
        return $this->result;
    }

    /**
     * PRIVATE METHODS = Métodos privados para uso interno da classe
     * 
     */
    private function getCon() {
        $this->connection = parent::getConnection();
        $this->delete = $this->connection->prepare($this->query);
    }

    private function setParameters() {
        if (isset($this->binds) && !empty($this->binds)):
            foreach ($this->binds as $index => $value):
                $this->delete->bindValue(":{$index}", $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
            endforeach;
        endif;
    }

    private function Execute() {
        $this->getCon();
        try {
            $this->setParameters();
            $this->delete->execute();
            $this->result = true;
        } catch (PDOException $ex) {
            $this->result = false;
        }
    }

}
