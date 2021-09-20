<?php

class AssignContactToMission
{
    private int $id;
    private string $isMission;
    private string $idContact;

    public function insertDataAssignContact(){
        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare('INSERT INTO assign_contact_to_mission(id_mission, id_contact) VALUES (:id_mission, :id_contact)');
        $statement->bindParam(':id_mission', $this->idMission, PDO::PARAM_STR);
        $statement->bindParam(':id_contact', $this->idContact, PDO::PARAM_STR);
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
    public function getIsMission(): string
    {
        return $this->isMission;
    }

    /**
     * @param string $isMission
     */
    public function setIsMission(string $isMission): void
    {
        $this->isMission = $isMission;
    }

    /**
     * @return string
     */
    public function getIdConatct(): string
    {
        return $this->idContact;
    }

    /**
     * @param string $idAgent
     */
    public function setIdContact(string $idContact): void
    {
        $this->idContact = $idContact;
    }
}