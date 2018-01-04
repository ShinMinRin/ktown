<?php

class ClientDB extends Client {
    private $_db;
    private $_clientArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getClient() {
        try {
            $query = "SELECT * FROM client";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();

            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_clientArray[] = new Client($data);
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        
        
        return $_clientArray;
    }
    
    public function addClient(array $data, $user){
        $query = "INSERT INTO client (Nom,Prenom,Naiss,Rue,NumRue,CP,Ville,Pays,Tel,id_user) "
                ."VALUES (:n,:p,:naiss,:rue,:num,:cp,:v,:pays,:t,:user)";
        
        
        try{
            
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':n', $data['nom'], PDO::PARAM_STR);
            $resultset->bindValue(':p', $data['prenom'], PDO::PARAM_STR);
            $resultset->bindValue(':naiss', $data['naiss'], PDO::PARAM_STR);
            $resultset->bindValue(':rue', $data['rue'], PDO::PARAM_STR);
            $resultset->bindValue(':num', $data['num'], PDO::PARAM_INT);
            $resultset->bindValue(':cp', $data['cp'], PDO::PARAM_INT);
            $resultset->bindValue(':v', $data['ville'], PDO::PARAM_STR);
            $resultset->bindValue(':pays', $data['pays'], PDO::PARAM_STR);
            $resultset->bindValue(':t', $data['tel'], PDO::PARAM_STR);
            $resultset->bindValue(':user', $user, PDO::PARAM_INT);
            $resultset->execute();
            
        } catch (PDOException $ex) {
            print "<br/>Echec de l'insertion<br/>";
            print $ex->getMessage();
        }
        
    }
}
