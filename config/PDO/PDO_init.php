<?php

require_once(dirname(__FILE__) . '/PDO_consts.php');


class DataBase
{
    public static function dbConnect(): object
    {
        try {
            $pdo = new PDO(DSN, USER, PASSWORD, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ));
        } catch (PDOException $e) {
            $error = 'Erreur :' . $e->getMessage();
        }
        return $pdo;
    }
}
