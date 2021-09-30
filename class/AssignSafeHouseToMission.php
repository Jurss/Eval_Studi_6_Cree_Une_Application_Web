<?php

class AssignSafeHouseToMission
{
    private int $id;
    private string $idMission;
    private string $idSafeHouse;

    public function insertDataAssignSafeHouse(){
        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare('INSERT INTO assign_safe_house_to_mission(id_mission, id_safe_house) VALUES (:id_mission, :id_safe_house)');
        $statement->bindParam(':id_mission', $this->idMission, PDO::PARAM_STR);
        $statement->bindParam(':id_safe_house', $this->idSafeHouse, PDO::PARAM_STR);
        if($statement->execute() !== false){
            return true;
        }else {
            return false ;
        };
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdMission(): string
    {
        return $this->idMission;
    }

    /**
     * @param string $idMission
     */
    public function setIdMission(string $idMission): void
    {
        $this->idMission = $idMission;
    }

    /**
     * @return string
     */
    public function getIdSafeHouse(): string
    {
        return $this->idSafeHouse;
    }

    /**
     * @param string $idSafeHouse
     */
    public function setIdSafeHouse(string $idSafeHouse): void
    {
        $this->idSafeHouse = $idSafeHouse;
    }
}