<?php
include '../settings/connection.php';

if (isset($_GET['id'])) {
    $choreId = $_GET['id'];

    $sql = "DELETE FROM Chores WHERE cid = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $choreId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: ../admin/chore_control_view.php");
            exit();
        } else {
            echo "Error: Unable to delete chore. Please try again.";
        }

        $stmt->close();
    } else {
        echo "Error: Unable to prepare statement. Please try again.";
    }
} else {
    header("Location: ../admin/chore_control_view.php");
    exit();
}
?>