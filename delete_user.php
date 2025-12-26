<?php
require_once __DIR__ . '/PHPLogicPages/UsersLogic.php';

if (isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']); // sanitize input

    // Call the delete function
    if (DeleteUser($user_id)) {
        // Redirect back to users page after deletion
        header("Location: users.php?deleted=1");
        exit;
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "Invalid request.";
}
?>
