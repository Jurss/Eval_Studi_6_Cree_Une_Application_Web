<?php

class SafeHouse
{
    private string $id;
    private string $code;
    private string $address;
    private string $country;
    private string $type;

    public function insertDataSafeHouse(){
        try{
            $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
            $statement = $pdo->prepare('INSERT INTO safe_house VALUES (UUID(), :codeHouse, :addressHouse, :countryHouse, :typeHouse)');
            $statement->bindParam(':codeHouse', $this->code, PDO::PARAM_STR);
            $statement->bindParam(':addressHouse', $this->address, PDO::PARAM_STR);
            $statement->bindParam(':countryHouse', $this->country, PDO::PARAM_STR);
            $statement->bindParam(':typeHouse', $this->type, PDO::PARAM_STR);
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
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}