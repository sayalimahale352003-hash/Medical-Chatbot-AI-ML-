<?php
session_start();
require_once "database.php"; // Adjust the path to your database connection script

if (!isset($_SESSION["user"])) {
    http_response_code(403); // Forbidden
    exit();
}

$user_id = $_SESSION["user"];
$sql = "SELECT search_query, search_time FROM search_history WHERE user_id = ? ORDER BY search_time DESC";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    http_response_code(500); // Internal Server Error
    exit();
}
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$history = [];
while ($row = mysqli_fetch_assoc($result)) {
    $history[] = $row;
}

header('Content-Type: application/json');
echo json_encode($history);
?>
