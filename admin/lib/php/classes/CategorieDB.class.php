<?php

class CategorieDB extends Categorie {

    private $_db;
    private $_typeArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getCategorie() {
        try {
            $query = "SELECT * FROM categorie ORDER BY nom_cat";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_typeArray[] = new Categorie($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        
        return $_typeArray;
    }

}
