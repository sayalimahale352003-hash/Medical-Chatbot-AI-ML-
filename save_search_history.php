<?php
session_start();
require_once "database.php"; // Adjust the path to your database connection script

if (!isset($_SESSION["user"])) {
    http_response_code(403); // Forbidden
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION["user"];
    $query = $_POST['query'];

    // Prepare and execute SQL statement to insert search query
    $sql = "INSERT INTO search_history (user_id, search_query) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        http_response_code(500); // Internal Server Error
        exit();
    }
    mysqli_stmt_bind_param($stmt, "is", $user_id, $query);
    mysqli_stmt_execute($stmt);

    // Check if insertion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo json_encode(["status" => "success"]);
    } else {
        http_response_code(500); // Internal Server Error
    }
} else {
    http_response_code(405); // Method Not Allowed
}
?>
