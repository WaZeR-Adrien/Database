<?php
/**
 * Created by IntelliJ IDEA.
 * User: Adrien
 * Date: 24/04/2017
 * Time: 19:04
 */
include_once 'config.php';

class Database
{
    private static $_pdo;

    private function __construct() {}

    private static function getConnexion(){
        try
        {
            $pdo = new PDO('mysql:dbname='.DB.';host='.HOST, USER, PW);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        self::$_pdo = $pdo;

        self::$_pdo->exec('SET NAMES \'utf8\'');
        self::$_pdo->query('SET NAMES \'utf8\'');

        return self::$_pdo;
    }

    public static function query($statement, $class){
        if (is_null(self::$_pdo)) self::getConnexion();

        $q = self::$_pdo->query($statement);
        $res = $q->fetchAll(PDO::FETCH_CLASS, $class);

        return $res;
    }

    public static function exec($statement){
        if (is_null(self::$_pdo)) self::getConnexion();

        return self::$_pdo->exec($statement);
    }

    public static function insert($table,$field,$value){
        if (is_null(self::$_pdo)) self::getConnexion();

        $q = self::$_pdo->exec(
            'INSERT INTO '. $table .'
             ('. $field .')
             VALUES ('. $value .')'
        );

        return $q;
    }

    public static function update($table,$field,$value,$byField,$key){
        if (is_null(self::$_pdo)) self::getConnexion();

        $f = explode(",",$field);
        $v = explode(",",$value);

        $set = '';
        for ($i = 0;$i < count($f);$i++){
            $set .= $f[$i] .' = '. $v[$i] .', ';
            if ($i == (count($f) -1)) $set = substr($set, 0, strlen($set) - 2);
        }

        $q = self::$_pdo->exec(
            'UPDATE '. $table .' 
            SET '. $set .' 
            WHERE '. $byField .' = '.$key
        );

        return $q;
    }

    public static function delete($table,$byField,$key){
        if (is_null(self::$_pdo)) self::getConnexion();

        $q = self::$_pdo->exec(
            'DELETE FROM '. $table .' 
            WHERE '. $byField .' = '. $key
        );

        return $q;
    }
}