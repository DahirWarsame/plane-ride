# README

De opdracht is als volgt:

Er worden voor elke vlucht van een 737 tickets verkocht.  
Zie de afbeelding voor de stoelindeling van dit type toestel.  
Sommige mensen wiassignTicketsllen graag bij elkaar zitten,  
sommige mensen willen graag aan het raam zitten.  
Je mag Object georiënteerd of procedureel werken.

Opdracht: zorg dat iedereen een stoel (bv "34A") krijgt in zijn eigen klasse.

Bonus opdracht: probeer mensen die dat willen aan het raam te plaatsen.

Extra Bonus opdracht: probeer groepen bij elkaar te houden.

# Mijn oplossing

run het in een terminal met `php -f .\opdracht.php`.
Ik werk zelf met php 7.4 en moest een aantal kleine aanpassingen maken in `Ticket.php`.

namelijke:

```

    public function __construct(string $fullName, string $passportNumber, string $seating, ?Ticket $travelsWith, Passenger $passenger)
    {
        $this->fullName = $fullName;
        $this->passportNumber = $passportNumber;
        $this->seating = $seating;
        $this->travelsWith = $travelsWith;
        $this->passenger = $passenger;
    }

```

Daarnaast heb ik een aantal nieuw classes gemaakt. 

`Plane.php`, `Seat.php`, `Passenger.php`
een beetje overkill maar je kan maar één keer een goeie indruk achterlaten :)

het is allemaal fairly straight forward.
er is 1 vliegtuig met x aantal stoelen. de vliegtuig defineert de stoelen door gebruik te maken van `Seat.php`
Elke ticket is gelinked aan een Passenger en die worden gemaakt in `Ticket737.php` in de `assignTickets` methode.

Hierna verwerkt `assignSeats()` in `Plane.php` de tickets gemaakt in `opdracht.php`:

```
$tickets = $generator->generateFakeTickets();
$tickets = $vliegtuig->assignSeats($tickets);
```
