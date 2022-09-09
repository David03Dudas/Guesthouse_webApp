<?php
session_start();
if(!isset($_SESSION['logged'])) {
    header('location: ./login.php');
    exit;
}

    if(isset($_GET['day'])){
        $day = $_GET['day'];
        $month = $_GET['month'];
        $year = $_GET['year'];
    }
    else {
        header('Location: ../index.php');
        exit;
    }

    include './includes/functions.inc.php';

    $rezervari = getRezervations($day, $month, $year);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anulare rezervări</title>
    <link rel="stylesheet" href="./style/style_delPage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    
    <form action=<?php echo "./includes/del-rez.inc.php?day=".$day."&month=".$month."&year=".$year ?> method='POST'>
        <?php
            echo '<div class = " label_and_checkbox label_and_checkbox-header" id = "form-header">';
            echo '<label class = "date-rezervare">
                <p>Nume</p>
                <p>Ziua</p>
                <p>Luna</p>
                <p>Anul</p>
                <p>Camera</p>
                </label>';
            echo '<button class="div_second_row" onClick="backHome('.$day.','.$month.','.$year.')">Închide</button></div>';
        ?>
        <div id="rezervations">
            <?php

                for($i = 0; $i < count($rezervari); $i++)
                {
                    echo '<div class = "label_and_checkbox">';
                    echo '<label for="'.$rezervari[$i]['id'].'" class = "date-rezervare">
                        <p>'.$rezervari[$i]['client_name'].'</p>
                        <p>'.$rezervari[$i]['day'].'</p>
                        <p>'.$rezervari[$i]['month'].'</p>
                        <p>'.$rezervari[$i]['year'].'</p>
                        <p>'.$rezervari[$i]['room'].'</p>
                        </label>';
                    echo '<input class="div_second_column" type = "checkbox" name ="'.$rezervari[$i]['id'].'" value = "'.$rezervari[$i]['id'].'"></div>';
                }

            ?>
        </div>

        <br><br>
        <input type="submit" name="submit" value="Șterge" id = "submit_btn">
    </form>
    <script src="./javascript/del-rez.js">
        setBackgrounds();
    </script>
</body>
</html>