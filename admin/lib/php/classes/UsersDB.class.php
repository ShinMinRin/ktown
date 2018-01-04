<?php


class UsersDB extends Users {
    
    private $_db;
    private $_userArray = array();
    
    public function __construct($cnx){
        $this->_db = $cnx;
    }
    
    public function getUsers(){
        try{
            $query = "SELECT * FROM users";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();
            $resultset->execute();
            
            
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        
        while ($data = $resultset->fetch()){
            try{
                $_userArray[] = new Users($data);
            } catch (PDOException $ex) {
                print $ex->getMessage();
            }
        }
        
        return $_userArray;
    }
    
    
    public function getLastUser(){
        try{
            $query = "SELECT id_user FROM users WHERE id_user=LAST_INSERT_ID()";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $data = $resultset->fetch();
            
            
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        
        return $data;
    }
    
    
    public function addUsers(array $data){
        
        $query = "INSERT INTO users (pseudo,mdp,email)"
                ."VALUES (:pseudo, :mdp, :email)";
        
        try{
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':pseudo', $data['pseudo'], PDO::PARAM_STR);
            $resultset->bindValue(':mdp', $data['mdp'], PDO::PARAM_STR);
            $resultset->bindValue(':email', $data['email'], PDO::PARAM_STR);
            $resultset->execute();
            
        } catch (PDOException $ex) {
            print "<br/>Echec de l'insertion";
            print $ex->getMessage();
        }
        
    }
    
    
    
    
}
