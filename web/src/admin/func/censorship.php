<?php
session_start();
include_once "../../DB_Config/connectDB.php"; // Ensure the case matches your directory name
include_once "./post.php";

if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin" &&
    isset($_GET['ID']) &&
    isset($_GET['action']) // Check for action parameter
) {
    $id = $_GET['ID'];
    $action = $_GET['action']; // Get the action from URL
    $name = getPostNamebyID($conn, $id);

    // Insert into history
    $sql1 = "INSERT INTO history(User_ID, Post_Tittle, Event_ID) VALUES (?, ?, ?)";
    $stmt1 = $conn->prepare($sql1);

    if ($action === 'accept') {
        $stmt1->execute([$_SESSION['ID'], $name, 4]); // Event_ID for accept
        $result = acceptPost($conn, $id);
    } elseif ($action === 'deny') {
        $stmt1->execute([$_SESSION['ID'], $name, 5]); // Event_ID for deny
        $result = denyPost($conn, $id);
    } else {
        header("Location:../404.php");
        exit;
    }
} else {
    header("Location:../404.php");
    exit;
}
