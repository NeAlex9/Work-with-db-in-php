<?php
    $link = mysqli_connect('localhost', 'root', '', 'calendar');
    mysqli_query($link, "SET NAMES 'utf8'");
    $day_has_event = false;
    if ($link) {
        $query = "SELECT * FROM event_date";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result)) {
            echo '<div>';
            $date = $_GET['date'];
            $arr = explode( '-', $date);
            $day_month = $arr[1].'-'.$arr[2];
            $arr = explode( '-', $row['date']);
            $day_month_from_db = $arr[1].'-'.$arr[2];;
            if ($day_month === $day_month_from_db){
                echo "<div style='font-size: 20px; text-align: center' > Сегодня ".$row['event']."!</div>";
                $day_has_event = true;
            }
        }
        if (!$day_has_event){
            echo "<div style='font-size: 20px; text-align: center'> Сегодня нет праздников ): </div>";
        }
    } else
        echo "can't get access to database";