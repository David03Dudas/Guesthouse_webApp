<?php
    function db_connect()
        {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "guesthouse_rezervations";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
        
        return $conn;
        }

    function db_connect_PDO() {
        $dbh = new PDO('mysql:host=localhost;dbname=guesthouse_rezervations', "root", "");
        return $dbh;
    }
?>