<?php

class getSpecialityRequired
{
    public function getSpecialityRequired($id){
        $idInt = intval($id);
        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare('SELECT name FROM speciality WHERE id = :id');
        $statement->bindParam(':id', $idInt, PDO::PARAM_INT);
        if($statement->execute()){
            return $statement->fetchAll();
        }
    }
}