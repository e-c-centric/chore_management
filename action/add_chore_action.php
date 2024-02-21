<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $choreName = $_POST['choreName'];

    $sql = "INSERT INTO Chores (chorename) VALUES (?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $choreName);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../admin/chore_control_view.php");
        $_SESSION['chore_added'] = true;

        exit();
    } else {
        echo "Error: Unable to add chore. Please try again.";
    }

    $stmt->close();
} else {
    header("Location: ../admin/chore_control_view.php");
    exit();
}
