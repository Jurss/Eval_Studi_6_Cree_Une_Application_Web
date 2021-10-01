<?php

class ConnexBdd
{
    public function createDatabase(string $sqlDatabase, array $sqlTable){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');

            $statementDatabase = $pdo->prepare($sqlDatabase);
            $statementDatabase->execute();

            foreach ($sqlTable as $sqlIndex){
                $statementTable = $pdo->prepare($sqlIndex);
                $statementTable->execute();
            }
        } catch (PDOException $e){
            echo 'echec de la connexion';
            file_put_contents('../dblogs.txt', $e->getMessage().PHP_EOL, FILE_APPEND);
        }

    }
}