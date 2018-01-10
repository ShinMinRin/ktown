<?php

class ProduitDB extends Produit {

    private $_db;
    private $_produitArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getProduit() {
        try {
            $query = "SELECT * FROM produit";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_produitArray[] = new Produit($data);
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
        }

        return $_produitArray;
    }

    public function getProduitById($id) {
        try {
            $query = "SELECT * FROM produit WHERE id_prod=:id";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id, PDO::PARAM_INT);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_produitArray[] = new Produit($data);
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
        }

        return $_produitArray;
    }

    public function addProduit(array $data, $img) {
        $query = "INSERT INTO produit (nom_prod, descr_prod, prix_unit, cat_prod,image) "
                . "VALUES (:n,:d,:pu,:cat,:img)";


        try {

            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':n', $data['nom_prod'], PDO::PARAM_STR);
            $resultset->bindValue(':d', $data['descr'], PDO::PARAM_STR);
            $resultset->bindValue(':pu', $data['prix_unit'], PDO::PARAM_STR);
            $resultset->bindValue(':cat', $data['categorie'], PDO::PARAM_STR);
            $resultset->bindValue(':img', $img, PDO::PARAM_STR);
            $resultset->execute();
        } catch (PDOException $ex) {
            print "<br/>Echec de l'insertion produit<br/>";
            print $ex->getMessage();
        }
    }

    public function getLastProduit() {
        try {
            $query = "SELECT id_prod FROM produit WHERE id_prod=LAST_INSERT_ID()";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetch();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }

        return $data;
    }

    public function linkProdToArt($p, $a) {
        $query = "INSERT INTO art_prod(id_prod,id_artiste) "
                . "VALUES (:p,:a)";


        try {

            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':p', $p, PDO::PARAM_INT);
            $resultset->bindValue(':a', $a, PDO::PARAM_INT);
            $resultset->execute();
        } catch (PDOException $ex) {
            print "<br/>Echec de l'insertion art_produit<br/>";
            print $ex->getMessage();
        }
    }

}
