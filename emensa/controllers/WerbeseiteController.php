<?php


class WerbeseiteController
{
public function index(RequestData $rd){
    return view('werbeseite.layout', ['title' => 'Werbeseite']);
}
}

?>