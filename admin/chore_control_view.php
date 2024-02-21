<?php
include '../settings/core.php';
include '../functions/chore_fxn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, maximum-scale=1.0" />
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />
    <link rel="stylesheet" type="text/css" href="../css/login.css" />
    <link rel="stylesheet" type="text/css" href="../css/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="../css/globals.css" />
    <link rel="stylesheet" type="text/css" href="../css/chore-control-panel.css" />
    <title>Chore Control Panel</title>
</head>

<body>
    <input type="hidden" id="anPageName" name="page" value="chorecontrolpanel" />
    <div class="login screen">
        <div class="section section-2">
            <div class="container container-2">
                <h1 class="title-2 valign-text-middle title-4 roboto-bold-black-40px">The Siuu Chore Management System</h1>
                <button class="button-1 button-2 primary-1 primary-2" id="toggleCreateChoreForm">
                    <div class="title title-4 roboto-medium-white-16px">Create New Chore</div>
                </button>
                <!--Note to self: Take out condition inversion after testing-->

                <?php if (isLoggedIn()) : ?>
                    <div class="section-1 section-2">
                        <div class="container-1 container-2">
                            <div class="title-3 title-4 roboto-bold-black-40px">Chore List </div>
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
                                        echo "<td><a href=\"../admin/edit_chore_view.php?id={$chore['cid']}\">📝</a><a href=\"../action/delete_chore_action.php?id={$chore['cid']}\">🚮</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <form action="./../action/add_chore_action.php" method="POST" id="createChoreForm" name="createChoreForm" style="display: none;">
                        <div class="section-1 section-2">
                            <div class="container-1 container-2">
                                <div class="title-3 title-4 roboto-bold-black-40px">Create Chore</div>
                                <div class="input">
                                    <label for="choreName" class="title-1 title-4 roboto-medium-black-14px">Chore Name</label>
                                    <input type="text" id="choreName" name="choreName" class="textfield" placeholder="Enter the name of the chore" required>
                                </div>
                                <button type="submit" class="button-1 button-2 primary-1 primary-2">
                                    <div class="title title-4 roboto-medium-white-16px">Create Chore</div>
                                </button>
                            </div>
                        </div>
                    </form>

                    <img class="vector-200" src="../img/vector-200-4.png" alt="Vector 200" />
            </div>
        </div>

    <?php else : ?>
        <p>Please log in to access this page.</p>
    <?php endif; ?>
</body>
<script>
    document.getElementById('toggleCreateChoreForm').addEventListener('click', function() {
        var form = document.getElementById('createChoreForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
        if (form.style.display === 'block') {
            form.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
</script>

</html>