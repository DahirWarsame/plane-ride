<?php
class Passenger
{
    private $fullName;
    private $passportNumber;

    public function __construct(
        string $fullName,
        string $passportNumber
    ) {
        $this->fullName = $fullName;
        $this->passportNumber = $passportNumber;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getPassportNumber(): string
    {
        return $this->passportNumber;
    }
}
