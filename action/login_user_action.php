<?php
session_start();
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT pid, passwd, rid FROM People WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($pid, $hashedPassword, $rid);

            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['pid'] = $pid;
                $_SESSION['rid'] = $rid;

                header("Location: ./../view/welcome-page-users.php");
                exit();
            } else {
                echo "Incorrect username or password.";
            }
        } else {
            echo "User not registered or incorrect username.";
        }

        $stmt->close();
    } else {
        echo "Error: Unable to prepare statement. Please try again.";
    }
} else {
    header("Location: login_view.php");
    exit();
}

$conn->close();
?>
