<?php

    function set_day_week_header($days_week)
    {
        echo "<table class=\"all_days\"> <tr> ";
        foreach ($days_week as $day_week)
            echo "<td class='day_week'>$day_week</td>";
        echo "</tr> </table>";
    }

    function set_month_calendar($curr_month, $curr_year)
    {
        $max_day_curr_month = cal_days_in_month(CAL_GREGORIAN, $curr_month + 1, $curr_year);
        if ($curr_month === 0){
            $prev_month = 11;
            $prev_year = $curr_year - 1;
        }
        else{
            $prev_month = $curr_month - 1;
            $prev_year = $curr_year;
        }
        $max_day_last_month = date('t', mktime(0, 0, 0, $prev_month + 1, $curr_year));
        $date = $curr_year . "-" . str_pad($curr_month + 1, 2, '0', STR_PAD_LEFT) . "-" . str_pad('1', 2, '0', STR_PAD_LEFT);
        $curr_day_week = strftime('%u', strtotime($date));
        echo "<div class='days_wrapper'>";
        for ($num = $curr_day_week - 1; $num > 0; $num--) {
            $num_day = $max_day_last_month - $num + 1;
            $date = $prev_year . "-" . str_pad($prev_month + 1, 2, '0', STR_PAD_LEFT) . "-" . str_pad($num_day, 2, '0', STR_PAD_LEFT);
            echo "<div class='one_day_wrapper' style='background-color: darkgray'><a href='display_event.php?date=$date' class='day'>" . $num_day . "</a></div>";
        }
        for ($num_day = 1; $num_day <= $max_day_curr_month; $num_day++) {
            $date = $curr_year . "-" . str_pad($curr_month + 1, 2, '0', STR_PAD_LEFT) . "-" . str_pad($num_day, 2, '0', STR_PAD_LEFT);
            echo "<div class='one_day_wrapper'><a href='display_event.php?date=$date' class='day'>" . $num_day . "</a></div>";
        }
        echo "</div>";
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>MyBD</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
</head>
<body>
<main>
    <div class="wrapper_calendar">
        <?php
            $months = [0 => "Январь", "Февраль", "Март", "Апрель", "Май",
                "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь",
                "Декабрь"];
            $days_week = [1 => "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];
            if (!isset($_GET['curr_month'])) {
                $curr_month = (int)date("m") - 1;
                $curr_year = date("Y");
            } else {
                $curr_month = $_GET['curr_month'];
                $curr_year = $_GET['curr_year'];
            }

            if ($curr_month - 1 === -1) {
                $prev_month = 11;
                $prev_year = $curr_year - 1;
            } else {
                $prev_month = $curr_month - 1;
                $prev_year = $curr_year;
            }

            if ($curr_month + 1 === 12) {
                $next_month = 0;
                $next_year = $curr_year + 1;
            } else {
                $next_month = $curr_month + 1;
                $next_year = $curr_year;
            }

            echo "<div class='header_month'>
                    <a href='index.php?curr_month=$prev_month&curr_year=$prev_year'><img class='arrow' src='img/arrow-left.png' ></a>
                    <div class=\"month\">" . $months[$curr_month] . " " . $curr_year . "</div > 
                   <a href='index.php?curr_month=$next_month&curr_year=$next_year'><img class='arrow' src='img/arrow-right.png' ></a>
                  </div>";
            set_day_week_header($days_week);
            set_month_calendar($curr_month, $curr_year);
        ?>
    </div>
</main>
</body>
</html>