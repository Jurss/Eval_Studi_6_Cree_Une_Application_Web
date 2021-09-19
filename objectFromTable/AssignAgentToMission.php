<?php

class AssignAgentToMission
{
    private int $id;
    private string $isMission;
    private string $idAgent;

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