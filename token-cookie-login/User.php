<?php

require_once "DBInit.php";

class User {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, username, first_name, last_name, FROM users");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id,  username, first_name, last_name, FROM users 
            WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function valid_login($username, $password) {
        $dbh = DBInit::getInstance();

        $query = "SELECT COUNT(id) FROM users WHERE username = :username AND pwd = :password";
        $stmt = $dbh->prepare($query);
        
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    
        $stmt->execute();
    
        $count = $stmt->fetchColumn();
    
        return $count > 0;
    }

    public static function valid_username($username){
        $dbh = DBInit::getInstance();

        $query = "SELECT COUNT(id) FROM users WHERE username = :username";
        $stmt = $dbh->prepare($query);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public static function set_access_token($username, $token){
        $dbh = DBInit::getInstance();

        $query = "UPDATE users SET access_token = :token WHERE username = :username;";
        $stmt = $dbh->prepare($query);
        
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    
        $stmt->execute();
    }

    public static function unset_access_token($token){
        $dbh = DBInit::getInstance();
    
        $query = "UPDATE users SET access_token = NULL WHERE access_token = :access_token;";
        $stmt = $dbh->prepare($query);
        
        $stmt->bindParam(':access_token', $token, PDO::PARAM_STR);
    
        $stmt->execute();
    }
    

    public static function valid_token($token){
        $dbh = DBInit::getInstance();
    
        $query = "SELECT COUNT(id) FROM users WHERE access_token = :token";
        $stmt = $dbh->prepare($query);
    
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchColumn() > 0;
    }

    public static function get_username_from_token($token){
        $dbh = DBInit::getInstance();
    
        $query = "SELECT username FROM users WHERE access_token = :token";
        $stmt = $dbh->prepare($query);
    
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['username'];
        } else {
            return null; 
        }
    }

}
