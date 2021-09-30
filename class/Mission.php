<?php

class Mission
{
    private string $id;
    private string $title;
    private string $description;
    private string $codeName;
    private string $country;
    private string $typeAssignment;
    private string $status;
    private $dateStart;
    private $dateEnd;
    private int $idRequireSpeciality;

    public function insertDataMission(){
        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare('INSERT INTO mission VALUES (UUID(), :title, :description, :code_name, :country, :type_assignment, :status, :id_require_speciality, :start_date, :end_date)');
        $statement->bindParam(':title', $this->title, PDO::PARAM_STR);
        $statement->bindParam(':description', $this->description, PDO::PARAM_STR);
        $statement->bindParam(':code_name', $this->codeName, PDO::PARAM_STR);
        $statement->bindParam(':country', $this->country, PDO::PARAM_STR);
        $statement->bindParam(':type_assignment', $this->typeAssignment, PDO::PARAM_STR);
        $statement->bindParam(':status', $this->status, PDO::PARAM_STR);
        $statement->bindParam(':id_require_speciality', $this->idRequireSpeciality, PDO::PARAM_INT);
        $statement->bindParam(':start_date', $this->dateStart,PDO::PARAM_STR);
        $statement->bindParam(':end_date', $this->dateEnd, PDO::PARAM_STR);
        if($statement->execute() !== false){
            return true;
        }else {
            return false ;
        };
    }

    public function getUuid($title){
        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare('SELECT id FROM mission WHERE title = :title');
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        if($statement->execute() !== false){
            return $statement->fetch();
        }else{
            return  false;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getTypeAssignment(): string
    {
        return $this->typeAssignment;
    }

    /**
     * @param string $typeAssignment
     */
    public function setTypeAssignment(string $typeAssignment): void
    {
        $this->typeAssignment = $typeAssignment;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getIdRequireSpeciality(): int
    {
        return $this->idRequireSpeciality;
    }

    /**
     * @param int $idRequireSpeciality
     */
    public function setIdRequireSpeciality(int $idRequireSpeciality): void
    {
        $this->idRequireSpeciality = $idRequireSpeciality;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param mixed $dateStart
     */
    public function setDateStart($dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }
}