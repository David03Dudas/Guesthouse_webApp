<?php

    include './db_connection.php';

    if(isset($_POST['nume_client'])){
        $nume_client = $_POST['nume_client'];
        $nr_camera = $_POST['nr_camera'];
        $nr_zile = $_POST['nr_zile'];
        $nr_pers = $_POST['nr_pers'];
        $comentariu = $_POST['comentariu'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
    }
    else {
        header('Location: ../index.php');
        exit;
    }

    $vDay = intval($day);
    $vMonth = intval($month);
    $vYear = intval($year);
    
    try {
        $dbh = db_connect_PDO();

        for($i = 0; $i < $nr_zile; $i++) {
            $stmt = $dbh->prepare("SELECT room FROM rezervations WHERE day = :d AND month = :m AND year = :y");
            $stmt->execute([":d" => $vDay, ":m" => $vMonth, ":y" => $vYear]);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['room'] == $nr_camera) {
                    header('Location: ../index.php?error=indisponible_room&room='.$nr_camera.'&day='.$vDay.'&month='.$vMonth.'&year='.$vYear);
                    exit();
                }
            }

            $vDay = $vDay+1;
            if($vDay > cal_days_in_month(CAL_GREGORIAN, 8, 2009)){
                $vMonth++;
                $vDay = 1;
            }
            if($vMonth > 12) {
                $vMonth = 1;
                $vYear++;
            }
        }
    }
    catch(PDOException $e) {
        $dbh = null;
        print "Error!:".$e->getMessage()."<br/>";
        die();
    }

    $vDay = intval($day);
    $vMonth = intval($month);
    $vYear = intval($year);
    
    for($i = 0; $i < $nr_zile; $i++){

        $stmt = $dbh->prepare("INSERT INTO rezervations (room, client_name, nr_pers, day, month, year, comment) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$nr_camera, $nume_client, $nr_pers, $day, $month, $year, $comentariu]);

        $day = $day+1;
        if($day > cal_days_in_month(CAL_GREGORIAN, 8, 2009)){
            $month++;
            $day = 1;
        }
        if($month > 12) {
            $month = 1;
            $year++;
        }
    }

    $dbh = null;

    header('Location: ../index.php?day='.$vDay.'&month='.$vMonth.'&year='.$vYear);
    exit;
?>