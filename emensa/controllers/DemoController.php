<?php
require_once('../models/gericht.php');
require_once('../models/kategorie.php');

class DemoController
{
    public function dbconnect() {
        $data = db_gericht_select_all();
        // Frage Daten aus kategorie ab:
        // $data = db_kategorie_select_all();
        return view('demo.dbdata', ['data' => $data]);
    }

    public function demo(RequestData $rd) {
        $vars = [
            'bgcolor' => $rd->query['bgcolor'] ?? 'ffffff',
            'name' => $rd->query['name'] ?? 'Dich',
            'rd' => $rd
        ];
        return view('demo.demo', $vars);
    }
}