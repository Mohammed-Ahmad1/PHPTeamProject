<?php
require_once __DIR__ . '/../includes/config.php';

function ListAllAdmins()
{
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users where role='admin' and email ='admin@gmail.com'");
    $stmt->execute();

    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conn->close();

    return $users;
}



