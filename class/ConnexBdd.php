<?php

class ConnexBdd
{
    public function createDatabase(string $sqlDatabase, array $sqlTable){
        $statementDatabase = $this->pdo->prepare($sqlDatabase);
        $statementDatabase->execute();

        foreach ($sqlTable as $sqlIndex){
            $statementTable = $this->pdo->prepare($sqlIndex);
            $statementTable->execute();
        }
    }
}