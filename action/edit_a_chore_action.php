<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $choreId = $_POST['choreId'];
    $newChoreName = $_POST['choreName'];

    $sql = "UPDATE Chores SET chorename = ? WHERE cid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newChoreName, $choreId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../admin/chore_control_view.php");
        exit();
    } else {
        echo "Error updating chore. Please try again.";
    }

    $stmt->close();
} else {
    header("Location: ../admin/chore_control_view.php");
    exit();
}
?>