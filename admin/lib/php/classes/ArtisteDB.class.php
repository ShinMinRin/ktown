<?php

class ArtisteDB extends Artiste {

    private $_db;
    private $_artisteArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getArtiste() {
        try {
            $query = "SELECT * FROM artiste";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_artisteArray[] = new Produit($data);
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
        }

        return $_artisteArray;
    }
    
    
    public function getArtisteByIdProd($id_prod){
        try {
            $query = "SELECT * FROM artiste WHERE id_artiste in"
                    ."(SELECT id_artiste FROM art_prod WHERE id_prod = :id)";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id_prod, PDO::PARAM_INT);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_artisteArray[] = new Artiste($data);
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
        }

        return $_artisteArray;
    }

}
