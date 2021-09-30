<?php

class GetDetailMission
{
    public function getDetailMission($title){
        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare('SELECT id, title, description, code_name, country, type_assignment, status, id_require_speciality, start_date, end_date FROM mission WHERE title = :title');
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}