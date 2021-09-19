<?php

class AssignSafeHouseToMission
{
    private int $id;
    private string $isMission;
    private string $idSafeHouse;

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