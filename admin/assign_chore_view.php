<?php

include '../settings/core.php';
include '../functions/select_people_fxn.php';
include '../functions/select_chores_fxn.php';
checkLogin();

if (checkUserRole() == 3) {
    header("Location: ./../view/home_view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Chore</title>
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
                <div class="flex items-center gap-4 active">
                    <img width="48" height="48" src="https://img.icons8.com/badges/48/course-assign.png" alt="course-assign" /> <a href="../admin/assign_chore_view.php">Chore Assignments</a>
                </div>

                <div class="flex items-center gap-4">
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
                    <h3></h3>
                <p><?php echo $_SESSION['fullname']; ?></p>
                </div>
                    <div class="flex items-center justify-between">
                        <h3>Chore Assignments</h3>
                        <button class="add-chore" onclick="document.getElementById('assignModal').classList.remove('hidden')" id="modal-btn">Assign a chore</button>

                    </div>
                    <div class=" flex items-center justify-between gap-6">
                        <table>
                            <thead>
                                <tr>
                                    <th>Chore Name</th>
                                    <th>Assigned To</th>
                                    <th>Date Assigned</th>
                                    <th>Date Due</th>
                                    <th>Chore Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody><?php include '../functions/get_all_assignment_fxn.php'; ?></tbody>
                        </table>
                    </div>
                </div>
                <div id="assignModal" class="modal hidden">
                    <div class="overlay"></div>
                    <div class="modal-body flex flex-column gap-4">
                        <div class="header flex flex-column gap-4">
                            <div class="flex items-center justify-between">
                                <h3>Assign a chore</h3>
                                <button class="close" onclick="document.getElementById('assignModal').classList.add('hidden')" id="modal-close-btn">
                                    X
                                </button>
                            </div>
                            <hr>
                        </div>
                        <div class="flex flex-column gap-4 w-full">
                            <form action="" class="flex flex-column gap-4">
                                <div class="w-full flex flex-column gap-2">
                                    <label for="assignee" class="text-sm">Asignee</label>
                                    <select class="w-full" name="assignee" id="assignee_id" required>
                                        <option value="" disable selected>Assign person</option>
                                        <?php echo getPeople(); ?>
                                    </select>
                                </div>
                                <div class="w-full flex flex-column gap-2">
                                    <label for="chore_selected" class="text-sm">Assign Chore</label>
                                    <select class="w-full" name="chore_assigned" id="chore_assigned">
                                        <option value="" disable selected>Assign Chore</option>
                                        <?php echo getChores(); ?>
                                    </select>
                                </div>
                                <div class="w-full flex flex-column gap-2">
                                    <label for="" class="text-sm">Due Date</label>
                                    <input type="date" class="w-full" id="due_date" placeholder="Chore name">
                                </div>
                                <button>Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault();

                var pid = document.getElementById('assignee_id').value;
                var cid = document.getElementById('chore_assigned').value;
                var date = document.getElementById('due_date').value;

                console.log(pid, cid, date);

                $.ajax({
                    url: '../action/assign_a_chore_action.php',
                    type: 'POST',
                    data: {
                        pid: pid,
                        cid: cid,
                        date: date
                    },
                    success: function(response) {
                        if (response === "1") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Chore assigned successfully',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#modal-close-btn').click();
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to assign chore',
                                text: "Try again later",
                                showConfirmButton: false,
                                timer: 6000
                            });
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.delete').click(function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                var assignmentid = url.split('=')[1];
                console.log(assignmentid);
                $.ajax({
                    url: '../action/delete_assignment_action.php',
                    type: 'GET',
                    data: {
                        assignmentid: assignmentid
                    },
                    success: function(response) {
                        if (response === "1") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Assignment deleted successfully',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to delete chore',
                                text: response,
                                showConfirmButton: false,
                                timer: 6000
                            });
                        }
                    }
                });
            });
        });
    </script>


</body>

</html>