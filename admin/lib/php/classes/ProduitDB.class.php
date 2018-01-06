<?php

class ProduitDB extends Produit {
    private $_db;
    private $_produitArray = array();
    
    public function __construct($cnx) {
        $this->_db = $cnx;
    }
    
    
    public function getProduit(){
        try{
            $query = "SELECT * FROM produit";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();
            
            $resultset->execute();            
            
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        
        while($data = $resultset->fetch()){
            try{
                $_produitArray[] = new Produit($data);
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
        }
        
        return $_produitArray;
    }
    
    
    public function getProduitById($id){
        try{
            $query = "SELECT * FROM produit WHERE id_prod=:id";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id, PDO::PARAM_INT);
            $resultset->execute();
            $data = $resultset->fetchAll();
            
            $resultset->execute();            
            
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        
        while($data = $resultset->fetch()){
            try{
                $_produitArray[] = new Produit($data);
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
        }
        
        return $_produitArray;
    }
    
    
    
}
