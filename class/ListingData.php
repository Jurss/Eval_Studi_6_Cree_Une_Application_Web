<?php

class ListingData
{

    public function getData($class){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement = $pdo->prepare('SELECT * FROM '.$class);
            if($statement->execute()){
                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $rows;
            }
        } catch (PDOException $e){
            echo 'echec de la connexion';
            file_put_contents('../dblogs.txt', $e->getMessage().PHP_EOL, FILE_APPEND);
        }

    }
    public function getSpecificData($class, $specific){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement = $pdo->prepare('SELECT '.$specific.' FROM '.$class);
            if($statement->execute()){
                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $rows;
            }
        } catch (PDOException $e){
            echo 'echec de la connexion';
            file_put_contents('../dblogs.txt', $e->getMessage().PHP_EOL, FILE_APPEND);
        }

    }
    public function getForeignKeyIdSpeciality($value){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement= $pdo->prepare("SELECT id FROM speciality WHERE name = :value");
            $statement->bindParam(':value', $value, PDO::PARAM_STR);
            if($statement->execute()){
                $rows = $statement->fetch();
                return $rows['id'];
            }
        } catch (PDOException $e){
            echo 'echec de la connexion';
            file_put_contents('../dblogs.txt', $e->getMessage().PHP_EOL, FILE_APPEND);
        }

    }
    public function getForeignKeyFullName($table, $firstName, $lastName){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement= $pdo->prepare("SELECT id FROM ".$table." WHERE firstName = :firstName AND lastName = :lastName");
            $statement->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $statement->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            if($statement->execute()){
                $rows = $statement->fetch();
                return $rows;
            }
        } catch (PDOException $e){
            echo 'echec de la connexion';
            file_put_contents('../dblogs.txt', $e->getMessage().PHP_EOL, FILE_APPEND);
        }

    }
    public function getIdSafeHouse($code){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement= $pdo->prepare("SELECT id FROM safe_house WHERE code = :code");
            $statement->bindParam(':code', $code, PDO::PARAM_STR);
            if($statement->execute()){
                $rows = $statement->fetch();
                return $rows;
            }
        } catch (PDOException $e){
            echo 'echec de la connexion';
            file_put_contents('../dblogs.txt', $e->getMessage().PHP_EOL, FILE_APPEND);
        }

    }
    public function getColumns($class){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement = $pdo->prepare('SHOW COLUMNS FROM '.$class);
            if($statement->execute()){
                $col = $statement->fetchAll();
                return $col;
            }
        } catch (PDOException $e){
            echo 'echec de la connexion';
            file_put_contents('../dblogs.txt', $e->getMessage().PHP_EOL, FILE_APPEND);
        }
    }
}