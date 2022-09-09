<?php
session_start();
if(!isset($_SESSION['logged'])) {
    header('location: ./login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style_rezPage.css">
    <title>Lista rezervări pensiune</title>
</head>
<body>

<table>
    <tr>
        <th>NUME</th>
        <th>CAMERA</th>
        <th>NR. PERS</th>
        <th>COMMENT</th>
        <th>NR. ZILE</th>
    </tr>

<?php 

    include './includes/functions.inc.php';

    $rezervations = getRezervationsForMonth($_GET['month'], $_GET['year']);

    while(count($rezervations)) {
        echo '<tr>';
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
        echo '<th>'.$name.'</th>';
        echo '<th>'.$room.'</th>';
        echo '<th>'.$nr_pers.'</th>';
        echo '<th>'.$comment.'</th>';
        echo '<th>'.$nr_zile.'</th>';
        echo '</tr>';
    }
    echo '</table>';

?>

</body>
</html>