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