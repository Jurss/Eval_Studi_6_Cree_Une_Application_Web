<?php

class Target
{
    private string $id;
    private string $firstName;
    private string $lastName;
    private $birthDate;
    private string $codeName;
    private string $nationality;

    public function update($table, $id, $colName,$colValue){

        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare("UPDATE Target SET lastName = :colValue WHERE id = :id");
        $statement->bindParam(':colName', $colName, PDO::PARAM_STR);
        $statement->bindParam(':colValue', $colValue, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);

        if($statement->execute() !== false){
            return true;
        }else {
            return false ;
        }
    }

    public function insertDataTarget(){
        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare('INSERT INTO target VALUES (UUID(), :firstName, :lastName, :birth_date, :code_name, :nationality)');
        $statement->bindParam(':firstName', $this->firstName, PDO::PARAM_STR);
        $statement->bindParam(':lastName', $this->lastName, PDO::PARAM_STR);
        $statement->bindParam(':birth_date', $this->birthDate, PDO::PARAM_STR);
        $statement->bindParam(':code_name',$this->codeName, PDO::PARAM_STR);
        $statement->bindParam(':nationality', $this->nationality, PDO::PARAM_STR);
        if($statement->execute() !== false){
            return true;
        }else {
            return false ;
        }
    }
    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */

    public function setBirthDate($birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @param string $codeName
     */
    public function setCodeName(string $codeName): void
    {
        $this->codeName = $codeName;
    }

    /**
     * @param string $nationality
     */
    public function setNationality(string $nationality): void
    {
        $this->nationality = $nationality;
    }
}