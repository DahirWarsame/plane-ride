<?php

declare(strict_types=1);

class Ticket
{
    private string $fullName;
    private string $passportNumber;
    private string $seating;
    private ?Ticket $travelsWith;
    private string $seatNumber = '';
    private Passenger $passenger;

    private bool $prefersWindowSeat = false;

    public function __construct(string $seating, ?Ticket $travelsWith, Passenger $passenger)
    {
        $this->fullName = $passenger->getFullName();
        $this->passportNumber = $passenger->getPassportNumber();
        $this->seating = $seating;
        $this->travelsWith = $travelsWith;
        $this->passenger = $passenger;
    }

    public function getSeatNumber(): string
    {
        return $this->seatNumber;
    }

    public function setSeatNumber(string $seatNumber): void
    {
        $this->seatNumber = $seatNumber;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getPassportNumber(): string
    {
        return $this->passportNumber;
    }

    public function getSeating(): string
    {
        return $this->seating;
    }

    public function getTravelsWith(): Ticket
    {
        return $this->travelsWith;
    }

    public function hasTravelPartner(): bool
    {
        return $this->travelsWith !== null;
    }

    public function setTravelPartner(Ticket $otherTicket): void
    {
        $this->travelsWith = $otherTicket;
    }

    public function getPrefersWindowSeat(): bool
    {
        return $this->prefersWindowSeat;
    }

    public function setPrefersWindowSeat(bool $true): void
    {
        $this->prefersWindowSeat = true;
    }
}
