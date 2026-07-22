<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: http://127.0.0.1:8000/");
    exit(); // Always use exit() after header redirection
}

$page = 'login'; // To set active link in navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">HealthCare</h2>
            </div>
            <div class="menu">
                <ul>
                    <li class="<?php if ($page == 'about') { echo 'active'; } ?>"><a href="about.php">ABOUT</a></li>
                    <li class="<?php if ($page == 'service') { echo 'active'; } ?>"><a href="service.php">SERVICE</a></li>
                    <li class="<?php if ($page == 'Resources') { echo 'active'; } ?>"><a href="Resources.php">RESOURCES</a></li>
                </ul>
            </div>
            <div class="search">
                <input class="srch" type="search" name="" placeholder="Type to search">
                <a href="#"><button class="btn">Search</button></a>
            </div>
        </div>
        <div class="container">
            <?php
            $email = '';
            $errors = array();

            if (isset($_POST["submit"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                if (empty($email) || empty($password)) {
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    die("SQL error");
                }
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user = mysqli_fetch_assoc($result);
                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        $_SESSION["user"] = $user["id"];
                        // Redirect to the chatbot interface after successful login
                        header("Location: http://127.0.0.1:8000/");
                        exit();
                    } else {
                        array_push($errors, "Incorrect password");
                    }
                } else {
                    array_push($errors, "No user found with this email");
                }
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
                }
            }
            ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <h2>Login Here</h2>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email:">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password:">
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Login" name="submit">
                </div>
            </form>
            <div><p>Not registered yet? <a href="registration.php">Register Here</a></p></div>
        </div>
    </div>
</body>
</html>