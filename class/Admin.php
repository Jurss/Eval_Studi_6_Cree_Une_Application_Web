<?php

class Admin
{
    private string $id;
    private string $firstName;
    private string $lastName;
    private  string $mail;
    private string $password;
    private $creationDate;

    public function insertDataAdmin(){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement = $pdo->prepare('INSERT INTO admin(id, firstName, lastName, mail, password, creation_date) VALUES (UUID(), :firstName, :lastName, :mail, :password, :creation_date)');
            $statement->bindParam(':firstName', $this->firstName, PDO::PARAM_STR);
            $statement->bindParam(':lastName', $this->lastName, PDO::PARAM_STR);
            $statement->bindParam(':mail', $this->mail, PDO::PARAM_STR);
            $statement->bindValue(':password', password_hash($this->password, PASSWORD_BCRYPT), PDO::PARAM_STR);
            $statement->bindValue(':creation_date', date('Y-m-d'), PDO::PARAM_STR);
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
    public function UpdateData(array $req){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement = $pdo->prepare('UPDATE admin SET :colName = :colValue WHERE id = :requestValue');
            $statement->bindParam(':colName', $req['colName'], PDO::PARAM_STR);
            $statement->bindParam(':colValue', $req['colValue'], PDO::PARAM_STR);
            $statement->bindParam(':requestValue', $req['requestValue'], PDO::PARAM_STR);

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
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}