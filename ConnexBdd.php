<?php

class ConnexBdd
{
    private string $host = 'eu-cdbr-west-01.cleardb.com';
    private string $username = 'b94cf7196dd4fc';
    private string $pass = '85ca6d05';
    private string $dbName = 'heroku_fa8e42539ffae79';
    private $pdo;

    public function __construct(){
        try{
            $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->username, $this->pass);
        }catch (PDOException $e){
            file_put_contents('dbLogs.txt', $e->getMessage(), FILE_APPEND);
        }
    }
    public function createDatabase(string $sqlDatabase, array $sqlTable){
        $statementDatabase = $this->pdo->prepare($sqlDatabase);
        $statementDatabase->execute();

        foreach ($sqlTable as $sqlIndex){
            $statementTable = $this->pdo->prepare($sqlIndex);
            $statementTable->execute();
        }
    }
}