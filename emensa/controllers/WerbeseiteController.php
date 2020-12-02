<?php


class WerbeseiteController
{
public function index(RequestData $rd){
    return view('werbeseite.layout', ['title' => 'Werbeseite']);
}

public function redirect(RequestData $rd){
    return view('werbeseite.wunschgericht', ['title' => "Wunschgericht"]);
}

}

?>