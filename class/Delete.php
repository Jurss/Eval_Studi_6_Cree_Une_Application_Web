<?php

class Delete
{
    public function delete($id, $table){
        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare("DELETE FROM ".$table." WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_STR);

        if($statement->execute() !== false){
            return true;
        }else {
            return false ;
        }
    }
}