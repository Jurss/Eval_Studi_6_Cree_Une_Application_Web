<?php

class Update
{
    public function update($table, $id, $colName,$colValue){
        echo $id;
        echo $table;
        echo $colName;
        echo $colValue;

        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare("UPDATE ".$table." SET ".$colName." = :colValue WHERE id = :id");
        $statement->bindParam(':colValue', $colValue, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);

        if($statement->execute() !== false){
            return true;
        }else {
            return false ;
        }
    }
}