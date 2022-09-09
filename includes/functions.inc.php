<?php

    include 'db_connection.php';

    function get_day_rez($day, $month, $year) {
        
        $dbh = db_connect_PDO();
        #$sql = "SELECT room, client_name, comment FROM rezervations WHERE day='$day' AND month='$month' AND year='$year'";
        $sql = $dbh->prepare("SELECT room, client_name, comment FROM rezervations WHERE day=:day AND month=:month AND year=:year");
        $sql->execute(['month'=>$month, 'year'=>$year, 'day'=>$day]);
        $return_this = [];
        while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            array_push($return_this, $row);
        }

        $dbh = null;

        return $return_this;
    }

    function getRezervations($day, $month, $year) {

        $dbh = db_connect_PDO();
        #$result = mysqli_query($conn, 'SELECT * FROM rezervations');
        #$aux = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $sql = $dbh->prepare("SELECT * FROM rezervations");
        $sql->execute();
        $aux = [];
        while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            array_push($aux, $row);
        }

        $dbh = null;

        $return_this = [];

        for($i = 0; $i < count($aux); $i++){
            if($aux[$i]['year'] > $year){
                array_push($return_this, $aux[$i]);
            }
            else if($aux[$i]['year'] == $year && $aux[$i]['month'] > $month) {
                array_push($return_this, $aux[$i]);
            }
            else if($aux[$i]['year'] == $year && $aux[$i]['month'] == $month && $aux[$i]['day'] >= $day){
                array_push($return_this, $aux[$i]);
            }
        }

        return $return_this;

    }

    function getDatesForRoom($room) {
        $dbh = db_connect_PDO();
        $sql = $dbh->prepare('SELECT day, month, year FROM rezervations WHERE room=:room');
        $sql->execute(['room'=>$room]);
        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
            print_r($row['day'].','.$row['month'].','.$row['year'].' ');
        }

        $dbh = null;
    }

    function getRezervationsForMonth($month, $year) {

        $dbh = db_connect_PDO();
        $sql = $dbh->prepare('SELECT client_name, nr_pers, comment, room FROM rezervations WHERE year=:year AND month=:month');
        $sql->execute(['year'=>$year, 'month'=>$month]);
        $return = [];
        while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            array_push($return, $row);
        }

        $dbh = null;

        return $return;
    }