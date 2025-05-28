<?php

/**
 * Class Plane
 *
 * Class to manage the seating arrangement on a plane.
 */

class Plane
{
    /**
     * Constants to define the maximum rows on the plane.
     */

    const MAX_ROWS = 38;
    /**
     * Constants to define the unlucky rows on the plane.
     */

    const UNLUCKY_ROWS = [5, 6,  9, 13, 16, 17, 18, 19, 33];

    /**
     * Constants to define the letters for first class seats.
     */

    const LETTERS_FIRST_CLASS = ['A', 'B', 'E', 'F'];
    /**
     * Constants to define the number of seats per row in first class.
     */

    const SEATS_PER_ROW_FIRST_CLASS = 4;

    /**
     * Constants to define the letters for economy class seats.
     */

    const LETTERS_ECONOMY = ['A', 'B', 'C', 'D', 'E', 'F'];
    /**
     * Constants to define the number of seats per row in economy class.
     */

    const SEATS_PER_ROW_ECONOMY = 6;

    /**
     * Property to store the seats information.
     *
     * @var array
     */

    private $seats;

    /**
     * Constructor to initialize the seating arrangement on the plane.
     */

    public function __construct()
    {
        $this->seats = [];
    }
    /**
     * Initializes the `seats` property with Seat objects.
     * 
     * @throws Exception If the `seats` property is not empty.
     */
    public function initSeats(): void
    {
        // If the seats property is not empty, throw an exception
        if (!empty($this->seats)) {
            throw new Exception('Seats have already been initialized!');
        }

        // Loop through all the rows
        for ($i = 1; $i <= self::MAX_ROWS; $i++) {
            // Determine the class of the current row
            $letters = 4 >= $i ? self::LETTERS_FIRST_CLASS : self::LETTERS_ECONOMY;
            $seatsPerRow = 4 >= $i ? self::SEATS_PER_ROW_FIRST_CLASS : self::SEATS_PER_ROW_ECONOMY;
            $class = 4 >= $i ? Tickets737::FIRST_CLASS : Tickets737::ECONOMY_PLUS;
            $class = $i <= 4 ? Tickets737::FIRST_CLASS : ($i <= 20 ? Tickets737::ECONOMY_PLUS : Tickets737::ECONOMY);

            // Skip unlucky rows
            if (in_array($i, self::UNLUCKY_ROWS)) {
                continue;
            }

            // Loop through all the seats in the current row
            for ($j = 0; $j < $seatsPerRow; $j++) {
                // Determine if the current seat is a window seat
                $windowSeat = $letters[$j] == 'A' || $letters[$j] == 'F' ? true :  false;

                // Add a new Seat object to the `seats` property
                $this->seats[] = new Seat($i, $i . $letters[$j], $class, $windowSeat);
            }
        }
    }
    /**
     * Getter method to return the seats information.
     *
     * @return array
     */
    public function getSeats(): array
    {
        return $this->seats;
    }

    /**
     * Function to return the first available seat of given class and window preference.
     *
     * @param bool $windowSeat Whether the seat should be a window seat.
     * @param string $seatClass The class for which the seat is required.
     *
     * @return Seat|null
     */
    public function getAvailableSeat(bool $windowSeat, string $seatClass)
    {
        foreach ($this->seats as $seat) {
            // check if the seat is available 
            if ($seat->getSeatClass() === $seatClass) {
                if (!$seat->isAssigned()) {
                    if ($windowSeat) {
                        if ($seat->isWindowSeat()) {
                            // return the windowseat
                            return $seat;
                        }
                    } else {
                        // return the seat  
                        return $seat;
                    }
                }
            }
        }
    }

    /**
     * Function to assign seats to the given tickets.
     *
     * @param array $tickets The tickets for which seats are to be assigned.
     *
     * @return array
     */

    public function assignSeats(array $tickets)
    {
        $classes = [
            Tickets737::FIRST_CLASS,
            Tickets737::ECONOMY_PLUS,
            Tickets737::ECONOMY
        ];

        $assignedTickets = [];

        foreach ($classes as $class) {

            $classTickets = array_filter($tickets, function ($ticket) use ($class) {
                return $ticket->getSeating() === $class;
            });

            foreach ($classTickets as $ticket) {
                $seat = $this->getAvailableSeat($ticket->getPrefersWindowSeat(), $class);

                if ($seat) {
                    $ticket->setSeatNumber($seat->getSeatNumber());
                    $seat->assignSeat();
                }
                $assignedTickets[] = $ticket;
            }
        }

        usort($assignedTickets, function ($ticket1, $ticket2) {
            $seatNumber1 = $ticket1->getSeatNumber();
            $seatNumber2 = $ticket2->getSeatNumber();

            $number1 = (int) substr($seatNumber1, 0, strlen($seatNumber1) - 1);
            $letter1 = substr($seatNumber1, -1);

            $number2 = (int) substr($seatNumber2, 0, strlen($seatNumber2) - 1);
            $letter2 = substr($seatNumber2, -1);

            if ($number1 == $number2) {
                return strcmp($letter1, $letter2);
            }

            return $number1 <=> $number2;
        });

        return $assignedTickets;
    }
}
