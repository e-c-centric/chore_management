<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $familyRole = $_POST['familyRole'];
    $dob = $_POST['dob'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retypedPassword = $_POST['retypedPassword'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $rid = 3;
    $roleQuery = "SELECT fid FROM Family_name WHERE fam_name = ?";
    $stmtRole = $conn->prepare($roleQuery);
    $stmtRole->bind_param("s", $familyRole);
    
    $stmtRole->execute();
    
    $resultRole = $stmtRole->get_result();
    
    if ($resultRole->num_rows > 0) {
        $row = $resultRole->fetch_assoc();
        $fid = $row['fid'];
        
        $resultRole->close();
        $stmtRole->close();}

    $sql = "INSERT INTO People (rid, fid, fname, lname, gender, dob, tel, email, passwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("iisssssss", $rid, $fid, $firstName, $lastName, $gender, $dob, $phoneNumber, $email, $hashedPassword);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: ./../login/login_view.php");
            exit();
        } else {
            echo "Error: Unable to register user. Please try again.";
        }

        $stmt->close();
    } else {
        echo "Error: Unable to prepare statement. Please try again.";
    }
} else {
    header("Location: ../view/register.html");
    exit();
}
?>