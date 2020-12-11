<?php
// Email admin@emensa.example
// Passwort: test..123
// Salt dbwt
$passwort = "test..123";
$salt = "dbwt";
$hash = password_hash($passwort.$salt, PASSWORD_DEFAULT);

if(password_verify($passwort.$salt, $hash)){
    echo 1;
}
else{
    echo 0;
}
?>