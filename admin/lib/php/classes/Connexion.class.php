<?php

class Connexion {

    private static $_instance = null;

    public static function getInstance($dsn, $user, $pass) {

        if (!self::$_instance) {
            try {
                self::$_instance = new PDO($dsn, $user, $pass);
                self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //print "Connexion OK";
            } catch (PDOException $e) {
                print "Echec de connexion " . $e->getMessage();
            }
        }
        return self::$_instance;
    }

}
