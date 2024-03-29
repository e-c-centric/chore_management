<?php
include '../settings/core.php';
include '../action/get_a_chore_action.php';

checkLogin();

if (checkUserRole()==3){
    header("Location: ./../view/home_view.php");
    exit();
}

if (isset($_GET['id'])) {
    $choreId = $_GET['id'];
    $chore = getChoreById($choreId);
} else {
    header("Location: chore_control_view.php?choreNotFound=true");
    exit();
}
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
    <title>Edit Chore Panel</title>
</head>

<body>
    <input type="hidden" id="anPageName" name="page" value="editchorepanel" />
    <div class="login screen">
        <div class="section section-2">
            <div class="container container-2">
                <h1 class="title-2 valign-text-middle title-4 roboto-bold-black-40px">The Siuu Chore Management System</h1>

                <?php if (isLoggedIn()) : ?>
                    <div class="section-1 section-2">
                        <div class="container-1 container-2">
                            <div class="title-3 title-4 roboto-bold-black-40px">Edit Chore </div>
                        </div>
                    </div>
                    <form action="../action/edit_a_chore_action.php" id="editChoreForm" name="editChoreForm" method="POST">
                        <input type="hidden" name="choreId" value="<?php echo $chore['cid']; ?>">

                        <div class="section-1 section-2">
                            <div class="container-1 container-2">
                                <!--<div class="title-3 title-4 roboto-bold-black-40px">Edit Chore</div>-->
                                <div class="input">
                                    <label for="choreName" class="title-1 title-4 roboto-medium-black-14px">Chore Name: </label>
                                    <input type="text" id="choreName" name="choreName" class="textfield" placeholder="Enter the new name of the chore" required>
                                </div>
                                <button type="submit" class="button-1 button-2 primary-1 primary-2">
                                    <div class="title title-4 roboto-medium-white-16px">Update Chore</div>
                                </button>
                            </div>
                        </div>
                    </form>

                    <img class="vector-200" src="../img/vector-200-4.png" alt="Vector 200" />
            </div>
        </div>

    <?php else : ?>
        <script>
        alert("Login to access this page");
        window.location.href = "./../login/login_view.php";
        </script>
    <?php endif; ?>

    <script>
            document.getElementById("editChoreForm").addEventListener("submit", function(event) {
                event.preventDefault();
                var form = event.target;
                var formData = new FormData(form);

                fetch(form.action, {
                        method: form.method,
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = "chore_control_view.php";
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>

</body>

</html>