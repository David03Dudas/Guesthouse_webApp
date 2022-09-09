<?php
    session_start();
    if(!isset($_SESSION['logged'])) {
        header('location: ./login.php');
        exit;
    }

    include './header.php';
    include './includes/functions.inc.php';

    if(isset($_GET['day'])) { 
        $day = $_GET['day'];
        $month = $_GET['month'];
        $year = $_GET['year'];
    }
    else {
        $day = date("d");
        $month = date("m");
        $year = 2000+ date("y");
        header('Location: ./index.php?day='.$day.'&month='.$month.'&year='.$year);
        exit;
    }

    if(isset($_POST["index"])) {
        $index = $_POST['index'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        if($index == 'add') {
            echo '<form action="./includes/add-rez.inc.php" method = \'POST\' id = \'add-rez-form\'>
            <label for="nume_client">Nume client:</label>
            <input type="text" name="nume_client"><br>
            <label for="nr_camera">Număr camera:</label>
            <select name="nr_camera">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="12A">12A</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
            </select><br>
            <label for="nr_zile">Număr zile:</label>
            <input type="number" name="nr_zile" min=\'1\' value=1></input><br>
            <label for="nr_pers">Persoane:</label>
            <input type="number" name="nr_pers" min=\'0\' value=0></input><br>
            <label for="comentariu">Comentariu:</label><br>
            <textarea name="comentariu" cols="40" rows="10"></textarea><br>
            <input type="hidden" name = \'day\' value = '.$day.'>
            <input type="hidden" name = \'month\' value = '.$month.'>
            <input type="hidden" name = \'year\' value = '.$year.'>
            <button type="submit">Rezervă</button><br>
            <input type="button" value="Închide" onClick="backHome('.$day.','.$month.','.$year.')">
        </form>';
        }
        elseif ($index == 'delete') {
            header('Location: ./del-rez.php?day='.$day.'&month='.$month.'&year='.$year);
            exit;
        }
        elseif ($index == 'edit') {
            header('Location: ./edit-rez.php?day='.$day.'&month='.$month.'&year='.$year);
            exit;
        }
        else {
            header('Location: ./index.php');
            exit;
        }
    }

    

?>

<body>

    <input type="hidden" name="day" id="hidden-day" value=<?php echo $day; ?>>
    <input type="hidden" name="month" id="hidden-month" value=<?php echo $month; ?>>
    <input type="hidden" name="day" id="hidden-year" value=<?php echo $year; ?>>
    
    <div id="ziua-curenta">
        <div id="afisare-data-curenta">
            <div id = "box-header-data-curenta" >
                <h2 class = "elemente-header-data-curenta">Rezervări</h2>
                <h1 class = "elemente-header-data-curenta"><?php echo $day.'.'.$month.'.'.$year;?></h1>
            </div>
        </div>
        <div id="lista-camere">
            <form method = "POST" action = <?php echo './index.php?day='.$day.'&month='.$month.'&year='.$year?> id = "camere">
                <button type = "submit" name = "room" value = "1" class = "cam-2paturi disponibila" id="cam1">1</button>
                <button type = "submit" name = "room" value = "2" class = "cam-2paturi disponibila" id="cam2">2</button>
                <button type = "submit" name = "room" value = "3" class = "cam-matrimonial disponibila" id="cam3">3</button>
                <button type = "submit" name = "room" value = "4" class = "cam-matrimonial disponibila" id="cam4">4</button>
                <button type = "submit" name = "room" value = "5" class = "cam-matrimonial disponibila" id="cam5">5</button>
                <button type = "submit" name = "room" value = "6" class = "cam-matrimonial disponibila" id="cam6">6</button>
                <button type = "submit" name = "room" value = "7" class = "cam-2paturi disponibila" id="cam7">7</button>
                <button type = "submit" name = "room" value = "8" class = "cam-2paturi disponibila" id="cam8">8</button>
                <button type = "submit" name = "room" value = "9" class = "cam-2paturi disponibila" id="cam9">9</button>
                <button type = "submit" name = "room" value = "10" class = "cam-2paturi disponibila" id="cam10">10</button>
                <button type = "submit" name = "room" value = "11" class = "cam-2paturi disponibila" id="cam11">11</button>
                <button type = "submit" name = "room" value = "12" class = "cam-2paturi disponibila" id="cam12">12</button>
                <button type = "submit" name = "room" value = "12A" class = "cam-2paturi disponibila" id="cam12A">12A</button>
                <button type = "submit" name = "room" value = "13" class = "cam-4paturi disponibila" id="cam13">13</button>
                <button type = "submit" name = "room" value = "14" class = "cam-4paturi disponibila" id="cam14">14</button>
                <button type = "submit" name = "room" value = "15" class = "cam-4paturi disponibila" id="cam15">15</button>
                <button type = "submit" name = "room" value = "16" class = "cam-4paturi disponibila" id="cam16">16</button>
                <input type="hidden" name = "month" id = "rooms-month">
                <input type="hidden" name = "year" id = "rooms-year">
                <input type="hidden" name="disp_dates" id="disp_dates">
            </form>
            <div id="legenda">
                <div id="culori">
                    <div class="cam-matrimonial"></div>
                    <div class="cam-2paturi"></div>
                    <div class="cam-4paturi"></div>
                </div>
                <div id="descriere">
                    <p>Camere matrimoniale</p>
                    <p>Camere cu două paturi</p>
                    <p>Camere cu patru paturi</p>
                </div>
            </div>
        </div>
        <div id="lista-rezevari">
            <div class = "rezervari" id="header_rezervari">
                <p>Nume</p>
                <p>Nr. cameră</p>
                <p>Comentarii</p>
            </div>
            <?php 
                $rezervari = get_day_rez($day, $month, $year);
                for($i = 0; $i < count($rezervari); $i++){
                    print_r('<div class = "rezervari"><p>'.$rezervari[$i]['client_name'].'</p><p>'.$rezervari[$i]['room'].'</p><p>'.$rezervari[$i]['comment'].'</p></div>');
                }
            ?>
        </div>
    </div>
    <div id="calendar">
        <div id = "calendar-header">
            <div id="data-curenta">
                <h1 id="luna"></h1>
                <h2 id="anul"></h2>
            </div>
            <button id="prev-luna"><</button>
            <button id="next-luna">></button>
        </div>
        <div id="calendar-zile">
            <form action = "index.php" method="get" id="datele"></form>
        </div>
        <button id='calendar-home-btn' onclick='backHome()'><i class = 'fa fa-home'></i></button>
        <button id='calendar-rezervations-list-btn' onclick = 'getRezervations()'><i class = 'fa fa-list-alt'></i></button>
    </div>
    <div id="optiuni">
        <form id = "form-optiuni" action=<?php echo './index.php?day='.$day.'&month='.$month.'&year='.$year?> method = "POST" >
            <button id="opt-add" name = "index" value = "add" class = "button-optiuni" type="submit">Adaugă</button>
            <button id="opt-delete" name = "index" value = "delete" class = "button-optiuni" type="submit">Șterge</button>
            <button id="opt-edit" name = "index" value = "edit" class = "button-optiuni" type="submit">Editează</button>
            <input type="hidden" name = 'day' id='day' value = <?php echo $day ?>>
            <input type="hidden" name = 'month' id='month' value = <?php echo $month ?>>
            <input type="hidden" name = 'year' id='year' value = <?php echo $year ?>>
        </form>
    </div>

</body>

<?php

if(isset($_GET['error'])){
    if($_GET['error'] == "indisponible_room"){
        echo '
            <script>
                alert("Camera '.$_GET['room'].' nu este disponibilă pe '.$_GET['day'].'/'.$_GET['month'].'/'.$_GET['year'].'");
                window.location.replace("./index.php");
            </script>';
        echo 'Hello';
    }
}

    include './footer.php';
?>