<?php

include_once '../settings/core.php';
include_once '../settings/connection.php';

checkLogin();

$userid = $_SESSION['pid'];

function getUserAssignedChores()
{
    global $conn, $userid;

    $sql = "SELECT * FROM assignment JOIN chores ON assignment.cid = chores.cid JOIN assigned_people ON assignment.assignmentid = assigned_people.assignmentid JOIN status ON assignment.sid = status.sid JOIN people ON people.pid = assignment.who_assigned WHERE assigned_people.pid  = $userid";
    //  "SELECT * FROM assignment JOIN chores ON assignment.cid = chores.cid JOIN assigned_people ON assignment.assignmentid = assigned_people.assignmentid WHERE assigned_people.pid = $userid";

    $result = $conn->query($sql);

    $var_data = $result;

    return $var_data;
}
