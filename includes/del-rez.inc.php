<?php

    include './db_connection.php';
    if(isset($_POST['submit'])){
    try {
        $dbh = db_connect_PDO();
        foreach ($_POST as &$id)
        {
            $stmt = $dbh->prepare('DELETE FROM rezervations WHERE id = :id');
            $stmt->execute(["id"=>$id]);
            
        }
    }
    catch(PDOException $e) {
        $dbh = null;
        print "Error!:".$e->getMessage()."<br/>";
        die();
    }
    }

    header('Location: ../index.php?day='.$_GET['day'].'&month='.$_GET['month'].'&year='.$_GET['year']);
    exit;