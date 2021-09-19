<?php

class AssignTargetToMission
{
    private int $id;
    private string $isMission;
    private string $idTarget;

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
    public function getIdTarget(): string
    {
        return $this->idTarget;
    }

    /**
     * @param string $idTarget
     */
    public function setIdTarget(string $idTarget): void
    {
        $this->idTarget = $idTarget;
    }
}