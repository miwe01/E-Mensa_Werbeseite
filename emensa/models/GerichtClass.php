<?php


class GerichtClass extends \Illuminate\Database\Eloquent\Model {
    protected $primaryKey = 'id';
    protected $table = 'gericht';
    protected $attributes = [
        'name',
        'beschreibung',
        'erfasst_am',
        'vegetarisch',
        'vegan',
        'preis_intern',
        'preis_extern',
        'bildname'
    ];

    function getPreis_internAttribute($value) {
        number_format($value,2);
    }
    function getPreis_externAttribute($value) {
        number_format($value,2);
    }

    function setVegetarischAttribute($value) {
        $value = str_replace(' ', '', $value);
        $value = strtolower($value);
        if ($value == 'true' || $value == 'yes' || $value == '1') {
            $result = '1';
        } else if ($value == 'false' || $value == 'no'|| $value == '0') {
            $result = '0';
        }
        $this->attributes['vegetarisch'] = $result;
    }

    function setVeganAttribute($value) {
        $value = str_replace(' ', '', $value);
        $value = strtolower($value);
        if ($value == 'true' || $value == 'yes' || $value == '1') {
            $result = '1';
        } else if ($value == 'false' || $value == 'no'|| $value == '0') {
            $result = '0';
        }
        $this->attributes['vegan'] = $result;
    }
}