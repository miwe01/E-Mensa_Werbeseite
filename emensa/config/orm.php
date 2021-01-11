<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "localhost",
    "database" => "emensawerbeweite",
    "username" => "root",
    "password" => "test..123"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();