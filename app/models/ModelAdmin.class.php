<?php

class ModelAdmin extends Conn {

    private $data;
    private $result;
    private $rowcount;

    public function BackupDatabase($database) {

        $connection = parent::getConnection();

        // try{
        //     $backup = $connection->prepare('mysqldump -u root -p 123456 '. $database .' > ' . HOME . 'archives/backup.sql');
        //     $backup->execute();
        //     return true;
        // }catch(Exception $e){
        //     return false;
        //     $this->result = $e;
        // }
        return system('mysqldump -u root -p 123456 '. $database .' > ' . HOME . 'archives/backup.sql');
    }

    public function getResult() {
        return $this->result;
    }

    public function getRowCount() {
        return $this->rowcount;
    }

    ######################################
    ######## PRIVATE METHODS #############
    ######################################


}
