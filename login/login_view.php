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
    <title>Login</title>
</head>

<body>
    <input type="hidden" id="anPageName" name="page" value="login" />
    <div class="login screen">
        <div class="section section-2">
            <div class="container container-2">
                <h1 class="title-2 valign-text-middle title-4 roboto-bold-black-40px">The Siuu Chore Management System</h1>
                <p class="description roboto-normal-black-16px">Log in to your account</p>
                <div class="button-2">
                    <a href="../login/register_view.php">
                        <div class="seconday">
                            <div class="title title-4 roboto-medium-black-16px">Register</div>
                        </div>
                    </a>
                    <div class="primary-2">
                        <div class="title title-4 roboto-medium-white-16px">Sign in</div>
                    </div>
                </div>
            </div>
            <img class="vector-200" src="../img/vector-200-3.png" alt="Vector 200" />
        </div>
        <form action="./../action/login_user_action.php" method="POST" id="loginForm" name="loginForm">
            <div class="section-1 section-2">
                <div class="container-1 container-2">
                    <div class="title-3 title-4 roboto-bold-black-40px">Login</div>
                    <div class="input">
                        <label for="email" class="title-1 title-4 roboto-medium-black-14px">Email</label>
                        <input type="email" id="email" name="email" class="textfield" placeholder="Enter your email" required>
                        <div class="info">Valid email address required</div>
                    </div>
                    <div class="input">
                        <label for="password" class="title-1 title-4 roboto-medium-black-14px">Password</label>
                        <input type="password" id="password" name="password" class="textfield" placeholder="Enter your password" minlength="8" required>
                        <div class="info">Password must be at least 8 characters</div>
                    </div>
                    <button type="submit" class="button-1 button-2 primary-1 primary-2">
                        <div class="title title-4 roboto-medium-white-16px">Sign in</div>
                    </button>
                </div>
            </div>
        </form>

        <img class="vector-200" src="../img/vector-200-4.png" alt="Vector 200" />
    </div>
    </div>
</body>

</html>