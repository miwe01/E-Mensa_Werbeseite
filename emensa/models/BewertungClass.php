<?php


class BewertungClass extends \Illuminate\Database\Eloquent\Model {
    protected $primaryKey = 'id';
    protected $table = 'benutzer_bewertet_gericht';
    protected $attributes = [
        'IDBenutzer',
        'IDGericht',
        'Sternbewertung',
        'Bemerkung',
        'Bewertungszeitpunkt',
        'Hervorgehoben'
    ];
}