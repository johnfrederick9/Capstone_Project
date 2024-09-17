<?php
session_start();
require 'database.php';

if (isset($_SESSION["user_id"]) && isset($_POST["theme"])) {
    $id = $_SESSION["user_id"];
    $theme = $_POST["theme"];
    
    // Update the user's theme preference in the database
    $query = "UPDATE tb_user SET theme = '$theme' WHERE user_id = $id";
    if (mysqli_query($conn, $query)) {
        $_SESSION["theme"] = $theme; // Update session theme
        echo "Theme preference saved.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "No theme preference provided or user not logged in.";
}
?>
