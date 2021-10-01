<?php

class AssignAgentToMission
{
    private int $id;
    private string $idMission;
    private string $idAgent;

    public function insertDataAssignAgent(){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement = $pdo->prepare('INSERT INTO assign_agent_to_mission(id_mission, id_agent) VALUES (:id_mission, :id_agent)');
            $statement->bindParam(':id_mission', $this->idMission, PDO::PARAM_STR);
            $statement->bindParam(':id_agent', $this->idAgent, PDO::PARAM_STR);
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
    public function getIdAgent(): string
    {
        return $this->idAgent;
    }

    /**
     * @param string $idAgent
     */
    public function setIdAgent(string $idAgent): void
    {
        $this->idAgent = $idAgent;
    }
}