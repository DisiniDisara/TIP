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
        $class = $row->unitCode;
        array_push($CLASSES, $class);
    };

    // The 2D array containing times, days, and class info.
    $timetable = generateTimeTableTemplateArray();

    // Iterate over the result and fill in the timetable 2D array
    while ($row = mysqli_fetch_assoc($result)) {
        
        $classType = array_key_exists('classtype', $row) ? $row['class_type']: $row['classType'];
        $day = array_key_exists('day', $row) ? $row['day']: $row['classDay'];
        $start_time = array_key_exists('start_time', $row) ? $row['start_time']: $row['classStartTime'];
        $end_time = array_key_exists('end_time', $row) ? $row['end_time']: $row['classEndTime'];
        $class_name = array_key_exists('class_name', $row) ? $row['class_name']: $row['className'];
        $class_code = array_key_exists('class_code', $row) ? $row['class_code']: $row['classCode'];
        $unit_code = array_key_exists('unit_code', $row) ? $row['unit_code']: $row['unitCode'];

        $staff = array_key_exists('staff', $row) ? $row['staff']: 'NA';

        // Grab a color for this class based on the index of the class_name shown in #CLASSES
        $color = $allColors[array_search($unit_code, $CLASSES)];

        // Cell info in the table is different for start, middle, end block of the class session
        $start_info = "<div class='class-block' style='background-color: $color; padding:0; margin:0; height: 100%;'>$class_code</div>";
        $middle_info  = "<div class='class-block' style='background-color: $color; color: $color; padding:0; margin:0; height:100%;'>' '</div>";
        $end_info = "<div class='class-block' style='background-color: $color; color: $color; padding: 0; margin:0; height: 100%;'>' '</div>";

        // Time blocks from sart to end times, inclusively
        $times = getStartToEndTimes($start_time, $end_time);

        // Number of time slots
        $n_times = count($times) - 1;

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

    $TIMETABLE = '';

    // Days for the timetable header
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    // Start of generating timetable html
    $TIMETABLE .= "<table style='border-collapse: collapse; border-color: red; border: 1px solid darkblue;'>" . PHP_EOL .
    "<tr><th style='border: 1px solid darkblue; padding:0; margin:0;'>Time</th>";

    // Add day in header
    foreach ($days as $day) {
        $TIMETABLE .= "<th style='border: 1px solid darkblue; padding:0; margin:0;'>$day</th>";
    }

    // Go through timetable array and add info to td tag
    foreach ($timetable as $row) {
        $TIMETABLE .= "<tr>";
        foreach ($row as $cell) {

            $TIMETABLE .= "<td style='border: 1px solid darkblue; padding:0; margin:0;'>" . $cell . "</td>";
        }
        $TIMETABLE .= "</tr>";
    }
    $TIMETABLE .= "</table>";

    return $TIMETABLE;
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
        // '17:30' => array('time' => '17:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        // '18:00' => array('time' => '18:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        // '18:30' => array('time' => '18:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        // '19:00' => array('time' => '19:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        // '19:30' => array('time' => '19:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        // '20:00' => array('time' => '20:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        // '20:30' => array('time' => '20:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        // '21:00' => array('time' => '21:00', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => ''),
        // '21:30' => array('time' => '21:30', 'Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => '')
    );

        return $timetable;
}

function getStartToEndTimes($start, $end){
    // Args
    // $start = string of 24h time format of class start time
    // $end = string of 24h time format of class end time
    // return the times from start to end, inclusively

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

function generatePrefClassTable( 
    $applicantID, $result, $result2, $edit=false, $mainColor=NULL,
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
    // $applicantID: string of applicant id to query db for their previous preferences
    // result1: mysqli object after querying for the class sessions with: className, day, startTime, endTime, staff 
    // result2: mysqli object to query and get distinct class names 
    // allColors: an array of string of color names in html
    // Return: HTML table class sessions with user input for preference

    require 'connections.php';

    // Array of unique class names in table
    $CLASSES = [];
    while ($row = $result2 -> fetch_object()) {
        $class = $row->class;
        array_push($CLASSES, $class);
    };

    // The 2D array containing times, days, and class info.
    $timetable = generateTimeTableTemplateArray();

    // Iterate over the result and fill in the timetable 2D array
    while ($row = mysqli_fetch_assoc($result)) {

        $classType = array_key_exists('classtype', $row) ? $row['class_type']: $row['classType'];
        $day = array_key_exists('day', $row) ? $row['day']: $row['classDay'];
        $start_time = array_key_exists('start_time', $row) ? $row['start_time']: $row['classStartTime'];
        $end_time = array_key_exists('end_time', $row) ? $row['end_time']: $row['classEndTime'];
        $class_name = array_key_exists('class_name', $row) ? $row['class_name']: $row['className'];
        $class_code = array_key_exists('class_code', $row) ? $row['class_code']: $row['classCode'];
        $staff = array_key_exists('staff', $row) ? $row['staff']: 'NA';

        // Grab a color for this class based on the index of the class_name shown in #CLASSES
        $color = ($mainColor===NULL) ? $allColors[array_search($class_name, $CLASSES)]:$mainColor;

        // Get the preference for this class session
        $sql = "SELECT * FROM preferences WHERE preferences.classCode = '$class_code' and preferences.userID = '$applicantID' ";
        $preferences_results = $mysqli->query($sql);
        $prefLevel = '';
        if ($preferences_results->num_rows > 0) {
            $prefLevel = $preferences_results->fetch_object()->prefLevel;
        }
        
        // Cell info in the table is different for start, middle, end block of the class session
        if ($edit===true) {
            $start_info = <<<HTML
        <div class='class-block' style='background-color: $color; padding:0; margin:0; height: 100%;'>
        <div style='margin: 0; padding:0;'><input type="number" name='preferences[]' value='{$prefLevel}' size=2 style="font-size: 1rem; margin: 0; padding:0; text-align: center; border: solid 2px lightblue; width: 3rem; height: 1.6rem; border-radius: 2px; background-color: white; margin-right:4px;"/> $class_code</div>
        <input type="hidden" name="classCode[]" value="{$class_code}" />
HTML; 
        } else {
            $start_info = <<<HTML
        <div class='class-block' style='background-color: $color; padding:0; margin:0; height: 100%;'>
        <div style='margin: 0; padding:0; display: flex; align-items: center;'><div class='pref_box' style='font-size: 1rem; margin: 0; padding:0; text-align: center; width: 2rem; height: 1.6rem; border-radius: 2px; background-color: white; margin-right:4px;'>{$prefLevel}</div>$class_code</div>
HTML;
        }

        if ($prefLevel === '' && $edit===false) {
            $start_info = <<<HTML
        <div class='class-block' style='background-color: $color; padding:0; margin:0; height: 100%;'>
        <div style='margin: 0; padding:0; display: flex; align-items: center; width:2rem;'>{$prefLevel}</div>$class_code</div>
HTML;
        } 

        
        $middle_info  = "<div class='class-block' style='background-color: $color; color: $color; padding:0; margin:0; height:100%;'>' '</div>";
        $end_info = "<div class='class-block' style='background-color: $color; color: $color; padding: 0; margin:0; height: 100%;'>' '</div>";

        // Time blocks from sart to end times, inclusively
        $times = getStartToEndTimes($start_time, $end_time);

        // Number of time slots
        $n_times = count($times) - 1;

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
    $TIMETABLE = '';

    // Days for the timetable header
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    // Start of generating timetable html
    $TIMETABLE .= "<table style='border-collapse: collapse; border-color: red; border: 1px solid darkblue;'>" . PHP_EOL .
    "<tr><th style='border: 1px solid darkblue; padding:0; margin:0;'>Time</th>";

    // Add day in header
    foreach ($days as $day) {
        $TIMETABLE .= "<th style='text-align: center; border: 1px solid darkblue; padding:0; margin:0; height: 1.5rem;'>$day</th>";
    }

    // Go through timetable array and add info to td tag
    foreach ($timetable as $row) {
        $TIMETABLE .= "<tr>";
        foreach ($row as $cell) {

            $TIMETABLE .= "<td style='border: 1px solid darkblue; padding:0; margin:0; height: 1.5rem;'>" . $cell . "</td>";
        }
        $TIMETABLE .= "</tr>";
    }
    $TIMETABLE .= "</table>";

    return $TIMETABLE;
}

function generateAllocationTable( 
    $unitCode, $result, $result2, $edit=true, $mainColor=NULL,
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
    )
    {
    // A timetable of classes for a unit with scroll down input of applicants for a session.
    // Args
    // $applicantID: string of applicant id to query db for their previous preferences
    // result: mysqli object after querying for the class sessions with: className, day, startTime, endTime, staff 
    // result2: mysqli object to query and get distinct class names 
    // allColors: an array of string of color names in html

    require 'connections.php';

    // Array of unique class names in table
    $CLASSES = [];
    while ($row = $result2->fetch_object()) {
        $class = $row->class;
        array_push($CLASSES, $class);
    };

    // The 2D array containing times, days, and class info.
    $timetable = generateTimeTableTemplateArray();

    // Iterate over the result and fill in the timetable 2D array
    while ($row = mysqli_fetch_assoc($result)) {

        $day = array_key_exists('day', $row) ? $row['day']: $row['day'];
        $start_time = array_key_exists('start_time', $row) ? $row['start_time']: $row['startTime'];
        $end_time = array_key_exists('end_time', $row) ? $row['end_time']: $row['endTime'];
        $class_name = array_key_exists('class_name', $row) ? $row['class_name']: $row['className'];
        $class_code = array_key_exists('class_code', $row) ? $row['class_code']: $row['classCode'];
        $staff = array_key_exists('staff', $row) ? $row['staff']: $row['staffID'];
        $allocated = array_key_exists('allocated', $row) ? $row['allocated']: $row['allocated'];
        $allocated = ($allocated===NULL) ? 'NULL':$allocated;

        // Grab a color for this class based on the index of the class_name shown in #CLASSES
        $color = ($mainColor===NULL) ? $allColors[array_search($class_name, $CLASSES)]:$mainColor;

        // Store hired applicants with preference for this class session
        $interestedApps = [["", "", 'NULL']];

        // Finding interested applicants
        $sql = "SELECT * FROM preferences WHERE classCode = '$class_code'";
        $prefs_object = $mysqli->query($sql);

        if ($prefs_object->num_rows > 0) {
            while ($prefs = mysqli_fetch_assoc($prefs_object)) {

                $applicantID = $prefs['applicantID']; 
                
                $sql2 = "SELECT givenName, familyName FROM systemUser, class WHERE systemUser.userID='$applicantID' and class.userID='$applicantID'";
                $result3 = $mysqli->query($sql2);

                if ($result3->num_rows > 0 ){
                    $applicantDetail = $result3->fetch_object();
                    $givenName = $applicantDetail->givenName;
                    $familyName = $applicantDetail->familyName;

                    array_push($interestedApps, [$givenName, $familyName, $applicantID]);
                }
                
            }
        }
        $start_info = <<<HTML
            <div class='class-block' style='background-color: $color; padding:0; margin:0; height: 100%;'> $class_code</div>
HTML;

        $middle_info  = "<div class='class-block' style='background-color: $color; color: $color; padding:0; margin:0; height:100%;'>' '</div>";

        $end_info = <<<HTML
        <div class='class-block' style='padding: 0; margin:0; height: 100%;'>
        <div style='margin: 0; padding:0;'>
        <input type="hidden" name="classCode[]" value={$class_code}>
        <select name='allocation[]'>
HTML;        
        foreach ($interestedApps as $app) {
            if ($app[2]===$allocated){
                if ($app[2]!='NULL'){
                    $sql = "SELECT applicantID, givenName, familyName FROM applicant WHERE applicantID='$allocated' ";
                    $object= $mysqli->query($sql);
                    $data = $object->fetch_object();
                    $fn = $data->givenName;
                    $ln = $data->familyName;

                    $end_info .= <<<HTML
                    <option value=$allocated selected>$fn $ln $allocated</option>
HTML;             
                } else {
                    $end_info .= <<<HTML
                    <option value='NULL' selected>No Allocation</option>
HTML;             
                }
            } 
            else{
                if ($app[2]!='NULL'){
                    $end_info .= <<<HTML
                    <option value= $app[2] >$app[0] $app[1] $app[2]</option>
HTML;              
                } else {
                    $end_info .= <<<HTML
                    <option value='NULL' selected>No Allocation</option>
HTML;             
                }
            } 
            
        }
        $end_info .= <<<HTML
        </select></div></div>
HTML;
        
        // Time blocks from sart to end times, inclusively
        $times = getStartToEndTimes($start_time, $end_time);

        // Number of time slots
        $n_times = count($times) - 1;

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
    $TIMETABLE = '';

    // Days for the timetable header
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    // Start of generating timetable html
    $TIMETABLE .= "<table style='border-collapse: collapse; border-color: red; border: 1px solid darkblue;'>" . PHP_EOL .
    "<tr><th style='border: 1px solid darkblue; padding:0; margin:0;'>Time</th>";

    // Add day in header
    foreach ($days as $day) {
        $TIMETABLE .= "<th style='text-align: center; border: 1px solid darkblue; padding:0; margin:0; height: 1.5rem;'>$day</th>";
    }

    // Go through timetable array and add info to td tag
    foreach ($timetable as $row) {
        $TIMETABLE .= "<tr>";
        foreach ($row as $cell) {

            $TIMETABLE .= "<td style='border: 1px solid darkblue; padding:0; margin:0; height: 1.5rem;'>" . $cell . "</td>";
        }
        $TIMETABLE .= "</tr>";
    }
    $TIMETABLE .= "</table>";

    return $TIMETABLE;
}


?>
