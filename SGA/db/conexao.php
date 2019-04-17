<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 09/01/2018
 * Time: 16:24
 */

//ini_set('display_errors', 0);

require_once "configDB.php";

class Conexao
{

    private static $pdo;

    private function __construct() {
        self::getInstance();
    }

    public static function getInstance() {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(DRIVER.":host=" . HOSTNAME . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USER, PASS);
            } catch (PDOException $e) {
                print "Erro: " . $e->getMessage();
            }
        }
        return self::$pdo;
    }

}


/*try {
    $pdo = new PDO('mysql:host=localhost;dbname=sga', 'root', 'root');
    $pdo->exec("set names utf8");
} catch ( PDOException $e ) {
    echo 'Erro ao conectar com o Banco: ' . $e->getMessage();
    exit(1);
}*/