<?php

class Vue_produitsDB {

    private $_db;

    function __construct($_db) {
        $this->_db = $_db;
    }

    //liste des produits correspondant au choix de la catégorie dans la liste déroulante
    function getVue_produitsCat($id) {
        try {
            $query = "SELECT * FROM vue_produits WHERE id_cat=:id";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id);
            $resultset->execute();
            $data = $resultset->fetchAll();
            //var_dump($data);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = $data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

    function getVue_produits() {
        try {
            $query = "SELECT * FROM vue_produits";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();
            //var_dump($data);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = $data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

    function getVue_produitsByCat($id) {
        try {
            $query = "SELECT * FROM vue_produits WHERE id_cat=:id_cat";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_cat', $id);
            $resultset->execute();
            $data = $resultset->fetchAll();
            //var_dump($data);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = $data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        return $_infoArray;
    }

}
