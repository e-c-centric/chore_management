<?php

include '../settings/core.php';
include '../functions/select_people_fxn.php';
include '../functions/select_chores_fxn.php';
checkLogin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Chores</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <aside class="sidebar flex flex-column">
        <h3>Siuuuu Chore MS</h3>

        <div class="flex flex-column justify-between h-full">
            <div class="menu-links flex flex-column">
                <div class="flex items-center gap-4">
                    <img width="50" height="50" src="https://img.icons8.com/quill/50/bungalow.png" alt="bungalow" />
                    <a href="../view/home_view.php">Home</a>
                </div>
                <div class="flex items-center gap-4">
                    <img width="50" height="50" src="https://img.icons8.com/dotty/80/admin-settings-male.png" alt="admin-settings-male" />
                    <a href="../admin/chore_control_view.php">Chore Managament</a>
                </div>
                <div class="flex items-center gap-4">
                    <img width="48" height="48" src="https://img.icons8.com/badges/48/course-assign.png" alt="course-assign" /> <a href="../admin/assign_chore_view.php">Chore Assignments</a>
                </div>

                <div class="flex items-center gap-4 active">
                <img width="48" height="48" src="https://img.icons8.com/dotty/48/user.png" alt="user" /> <a href="../view/assigned_chores_view_user.php"><?php echo $_SESSION['fullname'];echo"\n"; ?>View Your Chores</a>
                </div>

                <div class="flex items-center gap-4">
                    <img width="50" height="50" src="https://img.icons8.com/ios/50/exit--v1.png" alt="exit--v1" /> <a href="../login/logout_view.php">Logout</a>
                </div>
            </div>

    </aside>
    <div class="container">
        <div class="content">
            <div class="inner flex flex-column gap-8">
                <div class="flex flex-column gap-4">
                    <div class="flex items-center justify-between">
                        <h3>Chore Assignments</h3>
                        <p><?php echo $_SESSION['fullname']; ?></p>
                    </div>
                    <div class=" flex items-center justify-between gap-6">
                        <table>
                            <thead>
                                <tr>
                                    <th>Chore Name</th>
                                    <th>Assigned By</th>
                                    <th>Date Assigned</th>
                                    <th>Date Due</th>
                                    <th>Chore Status</th>
                                </tr>
                            </thead>
                            <tbody><?php include '../functions/get_users_assigned_chore_fxn.php';
                                    echo showRecent();
                                    ?></tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>

</body>

</html>