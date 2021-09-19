<?php

class SafeHouse
{
    private string $id;
    private string $code;
    private string $address;
    private string $country;
    private string $type;

    public function insertDataSafeHouse(){
        $pdo = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_fa8e42539ffae79', 'b94cf7196dd4fc', '85ca6d05');
        $statement = $pdo->prepare('INSERT INTO safe_house VALUES (UUID(), :code, :address, :country, :type');
        $statement->bindParam(':code', $this->code, PDO::PARAM_STR);
        $statement->bindParam(':address', $this->address, PDO::PARAM_STR);
        $statement->bindParam(':country', $this->country, PDO::PARAM_STR);
        $statement->bindParam(':type', $this->type, PDO::PARAM_STR);
        if($statement->execute() !== false){
            return true;
        }else {
            return false ;
        };
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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}