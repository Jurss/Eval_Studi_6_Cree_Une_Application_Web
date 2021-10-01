<?php

class Agent
{
    private string $id;
    private string $firstName;
    private string $lastName;
    private $birthDate;
    private int $identificationCode;
    private string $nationality;
    private int $idSpeciality;

    public function insertDataAgent(){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement = $pdo->prepare('INSERT INTO agent(id, firstName, lastName, birth_date, identification_code, nationality, id_speciality) VALUES(UUID(), :firstName, :lastName, :birth_date, :identification_code, :nationality, :id_speciality)');
            $statement->bindParam(':firstName', $this->firstName, PDO::PARAM_STR);
            $statement->bindParam(':lastName', $this->lastName, PDO::PARAM_STR);
            $statement->bindParam(':birth_date', $this->birthDate, PDO::PARAM_STR);
            $statement->bindParam(':identification_code', $this->identificationCode, PDO::PARAM_INT);
            $statement->bindParam(':nationality', $this->nationality, PDO::PARAM_STR);
            $statement->bindParam(':id_speciality', $this->idSpeciality, PDO::PARAM_INT);
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
     * @return int
     */
    public function getIdentificationCode(): int
    {
        return $this->identificationCode;
    }

    /**
     * @param int $identificationCode
     */
    public function setIdentificationCode(int $identificationCode): void
    {
        $this->identificationCode = $identificationCode;
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

    /**
     * @return int
     */
    public function getIdSpeciality(): int
    {
        return $this->idSpeciality;
    }

    /**
     * @param int $idSpeciality
     */
    public function setIdSpeciality(int $idSpeciality): void
    {
        $this->idSpeciality = $idSpeciality;
    }
}