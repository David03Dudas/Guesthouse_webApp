    <?php
    if(isset($_POST["disp_dates"])){
        echo '<input type="hidden" name="disp_dates_list" id="disp_dates_list" value = "';
        getDatesForRoom($_POST['room']);
        echo '">';
    }

    ?>

    <script src="./javascript/calendar.js"></script>
    <script src="./javascript/functions.js"></script>

</html>