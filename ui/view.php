
<?php
    $b = new \Bookings;

    $params= $GLOBALS['f3']->get('params');
    echo $params['startdate'], $params['enddate'];
    $pa='gte[RequestedPickupTime]=' . $params['startdate'].' 00:00:00&amplt[RequestedPickupTime]=' . $params['enddate'] . ' 23:59:59';
    // print_r('xkn '.$pa);

    $results = $b->get($GLOBALS['f3'], $pa);
    
    // print_r($results[0]);

    echo "<div class='viewcontrol'>";
    // $startdate = date_format(date_create(str_replace("/","-",$params['startdate'])),"Y-m-d");
    // echo $startdate;
    echo "<form action='/btax/view' method='get'>";
        echo "<label for='startdate'>Start date:</label><input type='date' id='startdate' name='startdate' value='" . date_format(date_create(str_replace("/","-",$params['startdate'])),"Y-m-d") ."' />";
        echo "<label for='enddate'>Start date:</label><input type='date' id='enddate' name='enddate' value='" . date_format(date_create(str_replace("/","-",$params['enddate'])),"Y-m-d") . "' />";
        echo "<input type='submit' />";
    echo "</form>";
    echo "</div>";

    echo "<table>";
        echo "<tr>";
            // echo "<th>";
            $array_keys = array_keys($results[0]);
            foreach ($array_keys as $array_key) {
            echo "<th>" . $array_key . "</th>";
            }
            // echo "</th>";
        foreach($results as $row) {
            echo "</tr>";
                $array_keys = array_keys($row);
                foreach ($array_keys as $array_key) {
                    echo "<td>" . $row[$array_key] . "</td>";
                }          
            echo "<tr>";
        }
    echo "</table>";
    