<?php
require_once('../models/kategorie.php');
require_once('../models/gericht.php');

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {
        // ...
        return view('examples.m4_6a_queryparameter',
            ['rd' => $rd, 'name' => "name"]);
    }

    public function m4_6b_kategorie(RequestData $rd){
        $kategorien = db_kategorie_select_all();
        return view('examples.m4_6b_kategorie', ['kategorien' => $kategorien]);
    }

    public function m4_6c_gerichte(RequestData $rd){
        $gerichte = db_gericht_select_all();
        return view('examples.m4_6c_gerichte', ['gerichte' => $gerichte]);
    }
    public function m4_6d_layout(RequestData $rd){

        if (isset($_GET["no"]) && $_GET["no"] == 1){
            return view('examples.m4_6d_layout', ['title' => 'Layout1', 'layout' => '1']);
        }
        else if(isset($_GET["no"]) && $_GET["no"] == 2){
            return view('examples.m4_6d_layout', ['title' => 'Layout2', 'layout' => '2']);
        }
        else{
            return view('examples.m4_6d_layout', ['title' => 'Layout1', 'layout' => '1']);
        }
    }
}