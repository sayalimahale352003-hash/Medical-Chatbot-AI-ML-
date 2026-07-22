<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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
            $userName = '';
            $email = '';
            $errors = array();

            if (isset($_POST["submit"])) {
                $userName = $_POST["Username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                if (empty($userName) || empty($email) || empty($password)) {
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
                if (strlen($password) < 8) {
                    array_push($errors, "Password must be at least 8 characters long");
                }

                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    die("SQL error");
                }
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $rowCount = mysqli_stmt_num_rows($stmt);
                if ($rowCount > 0) {
                    array_push($errors, "Email already exists!");
                }

                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
                    }
                } else {
                    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, "sss", $userName, $email, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>You are registered successfully.</div>";
                    } else {
                        die("Something went wrong");
                    }
                }
            }
            ?>
            <form action="registration.php" method="post">
                <div class="form-group">
                    <h2>Register Here</h2>
                    <input type="text" class="form-control" name="Username" value="<?php echo isset($userName) ? htmlspecialchars($userName) : ''; ?>" placeholder="User Name:">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" placeholder="Email:">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password:">
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Register" name="submit">
                </div>
            </form>
            <div><p>Already registered? <a href="login.php">Login Here</a></p></div>
        </div>
    </div>
</body>
</html>