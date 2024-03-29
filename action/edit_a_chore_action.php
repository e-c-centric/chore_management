<?php
include '../settings/connection.php';

$response = array('success' => false, 'message' => '');

if (isset($_GET['choreId'], $_GET['choreName'])) {
    $choreId = $_GET['choreId'];
    $newChoreName = $_GET['choreName'];

    $sql = "UPDATE Chores SET chorename = ? WHERE cid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newChoreName, $choreId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response['success'] = true;
        $response['message'] = "Chore updated successfully.";
    } else {
        $response['message'] = "Error updating chore. Please try again.";
    }

    $stmt->close();
} else {
    $response['message'] = "Wrong request method. Please try again.";
}

$conn->close();
echo json_encode($response);
?>