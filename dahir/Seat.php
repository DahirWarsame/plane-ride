<?php

class Seat
{

    private string $seatRow;
    private string $seatNumber;
    private string $seatClass;
    private bool $windowSeat;

    private bool $taken;

    public function __construct(string $seatRow, string $seatNumber, string $seatClass, bool $windowSeat)
    {
        $this->seatRow = $seatRow;
        $this->seatNumber = $seatNumber;
        $this->seatClass = $seatClass;
        $this->windowSeat = $windowSeat;
        $this->taken = false;
    }


    /**
     * Get the value of taken
     */
    public function isAssigned(): bool
    {
        return $this->taken;
    }

    /**
     * Get the value of taken
     */
    public function assignSeat()
    {
        $this->taken = true;
    }


    /**
     * Get the value of windowSeat
     */
    public function isWindowSeat(): bool
    {
        return $this->windowSeat;
    }

    /**
     * Set the value of windowSeat
     *
     */
    public function setWindowSeat($windowSeat)
    {
        $this->windowSeat = $windowSeat;
    }

    /**
     * Get the value of seatNumber
     */
    public function getSeatNumber(): string
    {
        return $this->seatNumber;
    }

    /**
     * Set the value of seatNumber
     *
     */
    public function setSeatNumber($seatNumber)
    {
        $this->seatNumber = $seatNumber;
    }

    /**
     * Get the value of seatClass
     */
    public function getSeatClass()
    {
        return $this->seatClass;
    }

    /**
     * Set the value of seatClass
     *
     */
    public function setSeatClass($seatClass)
    {
        $this->seatClass = $seatClass;
    }

    /**
     * Get the value of seatRow
     */
    public function getSeatRow()
    {
        return $this->seatRow;
    }
}
