<?php
include '../settings/core.php';
include '../functions/chore_fxn.php';

checkLogin();

if (checkUserRole() == 3) {
    header("Location: ./../view/home_view.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, maximum-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="../css/style.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Chore Control Panel</title>
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
                <div class="flex items-center gap-4 active">
                    <img width="50" height="50" src="https://img.icons8.com/dotty/80/admin-settings-male.png" alt="admin-settings-male" />
                    <a href="../admin/chore_control_view.php">Chore Management</a>
                </div>
                <div class="flex items-center gap-4">
                    <img width="48" height="48" src="https://img.icons8.com/badges/48/course-assign.png" alt="course-assign" /> <a href="../admin/assign_chore_view.php">Chore Assignments</a>
                </div>

                <div class="flex items-center gap-4">
                    <img width="48" height="48" src="https://img.icons8.com/dotty/48/user.png" alt="user" /> <a href="../view/assigned_chores_view_user.php"><?php echo $_SESSION['fullname'];
                                                                                                                                                                echo "\n"; ?>View Your Chores</a>
                </div>

                <div class="flex items-center gap-4">
                    <img width="50" height="50" src="https://img.icons8.com/ios/50/exit--v1.png" alt="exit--v1" /> <a href="../login/logout_view.php">Logout</a>
                </div>
            </div>

    </aside>

    <div class="content">

        <div class="inner flex flex-column gap-8">
            <div class="flex flex-column gap-4">
                <div class="flex items-center justify-between">
                    <h3></h3>
                    <p><?php echo $_SESSION['fullname']; ?></p>
                </div>
                <div class="flex items-center justify-between">
                    <h1>Manage Chores</h1>
                    <button class="add-chore" onclick="document.getElementById('addChoreModal').classList.remove('hidden');" id="modal-btn">Add a chore</button>
                </div>
                <div class=" flex items-center justify-between gap-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Chore Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($var_data as $chore) {
                                echo "<tr>";
                                echo "<td>{$chore['chorename']}</td>";
                                echo "<td><a class =\"edit-chore\" href=\"../admin/edit_chore_view.php?id={$chore['cid']}\">📝</a><a href=\"#\" class=\"delete-chore\" data-id=\"{$chore['cid']}\">🚮</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="addChoreModal" class="modal hidden">
                <div class="overlay"></div>
                <div class="modal-body flex flex-column gap-4">
                    <div class="header flex flex-column gap-4">
                        <div class="flex items-center justify-between">
                            <h3>Add a chore</h3>
                            <button class="close" onclick="document.getElementById('addChoreModal').classList.add('hidden');" id="modal-close-btn">
                                X
                            </button>
                        </div>
                        <hr>
                    </div>
                    <div class="flex flex-column gap-4 w-full">
                        <div class="w-full">
                            <input type="text" class="w-full" id="chorename" placeholder="Chore name">
                        </div>
                        <button id="submit" onClick="addChoreAction()">Add Chore</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="editMdal" class="modal hidden">
            <div class="overlay"></div>
            <div class="modal-body flex flex-column gap-4">
                <div class="header flex flex-column gap-4">
                    <div class="flex items-center justify-between">
                        <h3>Update chore</h3>
                        <button class="close" onclick="document.getElementById('editMdal').classList.add('hidden');" id="modal-close-btn">
                            X
                        </button>
                    </div>
                    <hr>
                </div>
                <div class="flex flex-column gap-4 w-full">
                    <div class="w-full">
                        <input type="text" id="newChoreName" class="w-full" placeholder="Chore name">
                    </div>
                    <button id="editChore" onClick=editChoreAction()>Submit</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    var choreId = null;

    function addChoreAction() {
        var choreName = document.getElementById('chorename').value;

        $.ajax({
            url: './../action/add_chore_action.php',
            type: 'POST',
            data: {
                choreName: choreName
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.success) {
                    document.getElementById('addChoreModal').classList.add('hidden');
                    Swal.fire({
                        icon: 'success',
                        title: 'Chore added successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.reload(true);
                }
            },
            error: function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error adding chore!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    };

    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.delete-chore');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                var id = this.getAttribute('data-id');
                var row = this.closest('tr');

                fetch('../action/delete_chore_action.php?id=' + encodeURIComponent(id), {
                        method: 'GET',
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            row.remove();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-chore');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                choreId = url.split('=')[1];
                document.getElementById('editMdal').classList.remove('hidden');
            });
        });
    });

    function editChoreAction() {
        var choreName = document.getElementById('newChoreName').value;
        console.log(choreName, choreId);
        $.ajax({
            url: './../action/edit_a_chore_action.php',
            type: 'GET',
            data: {
                choreName: choreName,
                choreId: choreId
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.success) {
                    document.getElementById('editMdal').classList.add('hidden');
                    Swal.fire({
                        icon: 'success',
                        title: 'Chore updated successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.reload(true);
                }
            },
            error: function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error updating chore!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    };
</script>

</html>