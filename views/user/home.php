<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['isAuthenticated']) || $_SESSION['isAuthenticated'] !== true) {
    header("Location: /vending-machine/views/login.php");
    exit;
}

echo "Welcome, user " . htmlspecialchars($_SESSION['username']) . "!";
?>

<form action="/vending-machine/app/handler/authHandler.php" method="POST">
    <input type="hidden" name="action" value="logout">
    <button type="submit">logout</button>
</form>