<?php
include '../settings/connection.php';
include '../settings/core.php';

checkLogin();
$role = checkUserRole();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <aside class="sidebar flex flex-column">
    <h3>Siuuuu Chore MS</h3>

    <div class="flex flex-column justify-between h-full">
      <div class="menu-links flex flex-column">
        <div class="flex items-center gap-4 active">
          <img width="50" height="50" src="https://img.icons8.com/quill/50/bungalow.png" alt="bungalow" />
          <a href="../view/home_view.php">Home</a>
        </div>
        <?php
        if ($role != 3) {
          echo '
        <div class="flex items-center gap-4">
          <img width="50" height="50" src="https://img.icons8.com/dotty/80/admin-settings-male.png" alt="admin-settings-male" />
          <a href="../admin/chore_control_view.php">Chore Management</a>
        </div>
        <div class="flex items-center gap-4">
          <img width="48" height="48" src="https://img.icons8.com/badges/48/course-assign.png" alt="course-assign" /> <a href="../admin/assign_chore_view.php">Chore Assignments</a>
        </div>';
        } ?>

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
      <header class="flex items-center justify-between">
        <h2>Dashboard</h2>
        <p>Welcome, <?php echo $_SESSION['fullname']; ?></p>
      </header>


      <div class="inner flex flex-column gap-8">
        <div class="flex flex-column gap-2">
          <h5>Chore Statistics</h5>
          <div class=" flex items-center justify-between gap-6">
            <div class="card flex flex-column gap-5">
              <div class="flex items-center gap-4">
                <div class="icon">
                  <img width="48" height="48" src="https://img.icons8.com/color/48/filled-plus-2-math.png" alt="" />
                </div>
                <p>All Chores Assigned</p>
              </div>
              <h1 class="progress">
                <?php
                include '../functions/home_fxn.php';
                echo getCount('assignment');
                ?>
              </h1>
            </div>
            <div class="card flex flex-column gap-5">
              <div class="flex items-center gap-4">
                <div class="icon">
                  <img width="48" height="48" src="https://img.icons8.com/color/48/in-progress--v1.png" alt="in-progress--v1" />
                </div>
                <p>In Progress</p>
              </div>
              <h1 class="progress">
                <?php
                echo getCount('inProgress');
                ?>
              </h1>
            </div>
            <div class="card flex flex-column gap-5">
              <div class="flex items-center gap-4">
                <div class="icon">
                  <img width="48" height="48" src="https://img.icons8.com/fluency/48/cancel-2.png" alt="cancel-2" />
                </div>
                <p>Incomplete</p>
              </div>
              <h1 class="incomplete">
                <?php
                echo getCount('incomplete');
                ?>
              </h1>
            </div>
            <div class="card flex flex-column gap-5">
              <div class="flex items-center gap-4">
                <div class="icon">
                  <img width="48" height="48" src="https://img.icons8.com/doodle/48/inspection.png" alt="inspection" />
                </div>
                <p>Completed</p>
              </div>
              <h1 class="completed">
                <?php
                echo getCount('completed');
                ?>
              </h1>
            </div>
          </div>
        </div>

        <div class="flex flex-column gap-2 recently-assigned">
          <div class="flex items-center justify-between">
            <h5>Recently Assigned Chores</h5>
            <a href="assigned_chores_view_user.php" class="text-sm">View assigned chores</a>
          </div>
          <?php
          echo showRecent();
          ?>
        </div>
      </div>


    </div>
  </div>
</body>

</html>