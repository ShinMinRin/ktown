<?php

class AdminDB extends Admin {

    private $_db;
    private $_admin = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    function isAdmin($login, $password) {
        //$password = md5($password);
        try {
            $query = "select * from users where pseudo = :login and mdp = :password and statut = 1";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':login', $login);
            $resultset->bindValue(':password', $password);
            $resultset->execute();
            $data = $resultset->fetch();
            if (!empty($data)) {
                try {
                    $_admin[] = new Admin($data);
                    if ($_admin[0]->pseudo == "$login" && $_admin[0]->mdp == $password && $_admin[0]->statut == 1) {
                        return $_admin;
                    } else {
                        return null;
                    }
                } catch (PDOException $e) {
                    print $e->getMessage();
                }
            }
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te." . $e->getMessage();
        }
    }
}