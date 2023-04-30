<?php
function generateTimeTable( 
    $result, $result2, 
    $allColors = [
        0 => 'violet',
        1 =>'dodgerblue', 
        2 =>'tomato', 
        3 => 'pink',
        4 => 'mediumseagreen', 
        5 => 'green', 
        6 => 'orange', 
        7 => 'brown', 
        8 => 'taupe']
    ){
    // Args
    // result1: mysqli object after querying for the class sessions with: className, day, startTime, endTime, staff 
    // result2: mysqli object to query and get distinct class names 
    // allColors: an array of string of color names in html

    // Array of unique class names in table
    $CLASSES = [];
    while ($row = $result2 -> fetch_object()) {
        $class = $row->class;
        array_push($CLASSES, $class);
    };

    // The 2D array containing times, days, and class info.
    $timetable = generateTimeTableTemplateArray($increment=30);

    // Iterate over the result and fill in the timetable 2D array
    while ($row = mysqli_fetch_assoc($result)) {
        $day = $row['day'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $class_name = $row['class_name'];
        $class_code = $row['class_code'];
        $staff = $row['staff'];

        // Grab a color for this class based on the index of the class_name shown in #CLASSES
        $color = $allColors[array_search($class_name, $CLASSES)];

        // Cell info in the table is different for start, middle, end block of the class session
        $start_info = "<div class='class-block' style='background-color: $color; padding:0; margin:0; height: 100%;'>$class_code</div>";
        $middle_info  = "<div class='class-block' style='background-color: $color; color: $color; padding:0; margin:0; height:100%;'>' '</div>";
        $end_info = "<div class='class-block' style='background-color: $color; color: $color; padding: 0; margin:0; height: 100%;'>' '</div>";

        // Time blocks from sart to end times, inclusively
        $times = getStartToEndTimes($start_time, $end_time);

        // Number of time slots
        $n_times = count($times);

        // Add html to timetable array based on the time block type
        foreach ($times as $i=>$time){
            if ($i==0){
                $timetable[$time][$day]= $start_info;
            } 
            if ($i>0 and $i<($n_times - 1)){
                $timetable[$time][$day]= $middle_info;
            } 
            if ($i==($n_times - 1)) {
                $timetable[$time][$day]= $end_info;
            } 
        };

    }
    
    // Days for the timetable header
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    // Start of generating timetable html
    echo "<table style='border-collapse: collapse; border-color: red; border: 1px solid darkblue;'>";
    echo "<tr><th style='border: 1px solid darkblue; padding:0; margin:0;'>Time</th>";

    // Add day in header
    foreach ($days as $day) {
        echo "<th style='border: 1px solid darkblue; padding:0; margin:0;'>$day</th>";
    }

    // Go through timetable array and add info to td tag
    foreach ($timetable as $row) {
        echo "<tr>";
        foreach ($row as $cell) {

            echo "<td style='border: 1px solid darkblue; padding:0; margin:0;'>" . $cell . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}


function generateTimeTableTemplateArray(){

    $timetable = array(
        '08:00' => array('time' => '08:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '08:30' => array('time' => '08:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '09:00' => array('time' => '09:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '09:30' => array('time' => '09:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '10:00' => array('time' => '10:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '10:30' => array('time' => '10:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '11:00' => array('time' => '11:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '11:30' => array('time' => '11:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '12:00' => array('time' => '12:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '12:30' => array('time' => '12:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '13:00' => array('time' => '13:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '13:30' => array('time' => '13:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '14:00' => array('time' => '14:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '14:30' => array('time' => '14:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '15:00' => array('time' => '15:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '15:30' => array('time' => '15:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '16:00' => array('time' => '16:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '16:30' => array('time' => '16:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '17:00' => array('time' => '17:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '17:30' => array('time' => '17:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '18:00' => array('time' => '18:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '18:30' => array('time' => '18:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '19:00' => array('time' => '19:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '19:30' => array('time' => '19:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '20:00' => array('time' => '20:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '20:30' => array('time' => '20:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '21:00' => array('time' => '21:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        '21:30' => array('time' => '21:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => '')
    );

        return $timetable;
}

function getStartToEndTimes($start, $end){
    
    $times = array(
        '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', 
        '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', 
        '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', 
        '20:00', '20:30', '21:00', '21:30'
    );

    $startTimeIndex = array_search($start, $times);
    $n = array_search($end, $times) - array_search($start, $times) + 1;
      
    return array_slice($times, $startTimeIndex, $n);
}
