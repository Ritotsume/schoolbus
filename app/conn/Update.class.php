<?php

class Update extends Conn {

    /** @var PDO */
    private $connection;

    /** @var PDOStatement */
    private $update;
    //atributos da classe
    private $table;
    private $binds;
    private $data;
    private $where;
    private $result;

    public function Updater($table, array $dados, $where, $bind) {
        $this->table = (string) $table;
        $this->data = $dados;
        $this->where = (string) $where;
        parse_str($bind, $this->binds);

        $this->Execute();
    }

    public function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->update->rowCount();
    }

    /**
     * PRIVATE METHODS - Métodos privados para uso interno da classe
     * 
     */
    private function getCon() {
        $this->connection = parent::getConnection();
        $this->update = $this->connection->prepare($this->update);
    }

    private function setParameters() {
        foreach ($this->data as $index => $value):
            $peaces[] = $index . ' = :' . $index;
        endforeach;
        $peaces = implode(',', $peaces);
        $this->update = "update {$this->table} set {$peaces} {$this->where}";
    }

    private function Execute() {
        $this->setParameters();
        $this->getCon();
        try {
            $this->update->execute(array_merge($this->data, $this->binds));
            $this->result = true;
        } catch (PDOException $ex) {
            $this->result = false;
            $erro = 'Algum erro...' . $ex->getMessage();
        }
    }

}
