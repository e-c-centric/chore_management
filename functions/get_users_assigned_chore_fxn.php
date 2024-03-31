<?php

include_once '../action/get_assigned_chores.php';

$assignments = getUserAssignedChores();

function showRecent()
{
    global $assignments;
    if ($assignments->num_rows > 0) {
        $table = '';
        while ($row = $assignments->fetch_assoc()) {
            $table .= '<tr><td>' . $row['chorename'] . '</td><td>' . $row['fname'] . ' ' . $row['lname'] . '</td><td>' . $row['date_assign'] . '</td><td>' . $row['date_due'] . '</td><td>' . $row['sname'] . '</td></tr>';
        }
        echo $table;
    } else {
        echo '<tr><td colspan="6">' . "Nothing to do" . '</td></tr>';
    }
}
