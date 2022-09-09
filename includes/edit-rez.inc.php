<?php

    include './db_connection.php';

    if(isset($_POST['name'])) {

        print_r($_POST);
        $dbh = db_connect_PDO();
        $sql = $dbh->prepare('UPDATE rezervations SET client_name=?, nr_pers=?, comment=? WHERE client_name = ? AND comment = ?');
        $sql->execute([$_POST['name'], $_POST['nr_pers'],$_POST['comment'],$_POST['prevName'],$_POST['prevComment']]);

        header('Location: ../index.php');
        exit;
    }