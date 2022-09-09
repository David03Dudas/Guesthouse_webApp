<?php
session_start();
if(!isset($_SESSION['logged'])) {
    header('location: ./login.php');
    exit;
}

    $day = $_GET['day'];
    $month = $_GET['month'];
    $year = $_GET['year'];

    include './includes/functions.inc.php';

    if(isset($_POST['name'])) {
        echo '<form method = "POST" action = "./includes/edit-rez.inc.php" id = "edit-form" >';
        echo '<div><label for="name">Nume:</label><input type = "text" name = "name" value="'.$_POST['name'].'"/>';
        echo '<label for="nr_pers">Nr. pers:</label><input type = "number" name = "nr_pers" value="'.$_POST['nr_pers'].'"/>';
        echo '<label for="comment">Comment:</label><textarea rows=5 columns = 30 name = "comment" value="'.$_POST['comment'].'">'.$_POST['comment'].'</textarea></div>';
        echo '<input type = "hidden" name = "prevName" value="'.$_POST['name'].'">';
        echo '<input type = "hidden" name = "prevComment" value="'.$_POST['comment'].'">';
        echo '<button type = "submit">Salvează</button>';
        echo '</form>';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style_editPage.css">
    <title>Editează rezervări</title>
</head>
<body>
    <div id="rezervari">
    <div class = 'rowForm'>
        <p>Nume</p>
        <p>Camera</p>
        <p>Nr. pers</p>
        <p>Comment</p>
        <p>Nr. zile</p>
        <button onclick=backHome()>Exit</button>
    </div>
    
    <?php

    $rezervations = getRezervations($day, $month, $year);
    while(count($rezervations)) {
        echo "<form action ='./edit-rez.php?day=".$_GET['day']."&month=".$_GET['month']."&year=".$_GET['year']."' method = 'POST' class='rowForm'>";
        $name = $rezervations[0]['client_name'];
        $comment = $rezervations[0]['comment'];
        $room = $rezervations[0]['room'];
        $nr_pers = $rezervations[0]['nr_pers'];
        $nr_zile = 0;
        for($j = 0; $j < count($rezervations); $j++) {
            if($name == $rezervations[$j]['client_name'] && $room == $rezervations[$j]['room']) {
                $nr_zile++;
                \array_splice($rezervations, $j, 1);
                $j--;
            }
        }
        echo '<p>'.$name.'</p>';
        echo '<input type = "hidden" name = "name" value="'.$name.'"/>';
        echo '<p>'.$room.'</p>';
        echo '<input type = "hidden" name = "room" value="'.$room.'"/>';
        echo '<p>'.$nr_pers.'</p>';
        echo '<input type = "hidden" name = "nr_pers" value="'.$nr_pers.'"/>';
        echo '<p>'.$comment.'</p>';
        echo '<input type = "hidden" name = "comment" value="'.$comment.'"/>';
        echo '<p>'.$nr_zile.'</p>';
        echo '<input type = "hidden" name = "zile" value="'.$nr_zile.'"/>';
        echo '<button type="submit">Editează</button>';
        echo '</form>';
    }


    ?>

</div>

    
</body>

<script src="./javascript/functions.js"></script>
</html>