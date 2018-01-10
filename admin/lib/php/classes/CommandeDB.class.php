<?php

class CommandeDB extends Commande {

    private $_db;
    private $_CommandeArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getVueCommande() {
        try {
            $query = "SELECT * FROM vue_commande";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_CommandeArray[] = new Commande($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }


        return $_CommandeArray;
    }
    
    
    
    public function addCommande($c,$t){
        $query = "INSERT INTO commande (date_cde, client, total_cde)"
                ."VALUES (CURRENT_DATE(),:c,:t)";
        
        try{
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':c', $c, PDO::PARAM_INT);
            $resultset->bindValue(':t', (string)$t, PDO::PARAM_STR);
            $resultset->execute();
            
        } catch (PDOException $ex) {
            print "<br/>Echec de l'insertion commande<br/>";
            print $ex->getMessage();
        }
    }
    
    public function getLastCommande(){
        try{
            $query = "SELECT id_cde FROM commande WHERE id_cde=LAST_INSERT_ID()";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetch();
            
            
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        
        return $data;
    }
    
    
    public function addDetailCde($id, array $data, $n){
          $query = "INSERT INTO detailcde (id_cde, id_prod, quantite)"
                ."VALUES (:c, :p, :q)";
        
        try{
            for($i = 0 ; $i < $n ; $i++){
                $resultset = $this->_db->prepare($query);
                $resultset->bindValue(':c', $id, PDO::PARAM_INT);
                $resultset->bindValue(':p', $data['id_prod'][$i], PDO::PARAM_INT);
                $resultset->bindValue(':q', $data['quantite'][$i], PDO::PARAM_INT);
                $resultset->execute();
            }
            
            
        } catch (PDOException $ex) {
            print "<br/>Echec de l'insertion detail<br/>";
            print $ex->getMessage();
        }
        
    }

}
