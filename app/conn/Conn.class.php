<?php

/**
 * Description of Conn
 *
 * @author gian, Monica, Erica
 */
class Conn {

    private static $host = 'localhost';
    private static $database = 'schoolbus';
    private static $user = 'root';
    private static $pass = '123456';

    /** @var PDO */
    private static $connect = null;

    private static function Connection() {
        if (self::$connect == null):
            try {
                $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$database;
                $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'];
                self::$connect = new PDO($dsn, self::$user, self::$pass, $options);
            } catch (PDOException $ex) {
                die('Erro: ' . $ex->getMessage());
            }
        endif;
        self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$connect;
    }

    public static function getConnection() {
        return self::Connection();
    }

}
