<?php

/**
 * De opdracht is als volgt:
 *
 * Er worden voor elke vlucht van een 737 tickets verkocht.
 * Zie de afbeelding voor de stoelindeling van dit type toestel.
 * Sommige mensen willen graag bij elkaar zitten,
 * sommige mensen willen graag aan het raam zitten.
 * Je mag Object georiënteerd of procedureel werken.
 *
 * Opdracht: zorg dat iedereen een stoel (bv "34A") krijgt in zijn eigen klasse.
 *
 * Bonus opdracht: probeer mensen die dat willen aan het raam te plaatsen.
 *
 * Extra Bonus opdracht: probeer groepen bij elkaar te houden.
 *
 */

require 'Ticket.php';
require 'Tickets737.php';

$generator = new Tickets737();
$tickets = $generator->generateFakeTickets();


// @TODO: Zorg dat elk ticket een stoelnummer krijgt.


// Een overzicht van de verkochte tickets.
printf("seat w passenger  passport  class                travelpartner\n");
foreach ($tickets as $ticket) {
    printf(
        "%s  %s %s   %s       %s       %s \n",
        $ticket->getSeatNumber() ?: '---',
        $ticket->getPrefersWindowSeat() ? '*' : ' ',
        $ticket->getFullName(),
        $ticket->getPassportNumber(),
        str_pad($ticket->getSeating(), 14, ' '),
        $ticket->hasTravelPartner() ? '(travels with: ' . $ticket->getTravelsWith()->getPassportNumber() . ')' : ''
    );
}


