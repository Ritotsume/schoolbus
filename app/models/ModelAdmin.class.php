<?php
session_start();

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

    public function Login($user, $pass)
    {
        $pass = md5($pass);
        $read = new Read;
        $read->Reader('tb_users', 'where user_login = :user and user_pass = :pass', "user={$user}&pass={$pass}");

        if($read->getResult())
        {
            $data = $read->getResult();
            $_SESSION['schoolbus_login'] = array(
                'username' => $data[0]['user_login'],
                'user_url' => $data[0]['user_url'],
                'user_nome' => $data[0]['user_nome'],
                'nivel' => $data[0]['user_nivel']
            );
            return true;
        }else{
            if(isset($_SESSION['schoolbus_login']))
            {
                unset($_SESSION['schoolbus_login']);
            }
            return false;
        }
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
