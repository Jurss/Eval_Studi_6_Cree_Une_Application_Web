<?php

class AssignContactToMission
{
    private int $id;
    private string $isMission;
    private string $idContact;

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