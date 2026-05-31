<?php

    $database= new mysqli("localhost","root","","doctorappoint");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>