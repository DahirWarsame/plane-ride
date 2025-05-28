<?php

declare(strict_types=1);

class Tickets737
{

    const FIRST_CLASS = 'First class';
    const ECONOMY_PLUS = 'Economy plus';
    const ECONOMY = 'Economy';

    const SEATS_FIRST_CLASS = 16;
    const SEATS_ECONOMY_PLUS = 48;
    const SEATS_ECONOMY = 102;

    /**
     * @return Ticket[]
     */
    public static function generateFakeTickets(): array
    {
        $tickets = self::assignTickets(self::FIRST_CLASS, self::SEATS_FIRST_CLASS);
        $tickets = array_merge($tickets, self::assignTickets(self::ECONOMY_PLUS, self::SEATS_ECONOMY_PLUS));
        $tickets = array_merge($tickets, self::assignTickets(self::ECONOMY, self::SEATS_ECONOMY));
        $tickets = self::randomlyRequestGroupedSeats($tickets);
        $tickets = self::randomlyRequestWindowSeats($tickets);
        return $tickets;
    }

    /**
     * @return Ticket[]
     */
    private static function assignTickets(string $seatClassing, int $maxSeats): array
    {
        $result    = [];
        $seatsSold = rand($maxSeats - 8, $maxSeats);
        for ($i = 0; $i < $seatsSold; $i++) {
            $result[] = new Ticket('***', substr(md5(microtime() . $i), 0, 8), $seatClassing, null);
        }
        return $result;
    }

    /**
     * @param Ticket[] $tickets
     * @return Ticket[]
     */
    private static function randomlyRequestGroupedSeats(array $tickets): array
    {
        $numberOfGroupRequests = rand(18, 64);
        for ($i = 0; $i < $numberOfGroupRequests; $i++) {
            $ticket       = null;
            $otherTicket  = null;
            $randomTicket = null;
            while (!$ticket) {
                $randomTicket = $tickets[rand(0, count($tickets) - 1)];
                if ($randomTicket->hasTravelPartner()) continue;
                $ticket = $randomTicket;
            }
            $randomTicket = null;
            while (!$otherTicket) {
                $randomTicket = $tickets[rand(0, count($tickets) - 1)];
                if ($randomTicket->hasTravelPartner() || $randomTicket->getSeating() !== $ticket->getSeating()) continue;
                $otherTicket = $randomTicket;
            }
            $ticket->setTravelPartner($otherTicket);
        }
        return $tickets;
    }

    /**
     * @param Ticket[] $tickets
     * @return Ticket[]
     */
    private static function randomlyRequestWindowSeats(array $tickets)
    {
        $numberOfRequests = rand(20, 50);
        for ($i = 0; $i < $numberOfRequests; $i++) {
            do {
                $randomTicket = $tickets[rand(0, count($tickets) - 1)];
            } while ($randomTicket->getPrefersWindowSeat());
            $randomTicket->setPrefersWindowSeat(true);
        }
        return $tickets;
    }

}
