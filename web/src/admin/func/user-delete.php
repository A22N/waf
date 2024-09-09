<?php
session_start();
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin" &&
    $_GET['ID']
) {
    $id = $_GET['ID'];
    include_once("./func/user.php");
    include_once("../DB_Config/connectDB.php");
    $name = getUserNameByID($conn, $id);
    $sql1 = "INSERT INTO history(User_ID,User,Event_ID) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql1);
    $stmt->execute([$_SESSION["ID"], $name, 11]);
    $user = deleteByIdUser($conn, $id);
?>
<?php } else {
    header("Location:404.php");
    exit;
}
?>