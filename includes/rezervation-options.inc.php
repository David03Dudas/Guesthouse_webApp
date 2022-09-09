<?php

if(isset($_POST["index"])) {
    $index = $_POST['index'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    if($index == 'add') {
        header('Location: ../add-rez.php?day='.$day.'&month='.$month.'&year='.$year);
        exit;
    }
    elseif ($index == 'delete') {
        header('Location: ../del-rez.php?day='.$day.'&month='.$month.'&year='.$year);
        exit;
    }
    elseif ($index == 'edit') {
        header('Location: ../edit-rez.php?day='.$day.'&month='.$month.'&year='.$year);
        exit;
    }
    else {
        header('Location: ../index.php');
        exit;
    }
}
else {
    header('Location: ../index.php');
    exit;
}