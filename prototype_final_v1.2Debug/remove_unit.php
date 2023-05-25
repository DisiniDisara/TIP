<?php
require "connections.php";

if (isset($_GET['unitCode'])){
    $unitCode = $_GET['unitCode'];
    $sql = "UPDATE unit SET vacancyStatus='false' WHERE unitCode = '$unitCode' ";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
}
header ("Location: units_staff_view.php")
?>