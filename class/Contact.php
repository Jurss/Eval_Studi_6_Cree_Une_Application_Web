<?php

class Contact
{
    private string $id;
    private string $firstName;
    private string $lastName;
    private $birthDate;
    private string $codeName;
    private string $nationality;

    public function insertDataContact(){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement = $pdo->prepare('INSERT INTO contact VALUES (UUID(), :firstName, :lastName, :birth_date, :code_name, :nationality)');
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
        } catch (PDOException $e){
            echo 'echec de la connexion';
            file_put_contents('../dblogs.txt', $e->getMessage().PHP_EOL, FILE_APPEND);
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
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
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getCodeName(): string
    {
        return $this->codeName;
    }

    /**
     * @param string $codeName
     */
    public function setCodeName(string $codeName): void
    {
        $this->codeName = $codeName;
    }

    /**
     * @return string
     */
    public function getNationality(): string
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     */
    public function setNationality(string $nationality): void
    {
        $this->nationality = $nationality;
    }
}