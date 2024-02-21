<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, maximum-scale=1.0" />
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />
    <link rel="stylesheet" type="text/css" href="../css/register.css" />
    <link rel="stylesheet" type="text/css" href="../css/styleguide.css" />
    <link rel="stylesheet" type="text/css" href="../css/globals.css" />
    <title>Sign Up</title>
</head>

<body style="margin: 0; background: #f7f0f0">
    <input type="hidden" id="anPageName" name="page" value="register" />
    <div class="register roboto-bold-melon-40px screen">
        <div class="section">
            <div class="container">
                <h1 class="title title-4 roboto-bold-melon-40px">Register</h1>
                <div class="description roboto-normal-black-16px">Create a new account</div>
                <div class="button-2">
                    <a href="../login/Login_view.php">
                        <div class="seconday">
                            <div class="title-3 title-4">Login</div>
                        </div>
                    </a>
                    <div class="primary-2">
                        <div class="title-1 title-4 roboto-medium-white-16px">Register</div>
                    </div>
                </div>
            </div>
            <img class="vector-200" src="../img/vector-200-5.png" alt="Vector 200" />
        </div>
        <form action="./../action/register_user_action.php" method="POST" id="registerForm" name="registerForm">
            <div class="section">
                <div class="container">
                    <div class="title title-4">Personal Information</div>
                    <div class="input">
                        <div class="title-2 title-4 roboto-medium-black-14px">First Name</div>
                        <div class="textfield"><input type="text" class="text text-2 roboto-normal-black-14px" placeholder="Enter your first name" name="firstName" id="firstName" required pattern="[a-zA-Z\- ]+"></div>
                    </div>
                    <div class="input">
                        <div class="title-2 title-4 roboto-medium-black-14px">Last Name</div>
                        <div class="textfield"><input type="text" class="text text-2 roboto-normal-black-14px" placeholder="Enter your last name" name="lastName" id="lastName" required pattern="[a-zA-Z\- ]+"></div>
                    </div>
                    <div class="selection">
                        <div class="title-2 title-4 roboto-medium-black-14px">Gender</div>
                        <div class="chip-group">
                            <div class="chip"><input type="radio" name="gender" value="male" id="male" required>
                                <div class="text-1 text-2 roboto-normal-black-14px-2">Male</div>
                            </div>
                            <div class="chip"><input type="radio" name="gender" value="female" id="female" required>
                                <div class="text-1 text-2 roboto-normal-black-14px-2">Female</div>
                            </div>
                        </div>
                    </div>
                    <div class="input">
                        <div class="title-2 title-4 roboto-medium-black-14px">Family Role</div>
                        <div class="dropdown">
                            <select name="familyRole" id="familyRole" required>
                                <option value="" disabled selected>Select Family Role</option>
                                <?php
                                include '../functions/select_role_fxn.php';
                                echo selectRoleDropdown();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="input">
                        <div class="title-2 title-4 roboto-medium-black-14px">Date of Birth</div>
                        <div class="textfield"><input type="date" class="text text-2 roboto-normal-black-14px" placeholder="Enter your date of birth" name="dob" id="dob" required max="<?php echo date('Y-m-d'); ?>"></div>
                    </div>
                    <div class="input">
                        <div class="title-2 title-4 roboto-medium-black-14px">Phone Number</div>
                        <div class="textfield"><input type="tel" class="text text-2 roboto-normal-black-14px" placeholder="Enter your phone number" name="phoneNumber" id="phoneNumber" required pattern="[0-9]{10}"></div>
                    </div>
                </div>
                <img class="vector-200" src="../img/vector-200-5.png" alt="Vector 200" />
            </div>
            <div class="section">
                <div class="container">
                    <div class="title title-4">Account Information</div>
                    <div class="input">
                        <div class="title-2 title-4 roboto-medium-black-14px">Email</div>
                        <div class="textfield"><input type="email" class="text text-2 roboto-normal-black-14px" placeholder="Enter your email" name="email" id="email" required></div>
                    </div>
                    <div class="input">
                        <div class="title-2 title-4 roboto-medium-black-14px">Password</div>
                        <div class="textfield"><input type="password" class="text text-2 roboto-normal-black-14px" placeholder="Enter your password" name="password" id="password" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$"></div>
                    </div>
                    <div class="input">
                        <div class="title-2 title-4 roboto-medium-black-14px">Retype Password</div>
                        <div class="textfield"><input type="password" class="text text-2 roboto-normal-black-14px" placeholder="Retype your password" name="retypePassword" id="retypePassword" required oninput="checkPasswordMatch()"></div>
                    </div>
                    <div class="">
                        <div class="">
                            <button type="submit" class="primary primary-2 button button-2 title-1 title-4 roboto-medium-white-16px">Register</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    function checkPasswordMatch() {
        var password = document.getElementById("password").value;
        var retypePassword = document.getElementById("retypePassword").value;

        if (password != retypePassword) {
            document.getElementById("retypePassword").setCustomValidity("Passwords do not match");
        } else {
            document.getElementById("retypePassword").setCustomValidity('');
        }
    }
</script>

</html>