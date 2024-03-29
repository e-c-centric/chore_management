<?php
include '../settings/connection.php';

$response = array('success' => false, 'message' => '');

include_once('../settings/core.php');

if (checkUserRole() != 1) {
    $response['message'] = "Error: You do not have permission to use this feature.";
    echo json_encode($response);
} else {

    if (isset($_GET['id'])) {
        $choreId = $_GET['id'];

        $sql = "DELETE FROM Chores WHERE cid = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $choreId);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = "Chore deleted successfully.";
            } else {
                $response['success'] = false;
                $response['message'] = "Error: Unable to delete chore. Please try again.";
            }

            $stmt->close();
        } else {
            $response['success'] = false;
            $response['message'] = "Error: Unable to prepare statement. Please try again.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Error: Wrong request method. Please try again.";
    }

    $conn->close();
    echo json_encode($response);
}
